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
.Estilo51 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style13 {font-size: 9px}
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
  		if($_GET){
			$crite=$_GET["crite"];
			$dato=$_GET["dato"];	
		}
		else{
			$crite=$_POST["crite"];
			$dato=$_POST["dato"];
		}
		//echo $crite."--".$dato;
		include("../php/conectarbase.php");
		$sql="SELECT * FROM equiposrep WHERE ".$crite."='".$dato."'";
		$result=mysql_db_query("db_iqe_ref",$sql);
		//echo $sql;
		$num=mysql_num_rows($result);
		$row=mysql_fetch_array($result);
		//echo $num;
		//echo "<center>Los datos fueron enviados correctamente</center>";
		//$i=1;
		//while($row=mysql_fetch_array($result)){
		if($num==0){
?>
</p>
<table width="297" border="0" align="center" cellspacing="1" bordercolor="#333333">
  <tr>
    <th bgcolor="#990000" scope="row"><span class="style13">.</span></th>
  </tr>
  <tr>
    <th><div align="center" class="Estilo51">No se encontro ningun registro</div>
        </label></th>
  </tr>
  <tr>
    <th bgcolor="#990000" scope="row"><label></label>
        <div align="right" class="style13">.</div>
      </label></th>
  </tr>
</table>
<?
	}
	else{
?>
<table width="448" border="0" align="center" cellspacing="0" bordercolor="#333333">
  <tr>
    <th colspan="4" bgcolor="#990000" scope="row"><span class="style4">Detalle del equipo </span>
        <div align="left"> </div></th>
  </tr>
  <tr>
    <th width="107" bgcolor="#CCCCCC" class="style7" scope="row">OT</th>
    <th width="118" scope="row"><?= $row["id"];?></th>
    <th width="90" bgcolor="#CECFCE" class="style7" scope="row">Folio Nextel </th>
    <th width="125" scope="row"><span class="style7">
      <?= $row["fnextel"];?>
    </span></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" scope="row"><span class="style7">CAP 
    Origen</span></th>
    <th colspan="3" scope="row"><?= $row["cap"];?></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" scope="row"><span class="style7">
      <label></label>
    </span><span class="style7">
      <label> ESN </label>
    </span>    <div align="left" class="style7"></div></th>
    <th colspan="3" bgcolor="#FFFFFF" scope="row"><div align="left"><span class="style7">
      <?= $row["esn"];?>
    </span><span class="style7">serie</span></div></th>
  </tr>
  
  <tr>
    <th bgcolor="#CCCCCC" scope="row"><span class="style7">IMEI </span></th>
    <th colspan="3" scope="row"><div align="left" class="style7">
      <?= $row["imei"];?>
    </div></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" scope="row"><span class="style7">modelo</span></th>
    <th colspan="3" scope="row"><div align="left" class="style7">
      <?= $row["modelo"];?>
    </div></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" scope="row"><span class="style7">Recibe </span></th>
    <th colspan="3" scope="row"><div align="left" class="style7">
      <?= $row["recibe"];?>
    </div></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" scope="row"><span class="style7">fecha de Recibo </span></th>
    <th colspan="3" bgcolor="#FFFF99" scope="row"><div align="left" class="style7">
      <div align="center">
        <input name="fecharec" type="hidden" id="fecharec" value="<?=date('Y-m-d');?>" />
        <?= $row["fecharec"];?>
      </div>
    </div></th>
  </tr>
  <tr>
    <th rowspan="2" bgcolor="#CCCCCC" scope="row"><span class="style7">DIAGNOSTICO</span> </th>
    <th colspan="3" scope="row"><div align="left">
      <?= $row["diag1"];?>
    </div></th>
  </tr>
  <tr>
    <th colspan="3" scope="row"><div align="left">
      <?= $row["diag2"];?>
    </div></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" class="style7" scope="row">Observaciones</th>
    <th colspan="3" class="style7" scope="row"><label>
    <div align="left">
      <?= $row["obs"];?>
    </div>
    </label></th>
  </tr>
  <tr>
    <th colspan="4" bgcolor="#990000" class="style7" scope="row"><div align="right"></div></th>
  </tr>
</table>
<?
	}
?>
<p align="center" class="style5">&nbsp;</p>
<hr />
<p align="center" class="Estilo1">IQelectronics
</body>
</html>
