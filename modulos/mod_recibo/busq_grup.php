<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Recibo de Equipo</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 9px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #CCCCCC;
}
.style5 {font-family: Geneva, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 16px; }
.Estilo50 {color: #FFFFFF}
body {
	margin-top: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
a:link {
	color: #FFFFFF;
}
a:hover {
	color: #FFFF00;
}
a:visited {
	color: #CCCCCC;
}
.style8 {color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style10 {font-size: 12px}
.style4 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
}
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
-->
</style>
</head>
<body>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td bgcolor="#CC3333"><div align="center" class="style8"><span class="style10"><a href="regeqpo.php">Registro de Equipo</a> | <a href="findeqp.php">Buscar Equipos</a> | <a href="asignaeqpo.php">Asignar Equipos</a></span></div></td>
  </tr>
</table>
<p>
  <?
		$crite=$_POST["crite"];
		$dato=$_POST["dato"];
		//echo $crite."--".$dato;
		include("../php/conectarbase.php");
		$sql="SELECT * FROM equiposrep WHERE ".$crite."='".$dato."'";
		$result=mysql_db_query("db_iqe_ref",$sql);
		//echo $sql;
		//echo "<center>Los datos fueron enviados correctamente</center>";
?>
</p>
<table width="656" border="0" align="center" cellspacing="1" bordercolor="#333333">
  <tr>
    <th colspan="8" bgcolor="#990000" scope="row"><span class="style4">Equipos encontrados </span></th>
  </tr>
  <tr>
    <th width="59" bgcolor="#CCCCCC" scope="row"><span class="style7">OT</span></th>
    <th width="60" bgcolor="#CCCCCC" scope="row"><span class="style7">CAP </span></th>
    <th width="74" bgcolor="#CCCCCC" scope="row"><span class="style7">F. NEXTEL</span></th>
    <th width="141" bgcolor="#CCCCCC" scope="row"><span class="style7">ESN</span> </th>
    <th width="129" bgcolor="#CCCCCC" scope="row"><span class="style7">IMEI </span></th>
    <th width="72" bgcolor="#CCCCCC" scope="row"><span class="style7">modelo</span></th>
    <th colspan="2" bgcolor="#CCCCCC" scope="row"><span class="style7">f. de Recibo </span></th>
  </tr>
  <?	
		  	$color=="#D9FFB3";
			$i=1;
		while($row=mysql_fetch_array($result)){
?>
  <tr>
    <th bgcolor="<? echo $color; ?>" class="style7" scope="row"><?= $row["id"];?></th>
    <th bgcolor="<? echo $color; ?>" class="style7" scope="row"><?= $row["cap"];?></th>
    <th bgcolor="<? echo $color; ?>" class="style7" scope="row"><?= $row["fnextel"];?></th>
    <th bgcolor="<? echo $color; ?>" class="style7" scope="row"><?= $row["esn"];?></th>
    <th bgcolor="<? echo $color; ?>" class="style7" scope="row"><?= $row["imei"];?></th>
    <th bgcolor="<? echo $color; ?>" class="style7" scope="row"><?= $row["modelo"];?></th>
    <th width="80" bgcolor="<? echo $color; ?>" class="style7" scope="row"><?= $row["fecharec"];?></th>
 </tr>
  <?
  	if ($color=="#D9FFB3") 
				$color="#FFFFFF";
			else 
				$color="#D9FFB3";
	}
?>
  <tr>
    <th colspan="8" bgcolor="#990000" class="style7" scope="row"></label></th>
  </tr>
</table>
<p align="center" class="style5">&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<hr />
<p align="center" class="Estilo1">IQelectronics
</body>
</html>
