<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    public function index()
    {
        $listado = Producto::all();
        $categorias = Categoria::all(); // <--- 2. CARGAR LAS CATEGORÍAS
        
        // 3. PASAR AMBAS VARIABLES A LA VISTA
        return view('Producto.verProductos', compact('listado', 'categorias'));
    }

    public function tienda()
    {
        $productos = DB::select('SELECT * FROM productos');
        return view('Producto.index', ['listado' => $productos]);
    }


    /* Guarda un nuevo producto*/
   public function store(Request $request) {
    $producto = new Producto();
    $producto->nombre = $request->txtnombre;
    $producto->categoria_id = $request->txtcategoria;
    $producto->descripcion = $request->txtdescripcion;
    $producto->precio = $request->txtprecio;

    if ($request->hasFile('txtimagen')) {
        // Guarda el archivo físico en storage/app/public
        $path = $request->file('txtimagen')->store('public');
        // Guarda solo el nombre en la BD
        $producto->imagen = basename($path);
    }

    $producto->save();
    return back()->with("correcto", "Producto registrado");
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
