<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class PersonaController extends Controller
{
    public function index(){
        $personas = DB::select('SELECT * FROM persona ');
        return view('persona.index', ['listado' => $personas]);
    }
    
    public function show($id, $nombre, $telefono){
         return view('persona.show' , ['persona' => $id, $nombre, $telefono]);
    }
}
?>
