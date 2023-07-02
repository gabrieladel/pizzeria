<?php
    require_once("app/models/Modelproducto.php");
    $productos = new Producto();
    $datos = $productos->getProductos();
    require_once("resources/views/index.php");
?>