<?
	//se recibe el esn del equipo
	$esn=$_GET['esn'];
	$cap=$_GET['cap'];
	$fnextel=$_GET['fnextel'];
	$imei=$_GET['imei'];
	$modelo=$_GET['modelo'];
	$diagnostico1=$_GET['diagnostico1'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Verificacion de Garantias</title>
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
	color: #666666;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #666666;
}
a:hover {
	text-decoration: underline;
	color: #666666;
}
a:active {
	text-decoration: none;
	color: #CCCCCC;
}
.style4 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
}
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
.style8 {color: #990000}
/*esquinas*/
.roundedcornr_box_603736 {
	background: url(../img/esquinas/roundedcornr_603736_tl.png) no-repeat top left;
}
.roundedcornr_top_603736 {
	background: url(../img/esquinas/roundedcornr_603736_tr.png) no-repeat top right;
}
.roundedcornr_bottom_603736 {
	background: url(../img/esquinas/roundedcornr_603736_bl.png) no-repeat bottom left;
}
.roundedcornr_bottom_603736 div {
	background: url(../img/esquinas/roundedcornr_603736_br.png) no-repeat bottom right;
}
.roundedcornr_content_603736 {
	background: url(../img/esquinas/roundedcornr_603736_r.png) top right repeat-y;
}

.roundedcornr_top_603736 div,.roundedcornr_top_603736,
.roundedcornr_bottom_603736 div, .roundedcornr_bottom_603736 {
	width: 100%;
	height: 10px;
	font-size: 1px;
}
.roundedcornr_content_603736, .roundedcornr_bottom_603736 {
	margin-top: -19px;
}
.roundedcornr_content_603736 { padding: 0 10px; }
-->
</style>
</head>

<body><br />
<blockquote>
  <p>
    [<a href="regeqpo.php?action=garantia&cap=<?=$cap;?>&esn=<?=$esn;?>&fnextel=<?=$fnextel;?>&imei=<?=$imei;?>&modelo=<?=$modelo;?>&diagnostico1=<?=$diagnostico1;?>" title="Regresar a la captura del equipo">Capturar Garantia</a>]&nbsp;
	[<a href="regeqpo.php?action=nuevo" title="Capturar nuevo Equipo">Capturar nuevo Equipo</a>]
  </p>
</blockquote>
<div align="center">
<?
	if($_GET['action']=="nuevo"){
		include("../php/conectarbase.php");
		$base="db_iqe_ref";
		$sql="select * from equiposrep where esn='$esn' order by shipdate";
		$result=mysql_db_query($base,$sql);
		$tequipos=mysql_num_rows($result);
		?>
		<center>
		<table width="860" border="0" cellpadding="1" cellspacing="0">
			<tr>
				<td width="49"><img src="../img/Attention.png" alt="Informaci&oacute;n" width="41" height="43" /></td>
				<td width="801"><div align="left"><span class="Estilo1">Equipo(s) con  el mismo numero de serie</span></div></td>
			</tr>
  </table>
		</center><br>
		  <table width="860" border="1" cellpadding="1" cellspacing="0">
			<tr class="style7">
			  <td bgcolor="#CCCCCC" class="style7"><div align="center">OT</div></td>
			  <td bgcolor="#CCCCCC" class="style7"><div align="center">ESN</div></td>
			  <td bgcolor="#CCCCCC" class="style7"><div align="center">FNEXTEL</div></td>
			  <td bgcolor="#CCCCCC" class="style7"><div align="center">IMEI</div></td>
			  <td bgcolor="#CCCCCC" class="style7"><div align="center">Modelo</div></td>
			  <td bgcolor="#CCCCCC" class="style7"><div align="center">Process </div></td>
			  <td bgcolor="#CCCCCC" class="style7"><div align="center">F. Recibo</div></td>
			  <td bgcolor="#CCCCCC" class="style7"><div align="center">ShipDate</div></td>
			  <td bgcolor="#CCCCCC" class="style7">&nbsp;</td>
			</tr>
			<?
				while($fila=mysql_fetch_array($result)){
				?>
			<tr class="style7">
			  <td><div align="center">
				  <?=$fila['ot'];?>
			  &nbsp;</div></td>
			  <td><div align="center">
				  <?=$fila['esn'];?>
			  &nbsp;</div></td>
			  <td><div align="center">
				  <?=$fila['fnextel'];?>
			  &nbsp;</div></td>
			  <td><div align="center">
				  <?=$fila['imei'];?>
			  &nbsp;</div></td>
			  <td><div align="center">
				  <?=$fila['modelo'];?>
			  &nbsp;</div></td>
			  <td><div align="center">
				  <?=$fila['process'];?>
			  &nbsp;</div></td>
			  <td><div align="center">
				  <?=$fila['fecharec'];?>
			  &nbsp;</div></td>
			  <td><div align="center">
				  <?=$fila['shipdate'];?>
			  &nbsp;</div></td>
			  <td><div align="center">
				  <a href="vgarantia.php?action=detalles&ot=<?=$fila['ot'];?>&esn=<?=$fila['esn']?>&fnextel=<?=$fnextel;?>&imei=<?=$imei;?>&modelo=<?=$modelo;?>&diagnostico1=<?=$diagnostico1;?>&cap=<?=$cap;?>">Detalles</a>
			  &nbsp;</div></td>
			</tr>
				<?
				}
			?>
			<tr class="style7">
			  <td bgcolor="#CCCCCC">Total</td>
			  <td bgcolor="#CCCCCC"><?=$tequipos;?>&nbsp;</td>
			  <td colspan="7" bgcolor="#CCCCCC">&nbsp;</td>
		    </tr>
		  </table>
<?		  
	}
	
  if($_GET['action']=="detalles"){
  	$ot=$_GET['ot'];
	$esn=$_GET['esn'];
	include("../php/conectarbase.php");
	$base="db_iqe_ref";
	/*********FRAGMENTO*********/
	$sql="select * from equiposrep where esn='$esn' order by shipdate";
	$result=mysql_db_query($base,$sql);
	$tequipos=mysql_num_rows($result);
	?>
	<table width="860" border="0" cellpadding="1" cellspacing="0">
			<tr>
				<td width="49"><img src="../img/Attention.png" alt="Informaci&oacute;n" width="41" height="43" /></td>
				<td width="801"><div align="left"><span class="Estilo1">Equipo(s) con  el mismo numero de serie</span></div></td>
			</tr>
  </table>
  <table width="860" border="1" cellpadding="1" cellspacing="0">
    <tr class="style7">
      <td bgcolor="#CCCCCC" class="style7"><div align="center">OT</div></td>
      <td bgcolor="#CCCCCC" class="style7"><div align="center">ESN</div></td>
      <td bgcolor="#CCCCCC" class="style7"><div align="center">FNEXTEL</div></td>
      <td bgcolor="#CCCCCC" class="style7"><div align="center">IMEI</div></td>
      <td bgcolor="#CCCCCC" class="style7"><div align="center">Modelo</div></td>
      <td bgcolor="#CCCCCC" class="style7"><div align="center">Process </div></td>
      <td bgcolor="#CCCCCC" class="style7"><div align="center">F. Recibo</div></td>
      <td bgcolor="#CCCCCC" class="style7"><div align="center">ShipDate</div></td>
	  <td bgcolor="#CCCCCC" class="style7">&nbsp;</td>
    </tr>
    <?
		while($fila=mysql_fetch_array($result)){
		?>
	<tr class="style7">
      <td><div align="center">
          <?=$fila['ot'];?>
      &nbsp;</div></td>
      <td><div align="center">
          <?=$fila['esn'];?>
      &nbsp;</div></td>
      <td><div align="center">
          <?=$fila['fnextel'];?>
      &nbsp;</div></td>
      <td><div align="center">
          <?=$fila['imei'];?>
      &nbsp;</div></td>
      <td><div align="center">
          <?=$fila['modelo'];?>
      &nbsp;</div></td>
      <td><div align="center">
          <?=$fila['process'];?>
      &nbsp;</div></td>
      <td><div align="center">
          <?=$fila['fecharec'];?>
      &nbsp;</div></td>
      <td><div align="center">
          <?=$fila['shipdate'];?>
      &nbsp;</div></td>
	  <td><div align="center">
          <a href="vgarantia.php?action=detalles&ot=<?=$fila['ot'];?>&esn=<?=$fila['esn']?>&fnextel=<?=$fnextel;?>&imei=<?=$imei;?>&modelo=<?=$modelo;?>&diagnostico1=<?=$diagnostico1;?>&cap=<?=$cap;?>">Detalles</a>
      &nbsp;</div></td>
    </tr>
		<?
		}
	?>
	<tr class="style7">
      <td bgcolor="#CCCCCC"><div align="center"><strong>Total</strong></div></td>
      <td bgcolor="#CCCCCC"><div align="center"><strong>
          <?=$tequipos;?>
      &nbsp;</strong></div></td>
      <td colspan="7" bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
  </table>
  <?
	/**************************/
	$sql="select * from equiposrep where ot='$ot'";
	$result=mysql_db_query($base,$sql);
	$fila1=mysql_fetch_array($result);
	?>
		<br />
		<table width="588" border="1" cellpadding="1" cellspacing="0">
		<tr>
		  <td colspan="3" class="Estilo1" bgcolor="#CCCCCC"><div align="left">Datos del Equipo </div></td>
		</tr>
		<tr>
		  <td width="223" class="style7"><div align="right"><strong>OT</strong></div></td>
		  <td width="343" colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['ot'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>CAP</strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['cap'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Folio Nextel </strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['fnextel'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>ESN</strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['esn'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>IMEI</strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['imei'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Modelo</strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['modelo'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Recibido por: </strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['recibe'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Fecha de Recibo </strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['fecharec'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Diagnostico 1 </strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['diag1'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Diagnostico 2 </strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['diag2'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Observaciones</strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['obs'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Status</strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['status'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Status General</strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['statusgral'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Fecha Inicio Reparacion</strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['fechainirep'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Fecha Fin Reparaci&oacute;n</strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['fechafinrep'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Status de la Reparaci&oacute;n</strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['status_rep'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Observaciones de la Reparaci&oacute;n</strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['obsrep'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Asignado a </strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['repara'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Tat</strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['tat'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Process</strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['process'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Status Control Calidad</strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['status_cc'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td class="style7"><div align="right"><strong>Status Despacho</strong></div></td>
		  <td colspan="2" class="style7" style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior"><?=$fila1['status_despacho'];?>&nbsp;</td>
		</tr>
		<tr>
		  <td colspan="3" bgcolor="#CCCCCC">&nbsp;</td>
		</tr>
  </table>
	  <br />
	  <?
		$sql="select * from repdiagnostico where ot='$ot'";
		$result=mysql_db_query($base,$sql);
		while($fila2=mysql_fetch_array($result)){
			$cl[]=$fila2['clavediag'];
			$des[]=$fila2['des'];
		}
	  ?>
	  <table width="588" border="1" cellpadding="1" cellspacing="0">
	  <tr>
		<td colspan="3" bgcolor="#CCCCCC"><div align="left" class="Estilo1">Datos de la Reparaci&oacute;n </div></td>
		</tr>
	  <tr>
		<td colspan="3"><div align="left" class="style1">Diagnostico (s) realizados </div></td>
		</tr>
	  <tr style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior">
		<td width="95" bgcolor="#CFCFCF" class="style7"><strong>Diagnostico 1: </strong></td>
		<td width="80" class="style7"><?=$cl[0];?>&nbsp;</td>
		<td width="391" class="style7"><?=$des[0];?>&nbsp;</td>
	  </tr>
	  <tr style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior">
		<td bgcolor="#CFCFCF" class="style7"><strong>Diagnostico 2: </strong></td>
		<td class="style7"><?=$cl[1];?>&nbsp;</td>
		<td class="style7"><?=$des[1];?>&nbsp;</td>
	  </tr>
	  <tr style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior">
		<td bgcolor="#CFCFCF" class="style7"><strong>Diagnostico 3: </strong></td>
		<td class="style7"><?=$cl[2];?>&nbsp;</td>
		<td class="style7"><?=$des[2];?>&nbsp;</td>
	  </tr>
	  <tr>
		<td colspan="3" class="style1">&nbsp;</td>
		</tr>
	  <tr>
		<td colspan="3"><div align="left" class="style1">Refacciones Utilizadas </div></td>
		</tr>
		<?
			$sql="select * from rep_refac_utilizadas where ot='$ot'";
			$result=mysql_db_query($base,$sql);
			while($fila3=mysql_fetch_array($result)){
				$cl1[]=$fila3['claverefac'];
				$des1[]=$fila3['des'];
			}
		?>
	  <tr style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior">
		<td bgcolor="#CFCFCF" class="style7"><strong>Refacci&oacute;n 1: </strong></td>
		<td class="style7"><?=$cl1[0];?>&nbsp;</td>
		<td class="style7"><?=$des1[0];?>&nbsp;</td>
	  </tr>
	  <tr style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior">
		<td bgcolor="#CFCFCF" class="style7"><strong>Refacci&oacute;n 2:</strong></td>
		<td class="style7"><?=$cl1[1];?>&nbsp;</td>
		<td class="style7"><?=$des1[1];?>&nbsp;</td>
	  </tr>
	  <tr style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior">
		<td bgcolor="#CFCFCF" class="style7"><strong>Refacci&oacute;n 3:</strong></td>
		<td class="style7"><?=$cl1[2];?>&nbsp;</td>
		<td class="style7"><?=$des1[2];?>&nbsp;</td>
	  </tr>
	  <tr style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior">
		<td bgcolor="#CFCFCF" class="style7"><strong>Refacci&oacute;n 4:</strong></td>
		<td class="style7"><?=$cl1[3];?>&nbsp;</td>
		<td class="style7"><?=$des1[3];?>&nbsp;</td>
	  </tr>
	  <tr style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior">
		<td bgcolor="#CFCFCF" class="style7"><strong>Refacci&oacute;n 5:</strong></td>
		<td class="style7"><?=$cl1[4];?>&nbsp;</td>
		<td class="style7"><?=$des1[4];?>&nbsp;</td>
	  </tr>
	  <tr style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior">
		<td bgcolor="#CFCFCF" class="style7"><strong>Refacci&oacute;n 6:</strong></td>
		<td class="style7"><?=$cl1[5];?>&nbsp;</td>
		<td class="style7"><?=$des1[5];?>&nbsp;</td>
	  </tr>
	  <tr>
		<td colspan="3">&nbsp;</td>
		</tr>
	  <tr>
		<td colspan="3"><div align="left" class="style1">Reparaci&oacute;n Efectuada </div></td>
		</tr>
		<?
			$sql="select * from rep_efectuada where ot='$ot'";
			$result=mysql_db_query($base,$sql);
			while($fila4=mysql_fetch_array($result)){
				$cl2[]=$fila4['clave_rep'];
				$des2[]=$fila4['des'];
			}
		?>
	  <tr style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior">
		<td bgcolor="#CFCFCF" class="style7"><strong>Reparaci&oacute;n 1: </strong></td>
		<td class="style7"><?=$cl2[0];?>&nbsp;</td>
		<td class="style7"><?=$des2[0];?>&nbsp;</td>
	  </tr>
	  <tr style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior">
		<td bgcolor="#CFCFCF" class="style7"><strong>Reparaci&oacute;n 2:</strong></td>
		<td class="style7"><?=$cl2[1];?>&nbsp;</td>
		<td class="style7"><?=$des2[1];?>&nbsp;</td>
	  </tr>
	  <tr style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
		onmouseout="this.style.backgroundColor=anterior">
		<td bgcolor="#CFCFCF" class="style7"><strong>Reparaci&oacute;n 3:</strong></td>
		<td class="style7"><?=$cl2[2];?>&nbsp;</td>
		<td class="style7"><?=$des2[2];?>&nbsp;</td>
	  </tr>
	  <tr>
		<td colspan="3">&nbsp;</td>
		</tr>
  </table>  
<?	
  }
  ?>
</div>
<br />
</body>
</html>
