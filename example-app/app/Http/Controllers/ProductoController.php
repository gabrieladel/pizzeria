<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class ProductoController extends Controller
{
    public function index(){
        $productos = DB::select('SELECT * FROM producto ');
        return view('producto.index', ['listado' => $productos]);
    }
    public function show($id, $nombre,$imagen, $precio){
         return view('producto.show' , ['producto' =>$id, $nombre, $precio]);
    }
}
?>