<?php
    require_once("../models/modelPersona.php");
    $personas = new Persona();
    $datos = $personas->getPersonas();
    require_once("../views/index.php");
?>