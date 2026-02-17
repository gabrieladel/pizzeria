<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>#Pizzas</title>
    
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>

    <style>
        body { background-color: #f8f9fa; }
        .main-container { min-height: 80vh; }
    </style>
</head>
<body>
<<<<<<< HEAD
=======
    @include('header')
>>>>>>> 81f19b526ec8ffacd7f2d0b2fb32c3ffd174c2f1
    <div id="app">
        <main class="py-4 main-container">
            @yield('contenido')
        </main>
    </div>

<<<<<<< HEAD
    @yield('footer')
=======
    @include('footer')
>>>>>>> 81f19b526ec8ffacd7f2d0b2fb32c3ffd174c2f1

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
