<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>catalogo de productos</h1>
    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>nombre</th>
            <th>descripción</th>
            <th>imagen</th>
            <th>precio</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listado as $item)  
        <tr>
            <td>{{$item ->id}}</td>
            <td>{{$item->nombre}}</td>
            <td>{{$item->descripción}}</td>
            <td><img src="data:image/jpeg;base64, base64_encode{{$item->imagen}} "/></td>
            <td>${{$item->precio}}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
</body>
</html>