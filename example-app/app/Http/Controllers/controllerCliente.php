<?php
    require_once("app/models/modelCliente.php");
    $clientes = new Cliente();
    $datos = $clientes->getClientes();
    require_once("resources/views/index.php");
?>