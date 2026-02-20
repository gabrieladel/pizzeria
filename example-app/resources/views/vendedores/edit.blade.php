@extends('adminlte::page')

@section('title', 'Editar Administrador')

@section('content_header')
    <h1>Editar Datos: {{ $usuario->name }}</h1>
@stop

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Modificar información de perfil</h3>
        </div>
        <form method="POST" action="{{ route('vendedores.update', $usuario->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control"
                            value="{{ $usuario->persona->nombre ?? $usuario->name }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Apellido</label>
                        <input type="text" name="apellido" class="form-control"
                            value="{{ $usuario->persona->apellido ?? '' }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="form-control"
                        value="{{ $usuario->persona->telefono ?? '' }}">
                </div>

                <div class="form-group">
                    <label>Legajo</label>
                    <input type="text" name="legajo" class="form-control"
                        value="{{ $usuario->persona->vendedor->legajo ?? '' }}" required>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                <a href="{{ route('vendedores.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@stop
