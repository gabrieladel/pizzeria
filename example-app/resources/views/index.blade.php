<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejemplo MVC con PHP</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <header class="text-center">
            <strong class="text-danger"><u><h1>PIZZERIA</h1></u></strong>
                
                <hr/>
                <p class="lead">Creamos una base de datos de los productos <br/>
                    que podría ofrecer una pizzeria y <br/>
                    operamos con ella utilizando el paradigma MVC</p>
            </header>
            <div class="col-lg-6 text-center">
              <hr/>
                <h3>VARIEDADES</h3>
                <table class="table">
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
                <a href="../index.php"> <i class="fa fa-arrow-circle-left"></i> Volver a la página principal</a>
                <hr/>
            </div> 
            <footer class="col-lg-12 text-danger text-center">
            <strong><?php echo date("Y"); ?></strong>
            </footer>
        </div>
    </body>
</html>