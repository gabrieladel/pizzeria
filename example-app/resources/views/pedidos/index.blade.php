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
                            <th>Estado</th> 
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Productos</th>
                            <th>Total (+IVA)</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $item)
                            <tr>
                                <td><span class="badge badge-secondary">#{{ $item->id }}</span></td>
                                <td>
                                    @if($item->estado == 'entregado')
                                        <span class="badge badge-success">Facturado</span>
                                    @else
                                        <span class="badge badge-warning">Pendiente</span>
                                    @endif
                                </td>
                                <td>{{ date('d/m/Y H:i', strtotime($item->fecha)) }}</td>
                                <td>
                                    <strong>{{ $item->cliente->persona->nombre ?? 'N/A' }} {{ $item->cliente->persona->apellido ?? '' }}</strong>
                                </td>
                                <td>
                                    @foreach($item->detalles as $detalle)
                                        <div class="small">
                                            • {{ $detalle->producto->nombre ?? 'Producto borrado' }} 
                                            <span class="badge badge-info">x{{ $detalle->cantidad }}</span>
                                        </div>
                                    @endforeach
                                </td>
                                <td><strong class="text-success">${{ number_format($item->total * 1.21, 2) }}</strong></td>
                                
                                <td class="text-center">
                                    <div class="btn-group">
                                        @if($item->estado != 'entregado')
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalFinalizar{{ $item->id }}">
                                            <i class="fas fa-check-circle"></i> Facturar
                                        </button>
                                        @endif

                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar{{ $item->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <form action="{{ route('pedidos.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            {{-- MODAL FINALIZAR (FACTURAR) --}}
                            <div class="modal fade" id="modalFinalizar{{ $item->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title">Finalizar Pedido #{{ $item->id }}</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <form action="{{ route('pedidos.finalizar', $item->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <p>Cliente: <strong>{{ $item->cliente->persona->nombre ?? 'N/A' }}</strong></p>
                                                <div class="form-group">
                                                    <label>Método de Pago</label>
                                                    <select name="metodo_pago" class="form-control">
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Transferencia">Transferencia</option>
                                                        <option value="Tarjeta">Tarjeta</option>
                                                    </select>
                                                </div>
                                                <div class="alert alert-info">
                                                    Total con IVA: <strong>${{ number_format($item->total * 1.21, 2) }}</strong>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Confirmar y Generar Factura</button>
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

    {{-- MODAL REGISTRAR NUEVO --}}
    <div class="modal fade" id="modalRegistrar" tabindex="-1" role="dialog">
        </div>
@stop