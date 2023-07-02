<?php
    require_once("app/models/Modelproducto.php");
    $productos = new Producto();
    $produc = $productos->getProductos();
    require_once("resources/views/index.php");
?>