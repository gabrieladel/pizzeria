<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Listar usuarios
    public function index()
    {
        $usuarios = User::with('persona')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    // Formulario de edición
    public function edit($id)
    {
        $usuario = User::with('persona')->findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Actualizar usuario
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'roles' => 'required'
        ]);

        $usuario->update([
            'roles' => $request->roles
        ]);

        return redirect()->route('usuarios.index')
                         ->with('success', 'Rol actualizado correctamente');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

   

    /*Remove the specified resource from storage.*/
    public function destroy(string $id)
    {
        //
    }
}
