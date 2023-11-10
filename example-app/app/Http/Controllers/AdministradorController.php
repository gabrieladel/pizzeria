<?php

namespace App\Http\Controllers;
use App\Http\Middleware;

use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    //
    public function __construct(){
        $this->Middleware("esAdmin");
    }

    public function index(){

        return "si llegaste aca tenes rol de admin";
    }
}
