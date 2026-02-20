<!DOCTYPE html>
<html>

<head>
    <title>Gracias por su compra</title>
</head>

<body>
    <h2>¡Hola, {{ $pedido->cliente->persona->nombre }}!</h2>
    <p>Adjunto a este correo encontrarás la factura de tu pedido realizado el {{ $pedido->fecha }}.</p>
    <p><strong>Detalles del pedido:</strong></p>
    <ul>
        <li>Pedido ID: #{{ $pedido->id }}</li>
        <li>Estado: Entregado / Facturado</li>
    </ul>
    <p>Gracias por confiar en nosotros.</p>
</body>

</html>
