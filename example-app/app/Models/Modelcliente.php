<?php

class Cliente {
    
    private $cliente;
    private $db;

    public function __construct() {
        $this->cliente = array();
        $this->db = new PDO('mysql:host=127.0.0.1:3306;dbname=db_pizzeria', "root", "");
    }

    private function setNames() {
        return $this->db->query("SET NAMES 'utf8'");
    }

    public function getClientes() {

        self::setNames();
        $sql = "SELECT id, cuil, persona FROM cliente";
        foreach ($this->db->query($sql) as $res) {
            $this->cliente[] = $res;
        }
        return $this->cliente;
    }

    public function setcliente($cuil) {

        self::setNames();
        $sql = "INSERT INTO cliente(cuil) VALUES ('" . $cuil . "')";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
?>