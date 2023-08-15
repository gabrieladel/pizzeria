
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
    integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
    crossorigin="anonymous"></script>
</head>
<body style="background-color:rgb(144, 143, 143)">
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
                    <a class="nav-link" href="/Nosotros">Contacto</a>
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
    <h1>Variedad de #Pizzas</h1>
    <div class="d-flex flex-row">
    @foreach ($listado as $item)  

       <div class="card " style="width: 14rem; margin:10px " >
        <img class="card-img-top" alt="Card image cap"src="{{$item->imagen}}" alt="" srcset="" >
        <div class="card-body">
          <h5 class="card-title">{{$item->nombre}}</h5>
          <p class="card-text">{{$item->descripción}}</p>
          <p class="card-text">{{$item->precio}}</p>
          <a href="#" class="btn btn-primary">pedir</a>
        </div>
    </div>

      @endforeach
    </div>
    <footer>
        <hr>
        <div class="row text-center" style="color: white">
          <div>
            <h6>Seguinos en nuestras redes</h6>
            <a href="https://www.facebook.com/" target="_blanck" title="Facebook"><i class="fab fa-facebook" style="color: white"></i></a>
            <a href="https://www.instagram.com/" target="_blanck" title="Instagram"><i class="fab fa-instagram" style="color: white"></i></a>
          </div>
          <div>
            <img src="imagenes/icono.png" width="150" height="110">
            <h4>#Pizzas</h4>
          </div>
            <small class="d-block mb-3">© 2023</small>
        </div>
        </div> 
      </footer>
</body>
</html>