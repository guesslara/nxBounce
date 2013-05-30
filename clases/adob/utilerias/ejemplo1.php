<?php 

    // *****************************************************************
    // Fichero....: ejemplo1.php
    // Descripción: Conecta a la base de datos, desconecta de la misma y
    // ...........: muestra los correspondientes mensajes.
    // Autor......: Manuel Domínguez Dorado
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
      print("<center><h1>Se ha cerrado la conexión.</h1></center>");
    }
?>
