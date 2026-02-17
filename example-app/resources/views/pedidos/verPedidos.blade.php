@extends('adminlte::page')

@section('content')
    <h2 class="p-3">Gestión Integral de Pedidos</h2>

    @if (session("correcto"))
        <div class="alert alert-success">{{ session("correcto") }}</div>
    @endif
    @if (session("incorrecto"))
        <div class="alert alert-danger">{{ session("incorrecto") }}</div>
    @endif

    <div class="p-4">
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalRegistrar">
            <i class="fas fa-plus"></i> Nuevo Pedido
        </button>
        
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Productos (Detalle)</th>
                            <th>Total</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $item)
                            <tr>
                                <td><span class="badge badge-secondary">#{{ $item->id }}</span></td>
                                <td>{{ date('d/m/Y H:i', strtotime($item->fecha)) }}</td>
                                <td>
                                    <strong>{{ $item->cliente->persona->nombre }} {{ $item->cliente->persona->apellido }}</strong>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $item->vendedor->persona->nombre ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    @foreach($item->detalles as $detalle)
                                        <div class="small">
                                            • {{ $detalle->producto->nombre }} 
                                            <span class="badge badge-info">x{{ $detalle->cantidad }}</span>
                                        </div>
                                    @endforeach
                                </td>
                                <td><strong class="text-success">${{ number_format($item->total, 2) }}</strong></td>
                                
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar{{ $item->id }}" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <form action="{{ route('pedidos.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Eliminar pedido?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Modificar Detallado -->
                            <div class="modal fade" id="modalEditar{{ $item->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-warning">
                                            <h5 class="modal-title">Actualizar Pedido #{{ $item->id }}</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <form action="{{ route('pedidos.update', $item->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Cliente</label>
                                                        <select name="cliente_id" class="form-control">
                                                            @foreach($clientes as $c)
                                                                <option value="{{ $c->id }}" {{ $item->cliente_id == $c->id ? 'selected' : '' }}>
                                                                    {{ $c->persona->nombre }} {{ $c->persona->apellido }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Vendedor</label>
                                                        <select name="vendedor_id" class="form-control">
                                                            @foreach($vendedores as $v)
                                                                <option value="{{ $v->id }}" {{ $item->vendedor_id == $v->id ? 'selected' : '' }}>
                                                                    {{ $v->persona->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mt-3 p-2 bg-light border rounded">
                                                    <h6><i class="fas fa-info-circle"></i> Info de Pago</h6>
                                                    <p class="mb-0">Monto actual: <strong>${{ number_format($item->total, 2) }}</strong></p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

       <div class="modal fade" id="modalRegistrar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Registrar Nuevo Pedido</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('pedidos.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Cliente</label>
                                <select name="cliente_id" class="form-control" required>
                                    @foreach($clientes as $c)
                                        <option value="{{ $c->id }}">{{ $c->persona->nombre }} {{ $c->persona->apellido }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Vendedor</label>
                                <select name="vendedor_id" class="form-control" required>
                                    @foreach($vendedores as $v)
                                        <option value="{{ $v->id }}">{{ $v->persona->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h6><i class="fas fa-pizza-slice"></i> Detalle del Producto</h6>
                        <div class="row">
                            <div class="col-md-8 form-group">
                                <label>Producto</label>
                                <select name="producto_id" class="form-control" required>
                                    @foreach($productos as $p)
                                        <option value="{{ $p->id }}">{{ $p->nombre }} - ${{ number_format($p->precio, 2) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Cantidad</label>
                                <input type="number" name="cantidad" class="form-control" value="1" min="1" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Pedido</button>
                    </div>
                </form>
            </div>
        </div>
@stop
