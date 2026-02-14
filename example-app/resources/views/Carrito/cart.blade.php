@extends('layouts.app')

@section('contenido')
<div class="container mt-5">
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
            @if($item->options->image)
                <img src="imagenes/{{ $item->options->image }}" width="50">
            @else
                <img src="imagenes/default.png" width="50">
            @endif
        </td>
                        <td>{{ $item->name }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->rowId }}">
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="text-right">
            <h4>Total: ${{ \Cart::total() }}</h4>
            <a href="/producto" class="btn btn-dark">Seguir comprando</a>

    <a href="{{ route('cart.checkout') }}" class="btn btn-success btn-lg">
        Finalizar Pedido <i class="fa fa-arrow-right"></i>
    </a>
        </div>

    @else
        <div class="alert alert-info text-center">
            <h3>Tu carrito está vacío</h3>
            <a href="/producto" class="btn btn-primary mt-3">Ver variedades de Pizzas</a>
        </div>
    @endif
</div>
@endsection
