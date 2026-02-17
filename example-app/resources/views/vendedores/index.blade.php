@extends('adminlte::page')
@section('content')
<div class="container">
    <h2>Lista de Vendedores</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Legajo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendedores as $vendedor)
                <tr>
                    <td>{{ $vendedor->id }}</td>
                    <td>{{ $vendedor->persona->nombre }}</td>
                    <td>{{ $vendedor->persona->apellido }}</td>
                    <td>{{ $vendedor->persona->telefono }}</td>
                    <td>{{ $vendedor->legajo }}</td>
                    <td>
                        <a href="{{ route('vendedores.edit', $vendedor->id) }}" class="btn btn-warning">
                            Editar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection