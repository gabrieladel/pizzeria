<?php
    require_once("../models/ModelPersona.php");
    $personas = new Persona();
    $datos = $personas->getPersonas();
    require_once("../views/index.php");
?>