@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Editar Vendedor</h2>

    <form method="POST" action="{{ route('vendedores.update', $vendedor->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control"
                   value="{{ $vendedor->persona->nombre }}" required>
        </div>

        <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control"
                   value="{{ $vendedor->persona->apellido }}" required>
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control"
                   value="{{ $vendedor->persona->telefono }}" required>
        </div>

        <div class="mb-3">
            <label>Legajo</label>
            <input type="text" name="legajo" class="form-control"
                   value="{{ $vendedor->legajo }}" required>
        </div>

        <button type="submit" class="btn btn-primary">
            Actualizar
        </button>
    </form>
</div>
@endsection
