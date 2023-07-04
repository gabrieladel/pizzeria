<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
class ProductoController extends Controller
{
    public function index(){
        return "controller productos";
    }
    public function show($id, $nombre, $precio){
         return view('producto.show' , ['producto' =>$id, $nombre, $precio]);
    }
}
?>