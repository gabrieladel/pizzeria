<?php
    require_once("app/models/modelPedido.php");
    $pedidos = new Pedido();
    $datos = $pedidos->getPedidos();
    require_once("resources/views/index.php");
?>