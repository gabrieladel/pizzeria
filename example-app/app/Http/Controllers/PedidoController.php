<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
  /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
?>