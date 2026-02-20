@extends('layouts.app')

@section('contenido')
    <div class="container mt-5">
        <div class="card shadow text-center">
            <div class="card-body">
                <h1 class="text-success">
                    <i class="fa fa-check-circle"></i> ¡Gracias por tu compra!
                </h1>

                <p class="mt-3">
                    Tu pedido fue registrado correctamente.
                </p>
                @if (isset($pedido))
                    @php
                        $iva = $pedido->total * 0.21;
                        $totalConIva = $pedido->total * 1.21;
                    @endphp

                    <div class="alert alert-info mt-4">
                        <strong>N° de pedido:</strong> {{ $pedido->id }} <br>
                        <strong>Subtotal:</strong> ${{ number_format($pedido->total, 2) }} <br>
                        <strong>IVA (21%):</strong> ${{ number_format($iva, 2) }} <br>
                        <strong>Total con IVA:</strong>
                        <span class="text-success">
                            ${{ number_format($totalConIva, 2) }}
                        </span><br>
                        <strong>Estado:</strong> {{ $pedido->estado }}
                    </div>
                @endif
                <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
@endsection
