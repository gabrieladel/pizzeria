<?php

class Vendedor {
    
    private $vendedor;
    private $db;

    public function __construct() {
        $this->vendedor = array();
        $this->db = new PDO('mysql:host=127.0.0.1:3306;dbname=db_pizzeria', "root", "");
    }

    private function setNames() {
        return $this->db->query("SET NAMES 'utf8'");
    }

    public function getVendedores() {

        self::setNames();
        $sql = "SELECT id, cuil FROM vendedor";
        foreach ($this->db->query($sql) as $res) {
            $this->vendedor[] = $res;
        }
        return $this->vendedor;
    }

    public function setvendedor($cuil) {

        self::setNames();
        $sql = "INSERT INTO vendedor(cuil) VALUES ('" . $cuil. "')";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
?>