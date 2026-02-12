@extends('adminlte::page')

@section('title', 'Listado de Pedidos')

@section('content_header')
    <h1>Gestión de Pedidos</h1>
@stop

@section('content')
    <div class="container-fluid">
        @if (session("correcto"))
            <div class="alert alert-success">{{ session("correcto") }}</div>
        @endif
        @if (session("incorrecto"))
            <div class="alert alert-danger">{{ session("incorrecto") }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Pedidos Activos</h3>
                <div class="card-tools">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrar">
                        <i class="fas fa-plus"></i> Añadir pedido
                    </button>
                </div>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead class="bg-dark">
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Producto</th>
                            <th>Total</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($listado as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nombre_cliente }}</td>
                        <td>{{ $item->nombre_producto }}</td>
                        <td><strong>${{ number_format($item->total, 2) }}</strong></td>
                        {{-- ... botones de acción ... --}}
                    </tr>
                @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script> console.log('Vista cargada correctamente.'); </script>
@stop
