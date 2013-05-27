<?php
//print_r($_POST);
    if($_POST["action"]=="guardar"){        
        //echo "<br>".
        $sql="UPDATE equiposrep SET statusgral='REP', repara='".$_POST["usuarioAsig"]."', fechainirep='".date("Y-m-d")."', status_rep='DIAG' WHERE id='".$_POST["id"]."'";
        $res=mysql_query($sql,conectarBd());
        if($res){
            echo "<script type='text/javascript'> alert('Registro Guardado'); asignarEquipo(); </script>";
        }else{
            echo "<div style='border-top:1px solid #FF0000;border-bottom:1px solid #FF0000;height:20px;padding:5px;background:#F5A9A9;font-size:14px;color:#000;'>Error al GUARDAR la informacion</div>";
        }
    }
    if($_POST["action"]=="del"){
        print_r($_POST);
        $sql="UPDATE equiposrep SET statusgral='REC', repara='', fechainirep='', status_rep='' WHERE id='".$_POST["id"]."'";
        $res=mysql_query($sql,conectarBd());
        if($res){
            echo "<script type='text/javascript'> alert('Se ha quitado la asignacion del Equipo'); listarAsignaciones(); </script>";
        }else{
            echo "<div style='border-top:1px solid #FF0000;border-bottom:1px solid #FF0000;height:20px;padding:5px;background:#F5A9A9;font-size:14px;color:#000;'>Error al ACTUALIZAR la informacion del equipo.</div>";
        }
    }
    
    
    function conectarBd(){
        require("../../includes/config.inc.php");
        $link=mysql_connect($host,$usuario,$pass);
        if($link==false){
            echo "Error en la conexion a la base de datos";
        }else{
            mysql_select_db($db);
            return $link;
        }				
    }    
?>