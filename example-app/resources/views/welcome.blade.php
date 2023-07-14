@extends('home')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS v5.2.1 -->
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
    <title>#Pizzas</title>
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
                      <a class="nav-link" href="#inicio">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="producto">Variedades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
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
        <section id="inicio">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="https://images.unsplash.com/photo-1584859977999-531c305575b7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fHBpenphc3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=600&q=60" class="d-block w-100" alt="..." height="400">
                    <div class="carousel-caption text-white d-none d-md-block">
                           <h5>Irresistibles</h5>
                           <p>Entra y mira las variedades que tenemos</p>
                           <a href="producto" class="btn btn-light">ver variedades</a>
                       </div> 
                </div>
                  <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1600628421066-f6bda6a7b976?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fHBpenphc3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=600&q=60" class="d-block w-100" alt="..." height="400">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="card text-white text-center p-3">
                           <h5>Irresistibles</h5>
                           <p>Entra y mira las variedades que tenemos</p>
                           <a href="producto" class="btn btn-light">ver variedades</a>
                       </div> 
                       </div> 
                  <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1534308983496-4fabb1a015ee?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTd8fHBpenphc3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=600&q=60" class="d-block w-100" alt="..." height="400">
                    
                    <div class="carousel-caption d-none d-md-block">
                     <div class="card text-white text-center p-3">
                        <h5>Irresistibles</h5>
                        <p>Entra y mira las variedades que tenemos</p>
                        <a href="producto" class="btn btn-light">ver variedades</a>   
                    </div> 
                    </div> 
                </div>
                </div>
              </div>
            </section>
              
                
           
              <section id="video">
                <br>
                <h3 style="text-align: center; color:#ffffff">Asi preparamos tu pizza favorita</h3>
      <hr>
                <iframe width="1170" height="394" src="https://www.youtube.com/embed/ywrLSeDVH5U" title="PIZZA  | Spot Publicitario Trattoria" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
              </section>
              <section id="Nosotros">
              </section>
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
            </div>
        </div>
    </body>
</html>
