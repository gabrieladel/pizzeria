@extends('adminlte::page')

@section('content')
    <div class="container">
        <h2>Lista de Clientes</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>CUIL</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->persona->nombre }}</td>
                        <td>{{ $cliente->persona->apellido }}</td>
                        <td>{{ $cliente->persona->telefono }}</td>
                        <td>{{ $cliente->cuil }}</td>
                        <td>
                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">
                                Editar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
