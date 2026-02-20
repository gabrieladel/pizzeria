<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Factura {{ $factura->nro_factura }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
        }

        .top {
            margin-bottom: 20px;
        }

        .header {
            background: #f9f9f9;
            padding: 20px;
            border-bottom: 2px solid #333;
        }

        .details {
            margin-top: 20px;
            width: 100%;
            text-align: left;
            border-collapse: collapse;
        }

        .details th {
            background: #333;
            color: #fff;
            padding: 8px;
        }

        .details td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        .total-section {
            margin-top: 30px;
            text-align: right;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            background: #eee;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="header">
            <table style="width: 100%;">
                <tr>
                    <td>
                        <h2>#PIZZA</h2>
                        <p>CUIT: 20-12345678-9<br>Dirección: Calle Falsa 123</p>
                    </td>
                    <td style="text-align: right;">
                        <h1 style="margin:0;">FACTURA</h1>
                        <span class="badge">Tipo: {{ $factura->tipo_factura }}</span><br>
                        <strong>Nro: {{ $factura->nro_factura }}</strong><br>
                        Fecha: {{ date('d/m/Y', strtotime($factura->fecha_emision)) }}
                    </td>
                </tr>
            </table>
        </div>

        <div style="margin-top: 20px;">
            <strong>Cliente:</strong> {{ $pedido->cliente->persona->nombre }}
            {{ $pedido->cliente->persona->apellido }}<br>
            <strong>Método de Pago:</strong> {{ $factura->metodo_pago }}
        </div>

        <table class="details">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cant.</th>
                    <th>Precio Unit.</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($detallePedidos as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->nombre ?? 'Producto' }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                        {{-- Calculamos el subtotal aquí mismo para evitar el $0.00 --}}
                        <td>${{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        <div class="total-section">
            <p>Subtotal: ${{ number_format($subtotal, 2) }}</p>
            <p>IVA (21%): ${{ number_format($iva, 2) }}</p>
            <hr>
            <h3>TOTAL: ${{ number_format($total, 2) }}</h3>
        </div>
    </div>
</body>

</html>
