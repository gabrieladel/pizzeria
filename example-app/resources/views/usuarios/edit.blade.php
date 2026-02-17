@extends('adminlte::page')
@section('content')
<div class="container">
    <h2>Editar Rol de Usuario</h2>

    <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Rol</label>
            <select name="roles" class="form-control">
                <option value="cliente" {{ $usuario->roles == 'cliente' ? 'selected' : '' }}>
                    Cliente
                </option>
                <option value="vendedor" {{ $usuario->roles == 'vendedor' ? 'selected' : '' }}>
                    Vendedor
                </option>
                <option value="admin" {{ $usuario->roles == 'admin' ? 'selected' : '' }}>
                    Administrador
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Actualizar Rol
        </button>
    </form>
</div>
@endsection