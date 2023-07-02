<?php
    require_once("../models/modelVendedor.php");
    $vendedores = new Vendedor();
    $datos = $vendedores->getVendedores();
    require_once("../views/index.php");
?>