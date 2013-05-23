<?
	/*
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
	*/
	print_r($_GET);
	function conectarBd(){
		require("../../includes/config.inc.php");
		$link=mysql_connect($host,$usuario,$pass);
		if($link==false){
			echo "Error en la conexion a la base de datos";
		}else{
			mysql_select_db($db);
			return $link;
		}				
	}
?>
<style type="text/css">
<!--
.style1 {color: #000000;font-size: 12px;font-family: Verdana, Arial, Helvetica, sans-serif;}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 9px;color: #999999;}
.style3 {color: #FFFFFF}
a:link {color: #FFFFFF;text-decoration: none;}
a:visited {text-decoration: none;color: #CCCCCC;}
a:hover {text-decoration: underline;color: #FFFF00;}
a:active {text-decoration: none;color: #FF0000;}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;color: #FFFFFF;}
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px;}
.style8 {color: #990000}
.campoal{font:Arial, Helvetica, sans-serif;font-size:12px;TEXT-TRANSFORM: uppercase;background:#FFFF99;/*#E7EFF7*/width:130px;}
.campov{FONT-SIZE: 10px;BACKGROUND: #FFFFFF;/*c0f0c0*/TEXT-TRANSFORM: uppercase;FONT-FAMILY: Arial, Helvetica, sans-serif;width:250px;}
/*para el cuadro*/
#myBox #contentBoxBg {filter: alpha(opacity=50);-moz-opacity:.50;opacity:.50;}
#myBox #content {padding: 20px; }
#myBox h3 {font-size: 17px;margin: 0px;text-align: center}
-->
</style>
<link rel="stylesheet" type="text/css" href="js/calendar-green.css">
<script type="text/javascript" src="js/fucniones1.js"></script>
 <!-- librería principal del calendario -->
<script type="text/javascript" src="js/calendar.js"></script>
 <!-- librería para cargar el lenguaje deseado -->
<script type="text/javascript" src="js/calendar-es.js"></script>
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->
<script type="text/javascript" src="js/calendar-setup.js"></script>
<br />
<?
	if($_GET['action']=="nuevo"){		
?>
	<form id="form1" name="form1" method="post" action="regeqpo.php?action=guardaequipo" onSubmit="return mensaje();">
		<table width="770" border="0" align="center" cellspacing="1" cellpadding="1" bordercolor="#333333" style="font-size: 10px;">
			<tr>
			  <th colspan="3" bgcolor="#333333" scope="row" style="font-size: 12px;height: 15px;padding: 5px;background: #f0f0f0;border: 1px solid #CCC;">Registro de Equipo</th>
			</tr>
			<tr>
				<th colspan="3">Proceso
				   <select name="process" id="process">
					 <option value="Bounce Refurbish" selected="selected">Bounce Refurbish</option>
					 <option value="No Reparable">No Reparable</option>
                   </select></th>
			</tr>
			<tr>
			  <th width="120" style="background: #F0F0F0;border: 1px solid #CCC;height: 15px;padding: 5px;">CAP Origen</th>
			  <th width="375" scope="row" style="text-align: left;">
				  <select name="cap" id="cap">
					<option></option>
<?
				//cargando Valores para combos
				echo $sql="SELECT * FROM caps ORDER BY cap";
				$result=mysql_query($sql,conectarBd());
				$i=0;
				while($row=mysql_fetch_array($result)){
?>
					<option value="<?=$row[2];?>"><?=utf8_encode($row[2]).'-'.utf8_encode($row[8]).'-'.utf8_encode($row[1]);?></option>
<?
					$sup[$i]=$row[9];
					$dir[$i]=$row[3]." ".$row[4]." ".$row[6]." ".$row[7]." ".$row[8];
					$cp[$i]=$row[2];
					//echo $sup[$i]."-".$dir[$i]."-".$cp[$i];
					$i=$i+1;
				}
?>
				  </select>
				  <input type="hidden" name="sup" id="sup" />
				  <input type="hidden" name="dir" id="dir" />
			  </th>
			  <th width="269">Seleccione la Fecha del Tat</th>
			</tr>
			<tr>
			  <th style="background: #F0F0F0;border: 1px solid #CCC;height: 15px;padding: 5px;"># Guia</th>
			  <th style="text-align: left;"><input name="fnextel" type="text" class="campov" id="fnextel" onFocus="CambioC('fnextel','L');" onBlur="RestableceC('fnextel','OL');" size="15" /></th>
			  <th style="text-align:left;">
              <!---->
              <input type="text" name="date" id="campo_fecha" />
				<input type="button" id="lanzador" value="..." />
              <!---->
              </th>
			</tr>
			<tr>
			  <th style="background: #F0F0F0;border: 1px solid #CCC;height: 15px;padding: 5px;">ESN</th>
			  <th style="text-align: left;"><input name="esn" type="text" class="campov" id="esn" size="40" onFocus="CambioC('esn','L');" onBlur="RestableceC('esn','OL');" />serie</th>
			  <th>&nbsp;</th>
			</tr>
			<tr>
			  <th style="background: #F0F0F0;border: 1px solid #CCC;height: 15px;padding: 5px;">IMEI </th>
			  <th style="text-align: left;"><input name="imei" type="text" class="campov" id="imei" size="40" onFocus="CambioC('imei','L');" onBlur="RestableceC('imei','OL');" /></th>
			  <th rowspan="4" class="style7">&nbsp;</th>
			</tr>
			<tr>
			  <th style="background: #F0F0F0;border: 1px solid #CCC;height: 15px;padding: 5px;">Modelo</th>
			  <th style="text-align: left;">
				  <select name="modelo" id="modelo" onChange="procesa(this.form.modelo.options[this.form.modelo.selectedIndex].value)">
					<option></option>
<?						
						$sql="SELECT * FROM cat_modradio ORDER BY modelo";
						$result=mysql_query($sql,conectarBd());
						while($fila=mysql_fetch_array($result))
						{
							echo "<option value='".$fila['modelo']."'>".$fila['modelo']."</option>\n";		
						}
?>
				  </select>				   
			  </th>
		    </tr>
			<tr>
			  <th style="background: #F0F0F0;border: 1px solid #CCC;height: 15px;padding: 5px;">Recibe</th>
			  <th style="text-align: left;">
				  <input name="recibe" type="text" class="campov" id="recibe" value="<?=$_COOKIE['usuario'];?>" size="40" />
			  </th>
		    </tr>
			<tr>
			  <th style="background: #F0F0F0;border: 1px solid #CCC;height: 15px;padding: 5px;">Fecha de Recibo</th>
			  <th bgcolor="#FFFF99" scope="row"><div align="left" class="style7">
				<div align="center">
				  <input name="fecharec" type="hidden" id="fecharec" value="<?=date('Y-m-d');?>" />
				  <?=date('Y-m-d');?>
				</div>
			  </div></th>
		    </tr>
			<tr>
			  <th rowspan="2" style="background: #F0F0F0;border: 1px solid #CCC;">Diagnostico</th>
			  <th style="text-align: left;">				
				  <select name="diagnostico1" id="diagnostico1">
				    <option></option>
<?
			//cargando Valores para combos				
				$sql="SELECT * FROM cat_fallas ORDER BY codigo";
				$result=mysql_query($sql,conectarBd());
				while($row=mysql_fetch_array($result)){
?>
				    <option value="<?=$row[1];?>">
			        <?=$row[1].'-'.$row[2];?>
			        </option>
<?
				}
?>
			      </select>
		      </th>
				<th>&nbsp;</th>
			</tr>
			<tr>
			  <th scope="row">
				<div align="left">
				  <select name="diagnostico2" id="diagnostico2">
				    <option></option>
		            <?
			//cargando Valores para combos				
				$sql="SELECT * FROM cat_fallas ORDER BY codigo";
				$result=mysql_query($sql,conectarBd());
				while($row=mysql_fetch_array($result)){
		?>
				    <option value="<?=$row[1];?>">
			        <?=$row[1].'-'.$row[2];?>
			        </option>
		            <?
				}
		?>
			      </select>
			    </div></th>
				<th>&nbsp;</th>
			</tr>
			 <tr>
				<th style="background: #F0F0F0;border: 1px solid #CCC;">Observaciones</th>
				<th class="style7" scope="row"><label>
				  <div align="left">
				    <textarea name="obs" cols="40" rows="3" id="obs"></textarea>
			      </div>
				</label></th>
				<th>&nbsp;</th>
			 </tr>
			 <tr>
			   <th colspan="3" style="height: 20px;padding: 5px;text-align: right;background: #f0f0f0;border: 1px solid #CCC;"><input type="submit" style="height: 45px;padding: 5px;" name="button" id="button" value="Registrar" /></th>
			 </tr>
	  </table>
</form>
	<?
	}//fin if verificacion
	
	if($_GET['action']=="garantia"){
		//se recuperan los valores capturados anteriormente
		$esn=$_GET['esn'];
		$cap=$_GET['cap'];
		$fnextel=$_GET['fnextel'];
		$imei=$_GET['imei'];
		$modelo=$_GET['modelo'];
		$diagnostico1=$_GET['diagnostico1'];
	?>
		
		<table width="770" border="0" align="center" cellpadding="1" cellspacing="0">
			<tr>
				<td width="45"><img src="../img/Attention.png" alt="Informaci&oacute;n" width="41" height="43" /></td>
				<td width="393">Capturando Garantia...</td>
			</tr>
		</table>
		<form id="form1" name="form1" method="post" action="regeqpo.php?action=guardargarantia" onSubmit="return mensaje();">
			<table width="770" border="0" align="center" cellspacing="0" bordercolor="#333333">
				<tr>
				  <th colspan="3" bgcolor="#333333" scope="row"><span class="style4">Registro de Equipo</span>        <div align="left">
					</div></th>
				</tr>
				
				<tr>
				  <th width="120" bgcolor="#CCCCCC" scope="row"><span class="style7">CAP 
				  Origen</span></th>
				  <th width="375" scope="row"><div align="left" class="style7">
					  <select name="cap" id="cap">
						<option value="<?=$cap;?>"><?=$cap;?></option>
			<?
				//cargando Valores para combos
					include("../php/conectarbase.php");
					$sql="SELECT * FROM caps ORDER BY cap";
					$result=mysql_db_query($basedatos,$sql);
					$i=0;
					while($row=mysql_fetch_array($result)){
			?>
						<option value="<?=$row[2];?>"><?=$row[2].'-'.$row[8].'-'.$row[1];?></option>
			<?
						$sup[$i]=$row[9];
						$dir[$i]=$row[3]." ".$row[4]." ".$row[6]." ".$row[7]." ".$row[8];
						$cp[$i]=$row[2];
						//echo $sup[$i]."-".$dir[$i]."-".$cp[$i];
						$i=$i+1;
					}
			?>
					  </select>
					  <input type="hidden" name="sup" id="sup" />
					  <input type="hidden" name="dir" id="dir" />
				  </div></th>
				  <th width="269"><span class="style7">Seleccione la Fecha del Tat</span></th>
				</tr>
				<tr>
				  <th bgcolor="#CCCCCC" scope="row"><span class="style7">
					<label>Folio NEXTEL</label>
				  </span></th>
				  <th scope="row"><div align="left" class="style7">
					  <input name="fnextel" type="text" id="fnextel" size="15" value="<?=$fnextel;?>" />
				  </div></th>
				  <th>
              <!---->
              <input type="text" name="date" id="campo_fecha" />
				<input type="button" id="lanzador" value="..." />
              <!---->                  
                  </th>
				</tr>
				<tr>
				  <th bgcolor="#CCCCCC" scope="row"><span class="style7">
					<label> ESN </label>
					</span></th>
				  <th scope="row"><div align="left" class="style7">
					  <input name="esn" type="text" id="esn" size="40" value="<?=$esn;?>" />
				  serie</div></th>
				  <th>&nbsp;</th>

				</tr>
				<tr>
				  <th bgcolor="#CCCCCC" scope="row"><span class="style7">IMEI </span></th>
				  <th scope="row"><div align="left" class="style7">
					  <input name="imei" type="text" id="imei" size="40" value="<?=$imei;?>" />
				  </div></th>
				  <th rowspan="4" class="style7">
					<div align="center"></div></th>
				</tr>
				<tr>
				  <th bgcolor="#CCCCCC" scope="row"><span class="style7">Modelo</span></th>
				  <th scope="row"><div align="left" class="style7">
					  <select name="modelo" id="modelo" onChange="procesa(this.form.modelo.options[this.form.modelo.selectedIndex].value)">
						<option value="<?=$modelo;?>"><?=$modelo;?></option>
						<?
							include("../php/conectarbase.php");
							$sql="SELECT * FROM catmodelo ORDER BY modelo";
							$result=mysql_db_query($basedatos,$sql);
							while($fila=mysql_fetch_array($result))
							{
								echo "<option value='".$fila['modelo']."'>".$fila['modelo']."</option>\n";		
							}
						?>
					  </select>
					   Proceso
					   <select name="process" id="process">
                       	 <option value="Reingreso Bounce" selected="selected">Reingreso Bounce</option>
						 <option value="Bounce Refurbish">Bounce Refurbish</option>
					 	 <option value="No Reparable">No Reparable</option>                         
					  </select>
				  </div></th>
				</tr>
				<tr>
				  <th bgcolor="#CCCCCC" scope="row"><span class="style7">Recibe </span></th>
				  <th scope="row"><div align="left" class="style7">
					  <input name="recibe" type="text" id="recibe" size="40" value="<?=$_COOKIE['usuario'];?>" />
				  </div></th>
				</tr>
				<tr>
				  <th bgcolor="#CCCCCC" scope="row"><span class="style7">Fecha de Recibo </span></th>
				  <th bgcolor="#FFFF99" scope="row"><div align="left" class="style7">
					<div align="center">
					  <input name="fecharec" type="hidden" id="fecharec" value="<?=date('Y-m-d');?>" />
					  <?=date('Y-m-d');?>
					</div>
				  </div></th>
				</tr>
				<tr>
				  <th rowspan="2" bgcolor="#CCCCCC" scope="row"><span class="style7">Diagnostico</span>          </th>
				  <th scope="row">
					<div align="left">
					  <select name="diagnostico1" id="diagnostico1">
						<option value="<?=$diagnostico1;?>"><?=$diagnostico1;?></option>
						<?
				//cargando Valores para combos
					include("../php/conectarbase.php");
					$sql="SELECT * FROM codfallas ORDER BY codigo";
					$result=mysql_db_query($basedatos,$sql);
					while($row=mysql_fetch_array($result)){
			?>
						<option value="<?=$row[1];?>">
						<?=$row[1].'-'.$row[2];?>
						</option>
						<?
					}
			?>
					  </select>
				  </div></th>
					<th>&nbsp;</th>
				</tr>
				<tr>
				  <th scope="row">
					<div align="left">
					  <select name="diagnostico2" id="diagnostico2">
						<option></option>
						<?
				//cargando Valores para combos
					include("../php/conectarbase.php");
					$sql="SELECT * FROM codfallas ORDER BY codigo";
					$result=mysql_db_query($basedatos,$sql);
					while($row=mysql_fetch_array($result)){
			?>
						<option value="<?=$row[1];?>">
						<?=$row[1].'-'.$row[2];?>
						</option>
						<?
					}
			?>
					  </select>
					</div></th>
					<th>&nbsp;</th>
				</tr>
				 <tr>
					<th bgcolor="#CCCCCC" class="style7" scope="row">Observaciones</th>
					<th class="style7" scope="row"><label>
					  <div align="left">
						<textarea name="obs" cols="40" rows="3" id="obs"></textarea>
					  </div>
					</label></th>
					<th>&nbsp;</th>
				 </tr>
				 <tr>
				   <th colspan="3" bgcolor="#333333" class="style7" scope="row"><div align="right">
					 <input type="submit" name="registrar" id="button" value="Registrar" />
				   </div></th>
				 </tr>
		  </table>
	</form>
	<?
	}
?>
<br />
<table width="770" border="0" align="center" cellspacing="1" bordercolor="#333333">
  <tr>
    <th colspan="8" bgcolor="#333333" scope="row"><span class="style4">Equipo Registrado</span></th>
  </tr>
  <tr>
    <th width="97" bgcolor="#CCCCCC" scope="row"><span class="style7">OT</span></th>
    <th width="78" bgcolor="#CCCCCC" scope="row"><span class="style7">CAP </span></th>
    <th width="90" bgcolor="#CCCCCC" scope="row"><span class="style7">F. NEXTEL</span></th>
    <th width="127" bgcolor="#CCCCCC" scope="row"><span class="style7">ESN</span>
    <th width="151" bgcolor="#CCCCCC" scope="row"><span class="style7">Proceso</span></th>
    <th width="85" bgcolor="#CCCCCC" scope="row"><span class="style7">modelo</span></th>
    <th colspan="2" bgcolor="#CCCCCC" scope="row"><span class="style7">f. de Recibo </span></th>
  </tr>
<?
	if($_GET['action']=="guardargarantia"){
		$cap=$_POST['cap'];
		$fnextel=$_POST['fnextel'];
		$esn=$_POST['esn'];
		$imei=$_POST['imei'];
		$modelo=$_POST['modelo'];
		$recibe=$_POST['recibe'];
		$fecharec=$_POST['fecharec'];
		$diagnostico1=$_POST['diagnostico1'];
		$diagnostico2=$_POST['diagnostico2'];
		$obs=$_POST['obs'];
		$process=$_POST['process'];
		//modificacion de campos nuevos para blackberry
		$bateria=$_POST['bateria'];
		$tapa=$_POST['tapa'];
		$sim=$_POST['sim'];
		if($tapa==""){
			$tapa="no";
		}
		if($bateria==""){
			$bateria="no";
		}
		if($sim==""){
			$sim="no";
		}
		//echo $bateria;
		//echo $tapa;
		//echo $sim;
		/********************************************************/
		$d=explode("-",$fecharec); 
		$cd = date("w", mktime (0,0,0,$d[1],$d[2],$d[0]));
		//echo "mes:: ".$d[1]."_dia:: ".$d[2]."_año:: ".$d[0]."   Num dia: ".$cd."       fecha: ".$fecha."     ";
		//CORREGIDO EL DIA 17 JUNIO 2008 PARA MODIFICACION DE 3 DIAS EN EL TAT
		switch($cd){
			case 1:{
					$ftat = date ("Y-m-d", mktime (0,0,0,$d[1],$d[2]+3,$d[0]));
					//$ftat = date ("F, l j Y",strtotime("+10 days"));
					//echo 'lunes'.$ftat;
					break;
				} 
			case 2:{
					$ftat = date ("Y-m-d", mktime (0,0,0,$d[1],$d[2]+3,$d[0]));
					break;
				}
			case 3:{
					$ftat = date ("Y-m-d", mktime (0,0,0,$d[1],$d[2]+5,$d[0]));
					break;
				}
			case 4:{
					$ftat = date ("Y-m-d", mktime (0,0,0,$d[1],$d[2]+5,$d[0]));
					break;
				}
			case 5:{
					$ftat = date ("Y-m-d", mktime (0,0,0,$d[1],$d[2]+5,$d[0]));
					break;
				}
		}
				
		include("../php/conectarbase.php");
		$SQL="INSERT INTO equiposrep (cap, fnextel, esn, imei, modelo, recibe, fecharec, diag1, diag2, obs, status,tat,comment, supervisor,direccion,process,bateria,tapa,sim) values ('$cap','$fnextel','$esn','$imei','$modelo','$recibe', '$fecharec', '$diagnostico1','$diagnostico2','$obs','In Repair','$ftat', '$diagnostico1','$sup[$cap]','$dir[$cap]','$process','$bateria','$tapa','$sim')";
		//echo $SQL;
		mysql_db_query("db_iqe_ref",$SQL);
		$result5=mysql_db_query("db_iqe_ref","SELECT LAST_INSERT_ID() as nreg");
		$row5=mysql_fetch_array($result5);
		$nreg=$row5['nreg'];
		$fiq="IQR".date('ym').sprintf('%05s',$nreg);
		//echo $fiq;
		$SQL="UPDATE equiposrep SET ot='$fiq' WHERE id='$nreg'";
		mysql_db_query("db_iqe_ref",$SQL);
		//proceso
		$sql1="select * from caps where cap='$cap'";
		$result1=mysql_db_query("db_iqe_ref",$sql1);
		$datoscap=mysql_fetch_array($result1);
		$supervisor=$datoscap['responsable'];
		$direccion=$datoscap['callenum'];
		$sql2="update equiposrep set supervisor='$supervisor',direccion='$direccion' where id='$nreg'";
		mysql_db_query("db_iqe_ref",$sql2);
		?>
			<script language="javascript">
				window.location.href="regeqpo.php?action=nuevo";
			</script>
		<?
	}
	
	if($_GET['action']=="guardaequipo"){
		$cap=$_POST['cap'];
		$fnextel=$_POST['fnextel'];
		$esn=$_POST['esn'];
		$imei=$_POST['imei'];
		$modelo=$_POST['modelo'];
		$recibe=$_POST['recibe'];
		$fecharec=$_POST['fecharec'];
		$diagnostico1=$_POST['diagnostico1'];
		$diagnostico2=$_POST['diagnostico2'];
		$obs=$_POST['obs'];
		$process=$_POST['process'];
		//modificacion de campos nuevos para blackberry
		$tat=$_POST['date'];		
		//fin modificaciones
		//echo $cap."<br>";
		//$cap=$cap-1;
		//funcion para mostrar equipos en la base si es que los tiene
		/********************************************************/
		$regf=buscaresn($esn);
		//echo $regf;
		if($regf>=1){
			echo $url="vgarantia.php?action=nuevo&esn=".$esn."&cap=".$cap."&fnextel=".$fnextel."&imei=".$imei."&modelo=".$modelo."&diag=".$diagnostico1;
			echo "<script language='javascript'>
				window.location.href='$url';
			</script>";
		}else{
			/********************************************************/
			$d=explode("-",$fecharec); 
			$cd = date("w", mktime (0,0,0,$d[1],$d[2],$d[0]));
			//echo "mes:: ".$d[1]."_dia:: ".$d[2]."_año:: ".$d[0]."   Num dia: ".$cd."       fecha: ".$fecha."     ";
			switch($cd){
				case 1:{
						$ftat = date ("Y-m-d", mktime (0,0,0,$d[1],$d[2]+10,$d[0]));
						//$ftat = date ("F, l j Y",strtotime("+10 days"));
						//echo 'lunes'.$ftat;
						break;
					} 
				case 2:{
						$ftat = date ("Y-m-d", mktime (0,0,0,$d[1],$d[2]+9,$d[0]));
						break;
					}
				case 3:{
						$ftat = date ("Y-m-d", mktime (0,0,0,$d[1],$d[2]+8,$d[0]));
						break;
					}
				case 4:{
						$ftat = date ("Y-m-d", mktime (0,0,0,$d[1],$d[2]+7,$d[0]));
						break;
					}
				case 5:{
						$ftat = date ("Y-m-d", mktime (0,0,0,$d[1],$d[2]+13,$d[0]));
						break;
					}
			}
			//echo "cap=".$cap;		
			include("../php/conectarbase.php");
			$SQL="INSERT INTO equiposrep (cap, fnextel, esn, imei, modelo, recibe, fecharec, diag1, diag2, obs, status,tat,comment, supervisor,direccion,process,bateria,tapa,sim) values ('$cap','$fnextel','$esn','$imei','$modelo','$recibe', '$fecharec', '$diagnostico1','$diagnostico2','$obs','In Repair','$tat', '$diagnostico1','$sup[$cap]','$dir[$cap]','$process','--','--','--')";
			echo $SQL;
			mysql_db_query("db_iqe_ref",$SQL);
			$result5=mysql_db_query("db_iqe_ref","SELECT LAST_INSERT_ID() as nreg");
			$row5=mysql_fetch_array($result5);
			$nreg=$row5['nreg'];
			$fiq="IQR".date('ym').sprintf('%05s',$nreg);
			//echo $fiq;
			$SQL="UPDATE equiposrep SET ot='$fiq' WHERE id='$nreg'";
			mysql_db_query("db_iqe_ref",$SQL);
			//proceso
			$sql1="select * from caps where cap='$cap'";
			$result1=mysql_db_query("db_iqe_ref",$sql1);
			$datoscap=mysql_fetch_array($result1);
			$supervisor=$datoscap['responsable'];
			$direccion=$datoscap['callenum'];
			$sql2="update equiposrep set supervisor='$supervisor',direccion='$direccion' where id='$nreg'";
			mysql_db_query("db_iqe_ref",$sql2);
			?>
				<script language="javascript">					
					window.location.href="regeqpo.php?action=nuevo";					
				</script>
			<?
			//cambios en la parte de process
			if($process=="No Reparable"){
				$sqlActualizaEquipo="UPDATE equiposrep set statusgral='EMP',status_cc='SPC',status_despacho='EMP',status_rep='NoRep',repara='Rafael.Contreras' where ot='$fiq'";
				$sql_diag="INSERT INTO repdiagnostico (clavediag, ot,des,posicion) values ('NN01','$fiq','No procede garantia de Refurbish (Mas de 90 Dias)','0')";
				$sql_refac="INSERT INTO rep_refac_utilizadas (claverefac, ot,des,posicion) values ('0000','$fiq','NINGUNA','0')";
				$sql_efect="INSERT INTO rep_efectuada (clave_rep, ot,des,posicion) values ('0000','$fiq','NINGUNA','0')";
				$resultNoRep=mysql_db_query("db_iqe_ref",$sqlActualizaEquipo);
				$resultDiag=mysql_db_query("db_iqe_ref",$sql_diag);
				$resultRefac=mysql_db_query("db_iqe_ref",$sql_refac);
				$resultEfect=mysql_db_query("db_iqe_ref",$sql_efect);				
				if($resultNoRep==true){
				?>
					<script language="javascript">					
						alert('El equipo se encuentra disponible para su envio');
                    </script>
				<?
				}else{
				?>
					<script language="javascript">					
						alert('Error: Han ocurrido errores en la Actualizacion del equipo verifique la informacion e intentelo mas tarde');
                    </script>
				<?	
				}
				if($resultDiag==true){
					echo "Datos Actualizados";
				}else{
					echo "Error al Actualizar los Datos";
				}
				if($resultRefac==true){
					echo "Datos Actualizados";					
				}else{
					echo "Error al Actualizar los Datos";					
				}
				if($resultEfect==true){
					echo "Datos Actualizados";					
				}else{
					echo "Error al Actualizar los Datos";					
				}
			}
		}//fin if
	}
	
	if($_GET['del']=="confirmar"){
		$id=$_GET['id'];
		echo $ot=$_GET['ot'];	
		echo "<script language='javascript'>
			if(confirm('¿Esta seguro de borrar el registro la orden de trabajo $ot?')){
				window.location.href='regeqpo.php?del=del&id=$id';
			}
			else{
				window.location.href='regeqpo.php?action=nuevo';
			}
		</script>";
	}
	
	if ($_GET['del']=="del"){
		$del=$_GET['del'];
		$id=$_GET['id'];
		if ($del=='del'){
			include("../php/conectarbase.php");
			$SQL="DELETE FROM equiposrep WHERE id='$id'";
			//echo $SQL;
			mysql_db_query("db_iqe_ref",$SQL);
			if(mysql_affected_rows()>=1){
				?>
				<script language="javascript">
					alert('Orden de trabajo Borrada');
					window.location.href="regeqpo.php?action=nuevo";
				</script>
				<?
			}else{
				?>
				<script language="javascript">
					alert('Error: al borrar la orden de Trabajo');
					window.location.href="regeqpo.php?action=nuevo";
				</script>
				<?
			}
		}
	}		
		//cargando radios capturados
		include("../php/conectarbase.php");
		$sql3="SELECT * FROM equiposrep WHERE fecharec='".date('Y-m-d')."' ORDER BY ot";
		//echo $sql3;
		$result3=mysql_db_query("db_iqe_ref",$sql3);
		$color="#F0F0F0";
		while($row3=mysql_fetch_array($result3)){
?>
  <tr>
    <th bgcolor="<?=$color;?>" class="style7" scope="row"><?= $row3[1];?></th>
    <th bgcolor="<?=$color;?>" class="style7" scope="row"><?= $row3['cap'];?></th>
    <th bgcolor="<?=$color;?>" class="style7" scope="row"><?= $row3['fnextel'];?></th>
    <th bgcolor="<?=$color;?>" class="style7" scope="row"><?= $row3['esn'];?></th>
    <th bgcolor="<?=$color;?>" class="style7" scope="row"><?= $row3['process'];?></th>
    <th bgcolor="<?=$color;?>" class="style7" scope="row"><?= $row3['modelo'];?></th>
    <th bgcolor="<?=$color;?>" width="94" class="style7" scope="row"><?= $row3['fecharec'];?></th>
    <th bgcolor="<?=$color;?>" width="23" class="style7" scope="row"><a href="regeqpo.php?del=confirmar&id=<?= $row3[0];?>&ot=<?= $row3[1];?>"><img src="../img/del.png" alt="Borrar Orden de Trabajo" width="16" height="16" border="0" /></a></th>
  </tr>
<?
			if($color=="#F0F0F0")
				$color="#FFFFFF";
			else
				$color="#F0F0F0";
		}
	
	function buscaresn($esn){
		include("../php/conectarbase.php");
		$base="db_iqe_ref";
		$sqlx="select * from equiposrep where esn='$esn'";
		$resultx=mysql_db_query($base,$sqlx);
		$totalreg=mysql_num_rows($resultx);
		return $totalreg;
	}
?>
  <tr>
    <th colspan="8" bgcolor="#990000" class="style7" scope="row"></label></th>
  </tr>
</table>
<hr color="#990000"/>
<p align="center" class="style2 style8">IQelectronics SA de CV &copy; </p>
<div align="center"></div>
<!-- script que define y configura el calendario-->
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "campo_fecha",      // id del campo de texto
        //ifFormat       :    "%d/%m/%Y",       // formato de la fecha, cuando se escriba en el campo de texto
		ifFormat	   :    "%Y/%m/%d",
        button         :    "lanzador"   // el id del botón que lanzará el calendario
    });
</script>
