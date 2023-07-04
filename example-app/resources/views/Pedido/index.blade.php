<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>catalogo de personas</h1>
    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>vendedor</th>
            <th>cliente</th>
            <th>fecha</th>
            <th>producto</th>
            <th>cantidad</th>
            <th>total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listado as $item)  
        <tr>
            <td>{{$item ->id}}</td>
            <td>{{$item->vendedor}}</td>
            <td>{{$item->cliente}}</td>
            <td>{{$item->fecha}}</td>
            <td>{{$item->producto}}</td>
            <td>{{$item->cantidad}}</td>
            <td>{{$item ->total}}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
</body>
</html>