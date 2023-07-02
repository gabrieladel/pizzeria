<?php

class Cliente {
    
    private $cliente;
    private $db;

    public function __construct() {
        $this->cliente = array();
        $this->db = new PDO('mysql:host=127.0.0.1:3308;dbname=pizzeria', "root", "");
    }

    private function setNames() {
        return $this->db->query("SET NAMES 'utf8'");
    }

    public function getClientes() {

        self::setNames();
        $sql = "SELECT id, nombre, precio FROM cliente";
        foreach ($this->db->query($sql) as $res) {
            $this->cliente[] = $res;
        }
        return $this->cliente;
    }

    public function setcliente($nombre, $precio) {

        self::setNames();
        $sql = "INSERT INTO cliente(nombre, precio) VALUES ('" . $nombre . "', '" . $precio . "')";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
?>