@yield('header')

<header>
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
