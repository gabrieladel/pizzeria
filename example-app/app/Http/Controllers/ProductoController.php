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
        $sql=DB::insert(" insert into producto(categoria_id,nombre,imagen,descripción,precio)values(?,?,?,?,?) ",[
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
    public function update(Request $request){
        try { 
           $sql = DB::update(" update producto set categoria_id=?,nombre=?,imagen=?,descripción=?,precio=? where id=? ",[
               $request->txtcategoria,
               $request->txtnombre,
               $request->txtimagen,
               $request->txtdescripcion,
               $request->txtprecio,
               $request->txtid
            ]);
            if ($sql==0){
                $sql=1;
            }
        } catch (\Throwable $th) {
           $sql= 0 ;
       } 
        if ($sql == true) {
           return back()->with("correcto","Producto modificado correctamente");
        } else {
           return back()->with("incorrecto","Error al modificar");
        }
   }
    public function delete($id)
    {
        try { 
            $sql = DB::delete(" delete from producto where id=$id ");
         } catch (\Throwable $th) {
            $sql= 0 ;
        } 
         if ($sql == true) {
            return back()->with("correcto","Producto eliminado correctamente");
         } else {
            return back()->with("incorrecto","Error al eliminar");
         }
    }
}
?>