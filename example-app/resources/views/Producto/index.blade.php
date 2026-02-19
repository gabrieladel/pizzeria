@extends('layouts.app')

@section('contenido')



<style>
    /* Definimos el efecto de movimiento y sombra */
    .pizza-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    /* Lo que pasa cuando el mouse está encima */
    .pizza-card:hover {
        transform: translateY(-10px); /* Se eleva 10 píxeles */
        box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important; /* Sombra más profunda */
    }

    /* Efecto suave para el botón */
    .btn-pedir {
        transition: background-color 0.3s ease;
    }
    .btn-pedir:hover {
        background-color: rgb(150, 30, 55) !important;
    }
</style>

<div class="container">
    <h1 style="text-align: center; color:rgb(127, 26, 46); margin: 30px 0;">Variedad de #Pizzas</h1>

    <div class="d-flex flex-wrap justify-content-center" style="gap: 25px;">

        @foreach ($listado as $item)
            {{-- Añadimos la clase "pizza-card" aquí --}}
            <div class="card pizza-card" style="width: 16rem; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; position: relative; padding-bottom: 60px; border: none;">
                
<img 
    class="card-img-top" 
    src="{{ $item->imagen 
        ? asset('storage/' . $item->imagen) 
        : asset('images/no-image.png') 
    }}" 
    style="height: 12rem; object-fit: cover;" 
    alt="{{ $item->nombre }}">

                
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold;">{{ $item->nombre }}</h5>
                    <p class="card-text" style="font-size: 0.85rem; color: #666; height: 40px; overflow: hidden;">{{ $item->descripcion }}</p>
                    
                    <p class="card-text"><strong>${{ number_format($item->precio, 2, ',', '.') }}</strong></p>

                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <input type="hidden" name="nombre" value="{{ $item->nombre }}">
                        <input type="hidden" name="precio" value="{{ $item->precio }}">
                        <input type="hidden" name="img" value="{{ $item->imagen }}">
                       

                        <div class="d-flex align-items-center mb-2">
                            <label class="me-2 mb-0">Cantidad:</label>
                            <input 
                                type="number" 
                                name="quantity" 
                                value="1" 
                                min="1" 
                                class="form-control form-control-sm" 
                                style="width: 70px;"
                            >
                        </div>
                        
                        <div style="position: absolute; bottom: 15px; left: 15px; right: 15px;">
                            <button type="submit" class="btn btn-danger btn-pedir w-100" style="background-color: rgb(127, 26, 46); border: none; border-radius: 8px; font-weight: bold;">
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
