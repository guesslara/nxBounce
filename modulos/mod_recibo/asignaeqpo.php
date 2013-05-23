<?
	//sacamos los datos del usuario para ver si tiene acceso a esta parte
	$nivel_usuario=$_COOKIE['nivel'];
	//echo $nivel;
	//niveles de acceso a esta pagina
	$nivel_pag=array(0,1,2);
	for($i=0;$i<count($nivel_pag);$i++){
		//comparamos el nivel del usuario
		if(!in_array($nivel_usuario,$nivel_pag)){
		?>
			<script language="javascript">
				alert('Modulo en mantenimiento!!!!');
				history.back();
			</script>
		<?
		}
	}
?>
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
-->
</style>
</head>
<body>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td colspan="3" bgcolor="#999999"><div align="center" class="style1"><span class="style3"><a href="regeqpo.php">Registro de Equipo</a> |<a href="findeqp.php"> Buscar Equipos</a> | <a href="asignaeqpo.php">Asignar Equipos</a></span></div></td>
  </tr>
</table>
<?
	if($_POST){
		$ot=$_POST['ot'];
		$esn=$_POST['esn'];
		$fechainirep=$_POST['fechainirep'];
		$tec=$_POST['tecnico'];
		if($tec==""){
			echo "<script language='javascript'>alert('Debes seleccionar un Técnico');</script>";
		}else{
			include("../php/conectarbase.php");
			$SQL="UPDATE equiposrep SET statusgral='REP', repara='$tec', fechainirep='$fechainirep', status_rep='DIAG' WHERE ot='$ot'";
			//echo $SQL;
			mysql_db_query("db_iqe_ref",$SQL);
		}
	}
	if ($_GET){
		$del=$_GET['del'];
		$esn=$_GET['id'];
		if ($del=='del'){
			include("../php/conectarbase.php");
			$SQL="UPDATE equiposrep SET statusgral='REC', repara='', fechainirep='', status_rep='' WHERE esn='$esn'";
		//echo $SQL;
		mysql_db_query("db_iqe_ref",$SQL);
		}
	}
?>
<!--nuevo forma de asignar-->
<?
	include("../php/conectarbase.php");
	$sql="SELECT * FROM equiposrep where repara=''";
	$result=mysql_db_query("db_iqe_ref",$sql);
	$i=0;
?>
<table width="951" border="0" align="center" cellspacing="1" bordercolor="#333333">
  <tr>
    <th colspan="9" bgcolor="#999999" scope="row"><span class="style4">Listado de Equipos</span></th>
  </tr>
  <tr>
    <th width="83" bgcolor="#CCCCCC" scope="row"><span class="style7">OT</span></th>
    <th width="119" bgcolor="#CCCCCC" scope="row"><span class="style7">CAP </span></th>
    <th width="96" bgcolor="#CCCCCC" scope="row"><span class="style7">F. NEXTEL</span></th>
    <th width="107" bgcolor="#CCCCCC" scope="row"><span class="style7">ESN</span></th>
    <th width="88" bgcolor="#CCCCCC" scope="row"><span class="style7">Proceso</span></th>
    <th width="75" bgcolor="#CCCCCC" scope="row"><span class="style7">modelo</span></th>
    <th width="93" bgcolor="#CCCCCC" scope="row"><span class="style7">f. de Recibo </span></th>
	<th width="159" bgcolor="#CCCCCC" scope="row"><span class="style7">Asignar a: </span></th>
	<th width="103" colspan="2" bgcolor="#CCCCCC" scope="row"><span class="style7">Registrar </span></th>
  </tr>
  	<?
  	while($fila=mysql_fetch_array($result))
	{
			if($i % 2 == 0){
				$bgcolor = "#F0F0F0";
			}else{
				$bgcolor = "FFFFFF";
			}	
			$nf="form".$i;			
	?>
	<form id="form" name="<?=$nf?>" method="post" action="asignaeqpo.php" onSubmit="return validaAsignacion()" >
	<tr><input name="fechainirep" type="hidden" id="fechainirep" value="<?=date('Y-m-d');?>" />
		<th scope="row" class="style7" bgcolor="<?=$bgcolor;?>"><?=$fila['ot'];?>
		  &nbsp;
	    <input type="hidden" name="ot" value="<?=$fila['ot'];?>" /></th>
		<th scope="row" class="style7" bgcolor="<?=$bgcolor;?>"><?=$fila['cap'];?>&nbsp;</th>
		<th scope="row" class="style7" bgcolor="<?=$bgcolor;?>"><?=$fila['fnextel'];?>&nbsp;</th>
		<th scope="row" class="style7" bgcolor="<?=$bgcolor;?>"><input name="esn" type="hidden" id="esn1" value="<?=$fila['esn'];?>" ><?=$fila['esn'];?>&nbsp;</th>
		<th scope="row" class="style7" bgcolor="<?=$bgcolor;?>"><?=$fila['process'];?>&nbsp;</th>
		<th scope="row" class="style7" bgcolor="<?=$bgcolor;?>"><?=$fila['modelo'];?>&nbsp;</th>
		<th bgcolor="<?=$bgcolor;?>" class="style7" scope="row"><?=$fila['fecharec'];?>		  &nbsp;&nbsp;</th>
		<th bgcolor="<?=$bgcolor;?>" class="style7" scope="row">
		<select name="tecnico" id="tecnico">
        <option></option>
<?
	//cargando Valores para combos
		include("../php/conectarbase.php");
		$sql1="SELECT * FROM userdbomega WHERE nivel_acceso=3 ";
		$result1=mysql_db_query("db_iqe_ref",$sql1);
		while($row=mysql_fetch_array($result1)){
?>
        <option value="<?=$row[3].'.'.$row[4];?>"><?=$row[3].'.'.$row[4];?></option>
<?
		}
?>
        </select>		</th>
	  <th width="103" bgcolor="<?=$bgcolor;?>" class="style7" scope="row"><input type="submit" id="Asignar" value="Asignar" /></th>
	</tr>
	</form>
	<?
	$i=$i+1;
	}
	?>
</table>
.
<!--fin nueva forma-->
<table width="656" border="0" align="center" cellspacing="1" bordercolor="#333333">
  <tr>
    <th colspan="4" bgcolor="#999999" scope="row"><span class="style4">Equipo Registrado</span></th>
  </tr>
  <tr>
    <th width="142" bgcolor="#CCCCCC" scope="row"><span class="style7">ESN</span></th>
    <th width="340" bgcolor="#CCCCCC" scope="row"><span class="style7">Tecnico </span>    </th>
    <th width="136" bgcolor="#CCCCCC" scope="row"><span class="style7">Fecha ini. Rep</span></th>
    <th width="25" bgcolor="#CCCCCC" scope="row">&nbsp;</th>
  </tr>
<?
	/*if($_POST){
		echo $esn=$_POST['esn'];
		echo $fechainirep=$_POST['fechainirep'];
		echo $tec=$_POST['tecnico'];
		include("../php/conectarbase.php");
		$SQL="UPDATE equiposrep SET statusgral='REP', repara='$tec', fechainirep='$fechainirep', status_rep='DIAG' WHERE esn='$esn'";
		//echo $SQL;
		mysql_db_query("dbcopiaomega",$SQL);
	}*/
	/*if ($_GET){
		$del=$_GET['del'];
		$esn=$_GET['id'];
		if ($del=='del'){
			include("../php/conectarbase.php");
			$SQL="UPDATE equiposrep SET statusgral='REC', repara='', fechainirep='', status_rep='' WHERE esn='$esn'";
		//echo $SQL;
		mysql_db_query("dbcopiaomega",$SQL);
		}
	}*/
		
		//cargando radios capturados
		include("../php/conectarbase.php");
		//$sql3="SELECT * FROM equiposrep WHERE status_rep='DIAG' and esn='$esn' ORDER BY ot";
		$sql3="SELECT * FROM equiposrep WHERE status_rep='DIAG' ORDER BY ot";
		//echo $sql3;
		$result3=mysql_db_query("db_iqe_ref",$sql3);
		while($row3=mysql_fetch_array($result3)){
?>
  <tr>
    <th class="style7" scope="row"><?= $row3['esn'];?></th>
    <th class="style7" scope="row"><?= $row3['repara'];?></th>
    <th class="style7" scope="row"><?= $row3['fechainirep'];?></th>
    <th class="style7" scope="row"><a href="asignaeqpo.php?del=del&id=<?= $row3['esn'];?>"><img src="../img/del.png" alt="del" width="16" height="16" border="0" /></a></th>
  </tr>
<?
	}
?>
  <tr>
    <th colspan="4" bgcolor="#990000" class="style7" scope="row"></label></th>
  </tr>
</table>
<hr color="#990000"/>
<p align="center" class="style2 style8">IQelectronics SA de CV &copy; </p>
<div align="center"></div>
</body>
</html>
