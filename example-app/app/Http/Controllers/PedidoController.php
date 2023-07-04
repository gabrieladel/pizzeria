<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
class PedidoController extends Controller
{
    public function index(){
        return "controller pedido";
    }
    public function show($id, $vendedor,$cliente, $fecha, $producto, $cantidad, $total){
         return view('pedido.show' , ['pedido' => $id, $vendedor,$cliente, $fecha, $producto, $cantidad, $total]);
    }
}
?>