@extends('adminlte::page')

@section('title', 'Nuevo Vendedor')

@section('content_header')
    <h1>Registrar Nuevo Vendedor</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos del Administrador</h3>
            </div>
            
            <form method="POST" action="{{ route('vendedores.store') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Ej: Juan" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellido">Apellido</label>
                            <input type="text" name="apellido" class="form-control" placeholder="Ej: Pérez" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" name="telefono" class="form-control" placeholder="12345678" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="legajo">Número de Legajo</label>
                        <input type="text" name="legajo" class="form-control" placeholder="LEG-001" required>
                    </div>

                    {{-- Nota: El controlador debe encargarse de asignar el rol 'admin' al crear el usuario --}}
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('vendedores.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-4">Guardar Vendedor</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop