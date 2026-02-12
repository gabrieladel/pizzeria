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
      
    $listado = DB::table('pedido')
        ->join('cliente', 'pedido.cliente_id', '=', 'cliente.id')
        ->join('persona', 'cliente.persona', '=', 'persona.id')
        ->join('producto', 'pedido.producto_id', '=', 'producto.id')
        ->select(
            'pedido.*', 
            'persona.nombre as nombre_cliente', 
            'producto.nombre as nombre_producto' 
        )
        ->get();

    return view('pedido.verPedidos', compact('listado'));

   }
   

   public function delete($id)
{
    $eliminado = DB::table('pedido')->where('id', $id)->delete();

    if ($eliminado) {
        return back()->with("correcto", "Pedido eliminado correctamente");
    } else {
        return back()->with("incorrecto", "No se pudo eliminar el pedido");
    }
}

}
