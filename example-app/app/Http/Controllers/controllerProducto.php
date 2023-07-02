<?php
    require_once("../models/Modelproducto.php");
    $productos = new Producto();
    $datos = $productos->getProductos();
    require_once("../views/index.php");
?>