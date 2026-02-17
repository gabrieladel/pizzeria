<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = DB::select('SELECT * FROM productos');
        
        return view('Producto.verProductos', ['listado' => $productos]);
    }

public function tienda()
{
    $productos = DB::select('SELECT * FROM productos');
    return view('Producto.index', ['listado' => $productos]);
}


    /* Guarda un nuevo producto*/
    public function store(Request $request)
    {
        try {
          
            $sql = DB::insert("INSERT INTO productos(categoria_id, nombre, imagen, descripcion, precio) VALUES(?,?,?,?,?)", [
                $request->txtcategoria,
                $request->txtnombre,
                $request->txtimagen,
                $request->txtdescripcion,
                $request->txtprecio
            ]);
            return back()->with("correcto", "Producto registrado correctamente");
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error al registrar: " . $th->getMessage());
        }
    }

    /*Actualiza*/
    public function update(Request $request, $id)
    {
        try {
            $sql = DB::update("UPDATE productos SET categoria_id=?, nombre=?, imagen=?, descripcion=?, precio=? WHERE id=?", [
                $request->txtcategoria,
                $request->txtnombre,
                $request->txtimagen,
                $request->txtdescripcion,
                $request->txtprecio,
                $id // Usamos el ID que viene por la URL desde el formulario
            ]);
            
            return back()->with("correcto", "Producto modificado correctamente");
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error al modificar");
        }
    }

    /* Elimina */
    public function destroy($id)
    {
        try {
            $sql = DB::delete("DELETE FROM productos WHERE id = ?", [$id]);
            return back()->with("correcto", "Producto eliminado correctamente");
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error al eliminar");
        }
    }

   
    public function show($id)
    {
        $producto = DB::select('SELECT * FROM productos WHERE id = ?', [$id]);
        return view('Producto.show', ['producto' => $producto[0] ?? null]);
    }
}
