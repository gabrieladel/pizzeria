@extends('layouts.app')

@section('contenido')
<div class="container mt-5" style="background-color: #f8f9fa; padding: 20px; border-radius: 10px;">
    <h2>Tu Pedido de Pizzas</h2>
    <hr>

    @if(count($cartCollection) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartCollection as $item)
                    <tr>
                        <td>
                            @if($item->attributes?->image)
                                <img src="storage/{{ $item->attributes->image }}" width="50">
                            @else
                                <img src="storage/default.png" width="50">
                            @endif
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <!-- Botón con color personalizado -->
                                <button type="submit" class="btn btn-sm" style="background-color: #d9534f; color: white;">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="text-right mt-3">
            <h4>Total: ${{ \Cart::getTotal() }}</h4>
            <!-- Botones con colores personalizados -->
            <a href="/productos" class="btn btn-sm" style="background-color: #6c757d; color: white;">Seguir comprando</a>
            <a href="{{ route('cart.checkout') }}" class="btn btn-lg" style="background-color: #28a745; color: white;">
                Finalizar Pedido <i class="fa fa-arrow-right"></i>
            </a>
        </div>

    @else
        <div class="alert alert-secondary text-center">
            <h3>Tu carrito está vacío</h3>
            <a href="/productos" class="btn mt-3" style="background-color: rgb(150, 30, 55); color: white;">
                Ver variedades de Pizzas
            </a>
        </div>
    @endif
</div>
@endsection
