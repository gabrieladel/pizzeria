<?php
namespace App\Http\Controllers;
use App\Models\Cliente;
use Illuminate\Http\Request;
class ClienteController extends Controller
{
    public function index(){
        $cliente=Cliente::all();
        return view('cliente.index',compact('cliente'));
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
        $cliente=new Cliente;
        $cliente->cuil=$request->input('cuil');/**name */
        $cliente->save();
        return redirect()->back();
    }

   


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
     /**
     * Display the specified resource.
     */
    public function show($id, $cuil, $resp, $persona){
         return view('cliente.show' , ['cliente' => $id, $cuil, $resp, $persona]);
    }
}
?>