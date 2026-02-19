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
        <button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#modalRegistrar">
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
    <div class="modal fade" id="modalRegistrar" tabindex="-1" role="dialog" aria-labelledby="modalRegistrarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="modalRegistrarLabel"><i class="fas fa-cart-plus"></i> Registrar Nuevo Pedido</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pedidos.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Cliente</label>
                                <select name="cliente_id" class="form-control" required>
                                    <option value="">Seleccione un cliente...</option>
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
                        <h5><i class="fas fa-box"></i> Productos del Pedido</h5>
                        
                        <div id="contenedor-productos">
                            {{-- Fila Molde --}}
                            <div class="row producto-fila mb-2">
                                <div class="col-md-7">
                                    <select name="productos[]" class="form-control" required>
                                        <option value="">Seleccione producto...</option>
                                        @foreach($productos as $p)
                                            <option value="{{ $p->id }}">{{ $p->nombre }} - ${{ number_format($p->precio, 2) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="cantidades[]" class="form-control" placeholder="Cant." min="1" value="1" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-eliminar" >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="btn-agregar-producto" class="btn btn-info btn-sm mt-2">
                            <i class="fas fa-plus"></i> Agregar otro producto
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Pedido</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        const btnAgregar = $('#btn-agregar-producto');
        const contenedor = $('#contenedor-productos');

        btnAgregar.on('click', function() {
            // Clonamos la primera fila
            let nuevaFila = $('.producto-fila').first().clone();

            // Limpiamos los valores de los inputs clonados
            nuevaFila.find('select').val('');
            nuevaFila.find('input').val('1');

            // Mostramos el botón de eliminar en la nueva fila
            nuevaFila.find('.btn-eliminar').show();

            // Agregamos la nueva fila al contenedor
            contenedor.append(nuevaFila);
        });

        // Evento para eliminar filas (usamos delegación de eventos)
        $(document).on('click', '.btn-eliminar', function() {
            $(this).closest('.producto-fila').remove();
        });
    });
</script>
@stop