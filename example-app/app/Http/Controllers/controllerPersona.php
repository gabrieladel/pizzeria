<?php
    require_once("app/models/modelPersona.php");
    $personas = new Persona();
    $pers = $personas->getPersonas();
    require_once("resources/views/index.php");
?>