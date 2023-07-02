<?php
    require_once("../models/modelPedido.php");
    $pedidos = new Pedido();
    $datos = $pedidos->getPedidos();
    require_once("../views/index.php");
?>