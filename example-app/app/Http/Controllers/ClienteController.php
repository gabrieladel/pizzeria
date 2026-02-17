<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Persona;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Listar clientes
    public function index()
    {
        $clientes = Cliente::with('persona')->get();
        return view('clientes.index', compact('clientes'));
    }

    // Formulario de edición
    public function edit($id)
    {
        $cliente = Cliente::with('persona')->findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    // Actualizar cliente
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'cuil' => 'nullable'
        ]);

        // actualizar persona
        $cliente->persona->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
        ]);

        // actualizar cliente
        $cliente->update([
            'cuil' => $request->cuil
        ]);

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente actualizado correctamente');
    }
}
