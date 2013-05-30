<?php 

    // *****************************************************************
    // Fichero....: ejemplo3.php
    // Descripci�n: Conecta a la base de datos, hace una SELECT, cuenta
    // ...........: el n�mero de registros obtenido y los recorre en un
    // ...........: bucle sin mostrarlos por pantalla.
    // Autor......: Manuel Dom�nguez Dorado
    // Email......: ingeniero@ManoloDominguez.com
    // Web........: http://www.ManoloDominguez.com
    // *****************************************************************
    
    include('../adodb/adodb.inc.php'); 
    $bd = ADONewConnection('mysql');
    $inserciones = 0;
    !$bd->Connect('localhost', 'usuario', 'todoprogramacion', 'mibd');
    $rs = $bd->Execute("select * from clientes"); 
    print('<H2>Se han extraido '.$rs->RecordCount().' registros.</H2>');
    $contador = 0;
    while (!$rs->EOF) {
      print('<H3>Puntero en el registro '.$contador.'</H3>');
      $contador++;
      $rs->MoveNext();
    }
    $rs->MoveFirst();
    print('<H3>Puntero en el primer registro</H3>');
    $rs->MoveLast();
    print('<H3>Puntero en el �ltimo registro</H3>');
    $rs->Close();
    $bd->Close();
?>
