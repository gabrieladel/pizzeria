<?php

class Persona {
    
    private $persona;
    private $db;

    public function __construct() {
        $this->persona = array();
        $this->db = new PDO('mysql:host=127.0.0.1:3306;dbname=db_pizzeria', "root", "");
    }

    private function setNames() {
        return $this->db->query("SET NAMES 'utf8'");
    }

    public function getPersonas() {

        self::setNames();
        $sql = "SELECT id, nombre, telefono FROM persona";
        foreach ($this->db->query($sql) as $res) {
            $this->persona[] = $res;
        }
        return $this->persona;
    }

    public function setPersona($nombre, $telefono) {

        self::setNames();
        $sql = "INSERT INTO persona(nombre, telefono) VALUES ('" . $nombre . "', '" . $telefono . "')";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
?>