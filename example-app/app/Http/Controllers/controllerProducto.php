<?php
    require_once("../models/modelProducto.php");
    $productos = new Producto();
    $datos = $productos->getProductos();
    require_once("../views/index.php");
?>