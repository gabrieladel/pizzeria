<?php
    require_once("../models/Modelcliente.php");
    $clientes = new Cliente();
    $datos = $clientes->getClientes();
    require_once("../views/index.php");
?>