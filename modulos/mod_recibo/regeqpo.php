<?
	session_start();
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
	//print_r($_SESSION);
	include("../../includes/txtApp.php");
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
		<div id="divResultadoInsercion" style="border: 0px solid #CCC;display: none;"></div><br>
		<input name="recibe" type="hidden" class="campov" id="recibe" value="<?=$_SESSION[$txtApp['session']['nombreUsuario']]." ".$_SESSION[$txtApp['session']['apellidoUsuario']];?>" size="40" />
		<table width="700" border="0" align="center" cellspacing="1" cellpadding="1" style="font-size: 10px;border: 1px solid #CCC;background: #e1e1e1;">
			<tr>
			  <th colspan="3" style="font-size: 12px;height: 15px;padding: 5px;background: #f0f0f0;border: 1px solid #CCC;">
				Registro de Equipo<br>
				<div style="text-align: left;font-weight: bold;font-size: 10px;">Proceso: BOUNCE</div>
				<input type="hidden" name="process" id="process" value="Bounce Refurbish">
			  </th>
			</tr>						
			<tr>
			  <th style="background: #F0F0F0;border: 1px solid #CCC;height: 15px;padding: 5px;">Fecha de Recibo</th>
			  <th colspan="2" bgcolor="#FFFF99" scope="row"><div align="left" class="style7">
				<div align="center">
				  <input name="fecharec" type="hidden" id="fecharec" value="<?=date('Y-m-d');?>" />
				  <?=date('Y-m-d');?>
				</div>
			  </div></th>
		    </tr>
			<tr>
			  <th style="background: #F0F0F0;border: 1px solid #CCC;height: 15px;padding: 5px;">Modelo</th>
			  <th colspan="2" style="text-align: left;">
				  <select name="modelo" id="modelo" tabindex="1" style="width: 120px;" onChange="procesa(this.form.modelo.options[this.form.modelo.selectedIndex].value)">
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
			  <th width="150" style="background: #F0F0F0;border: 1px solid #CCC;height: 15px;padding: 5px;">Fecha de Activaci&oacute;n</th>
			  <th width="420" style="text-align: left;">
				<!---->
				<input type="text" name="date" id="campo_fecha" style="width: 80px;" />
				<input type="button" id="lanzador" value="..." />
				<!---->
				<script type="text/javascript">
					Calendar.setup({
					    inputField     :    "campo_fecha",    // id del campo de texto
					    ifFormat	   :    "%Y-%m-%d",       // formato de la fecha, cuando se escriba en el campo de texto					    
					    button         :    "lanzador"   	  // el id del botón que lanzará el calendario
					});
				</script>
			  </th>
			  <th width="180" style="text-align:left;">&nbsp;</th>
			</tr>
			<tr>
			  <th width="150" style="background: #F0F0F0;border: 1px solid #CCC;height: 15px;padding: 5px;">Identificador</th>
			  <th width="420" style="text-align: left;">
				<select name="cboIdentificador" id="cboIdentificador" style="width: 120px;">
					<option value="" selected="selected"></option>
					<option value="2F">2F</option>
					<option value="MAQUILA">MAQUILA</option>
					<option value="VENTA">VENTA</option>
				</select>
			  </th>
			  <th width="180" style="text-align:left;">&nbsp;</th>
			</tr>			
			<tr>
			  <th width="150" style="background: #F0F0F0;border: 1px solid #CCC;height: 15px;padding: 5px;"># Guia</th>
			  <th width="420" style="text-align: left;"><input tabindex="2" name="fnextel" type="text" class="campov" id="fnextel" onFocus="CambioC('fnextel','L');" onBlur="RestableceC('fnextel','OL');" onkeyup="verificaTecla(event,'fnextel')" size="15" /></th>			  
			</tr>
			<tr>
			  <th style="background: #F0F0F0;border: 1px solid #CCC;height: 15px;padding: 5px;">Imei</th>
			  <th colspan="2" style="text-align: left;"><input tabindex="3" name="imei" type="text" class="campov" id="imei" size="40" onFocus="CambioC('imei','L');" onBlur="RestableceC('imei','OL');" onkeyup="verificaTecla(event,'imei')" /></th>			  
			</tr>
			<tr>
			  <th style="background: #F0F0F0;border: 1px solid #CCC;height: 15px;padding: 5px;">Serie</th>
			  <th colspan="2" style="text-align: left;"><input tabindex="4" name="esn" type="text" class="campov" id="esn" size="40" onFocus="CambioC('esn','L');" onBlur="RestableceC('esn','OL');" onkeyup="verificaTecla(event,'esn')" /></th>			  
			</tr>			
			<tr>
			  <th width="120" style="background: #F0F0F0;border: 1px solid #CCC;height: 15px;padding: 5px;">CAP Origen</th>
			  <th colspan="2" width="375" scope="row" style="text-align: left;">
				  <select name="cap" id="cap" tabindex="5" style="width: 400px;">
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
			</tr>
			<tr>
			  <th rowspan="2" style="background: #F0F0F0;border: 1px solid #CCC;">Diagnostico</th>
			  <th colspan="2" style="text-align: left;">				
				  <select name="diagnostico1" id="diagnostico1" tabindex="6" style="width: 400px;">
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
			</tr>
			<tr>
			  <th colspan="2" scope="row">
				<div align="left">
				  <select name="diagnostico2" id="diagnostico2" tabindex="7" style="width: 400px;">
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
			</tr>
			 <tr>
				<th style="background: #F0F0F0;border: 1px solid #CCC;">Observaciones</th>
				<th colspan="2" align="left"><textarea name="obs" tabindex="8" cols="40" rows="3" id="obs"></textarea></th>				
			 </tr>
			 <tr>
			   <th colspan="3" style="height: 20px;padding: 5px;text-align: right;background: #f0f0f0;border: 1px solid #CCC;"><input type="button" onclick="mensaje()" style="height: 45px;padding: 5px;" name="button" id="button" value="Registrar" /></th>
			 </tr>
	  </table><br>		
	<?
	}//fin if verificacion
?>	
<hr style="background: #CCC;width: 70%;"/>
<p align="center" class="style2 style8">IQelectronics SA de CV &copy; </p>
