<?	
	// le damos un mobre a la sesion.
    session_name($reparacion);
    // incia sessiones
    session_start();
	// Paranoia: decimos al navegador que no "cachee" esta página.
    session_cache_limiter('nocache,private');
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link type="text/css" rel="stylesheet" href="calendar.css">
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
	color: #CCCCCC;
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
.style13 {font-size: 9px}
.style14 {color: #FFFFFF}
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
<script language="javascript" src="javascript/funciones.js"></script>
<script language="javascript">
	var anterior;
	function borrarContenido(campo1,campo2){
		document.getElementById(campo1).value="";
		document.getElementById(campo2).value="";
	}
	
	function mostrarAdvertencia(){
		if(document.frm.chk1.checked){
			alert('No olvide anotar comentarios en el campo observaciones.');
		}else{
			alert('Ha quitado la selección que indica que la SIM esta dañada'+'\n'+'Si se equivoco vuelva a seleccionar esta opción');
		}
		
	}
</script>
</head>

<body>
<!--<table width="100%" border="0" cellspacing="0">
  <tr>
    <td colspan="3" bgcolor="#CC3333"><div align="center" class="style1"><a href="findeqprep.php">Buscar Equipo a Reparar</a></div></td>
  </tr>
</table>-->
<blockquote>
  <p>
    <?
	if($_GET['action']=="mostrar"){
		$esn=$_GET['esn'];
		$ot=$_GET['ot'];
	}/*else{
		$esn=$_POST['esn'];
		$ot=$_GET['ot'];
	}*/
	
	if($_GET['action']=="busqueda"){
		$x=false;
		$esn=$_GET['esn'];
		include("../php/conectarbase.php");
		$sqlx="select * from equiposrep where esn='$esn' order by fecharec DESC";
		$resultx=mysql_db_query("dbomega",$sqlx);
		?>
    <span class="Estilo1"><img src="../img/Attention.png" alt="Informaci&oacute;n" width="41" height="43" />&nbsp;Seleccione el equipo a Reparar...</span>
  </p>
</blockquote>
<center>
  <table width="797" border="1" cellpadding="1" cellspacing="0">
    <tr>
      <td width="134" bgcolor="#CCCCCC" class="style7"><div align="center"><strong>OT</strong></div></td>
      <td width="150" bgcolor="#CCCCCC" class="style7"><div align="center"><strong>ESN</strong></div></td>
      <td width="142" bgcolor="#CCCCCC" class="style7"><div align="center"><strong>Fecha Rec.</strong></div></td>
      <td width="148" bgcolor="#CCCCCC" class="style7"><div align="center"><strong>Modelo</strong></div></td>
      <td width="201" bgcolor="#CCCCCC" class="style7"><div align="center"><strong>Status Reparaci&oacute;n </strong></div></td>
      <td width="201" bgcolor="#CCCCCC" class="style7"><div align="center"><strong>Reparar</strong></div></td>
    </tr>
    <?
		while($fila=mysql_fetch_array($resultx)){
		?>
    <tr style="background-Color:#ffffff; cursor:hand;" onmouseover="anterior=this.style.backgroundColor;this.style.backgroundColor='#D9FFB3'"
onmouseout="this.style.backgroundColor=anterior" />  
  <td width="134" class="style7"><?=$fila['ot'];?></td>
      <td width="150" class="style7"><?=$fila['esn'];?></td>
    <td width="142" class="style7"><?=$fila['fecharec'];?></td>
    <td width="148" class="style7"><?=$fila['modelo'];?></td>
    <td width="201" class="style7"><?=$fila['status_rep'];?></td>
    <!--<td width="201" class="style7"><a href="repeqpo.php?action=mostrar&esn=<?$fila["esn"];?>&status=<?$fila["status_rep"];?>&ot=<?$fila["ot"];?>">Reparar</a></td>-->
    <td width="201" class="style7" align="center"><a href="javascript:seleccionReparacion('<?=$fila["esn"];?>','<?=$fila["status_rep"];?>','<?=$fila["ot"];?>')">Reparar</a></td>
  </tr>
  <?	
		}
		?>
  </table>
</center>
<?
	}
	
	$status=$_GET['status'];
	//echo $status;
	
	if($status=="DIAG"){
		$consulta="insertar";
	}else{
		$consulta="actualizar";
	}
	//echo $consulta;
	if(!x==false){
	
	}
	include("../php/conectarbase.php");
	$sql="SELECT equiposrep.*,codfallas.descripcion FROM equiposrep, codfallas WHERE (esn='$esn' and codfallas.codigo=equiposrep.diag1) and ot='$ot'";
	//echo $sql;
	$result=mysql_db_query("dbomega",$sql);
	$row=mysql_fetch_array($result);
	$num_rows = mysql_num_rows($result);
	//numero de orden
	$ot=$row[1];
	if($num_rows==0){
?>
<br />
<table width="297" border="0" align="center" cellspacing="1" bordercolor="#333333">
      <tr>
        <th bgcolor="#990000" scope="row"><span class="style13">.</span></th>
      </tr>
      <tr>
        <th><div align="center" class="Estilo1">Verifique la informaci&oacute;n </div>
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
<table width="874" border="0" align="center" cellspacing="1" bordercolor="#333333">
  <tr>
    <th colspan="6" bgcolor="#990000" scope="row"><span class="style4">Datos del Equipo-- OT #: <?=$row[1];?><span class="style7">
        
    </span></span></th>
  </tr>
  <tr>
    <th width="112" bgcolor="#CCCCCC" class="style7">Fol. NEXTEL</th>
    <th width="120" class="style7"><?=$row['fnextel'];?></th>
    <th width="76" bgcolor="#CCCCCC" class="style7">ESN</th>
    <th width="145" class="style7"><?=$row['esn'];?></th>
    <th width="72" bgcolor="#CCCCCC" class="style7">IMEI</th>
    <th width="253" class="style7"><?=$row['imei'];?></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" class="style7" scope="row">Modelo</th>
    <th class="style7" scope="row"><?=$row['modelo'];?></th>
    <th bgcolor="#CCCCCC" class="style7" scope="row">Fech. Rec.</th>
    <th class="style7" scope="row"><?=$row['fecharec'];?></th>
    <th rowspan="2" bgcolor="#CCCCCC" class="style7" scope="row">Falla Rep.</th>
    <th class="style7" scope="row"><?=$row['diag1'];?>
    .-<?=$row['descripcion'];?></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" class="style7" scope="row">Obs.</th>
    <th colspan="3" class="style7" scope="row"><div align="left"><?=$row['obs'];?>
    </div></th>
    <th class="style7" scope="row"><?=$row['diag2'];?></th>
  </tr>
  <?
  	if($row['modelo']=="BB7100i"){
	?>
		<tr>
			<th colspan="6" bgcolor="#990000" class="style7" scope="row">&nbsp;</th>
		</tr>
		<tr>
		<th bgcolor="#CCCCCC" class="style7" scope="row">Equipo Blackberry </th>
		<th colspan="5" bgcolor="" class="style1" scope="row">
		  <div align="left">
			<?
				echo "Equipo con BATERIA: ".$row['bateria']."<br>";
				echo "Equipo con TAPA: ".$row['tapa']."<br>";
				echo "Equipo con SIM: ".$row['sim'];			
		    ?>
			&nbsp;
		  </div></th>
	  </tr>
	<?  
	}
  ?>
  
  <tr>
    <th colspan="6" bgcolor="#FFFF00" class="Estilo1" scope="row">
 <?
 	$ftat=$row['tat'];
	$f=explode("-",$ftat);
	echo date("l d, F Y", mktime (0,0,0,$f[1],$f[2],$f[0]));
 ?>   	</th>
  </tr>
  <tr>
    <th colspan="6" scope="row"><hr color="#990000"/></th>
  </tr>
</table>
<?
	//realizar verificacion hacia la base de datos
	//cuadro en caso que se haya regresado un equipo a reparacion
	$sqlx="select * from pruebas where ot='$ot' and status='NOK'";
	$resultx=mysql_db_query('dbomega',$sqlx);
	do{
		$status_calidad=$fila['status'];
		$observaciones=$fila['observaciones'];
	}while($fila=mysql_fetch_array($resultx));
	//echo $status_calidad;
	if($status_calidad=="NOK"){
		?>
		<center>
		<table width="785" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
				<div class="roundedcornr_box_603736">
				   <div class="roundedcornr_top_603736"><div></div></div>
					  <div class="roundedcornr_content_603736">
						 <p class="Estilo1" align="left"><img src="../img/s_warn.png" />&nbsp;Observaciones:</p>
						 <p class="Estilo1" align="left"><?=$observaciones;?></p>
					  </div>
				   <div class="roundedcornr_bottom_603736"><div></div></div>
				</div>				</td>
			</tr>
		</table>
		</center>
		<?
	}
	?>
<form id="frm" name="frm" method="post" action="guardarep.php?ot=<?=$row[1];?>&consulta=<?=$consulta?>&mod=<?=$row['modelo'];?>" onsubmit="return confirmar()" >
  <table width="874" border="0" align="center" cellspacing="0" bordercolor="#000000">
    <tr>
      <th width="559" scope="row"><table width="539" border="0" cellspacing="1" bordercolor="#000000">
          <tr>
            <th colspan="5" bgcolor="#990000" class="style4" scope="row">Datos de Reparacion</th>
          </tr>
          <tr>
            <th width="15%" bgcolor="#CCCCCC" class="style7" scope="row">Fecha  Inicio</th>
            <th width="26%" class="style1" scope="row"><label>
              <?=$row['fecharec'];?>
              <span class="style7">
              <input name="modelo" type="hidden" value="<?=$row['modelo'];?>" />
              </span></label></th>
            <th width="18%" bgcolor="#CCCCCC" class="style7" scope="row">Status</th>
            <th width="41%" colspan="2" class="style7" scope="row"><label>
              <div align="left">
			  <?
			  	$sql="SELECT * from equiposrep where esn='$esn' and ot='$ot'";
				//echo $SQL;
				$result2=mysql_db_query("dbomega",$sql);
				$row1=mysql_fetch_array($result2);
			  ?>
                <select name="status" id="status">
                  <option  value="<?=$row1['status_rep']?>" selected="selected"><?=$row1['status_rep']?></option>
                  <option value="WIP">WIP</option>
                  <option value="Rep">Rep</option>
                  <option value="NoRep">NoRep</option>
                  <option value="Scrap">Scrap</option>
                </select>
              </div>
            </label></th>
          </tr>
          <tr class="style7">
            <th bgcolor="#CCCCCC" class="style7" scope="row">Fecha fin</th>
            <th class="style1" scope="row"><label>
              <input type="hidden" name="fecha_fin" id="hiddenField" value="<?=date("Y-m-d");?>"/><?=date("Y-m-d");?></label></th>
            <th rowspan="2" bgcolor="#CCCCCC" class="style7" scope="row">Observaciones</th>
            <th colspan="2" rowspan="2" class="style7" scope="row"><div align="left">
              <textarea name="observaciones" cols="18" rows="3" id="textfield14"><?=$row1['obsrep']?></textarea>
            </div></th>
          </tr>
          <tr class="style7">
            <th bgcolor="#CCCCCC" class="style7" scope="row">Tecnico</th>
            <th class="style1" scope="row"><label>
              <?=$row['repara'];?>
            </label></th>
          </tr>
              </table></th>
      <th width="311" scope="row"><table width="305" border="0" cellspacing="1">
        <tr>
          <th colspan="3" bgcolor="#990000" class="style4" scope="row">Diagnostico</th>
        </tr>
		<?
			if($status<>"DIAG"){
				//estraemos de la base de datos los registros coincidentes
				$sql="SELECT * from repdiagnostico where ot='$ot'";
				//echo $sql;
				$result=mysql_db_query("dbomega",$sql);
				while($fila=mysql_fetch_array($result))
				{
					$clave[]=$fila['clavediag'];
					$des[]=$fila['des'];
				}
				/*for($i=0;$i<=2;$i++){
					echo $clave[$i];
					echo $des[$i];
				}*/
			}
		?>
        <tr>
          <th width="7%" bgcolor="#CCCCCC" class="style7" scope="row">1</th>
          <th colspan="2" class="style7" scope="row">
            <div align="left">
            <a href="#" onclick="abreVentana('1')">
              <input name="cl1" type="text" id="cl1" size="5" value="<?=$clave[0]?>" />
              <input name="ds1" type="text" id="ds1" size="30" enable="enable" value="<?=$des[0]?>"/>
            </a></div></th>
          </tr>
        <tr class="style7">
          <th bgcolor="#CCCCCC" class="style7" scope="row">2</th>
          <th width="11%" class="style7" scope="row"><label>
            <input name="cl2" type="text" id="cl2" size="5" value="<?=$clave[1]?>" />
          </label></th>
          <th width="82%" class="style7" scope="row"><div align="left"><a href="#" onclick="abreVentana('2')">
            <input name="ds2" type="text" id="ds2" size="30" enable="enable" value="<?=$des[1]?>"/>
          </a></div></th>
        </tr>
        <tr class="style7">
          <th bgcolor="#CCCCCC" class="style7" scope="row">3</th>
          <th class="style7" scope="row"><label>
            <input name="cl3" type="text" id="cl3" size="5" value="<?=$clave[2]?>" />
          </label></th>
          <th class="style7" scope="row"><div align="left"><a href="#" onclick="abreVentana('3')">
            <input name="ds3" type="text" id="ds3" size="30" enable="enable" value="<?=$des[2]?>"/>
          </a></div></th>
        </tr>
      </table></th>
    </tr>
    <tr>
      <th colspan="2" scope="row"><hr color="#990000"/></th>
    </tr>
    <?
		if($status<>"DIAG"){
			$result="";
			//estraemos de la base de datos los registros coincidentes
			$sql="SELECT * from rep_refac_utilizadas where ot='$ot'";
			//echo $sql;
			$result=mysql_db_query("dbomega",$sql);
			while($fila=mysql_fetch_array($result))
			{
				$clave1[]=$fila['claverefac'];
				$des1[]=$fila['des'];
			}
			/*for($i=0;$i<=5;$i++){
				echo $clave1[$i];
				echo $des1[$i];
			}*/
		}
	?>
	<tr>
      <th scope="row"><table width="543" border="0" cellspacing="1">
        <tr>
          <th colspan="6" bgcolor="#990000" class="style4" scope="row">Refacc. Utilizadas</th>
        </tr>
        <tr>
          <th width="4%" bgcolor="#CCCCCC" class="style7" scope="row">1</th>
          <th width="6%" class="style7" scope="row"><label>
            <input name="rcl1" type="text" id="rcl1" size="5" value="<?=$clave1[0];?>" />
          </label></th>
          <th width="36%" class="style7" scope="row"><div align="left"><a href="#" onclick="abreVentanaRefaccion('1','<?=$row['modelo'];?>')">
            <input name="rds1" type="text" id="rds1" size="30" enable="enable" value="<?=$des1[0];?>"/>
          </a></div></th>
          <th width="3%" bgcolor="#CCCCCC" class="style7" scope="row">4</th>
          <th width="6%" class="style7" scope="row"><input name="rcl4" type="text" id="rcl4" size="5" value="<?=$clave1[3];?>" /></th>
          <th width="45%" class="style7" scope="row"><div align="left"><a href="#" onclick="abreVentanaRefaccion('4','<?=$row['modelo'];?>')">
            <input name="rds4" type="text" id="rds4" size="30" enable="enable" value="<?=$des1[3];?>"/>
          </a></div></th>
        </tr>
        <tr class="style7">
          <th bgcolor="#CCCCCC" class="style7" scope="row">2</th>
          <th class="style7" scope="row"><label>
            <input name="rcl2" type="text" id="rcl2" size="5" value="<?=$clave1[1];?>" />
          </label></th>
          <th class="style7" scope="row"><div align="left"><a href="#" onclick="abreVentanaRefaccion('2','<?=$row['modelo'];?>')">
            <input name="rds2" type="text" id="rds2" size="30" enable="enable" value="<?=$des1[1];?>"/>
          </a></div></th>
          <th bgcolor="#CCCCCC" class="style7" scope="row">5</th>
          <th class="style7" scope="row"><input name="rcl5" type="text" id="rcl5" size="5" value="<?=$clave1[4];?>" /></th>
          <th class="style7" scope="row"><div align="left"><a href="#" onclick="abreVentanaRefaccion('5','<?=$row['modelo'];?>')">
            <input name="rds5" type="text" id="rds5" size="30" enable="enable" value="<?=$des1[4];?>"/>
          </a></div></th>
        </tr>
        <tr class="style7">
          <th bgcolor="#CCCCCC" class="style7" scope="row">3</th>
          <th class="style7" scope="row"><label>
            <input name="rcl3" type="text" id="rcl3" size="5" value="<?=$clave1[2];?>" />
          </label></th>
          <th class="style7" scope="row"><div align="left"><a href="#" onclick="abreVentanaRefaccion('3','<?=$row['modelo'];?>')">
            <input name="rds3" type="text" id="rds3" size="30" enable="enable" value="<?=$des1[2];?>"/>
          </a></div></th>
          <th bgcolor="#CCCCCC" class="style7" scope="row">6</th>
          <th class="style7" scope="row"><input name="rcl6" type="text" id="rcl6" size="5" value="<?=$clave1[5];?>" /></th>
          <th class="style7" scope="row"><div align="left"><a href="#" onclick="abreVentanaRefaccion('6','<?=$row['modelo'];?>')">
            <input name="rds6" type="text" id="rds6" size="30" enable="enable" value="<?=$des1[5];?>"/>
          </a></div></th>
        </tr>
      </table></th>
      <th scope="row"><table width="305" border="0" cellspacing="1">
	  <?
		if($status<>"DIAG"){
			$result="";
			//estraemos de la base de datos los registros coincidentes
			$sql="SELECT * from rep_efectuada where ot='$ot'";
			//echo $sql;
			$result=mysql_db_query("dbomega",$sql);
			while($fila=mysql_fetch_array($result))
			{
				$clave2[]=$fila['clave_rep'];
				$des2[]=$fila['des'];
			}
			/*for($i=0;$i<=2;$i++){
				echo $clave2[$i];
				echo $des2[$i];
			}*/
		}
	?>
        <tr>
          <th colspan="3" bgcolor="#990000" class="style4" scope="row">Rep. Efectuada</th>
        </tr>
        <tr>
          <th width="8%" bgcolor="#CCCCCC" class="style7" scope="row">1</th>
          <th width="11%" class="style7" scope="row"><label>
            <input name="recl1" type="text" id="recl1" size="5" value="<?=$clave2[0];?>" />
          </label></th>
          <th width="81%" class="style7" scope="row"><div align="left"><a href="#" onclick="abreReparacionEfectuada('1','<?=$row['modelo'];?>')">
            <input name="reds1" type="text" id="reds1" size="30" enable="enable" value="<?=$des2[0];?>"/>
          </a></div></th>
        </tr>
        <tr class="style7">
          <th bgcolor="#CCCCCC" class="style7" scope="row">2</th>
          <th class="style7" scope="row"><label>
          <input name="recl2" type="text" id="recl2" size="5" value="<?=$clave2[1];?>" />
          </label></th>
          <th class="style7" scope="row"><div align="left"><a href="#" onclick="abreReparacionEfectuada('2','<?=$row['modelo'];?>')">
            <input name="reds2" type="text" id="reds2" size="30" enable="enable" value="<?=$des2[1];?>"/>
          </a></div></th>
        </tr>
        <tr class="style7">
          <th bgcolor="#CCCCCC" class="style7" scope="row">3</th>
          <th class="style7" scope="row"><label>
            <input name="recl3" type="text" id="recl3" size="5" value="<?=$clave2[2];?>" />
          </label></th>
          <th class="style7" scope="row"><div align="left"><a href="#" onclick="abreReparacionEfectuada('3','<?=$row['modelo'];?>')">
            <input name="reds3" type="text" id="reds3" size="30" enable="enable" value="<?=$des2[2];?>"/>
          </a></div></th>
        </tr>
      </table></th>
    </tr>
    <tr>
      <th colspan="2" class="Estilo1" scope="row"><hr color="#990000"/>        <label></label></th>
    </tr>
    <tr>
      <th bgcolor="#990000" class="Estilo1" scope="row"><span class="style4">Refurbished</span>
        <label>
        <input type="checkbox" name="refurbish" id="checkbox" />
        </label>
		
		<?
			if($row['modelo']=="BB7100i"){
		?>
				<!--Parte del modelo Blackberry-->
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label for="chk1" class="style4">Sim Da&ntilde;ada
					<input type="checkbox" name="blackberrySim" id="chk1" value="sim dañada" onclick="mostrarAdvertencia();" />
				</label>
				<!--Fin parte del modelo Blackberry-->
		<?		
			}
		?>		
		</th>
      <th class="Estilo1" scope="row"><input type="submit" name="Submit" value="Terminar Proceso de Reparaci&oacute;n" /></th>
    </tr>
  </table>
</form>
<?
	}
?>
<hr color="#990000"/>
<p align="center" class="style2 style8">IQelectronics SA de CV &copy;</p>
<div align="center"></div>
</body>
</html>
