@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Editar Cliente</h2>

    <form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control"
                   value="{{ $cliente->persona->nombre }}" required>
        </div>

        <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control"
                   value="{{ $cliente->persona->apellido }}" required>
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control"
                   value="{{ $cliente->persona->telefono }}" required>
        </div>

        <div class="mb-3">
            <label>CUIL</label>
            <input type="text" name="cuil" class="form-control"
                   value="{{ $cliente->cuil }}">
        </div>
        
        
        <button type="submit" class="btn btn-primary">
            Actualizar
        </button>
    </form>
</div>
@endsection