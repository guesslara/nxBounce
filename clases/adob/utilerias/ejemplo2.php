<?php 

    // *****************************************************************
    // Fichero....: ejemplo2.php
    // Descripci�n: Conecta a la base de datos, realiza varias operacio-
    // ...........: nes de manipulaci�n de datos, cierra la conexi�n  y
    // ...........: finaliza.
    // Autor......: Manuel Dom�nguez Dorado
    // Email......: ingeniero@ManoloDominguez.com
    // Web........: http://www.ManoloDominguez.com
    // *****************************************************************
    
    include('../adodb/adodb.inc.php'); 
    $bd = ADONewConnection('mysql');
    $inserciones = 0;
    $bd->Connect('localhost', 'usuario', 'todoprogramacion', 'mibd');
    $rs = $bd->Execute("insert into clientes values(NULL,'Jos�','Ruiz','Lasso','0000000')"); 
    if ($rs) {
      print ('<h3>Se han insertado '.$bd->Affected_Rows().' registros</h3>');
    } else {
      print ('<h3>No se han insertado registros</h3>');
    }
    $rs = $bd->Execute("update clientes set nombre='Xavier' where nombre='Jos�'"); 
    if ($rs) {
      print ('<h3>Se han modificado '.$bd->Affected_Rows().' registros</h3>');
    } else {
      print ('<h3>No se han modificado registros</h3>');
    }
    $rs = $bd->Execute("delete from clientes where nombre='Xavier'"); 
    if ($rs) {
      print ('<h3>Se han eliminado '.$bd->Affected_Rows().' registros</h3>');
    } else {
      print ('<h3>No se han eliminado registros</h3>');
    }
    $rs = $bd->Execute('select * from clientes'); 
    if ($rs) {
      print ('<h3>Existen '.$rs->RecordCount().' registros en mibd.</h3>');
    } else {
      print ('<h3>Ocurri� un error al ver los registros que hay</h3>');
    }
    $rs->Close();
    $bd->Close();
?>
