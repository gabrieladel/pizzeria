<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class VendedorController extends Controller
{
    // Listar vendedores
    public function index()
    {
   
   // Buscamos todos los usuarios con rol sea 'admin'
    // Cargamos la relación 'persona' y, dentro de persona, la relación 'vendedor'
    $vendedores = User::where('roles', 'admin')
        ->with(['persona.vendedor'])
        ->get();

    return view('vendedores.index', compact('vendedores'));
    }
    public function create()
    {
        return view('vendedores.create'); 
    }
    // Formulario de edición
    public function edit($id)
    {
         // Buscamos al Usuario Admin
            $usuario = User::with('persona.vendedor')->findOrFail($id);
            return view('vendedores.edit', compact('usuario'));
    }

   public function update(Request $request, $id)
{
    // 1. Validar datos
    $request->validate([
        'nombre'   => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'telefono' => 'nullable|string|max:20',
        'legajo'   => 'required|string',
    ]);

    DB::transaction(function () use ($request, $id) {
        // A. Actualizar Usuario (Nombre)
        $usuario = User::findOrFail($id);
        $usuario->update(['name' => $request->nombre]);

        // B. Actualizar o Crear Persona
        $persona = Persona::updateOrCreate(
            ['user_id' => $id],
            [
                'nombre'   => $request->nombre,
                'apellido' => $request->apellido,
                'telefono' => $request->telefono,
            ]
        );

        // C. Actualizar o Crear Vendedor
        Vendedor::updateOrCreate(
            ['persona_id' => $persona->id],
            ['legajo' => $request->legajo]
        );
    });

    return redirect()->route('vendedores.index')->with('success', 'Datos actualizados correctamente');
}

        // Eliminar el Admin
      public function destroy($id)
{
    DB::transaction(function () use ($id) {
        // Buscamos al usuario 
        $usuario = User::findOrFail($id);

        // Si tiene una persona asociada, buscamos su registro de vendedor
        if ($usuario->persona && $usuario->persona->vendedor) {
            // Borramos SOLO el legajo (tabla vendedores)
            // Esto lo quita de esta lista, pero mantiene a la Persona y sus Pedidos
            $usuario->persona->vendedor->delete();
        }

        // 3. Cambiamos su rol en la tabla 'users' a 'cliente'
        // Con esto no tendrá acceso a las funciones de admin
        $usuario->update([
            'roles' => 'cliente'
        ]);
    });

    return redirect()->route('vendedores.index')
        ->with('success', 'Acceso administrativo revocado. El usuario ahora es un cliente y se mantuvieron sus pedidos.');
}
}
