<?php

class Pedido {
    
    private $pedido;
    private $db;

    public function __construct() {
        $this->pedido = array();
        $this->db = new PDO('mysql:host=127.0.0.1:3308;dbname=db_pizzeria', "root", "");
    }

    private function setNames() {
        return $this->db->query("SET NAMES 'utf8'");
    }

    public function getPedidos() {

        self::setNames();
        $sql = "SELECT id, vendedor, cliente, fecha, producto , cantidad, total  FROM pedido";
        foreach ($this->db->query($sql) as $res) {
            $this->pedido[] = $res;
        }
        return $this->pedido;
    }

    public function setpedido( $vendedor, $cliente, $fecha, $producto, $cantidad, $total) {

        self::setNames();
        $sql = "INSERT INTO pedido(vendedor, cliente, fecha, producto, cantidad, total) VALUES ('" . $vendedor . "', '" . $cliente . "''" . $fecha . "', '" . $producto . "''" . $cantidad . "', '" . $total . "')";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
?>