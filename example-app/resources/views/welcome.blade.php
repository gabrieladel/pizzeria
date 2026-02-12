@extends('layouts.app')

@section('content')

@include('header')
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
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8cGl6emF8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=600&q=60"
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
        <iframe width="1170" height="394" src="https://www.youtube.com/embed/ywrLSeDVH5U" title="PIZZA" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen></iframe>
    </section>
    <section id="Nosotros">
    </section>