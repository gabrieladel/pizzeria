<?php
    require_once("../models/modelCliente.php");
    $clientes = new Cliente();
    $datos = $clientes->getClientes();
    require_once("../views/index.php");
?>