<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style1 {
	color: #000000;
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #999999;
}
.style3 {color: #FFFFFF}
a:link {
	color: #FFFFFF;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #CCCCCC;
}
a:hover {
	text-decoration: underline;
	color: #FFFF00;
}
a:active {
	text-decoration: none;
	color: #FF0000;
}
.style4 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
}
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
.style8 {color: #990000}
.Estilo14 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #FFFFFF; }
-->
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td colspan="3" bgcolor="#999999"><div align="center" class="style1"><span class="style3"><a href="regeqpo.php">Registro de Equipo</a> |<a href="findeqp.php"> Buscar Equipos</a> | <a href="asignaeqpo.php">Asignar Equipos</a></span></div></td>
  </tr>
</table>
.
<form id="form" name="form" method="post" action="busq.php">
  <table width="349" border="1" align="center" cellspacing="0" bordercolor="#000000">
    <tr>
      <td colspan="2" bgcolor="#999999"><center>
        <span class="Estilo14">Busqueda Individual </span>
      </center></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#CCCCCC" class="Estilo1"><center>
        Criterio de Busqueda
      </center></td>
    </tr>
    <tr>
      <td width="158" class="Estilo1"><div align="left">
        
          <input name="crite" type="radio" value="ot" checked="checked" />
OT.</div>
        <div align="left"></div>
        <div align="left"></div>
        <div align="left"></div>
        <div align="left"></div>        <div align="left"></div></td>
      <td rowspan="2">        <div align="center">
        <input name="dato" type="text" id="dato" />        
        <input type="submit" name="Submit" value="Buscar" />      
      </div></td>
    </tr>
    
    
    <tr class="Estilo1">
      <td><input name="crite" type="radio" value="fnextel" />
Folio Nextel </td>
    </tr>
  </table>
</form>
.
<form id="form2" name="form2" method="post" action="busq_grup.php">
  <table width="349" border="1" align="center" cellspacing="0" bordercolor="#000000">
    <tr>
      <td colspan="2" bgcolor="#999999"><center>
        <span class="Estilo14">Busqueda de Varios </span>
      </center></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#CCCCCC" class="Estilo1"><center>
        Criterio de Busqueda
      </center></td>
    </tr>
    <tr>
      <td width="158" class="Estilo1"><div align="left">
        <input name="crite" type="radio" value="cap" checked="checked" />
        CAP origen </div></td>
      <td rowspan="6">        <div align="center">
        <input name="dato" type="text" id="dato" />        
        <input type="submit" name="Submit2" value="Buscar" />      
      </div></td>
    </tr>
    <tr>
      <td class="Estilo1"><div align="left">
        <input name="crite" type="radio" value="esn" />
ESN</div></td>
    </tr>
    <tr>
      <td class="Estilo1"><div align="left">
        <input name="crite" type="radio" value="imei" />
IMEI</div></td>
    </tr>
    <tr class="Estilo1">
      <td><div align="left">
        <input name="crite" type="radio" value="modelo" />
        Modelo </div></td>
    </tr>
    <tr class="Estilo1">
      <td><div align="left">
        <input name="crite" type="radio" value="fecharec" />
        Fecha de recibo </div></td>
    </tr>
    <tr class="Estilo1">
      <td><div align="left">
        <input name="crite" type="radio" value="recibe" /> 
        Quien Recibe 
      </div>        <div align="left"></div>      <div align="left"></div></td>
    </tr>
  </table>
</form>
<hr color="#990000"/>
<p align="center" class="style2 style8">IQelectronics SA de CV &copy; </p>
<div align="center"></div>
</body>
</html>