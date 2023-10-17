{{-- @yield('content') --}}
@extends('footer')
@extends('header')
<!doctype html>

<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/app.css">
    <title>#Pizzas</title>
</head>

<body style="background-color:rgb(144, 143, 143)">

  @section('header')

  
  {{-- contenido --}}
  @yield('contenido') 

  @section('footer')

</body>

</html>
