<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class CategoriaController extends Controller
{
    public function index(){
        $categorias = DB::select('SELECT * FROM categoria ');
        return view('categoria.index',  ['listado' => $categorias]);
       
    }
    public function show($id,  $nombre){
         return view('categoria.show' , ['categoria' =>$id, $nombre]);
    }
      /**
     * Show the form for creating a new resource.
     */
    public function listar(){
        $categorias = DB::select('SELECT * FROM categoria ');
        return view('categoria.vercategorias',  ['listado' => $categorias]);
       
    }
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
    public function edit(CategoriaController $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoriaController $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoriaController $categoria)
    {
        //
    }
}
?>