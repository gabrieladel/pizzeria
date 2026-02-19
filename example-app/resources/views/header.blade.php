<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
      
      <button class="navbar-toggler" type="button" 
        data-bs-toggle="collapse" 
        data-bs-target="#navbarTogglerDemo03"
        aria-controls="navbarTogglerDemo03" 
        aria-expanded="false" 
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Logo -->
      <a class="navbar-brand d-flex align-items-center" href="/">
        <img src="{{ asset('imagenes/icono3.png') }}" width="70" height="70" class="me-2" alt="">
        <span class="fw-bold fs-4 text-warning">#Pizzas</span>
      </a>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/productos">Variedades</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/contacto">Contacto</a>
          </li>
        </ul>   

        <!-- Lado derecho -->
        <ul class="navbar-nav ms-auto align-items-center">
          @auth
    @if(Auth::user()->roles === 'admin')
        <li class="nav-item">
            <a class="nav-link text-white px-3 ml-2" 
               href="{{ url('/admin') }}" 
               style="background-color: #f79b08;">
                <i class="fas fa-user-cog"></i> Panel Administrativo
            </a>
        </li>
    @endif
@endauth

          <!-- Carrito -->
          <li class="nav-item">
            <a class="nav-link position-relative" href="{{ route('cart.list') }}"> 
             <i class="fa fa-shopping-cart fs-5"></i>

            @php
               $cantidad = \Cart::getTotalQuantity();
            @endphp
              @if($cantidad > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $cantidad }}
                </span>
              @endif
            </a>
          </li>
          

          @guest
              @if (Route::has('login'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">Login</a>
                  </li>
              @endif
              @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">Registro</a>
                  </li>
              @endif
          @else
              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                      {{ Auth::user()->name }}
                  </a>

                  
                  <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          Cerrar sesión
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
