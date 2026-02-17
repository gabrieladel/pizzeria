<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    // Listar vendedores
    public function index()
    {
        $vendedores = Vendedor::with('persona')->get();
        return view('vendedores.index', compact('vendedores'));
    }

    // Formulario de edición
    public function edit($id)
    {
        $vendedor = Vendedor::with('persona')->findOrFail($id);
        return view('vendedores.edit', compact('vendedor'));
    }

    // Actualizar vendedor
    public function update(Request $request, $id)
    {
        $vendedor = Vendedor::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'legajo' => 'required'
        ]);

        // actualizar persona
        $vendedor->persona->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
        ]);

        // actualizar vendedor
        $vendedor->update([
            'legajo' => $request->legajo
        ]);

        return redirect()->route('vendedores.index')
                         ->with('success', 'Vendedor actualizado correctamente');
    }
}
