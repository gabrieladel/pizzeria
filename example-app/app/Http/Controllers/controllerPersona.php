<?php
    require_once("app/models/modelPersona.php");
    $personas = new Persona();
    $datos = $personas->getPersonas();
    require_once("resources/views/index.php");
?>