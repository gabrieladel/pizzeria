<?php
   namespace App\Http\Controllers;
   use App\Http\Controllers\Controller;
   class VendedorController extends Controller
   {
       public function index(){
           return "controller vendedor";
       }
       public function show($id, $cuil, $resp, $persona){
            return view('vendedor.show' , ['vendedor' => $id, $cuil, $resp, $persona]);
       }
   }
?>