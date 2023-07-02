<?php
    require_once("app/models/modelVendedor.php");
    $vendedores = new Vendedor();
    $vende = $vendedores->getVendedores();
    require_once("resources/views/index.php");
?>