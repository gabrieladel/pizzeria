{{-- @extends('footer') --}}
@extends('home')

@section('content')
<body>
    {{-- <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
                <a class="navbar-brand" href="#">
                  <img src="imagenes/icono.png" width="150" height="110" alt="">#Pizzas
                </a>
          
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                  <a class="nav-link" href="/">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="producto">Variedades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacto">Contacto</a>
                  </li>
              </ul>
              <ul class="navbar-nav mr-sm-2">
              @if (Route::has('login'))
            <div class="login " >
                @auth
                    <a href="{{ url('/home') }}" class="font-semibold">Home</a>
                    <i class="fa-solid fa-cart-shopping" style="color: #ffffff;"> Carrito</i>
                @else
                    <a href="{{ route('login') }}" class="font-semibold " style="color: white">Log in</a>
    
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold" style="color: white"  >Register</a>
                    @endif
                @endauth
            </div>
          @endif
          </div>
        </ul>
        </nav>
    </header>
     --}}
    <h1>Carrito de compra</h1>
    {{-- <table class="carrito">
        <thead>
        <tr>
            <th>id</th>
            <th>vendedor</th>
            <th>cliente</th>
            <th>fecha</th>
            <th>producto</th>
            <th>cantidad</th>
            <th>total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listado as $item)  
        <tr>
            <td>{{$item ->id}}</td>
            <td>{{$item->vendedor}}</td>
            <td>{{$item->cliente}}</td>
            <td>{{$item->fecha}}</td>
            <td>{{$item->producto}}</td>
            <td>{{$item->cantidad}}</td>
            <td>{{$item ->total}}</td>
        </tr>
        @endforeach
    </tbody>
    </table> --}}
   {{--  @section('footer') --}}
</body>
</html>