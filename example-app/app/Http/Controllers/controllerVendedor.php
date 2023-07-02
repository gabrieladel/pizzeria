<?php
    require_once("../models/Modelvendedor.php");
    $vendedores = new Vendedor();
    $datos = $vendedores->getVendedores();
    require_once("../views/index.php");
?>