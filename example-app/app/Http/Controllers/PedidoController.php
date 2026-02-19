<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Factura;
use App\Models\DetallePedido;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Vendedor; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\FacturaMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with(['cliente.persona', 'vendedor.persona', 'detalles.producto'])
                    ->orderBy('id', 'desc')
                    ->get();

        $clientes = Cliente::with('persona')->get();
        $vendedores = Vendedor::with('persona')->get();
        $productos = Producto::all();

        return view('pedidos.index', compact('pedidos', 'clientes', 'vendedores', 'productos'));
    }

    public function show($id)
    {
        return redirect()->route('pedidos.index');
    }

    public function store(Request $request)
{
    // 1. Crear el pedido base
    $pedido = new \App\Models\Pedido();
    $pedido->cliente_id = $request->cliente_id;
    $pedido->vendedor_id = $request->vendedor_id;
    $pedido->fecha = now();
    $pedido->total = 0; // Se calculará sumando los productos
    $pedido->save();

    $totalPedido = 0;

    // 2. Guardar los productos del detalle (los arrays que enviamos desde el modal)
    if ($request->has('productos')) {
        foreach ($request->productos as $key => $producto_id) {
            $producto = \App\Models\Producto::find($producto_id);
            $cantidad = $request->cantidades[$key];
            $subtotal = $producto->precio * $cantidad;

            \App\Models\DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $producto_id,
                'cantidad' => $cantidad,
                'precio_unitario' => $producto->precio,
                'subtotal' => $subtotal
            ]);

            $totalPedido += $subtotal;
        }
    }

    // 3. Actualizar el total real del pedido
    $pedido->update(['total' => $totalPedido]);

    return back()->with("correcto", "¡Pedido #{$pedido->id} registrado con éxito!");
}


   public function finalizarCompraProfesional(Request $request, $pedido_id)
{
    // 1. Evitar duplicados
    $existeFactura = Factura::where('pedido_id', $pedido_id)->first();
    if ($existeFactura) {
        return back()->with('incorrecto', 'Este pedido ya fue facturado.');
    }

    // 2. Cargar datos con sus relaciones
    $pedido = Pedido::with(['cliente.persona', 'detalles.producto'])->findOrFail($pedido_id);

    // 3. Cálculos de montos
    $subtotal = 0;
    foreach ($pedido->detalles as $detalle) {
        $subtotal += ($detalle->cantidad * $detalle->precio_unitario);
    }
    
    $iva = $subtotal * 0.21;
    $total = $subtotal + $iva;

    // 4. Generar número de factura
    $ultimaFactura = Factura::orderBy('id', 'desc')->first();
    $nroFactura = "0001-" . str_pad(($ultimaFactura ? $ultimaFactura->id + 1 : 1), 8, "0", STR_PAD_LEFT);

    DB::beginTransaction();
    try {
        // 5. Guardar en Base de Datos
        $factura = Factura::create([
            'pedido_id'       => $pedido->id,
            'nro_factura'     => $nroFactura,
            'tipo_factura'    => $request->tipo_factura ?? 'B',
            'metodo_pago'     => $request->metodo_pago ?? 'Efectivo',
            'iva'             => $iva,
            'total_facturado' => $total,
            'fecha_emision'   => now(),
        ]);

        $pedido->update(['estado' => 'entregado']);

        // 6. Generar y Guardar PDF físicamente
        $data = [
            'factura'         => $factura,
            'pedido'          => $pedido,
            'detallePedidos'  => $pedido->detalles,
            'subtotal'        => $subtotal,
            'iva'             => $iva,
            'total'           => $total
        ];

        $pdf = Pdf::loadView('factura.pdf', $data);
        $pdfPath = storage_path('app/public/facturas/factura_' . $nroFactura . '.pdf');
        
        if (!file_exists(dirname($pdfPath))) {
            mkdir(dirname($pdfPath), 0755, true);
        }
        $pdf->save($pdfPath);

        // 7. ENVÍO DE EMAIL (Con try-catch interno para no bloquear la descarga)

// Buscamos el email en el usuario vinculado a esa persona
$usuario = \App\Models\User::find($pedido->cliente->persona->user_id);

if ($usuario && !empty($usuario->email)) {
    try {
        Mail::to($usuario->email)->send(new FacturaMail($pedido, $pdfPath));
    } catch (\Exception $e) {
        \Log::error("Error al enviar factura a {$usuario->email}: " . $e->getMessage());
        session()->flash('incorrecto', 'Factura generada, pero el correo falló.');
    }
}

        DB::commit();

        // 8. DESCARGAR EL ARCHIVO (Debe ser el return final)
        return $pdf->download('factura_' . $nroFactura . '.pdf');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('incorrecto', 'Error crítico: ' . $e->getMessage());
    }
}

    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->update($request->all());
        return redirect()->route('pedidos.index')->with('correcto', 'Pedido actualizado.');
    }

    public function destroy($id)
    {
        Pedido::findOrFail($id)->delete();
        return redirect()->route('pedidos.index')->with('correcto', 'Pedido eliminado.');
    }

    public function verFacturas()
    {
        $facturas = Factura::with(['pedido.cliente.persona'])->orderBy('id', 'desc')->get();
        return view('facturas.index', compact('facturas'));
    }
} 