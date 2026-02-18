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
    /**
     * Muestra el listado de pedidos y carga datos para los modales
     */
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
    {// En app/Http/Controllers/PedidoController.php

    // Si entras aquí por error, te redirigimos al index donde SÍ existe la variable $pedidos
    return redirect()->route('pedidos.index');

        // Si no tienes una vista detallada, redirigimos al index para evitar el error
        // Pero si quieres ver el detalle, asegúrate de tener la vista pedidos.show
        $pedido = Pedido::with(['cliente.persona', 'detalles.producto'])->findOrFail($id);
        return view('pedidos.index', compact('pedido')); 
    }

    /**
     * Finalizar compra y generar factura
     */
    public function finalizarCompraProfesional(Request $request, $pedido_id)
    {
        $existeFactura = Factura::where('pedido_id', $pedido_id)->first();
        if ($existeFactura) {
            return back()->with('incorrecto', 'Este pedido ya fue facturado.');
        }

        $pedido = Pedido::with(['cliente.persona', 'detalles.producto'])->findOrFail($pedido_id);

        $subtotal = 0;
        foreach ($pedido->detalles as $detalle) {
            $subtotal += ($detalle->cantidad * $detalle->precio_unitario);
        }
        
        $iva = $subtotal * 0.21;
        $total = $subtotal + $iva;

        $ultimaFactura = Factura::orderBy('id', 'desc')->first();
        $nroFactura = "0001-" . str_pad(($ultimaFactura ? $ultimaFactura->id + 1 : 1), 8, "0", STR_PAD_LEFT);

        DB::beginTransaction();
        try {
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

          $data = [
        'factura'         => $factura,
        'pedido'          => $pedido,
        'detallePedidos'  => $pedido->detalles, // Asegúrate de que esta variable se use en el PDF
        'subtotal'        => $subtotal,
        'iva'             => $iva,
        'total'           => $total
    ];


            $pdf = Pdf::loadView('factura.pdf', $data);
            $pdfPath = storage_path('app/public/facturas/factura_' . $nroFactura . '.pdf');
            
            if (!file_exists(dirname($pdfPath))) mkdir(dirname($pdfPath), 0755, true);
            $pdf->save($pdfPath);

           
         if ($pedido->cliente && $pedido->cliente->persona && !empty($pedido->cliente->persona->email)) {
    try {
        Mail::to($pedido->cliente->persona->email)->send(new FacturaMail($pedido, $pdfPath));
    } catch (\Exception $e) {
        // Si falla el mail (por configuración de servidor), igual guardamos la factura
        // Solo lanzamos un aviso pero no bloqueamos el proceso
        session()->flash('incorrecto', 'Factura creada pero el correo no pudo enviarse.');
    }
} else {
    // Si no tiene email, notificamos al usuario
    session()->flash('incorrecto', 'La factura se generó, pero el cliente no tiene un correo válido registrado.');
}

DB::commit();
return $pdf->download('factura_' . $nroFactura . '.pdf');


            Mail::to($pedido->cliente->persona->email)->send(new FacturaMail($pedido, $pdfPath));

            DB::commit();
            return $pdf->download('factura_' . $nroFactura . '.pdf');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('incorrecto', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Registrar nuevo pedido (Modal)
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $producto = Producto::findOrFail($request->producto_id);

            $pedido = Pedido::create([
                'cliente_id' => $request->cliente_id,
                'vendedor_id' => $request->vendedor_id,
                'fecha' => now(),
                'estado' => 'pendiente',
                'total' => ($producto->precio * $request->cantidad)
            ]);

            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $request->producto_id,
                'cantidad' => $request->cantidad,
                'precio_unitario' => $producto->precio
            ]);

            DB::commit();
            return redirect()->route('pedidos.index')->with('correcto', 'Pedido creado.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('incorrecto', 'Error al guardar.');
        }
    }

    /**
     * Actualizar pedido (Modal Editar)
     */
    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->update($request->all());
        return redirect()->route('pedidos.index')->with('correcto', 'Pedido actualizado.');
    }

    /**
     * Eliminar pedido
     */
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