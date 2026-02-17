@extends('adminlte::page')

@section('title', 'Listado de Pedidos')

@section('content_header')
    <h1>Gestión de Pedidos</h1>
@stop

@section('content')
<div class="container-fluid">

    {{-- Mensajes --}}
    @if (session("correcto"))
        <div class="alert alert-success">
            {{ session("correcto") }}
        </div>
    @endif

    @if (session("incorrecto"))
        <div class="alert alert-danger">
            {{ session("incorrecto") }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Pedidos Activos</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Productos</th>
                        <th>Total</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>

                            <td>
                                {{ $pedido->cliente->persona->nombre ?? 'Sin cliente' }}
                                {{ $pedido->cliente->persona->apellido ?? '' }}
                            </td>

                            <td>
                                @forelse($pedido->detalles as $detalle)
                                    <div>
                                        <strong>
                                            {{ $detalle->producto->nombre ?? 'Sin producto' }}
                                        </strong>
                                        <br>
                                        Cant: {{ $detalle->cantidad }}
                                        <br>
                                        ${{ $detalle->precio_unitario }}
                                        <hr class="m-1">
                                    </div>
                                @empty
                                    <span class="text-muted">Sin detalles</span>
                                @endforelse
                            </td>

                            <td>
                                ${{ $pedido->total }}
                            </td>

                            <td class="text-center">

                                {{-- Ver --}}
                                <a href="{{ route('pedidos.show', $pedido->id) }}" 
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Editar --}}
                                <a href="{{ route('pedidos.edit', $pedido->id) }}" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Eliminar --}}
                                <form action="{{ route('pedidos.destroy', $pedido->id) }}" 
                                      method="POST" 
                                      style="display:inline;"
                                      onsubmit="return confirm('¿Seguro que desea eliminar este pedido?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                No hay pedidos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    console.log('Vista cargada correctamente.');
</script>
@stop

