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
                    <tr>
                        <td><strong>VENDEDOR</strong></td>
                        <td><strong>CLIENTE</strong></td>
                        <td><strong>FECHA</strong></td>
                        <td><strong>PRODUCTO</strong></td>
                        <td><strong>CANTIDAD</strong></td>
                        <td><strong>TOTAL</strong></td>
                        
                    </tr>
                    <?php
                    for ($i = 0; $i < count($datos); $i++) {
                        ?>
                        <tr>
                            <td><?php echo $datos[$i]["vendedor"]; ?></td>
                            <td><?php echo $datos[$i]["cliente"]; ?></td>
                            <td><?php echo $datos[$i]["fecha"]; ?></td>
                            <td><?php echo $datos[$i]["producto"]; ?></td>
                            <td><?php echo $datos[$i]["cantidad"]; ?></td>
                            <td>$<?php echo $datos[$i]["total"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
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