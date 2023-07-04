<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class PedidoController extends Controller
{
    public function index(){
        $pedidos = DB::select('SELECT * FROM pedido ');
        return view('pedido.index', ['listado' => $pedidos]);
    }
    public function show($id, $vendedor,$cliente, $fecha, $producto, $cantidad, $total){
         return view('pedido.show' , ['pedido' => $id, $vendedor,$cliente, $fecha, $producto, $cantidad, $total]);
    }
}
?>