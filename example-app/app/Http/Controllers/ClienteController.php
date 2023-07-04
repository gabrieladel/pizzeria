<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
class ClienteController extends Controller
{
    public function index(){
        return "controller cliente";
    }
    public function show($id, $cuil, $resp, $persona){
         return view('cliente.show' , ['cliente' => $id, $cuil, $resp, $persona]);
    }
}
?>