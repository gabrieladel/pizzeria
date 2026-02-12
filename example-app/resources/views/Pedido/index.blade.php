<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Pedidos - Pizzería</title>
    <link href="https://cdn.jsdelivr.net" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Pedidos Entrantes</h3>
            <span class="badge bg-white text-danger">{{ $Pedido->count() }} pedidos hoy</span>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Producto</th>
                            <th>Cant.</th>
                            <th>Total</th>
                            <th>Fecha</th>
                            <th>Vendedor</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($Pedido as $pedido)
                        <tr>
                            <td><strong>#{{ $pedido->id }}</strong></td>
                            <td>{{ $pedido->cliente }}</td>
                            <td><span class="badge bg-info text-dark">{{ $pedido->producto }}</span></td>
                            <td>{{ $pedido->cantidad }}</td>
                            <td class="fw-bold text-success">${{ number_format($pedido->total, 2) }}</td>
                            <td>{{ $pedido->fecha }}</td>
                            <td><small class="text-muted">{{ $pedido->vendedor }}</small></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning">Editar</button>
                                <button class="btn btn-sm btn-danger">Borrar</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay pedidos registrados todavía.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
