
@yield('producto')
@extends('layouts.app')

@section('contenido')

<body>
     <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">
                <img src="imagenes/icono.png" width="150" height="110" alt="">#Pizzas
              </a>
        
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
              
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
              </ul>   <!-- Right Side Of Navbar -->
              <ul class="navbar-nav ms-auto">
                 <!-- Authentication Links -->
                 @guest
                     @if (Route::has('login'))
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                         </li>
                     @endif

                     @if (Route::has('register'))
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                         </li>
                     @endif
                 @else
                     <li class="nav-item dropdown">
                         <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                             {{ Auth::user()->name }}
                         </a>

                         <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                             <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}
                             </a>

                             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                 @csrf
                             </form>
                         </div>
                     </li>
                 @endguest
             </ul>
        </nav>
    </header> 
    <h1 style="text-align: center; color:rgb(127, 26, 46)">Variedad de #Pizzas</h1>
    <br>

    <div class="d-flex align-content-stretch flex-wrap" style="text-align: center;">
    @foreach ($listado as $item)  
    <div class="card-group" style="margin-left: 40px;">
       <div class="card " style="width: 12rem; margin:10px " >
        <img class="card-img-top" alt="Card image cap"src="{{$item->imagen}}" style="width: 12rem; height:10rem;"alt="" srcset="" >
        <div class="card-body">
          <h5 class="card-title">{{$item->nombre}}</h5>
          <p class="card-text">{{$item->descripción}}</p>
          
          <p class="card-text">${{$item->precio}}</p>
          <br>
          <div class="position-absolute fixed-bottom mb-2">
          <a href="carrito" class="btn btn-secondary btn-lg btn-block">Pedir</a>
        </div>
        </div>
    </div>
  </div>
      @endforeach
    </div>
{{--     @section('footer') --}}

</body>
</html>