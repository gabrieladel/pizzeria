<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        $Pedido = Pedido::all();
        return view('Pedido.index', compact('Pedido'));
    }

     public function listar()
   {
      
    $listado = DB::table('pedidos')
        ->join('clientes', 'pedido.cliente_id', '=', 'cliente.id')
        ->join('personas', 'cliente.persona', '=', 'persona.id')
        ->join('productos', 'pedido.producto_id', '=', 'producto.id')
        ->select(
            'pedidos.*', 
            'personas.nombre as nombre_cliente', 
            'productos.nombre as nombre_producto' 
        )
        ->get();

    return view('pedidos.verPedidos', compact('listado'));

   }
   

   public function delete($id)
{
    $eliminado = DB::table('pedidos')->where('id', $id)->delete();

    if ($eliminado) {
        return back()->with("correcto", "Pedido eliminado correctamente");
    } else {
        return back()->with("incorrecto", "No se pudo eliminar el pedido");
    }
}

}
