@extends('adminlte::page')

@section('content')
    <div class="card mt-3">
        <div class="card-header bg-dark text-white">
            <h5><i class="fas fa-file-invoice-dollar"></i> Listado de Facturas Emitidas</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nro Factura</th>
                        <th>Cliente</th>
                        <th>Fecha Emisión</th>
                        <th>Método Pago</th>
                        <th>IVA</th>
                        <th>Total</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($facturas as $f)
                        <tr>
                            <td><strong>{{ $f->nro_factura }}</strong></td>
                            <td>{{ $f->pedido->cliente->persona->nombre }} {{ $f->pedido->cliente->persona->apellido }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($f->fecha_emision)) }}</td>
                            <td>{{ $f->metodo_pago }}</td>
                            <td>${{ number_format($f->iva, 2) }}</td>
                            <td class="text-success"><strong>${{ number_format($f->total_facturado, 2) }}</strong></td>
                            <td><span class="badge badge-info">{{ $f->tipo_factura }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
