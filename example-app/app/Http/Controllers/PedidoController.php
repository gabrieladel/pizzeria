<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Vendedor;
use App\Models\DetallePedido;

class PedidoController extends Controller
{
    // Esta será la única función para mostrar la vista con TODO lo necesario
    public function index()
    {
        $pedidos = Pedido::with([
            'cliente.persona',
            'vendedor.persona',
            'detalles.producto'
        ])->get();

        // Estos datos son OBLIGATORIOS para que los Modales (Crear y Editar) funcionen
        $clientes = Cliente::with('persona')->get();
        $productos = Producto::all();
        $vendedores = Vendedor::with('persona')->get();

        return view('pedidos.verPedidos', compact('pedidos', 'clientes', 'productos', 'vendedores'));
    }

    public function store(Request $request)
    {
        try {
            $pedido = new Pedido();
            $pedido->cliente_id = $request->cliente_id;
            $pedido->vendedor_id = $request->vendedor_id;
            $pedido->fecha = now();
            $pedido->total = 0; 
            $pedido->save();

            $producto = Producto::findOrFail($request->producto_id);
            $subtotalCalculado = $producto->precio * $request->cantidad;

            $detalle = new DetallePedido();
            $detalle->pedido_id = $pedido->id;
            $detalle->producto_id = $request->producto_id;
            $detalle->cantidad = $request->cantidad;
            $detalle->precio_unitario = $producto->precio;
            $detalle->subtotal = $subtotalCalculado; 
            $detalle->save();

            $pedido->update(['total' => $subtotalCalculado]);

            return back()->with("correcto", "Pedido creado con éxito");
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error: " . $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pedido = Pedido::findOrFail($id);
            $pedido->update([
                'cliente_id' => $request->cliente_id,
                'vendedor_id' => $request->vendedor_id
            ]);
            return back()->with("correcto", "Pedido actualizado con éxito");
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error al actualizar");
        }
    }

    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();
        return back()->with("correcto", "Pedido eliminado correctamente");
    }
}
