
@extends('layouts.app')

@section('contenido')

@include('header')    
        <h1 style="text-align: center; color:rgb(127, 26, 46)">Variedad de #Pizzas</h1>
        <br>
@foreach ($listado as $item)
    <div class="card" style="width: 15rem; margin:15px; padding-bottom: 50px;">
        <img class="card-img-top" src="{{ $item->imagen }}" style="height:10rem; object-fit: cover;">
        <div class="card-body">
            <h5 class="card-title">{{ $item->nombre }}</h5>
            <p class="card-text" style="font-size: 0.9rem;">{{ $item->descripcion }}</p>
            <p class="card-text"><strong>${{ number_format($item->precio, 2) }}</strong></p>

            {{-- FORMULARIO DE AGREGAR --}}
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <input type="hidden" name="nombre" value="{{ $item->nombre }}">
                <input type="hidden" name="precio" value="{{ $item->precio }}">
                <input type="hidden" name="img" value="{{ $item->imagen }}">
                <input type="hidden" name="quantity" value="1">
                
                <div style="position: absolute; bottom: 15px; left: 0; right: 0; padding: 0 15px;">
                    <button type="submit" class="btn btn-danger btn-block w-100">
                        Pedir Ahora
                    </button>
                </div>
            </form>
        </div>
    </div>
@endforeach
