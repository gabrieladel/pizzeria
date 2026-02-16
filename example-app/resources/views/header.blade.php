
<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" 
    data-bs-toggle="collapse" 
    data-bs-target="#navbarTogglerDemo03"
    aria-controls="navbarTogglerDemo03" 
    aria-expanded="false" 
    aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="/">
        <img src="imagenes/icono.png" width="150" height="110" alt="">#Pizzas
      </a>
    
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="/">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/productos">Variedades</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/contacto">Contacto</a>
          </li>
        </ul>   
        <ul class="navbar-nav ms-auto">
                <li class="nav-item">
            <a class="nav-link" href="{{ route('cart.list') }}">
                <i class="fa fa-shopping-cart"></i> Carrito 
                @if(\Cart::count() > 0)
                    <span class="badge badge-danger" style="background-color: red; border-radius: 50%; padding: 2px 6px;">
                        {{ \Cart::count() }}
                    </span>
                @endif
            </a>
        </li>
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
                   <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       {{ Auth::user()->name }}
                   </a>
                   <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                       <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           {{ __('Logout') }}
                       </a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                           @csrf
                       </form>
                   </div>
               </li>
           @endguest
       </ul>
      </div>
  </nav>
</header>
