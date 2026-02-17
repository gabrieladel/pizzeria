@extends('layouts.app')
@section('contenido')
  
<section id="inicio">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1584859977999-531c305575b7"
                    class="d-block w-100" height="400">
                <div class="carousel-caption text-white d-none d-md-block">
                    <h5>Irresistibles</h5>
                    <p>Entra y mira las variedades que tenemos</p>
                    <a href="productos" class="btn btn-light">Ver variedades</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="video">
    <br>
    <h3 style="text-align: center; color:#000">Así preparamos tu pizza favorita</h3>
    <hr>
    <div class="text-center">
        <iframe width="100%" height="400"
            src="https://www.youtube.com/embed/ywrLSeDVH5U"
            allowfullscreen>
        </iframe>
    </div>
</section>
@endsection

