
@extends('layouts.app')

@section('contenido')

   

<div class="container">
    <h1 style="text-align: center; color:rgb(127, 26, 46); margin: 30px 0;">Variedad de #Pizzas</h1>

    {{-- Contenedor Flexbox para alinear horizontalmente --}}
    <div class="d-flex flex-wrap justify-content-center" style="gap: 20px;">

        @foreach ($listado as $item)
            <div class="card" style="width: 16rem; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; position: relative; padding-bottom: 60px;">
                
                {{-- Imagen --}}
                <img class="card-img-top" src="{{ $item->imagen }}" style="height: 12rem; object-fit: cover;" alt="{{ $item->nombre }}">
                
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold;">{{ $item->nombre }}</h5>
                    <p class="card-text" style="font-size: 0.85rem; color: #666;">{{ $item->descripcion }}</p>
                    
                    <p class="card-text"><strong>${{ number_format($item->precio, 2, ',', '.') }}</strong></p>

                    {{-- Formulario de compra --}}
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <input type="hidden" name="nombre" value="{{ $item->nombre }}">
                        <input type="hidden" name="precio" value="{{ $item->precio }}">
                        <input type="hidden" name="img" value="{{ $item->imagen }}">
                        <input type="hidden" name="quantity" value="1">
                        
                        <div style="position: absolute; bottom: 15px; left: 15px; right: 15px;">
                            <button type="submit" class="btn btn-danger w-100" style="background-color: rgb(127, 26, 46); border: none; border-radius: 8px;">
                                Pedir Ahora
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

    </div>
</div>

@endsection

