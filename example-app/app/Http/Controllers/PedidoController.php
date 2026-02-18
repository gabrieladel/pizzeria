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
                'detallePedidos'  => $pedido->detalles,
                'subtotal'        => $subtotal,
                'iva'             => $iva,
                'total'           => $total
            ];

            $pdf = Pdf::loadView('factura.pdf', $data);
            $pdfPath = storage_path('app/public/facturas/factura_' . $nroFactura . '.pdf');
            
            if (!file_exists(dirname($pdfPath))) mkdir(dirname($pdfPath), 0755, true);
            $pdf->save($pdfPath);

            // Verificación de email para evitar error de encabezado vacío
            if ($pedido->cliente && $pedido->cliente->persona && !empty($pedido->cliente->persona->email)) {
                try {
                    Mail::to($pedido->cliente->persona->email)->send(new FacturaMail($pedido, $pdfPath));
                } catch (\Exception $e) {
                    session()->flash('incorrecto', 'Factura creada pero el correo no pudo enviarse.');
                }
            } else {
                session()->flash('incorrecto', 'Factura generada. El cliente no tiene un correo válido.');
            }

            DB::commit();
            return $pdf->download('factura_' . $nroFactura . '.pdf');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('incorrecto', 'Error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            if (!$request->productos || count($request->productos) == 0) {
                return back()->with('incorrecto', 'Debe seleccionar al menos un producto.');
            }

            $pedido = Pedido::create([
                'cliente_id' => $request->cliente_id,
                'vendedor_id' => $request->vendedor_id,
                'fecha' => now(),
                'estado' => 'pendiente',
                'total' => 0 
            ]);

            $totalPedido = 0;

            foreach ($request->productos as $index => $producto_id) {
                $producto = Producto::findOrFail($producto_id);
                $cantidad = $request->cantidades[$index];
                $subtotal = $producto->precio * $cantidad;

                DetallePedido::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $producto_id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $producto->precio,
                    'subtotal' => $subtotal,
                ]);

                $totalPedido += $subtotal;
            }

            $pedido->update(['total' => $totalPedido]);

            DB::commit();
            return redirect()->route('pedidos.index')->with('correcto', 'Pedido creado con éxito.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('incorrecto', 'Error al guardar: ' . $e->getMessage());
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