<?php 

    // *****************************************************************
    // Fichero....: ejemplo4.php
    // Descripción: Conecta a la base de datos, hace una SELECT, cuenta
    // ...........: el número de registros obtenido y los recorre en un
    // ...........: bucle mostrándolos por pantalla.
    // Autor......: Manuel Domínguez Dorado
    // Email......: ingeniero@ManoloDominguez.com
    // Web........: http://www.ManoloDominguez.com
    // *****************************************************************
    
//    include('../adodb/adodb.inc.php');
	include("../adodb.inc.php");
    $bd = ADONewConnection('mysql');
    $inserciones = 0;
    !$bd->Connect('localhost', 'root', 'xampp', 'dbcompras');
    $rs = $bd->Execute("select * from clientes"); 
    print('<H1>Se han extraido '.$rs->RecordCount().' registros.</H1>');
    $contador = 0;
    while ($o = $rs->FetchNextObject()) {
      print('<H2>Registro '.$contador.'</H2>');
      print('<H3>----------> Nombre: '.$o->NOMBRE.'</H3>');
      print('<H3>----------> Apellido 1: '.$o->APELLIDO1.'</H3>');
      print('<H3>----------> Apellido 2: '.$o->APELLIDO2.'</H3>');
      print('<H3>----------> DNI: '.$o->DNI.'</H3>');
      $contador++;
    }
    $rs->Close();
    $bd->Close();
?>
