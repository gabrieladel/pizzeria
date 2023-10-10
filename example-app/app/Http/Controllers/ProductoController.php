<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class ProductoController extends Controller
{
    public function index(){
        $productos = DB::select('SELECT * FROM producto ');
        return view('producto.index',  ['listado' => $productos]);
       
    }
    public function show($id, $categoria, $nombre, $imagen, $precio){
         return view('producto.show' , ['producto' =>$id, $categoria, $nombre, $imagen, $precio]);
    }
      /**
     * Show the form for creating a new resource.
     */
    public function listar(){
        $productos = DB::select('SELECT * FROM producto ');
        return view('producto.verProductos',  ['listado' => $productos]);
       
    }
    public function create(Request $request)
    {
     try { 
        $sql = DB::insert(" insert into producto(id,categoria_id,nombre,imagen,descripción,precio)values(null,?,?,?,?,?) ",[
            $request->txtid,
            $request->txtcategoria,
            $request->txtnombre,
            $request->txtimagen,
            $request->txtdescripcion,
            $request->txtprecio
         ]);
     } catch (\Throwable $th) {
        $sql= 0 ;
    } 
     if ($sql == true) {
        return back()->with("correcto","Producto registrado correctamente");
     } else {
        return back()->with("incorrecto","Error al registrar");
     }
     
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
    public function edit(ProductoController $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductoController $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductoController $producto)
    {
        //
    }
}
?>