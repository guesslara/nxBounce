<?php
    include("modelo.php");
    $obj = new modelo();
    
    switch($_POST["action"]){
        case "listarEquipos":
            $obj->listarEquipos($_POST["idUsuario"]);    
        break;
        case "mostrarEquiposAReparar":
            //print_r($_POST);
            $obj->listarEquiposAReparar($_POST["idUsuario"],$_POST["filtro"],$_POST["imei"]);    
        break;
    }
?>