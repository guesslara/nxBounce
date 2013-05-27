<?
	//leemos la cookie
	$usuario=$_COOKIE["usuario"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link type="text/css" rel="stylesheet" href="calendar.css">
<link type="text/css" rel="stylesheet" href="../style.css" />
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
	color: #000000;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #000000;
}
a:hover {
	text-decoration: underline;
	color: #000000;
}
a:active {
	text-decoration: none;
	color: #000000;
}
.style4 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
}
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
.style8 {color: #990000}
.style11 {
	color: #000000;
	font-weight: bold;
}
/*********************************/
#progreso {
	 color:#003399; font-weight:bold;
}

span {font-size:8pt; border:solid silver 1px;}
-->
</style>
</head>

<body>
<br />
<?
	include("../php/conectarbase.php");
	if($_GET['action']=="filtrar"){
		$filtro=$_GET['filtro'];
		if($filtro=="todos"){
			/*solo administradores*/
			if(($_COOKIE['nivel']=="0")||($_COOKIE['nivel']=="1")){
				$sql="select * from equiposrep order by tat desc";
			}else{
				//usuarios
				$sql="SELECT * FROM equiposrep WHERE repara='$usuario' and status_rep='DIAG' order by tat";
			}
		}else{
			if(($_COOKIE['nivel']=="0")||($_COOKIE['nivel']=="1")){
			/*solo administradores*/
				$sql="select * from equiposrep where status_rep='$filtro'";
			}else{
			//usuarios
				$sql="select * from equiposrep where status_rep='$filtro' and repara='$usuario'";
			}
		}
		//echo $sql;
		$msg_filtro="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;filtrados por: '$filtro'";	
	}else{
		$sql="SELECT * FROM equiposrep WHERE repara='$usuario' and status_rep='DIAG' order by tat";			
	}
	//echo $sql;
	$result=mysql_db_query("db_iqe_ref",$sql);
	$row=mysql_fetch_array($result);
?>
<!--<table width="100%" border="0" cellspacing="0">
  <tr>
    <td colspan="3" bgcolor="#CC3333"><div align="center" class="style1"><a href="findeqprep.php?status=<?=$row['status_rep'];?>" class="style1">Buscar Equipo a Reparar</a></div></td>
  </tr>
</table>-->
<table width="100%" cellpadding="0" cellspacing="0">	
	<tr>
		<td width="62%">
		<form id="form1" name="form1" method="post" action="">
		<table width="370" border="0" align="center" cellspacing="1" bordercolor="#333333">
			<tr>
				<th width="105" bgcolor="#CCCCCC"><span class="style7">Buscar ESN</span></th>
				<th colspan="2"><div align="left">
					<input name="esn" type="text" id="esn" size="30" />
				</div>
				<th width="65" colspan="2"><input type="button" name="button2" id="button2" value="Buscar" onclick="busqueda()" /></th>
		    </tr>
		  </table>
		</form>
	  </td>
		<td width="38%">
		<?
			$pag=$_SERVER['PHP_SELF'];
		?>
		<form name="filtro" action="" method="post">
	<table border="0" cellpadding="1">
		<tr>
			<td><span class="style7">Filtrar por</span>:
			  <select name="filtro" id="filtro" onChange="filtros(this.form.filtro.options[this.form.filtro.selectedIndex].value,'<?=$_COOKIE["usuario"];?>','<?=$_COOKIE['nivel'];?>')">
			    <option value="seleciona" selected="selected">Selecciona un valor</option>
                <option value="todos">todos</option>
				<option value="WIP">WIP</option>
			    <option value="NoRep">NoRep</option>
			    <option value="Scrap">Scrap</option>
				<option value="Rep">Rep</option>
				<option value="NOK">NOK</option>
              </select>			
		  </tr>
		  </table>
		</form>
	  </td>
	</tr>
</table>
	<?
	if($result==false){
	echo "<table width='297' border='0' align='center' cellspacing='1' bordercolor='#333333'>
      <tr>
        <th bgcolor='#990000' scope='row'><span class='style13'>.</span></th>
      </tr>
      <tr>
        <th><div align='center' class='Estilo1'>No se encontro ningun registro</div>
        </label></th>
      </tr>
      <tr>
        <th bgcolor='#990000' scope='row'><label></label>
            <div align='right' class='style13'>.</div>
          </label></th>
      </tr>
    </table>";	
	}else{
		$num_rows = mysql_num_rows($result);
	?>	
		<!--nuevo contenido-->
		<?
			$sql1="SELECT count( * ) AS total FROM equiposrep WHERE repara = '$usuario' AND status_rep='NoRep'";
			$result5=mysql_db_query("db_iqe_ref",$sql1);
			//$fila=mysql_fetch_array($result5);
			while($fila=mysql_fetch_array($result5)){
				$total=$fila['total'];
			}
			
			$sql2="SELECT count( * ) AS total FROM equiposrep WHERE repara = '$usuario' AND status_rep='Scrap'";
			$result6=mysql_db_query("db_iqe_ref",$sql2);
			//$fila1=mysql_fetch_array($result6);
			while($fila1=mysql_fetch_array($result6)){
				$tot=$fila1['total'];
			}
			$sql3="SELECT count( * ) AS total FROM equiposrep WHERE repara = '$usuario' AND status_rep='WIP'";
			$result7=mysql_db_query("db_iqe_ref",$sql3);
			//$fila2=mysql_fetch_array($result7);
			while($fila2=mysql_fetch_array($result7)){
				$total1=$fila2['total'];
			}
		?>
		<br />
		<table width="884" border="0" align="center" cellspacing="1" bordercolor="#333333">
  <tr>
    <th colspan="2" bgcolor="#333333" scope="row"><span class="style4">Equipos encontrados <?=$num_rows?></span><span class="style4"></span></th>
	<th colspan="2" bgcolor="#333333" scope="row"><span class="style4">No Reparados <?=$total;?></span></th>
	<th colspan="2" bgcolor="#333333" scope="row"><span class="style4">Scrap <?=$tot;?></span></th>
	<th colspan="4" bgcolor="#333333" scope="row"><span class="style4">WIP <?=$total1;?></span></th>
  </tr>
  <tr>
    <th width="82" bgcolor="#CCCCCC" scope="row"><span class="style7">OT</span></th>
    <th width="100" bgcolor="#CCCCCC" scope="row"><span class="style7">F. NEXTEL</span></th>
    <th width="91" bgcolor="#CCCCCC" scope="row"><span class="style7">ESN</span> </th>
    <th width="140" bgcolor="#CCCCCC" scope="row"><span class="style7">IMEI </span></th>
    <th width="66" bgcolor="#CCCCCC" scope="row"><span class="style7">Modelo</span></th>
    <th width="103" bgcolor="#CCCCCC" scope="row"><span class="style7">F. de Recibo </span></th>
	<th width="98" bgcolor="#CCCCCC" scope="row"><span class="style7">TAT </span></th>
	<th width="76" bgcolor="#CCCCCC" scope="row"><span class="style7">STATUS </span></th>
	<th width="100" bgcolor="#CCCCCC" scope="row"><span class="style7">T&eacute;cnico</span></th>
  </tr>
  <?	
		  	$color=="#D9FFB3";
			$i=1;
		do{
?>
  <tr>
    <th bgcolor="<?=$color;?>" class="style7" scope="row"><?= $row["ot"];?></th>
    <th bgcolor="<?=$color;?>" class="style7" scope="row"><?= $row["fnextel"];?></th>
    <!--<th bgcolor="<?$color;?>" class="style7" scope="row"><a href="repeqpo.php?action=mostrar&esn=<?$row["esn"];?>&status=<?$row["status_rep"];?>&ot=<?$row["ot"];?>" title="Haga clic para Capturar Información sobre la Reparacion"><?$row["esn"];?></a></th>-->
	<th bgcolor="<?=$color;?>" class="style7" scope="row"><a href="javascript:consultas('<?=$row["esn"];?>','<?=$row["status_rep"];?>','<?=$row["ot"];?>')" title="Haga clic para Capturar Información sobre la Reparacion"><?=$row["esn"];?></a></th>
    <th bgcolor="<?=$color;?>" class="style7" scope="row"><?= $row["imei"];?></th>
    <th bgcolor="<?=$color;?>" class="style7" scope="row"><?= $row["modelo"];?></th>
    <th bgcolor="<?=$color;?>" class="style7" scope="row"><?= $row["fecharec"];?></th>
	<th bgcolor="#FFFF00" class="style7" scope="row"><?= $row["tat"];?></th>
	<th bgcolor="<? echo $color; ?>" class="style7" scope="row"><?= $row["status_rep"];?></th>
	<th bgcolor="<? echo $color; ?>" class="style7" scope="row"><?= $row["repara"];?></th>
 </tr>
  <?
  	if ($color=="#D9FFB3") 
				$color="#FFFFFF";
			else 
				$color="#D9FFB3";
	}
	while($row=mysql_fetch_array($result))
?>
  <tr>
    <th colspan="9" bgcolor="#333333" scope="row">&nbsp;</th>
  </tr>
</table>
		<!--fin nuevo contenido-->
	<?
	}
	//datos de prueba de actualizacion
	$s=$_GET['sql'];
	echo $s;	
	?>
<p align="center" class="style2 style8">IQelectronics SA de CV &copy;</p>
<div align="center"></div>
</body>
</html>
