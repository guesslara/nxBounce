<?php 

    // *****************************************************************
    // Fichero....: ejemplo1.php
    // Descripci�n: Conecta a la base de datos, desconecta de la misma y
    // ...........: muestra los correspondientes mensajes.
    // Autor......: Manuel Dom�nguez Dorado
    // Email......: ingeniero@ManoloDominguez.com
    // Web........: http://www.ManoloDominguez.com
    // *****************************************************************
    
    include('../adodb/adodb.inc.php'); 
    $bd = ADONewConnection('mysql'); 
    if (!$bd->Connect('localhost', 'usuario', 'todoprogramacion', 'mibd')) {
      print("<center><h1>No se pudo conectar</h1></center>");
    } else {
      print("<center><h1>Se pudo conectar</h1></center>");
      $bd->Close();
      print("<center><h1>Se ha cerrado la conexi�n.</h1></center>");
    }
?>
