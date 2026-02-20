@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h2>Editar Rol de Usuario: {{ $usuario->name }}</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="roles">Asignar Rol</label>
                        <select name="roles" id="roles" class="form-control">
                            {{-- Opción para el cliente común --}}
                            <option value="cliente" {{ $usuario->roles == 'cliente' ? 'selected' : '' }}>
                                Usuario
                            </option>

                            {{-- Opción para el administrador --}}
                            <option value="admin" {{ $usuario->roles == 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            Actualizar Rol
                        </button>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
