@extends('home')

@section('content')

    @extends('footer')


    <body style="background-color:rgb(144, 143, 143)">
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
                    aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
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
                            <div class="login ">
                                @auth
                                    <a href="{{ url('/home') }}" class="font-semibold">Home</a>
                                    <i class="fa-solid fa-cart-shopping" style="color: #ffffff;"> Carrito</i>
                                @else
                                    <a href="{{ route('login') }}" class="font-semibold " style="color: white">Log in</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 font-semibold"
                                            style="color: white">Register</a>
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
                        <img src="https://images.unsplash.com/photo-1584859977999-531c305575b7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fHBpenphc3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=600&q=60"
                            class="d-block w-100" alt="..." height="400">
                        <div class="carousel-caption text-white d-none d-md-block">
                            <h5>Irresistibles</h5>
                            <p>Entra y mira las variedades que tenemos</p>
                            <a href="producto" class="btn btn-light">ver variedades</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1600628421066-f6bda6a7b976?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fHBpenphc3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=600&q=60"
                            class="d-block w-100" alt="..." height="400">
                        <div class="carousel-caption d-none d-md-block">

                            <h5>Irresistibles</h5>
                            <p>Entra y mira las variedades que tenemos</p>
                            <a href="producto" class="btn btn-light">ver variedades</a>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="video">
            <br>
            <h3 style="text-align: center; color:#ffffff">Asi preparamos tu pizza favorita</h3>
            <hr>
            <iframe width="1170" height="394" src="https://www.youtube.com/embed/ywrLSeDVH5U"
                title="PIZZA  | Spot Publicitario Trattoria" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
        </section>
        <section id="Nosotros">
        </section>
    @section('footer')
        </div>
        </div>
    </body>

    </html>
