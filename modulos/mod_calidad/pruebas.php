<? session_start(); header("Cache-Control: no-store, no-cache, must-revalidate");?>
<?	
	//recuperamos la orden de trabajo
	$ot=$_GET['ot'];
	//leemos la cookie
	//$usuario=$_COOKIE["usuario"];
	$usuario=$_SESSION["loginUsuarioBounce"];
	session_start();
	session_cache_limiter('nocache,private');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pruebas</title>
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
.style10 {font-size: 12px}
.style12 {color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; }
.Estilo2 {color: #999999}
.blanco{color:#FFFFFF; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
tr{
	border:#CCCCCC solid thin;
}	
td{
	border:#CCCCCC solid thin;
}
.Estilo2 {
	font-size:36px;
	color:#000000;
}
.colorNegro{color:#000;}
-->
</style>
<script language="javascript">
	function seleccionar_todo(){ 
   		for (i=0;i<document.f1.elements.length;i++) 
      		if(document.f1.elements[i].type == "checkbox") 
         		document.f1.elements[i].checked=1 
	}
	function deseleccionar_todo(){ 
   		for (i=0;i<document.f1.elements.length;i++) 
      		if(document.f1.elements[i].type == "checkbox") 
         		document.f1.elements[i].checked=0 
	}
	function seleccionar_todo1(){ 
   		for (i=0;i<document.f3.elements.length;i++) 
      		if(document.f3.elements[i].type == "checkbox") 
         		document.f3.elements[i].checked=1 
	}
	function deseleccionar_todo1(){ 
   		for (i=0;i<document.f3.elements.length;i++) 
      		if(document.f3.elements[i].type == "checkbox") 
         		document.f3.elements[i].checked=0 
	}
	
	function validacion(obj) 
	{
		if(obj.checked){
			for(i=0;ele=obj.form.elements[i];i++)
				if(ele.checked)
					obj.form.elements[i].value='1';
		}
	}
	
</script>
</head>

<body>
<?
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
		
	$sql="SELECT * FROM equiposrep WHERE ot='$ot'";
	//echo $sql;
	$result=mysql_query($sql,conectarBd());
	$row=mysql_fetch_array($result);
	$modelo=$row['modelo'];
?>
<div align="center" class="style12" style="border:#999999 solid medium; background-color:#999999;">
	<span class="style10"> <a href="ctrolcalidad.php"><span class="negro"><strong>Equipos en Ctrol de Calidad</strong></span></a> <!--| <a href="ctrolcalidad.php"><span class="blanco">Estadisticas</span></a>--></span>
</div>
<br />
<?
	//acciones sobre la pagina
	if($_GET['action']=="nuevo"){
		nuevo($ot,$modelo);
	}
	
	if($_GET['action']=="guardatFuncional"){
		foreach($_POST as $nombre_campo=>$valor){
			echo $asignacion="\$".$nombre_campo."='".$valor."';";
			eval($asignacion);
		}
		//$vf
	}
	
	if($_GET['action']=="guardatCosmetico"){
		foreach($_POST as $nombre_campo=>$valor){
			echo $asignacion="\$".$nombre_campo."='".$valor."';";
			eval($asignacion);
		}
	}
	if($_GET['action']=="insertar"){
		$ot=$_POST['ot'];
		$modelo=$_POST['modelo'];
		/*Nuevas modificaciones ahora por cada radio se hara una prueba diferente, es decir guardara los datos de la prueba asi como los*/
		/*items de la misma prueba*/
		$sql="INSERT INTO pruebas (ot,modelo,vsoftware,status) VALUES('".$ot."','".$modelo."','-','CC')";
		//echo $sql;
		$result=mysql_query($sql,conectarBd());
		$uid=mysql_insert_id();
		if($result==false){
			echo "Error, al Guardar la Orden de Trabajo, con el Test";
		}else{
			//echo "Procesando test";
			consultar($uid,$ot);
		}	
	}
	
	function nuevo($ot,$modelo){
		global $base;
		$sql="SELECT ot,fnextel,esn,imei,modelo from equiposrep where ot='$ot'";
		$result=mysql_query($sql,conectarBd());
		$row=mysql_fetch_array($result);
	?>
		<center>
		<form id="form1" name="form1" method="post" action="pruebas.php?action=insertar" >
		  <table width="618" border="1" cellpadding="0" cellspacing="0">
			<tr>
			  <td width="94" class="Estilo1" bgcolor="#CCCCCC"><div align="center">OT</div></td>
			  <td width="94" class="Estilo1" bgcolor="#CCCCCC"><div align="center">F. Nextel</div></td>
			  <td width="99" class="Estilo1" bgcolor="#CCCCCC"><div align="center">ESN</div></td>
			  <td width="101" class="Estilo1" bgcolor="#CCCCCC"><div align="center">IMEI</div></td>
			  <td width="104" class="Estilo1" bgcolor="#CCCCCC"><div align="center">Modelo</div></td>
			  <td width="112" class="Estilo1" bgcolor="#CCCCCC">&nbsp;</td>
			</tr>
			<tr>
			  <td class="style7"><div align="center"><?=$ot;?><input type="hidden" name="ot" value="<?=$ot;?>" /></div></td>
			  <td class="style7"><div align="center"><?=$row['fnextel'];?></div></td>
			  <td class="style7"><div align="center"><?=$row['esn'];?></div></td>
			  <td class="style7"><div align="center"><?=$row['imei'];?></div></td>
			  <td class="style7"><div align="center"><?=$modelo;?><input type="hidden" name="modelo" value="<?=$modelo;?>" /></div></td>
			  <td class="style7"><div align="center"><input type="submit" name="Submit" value="Iniciar Test" /></div></td>
			</tr>
		  </table>
		</form>
		<p>&nbsp;</p>
		</center>
		<?
	}
	
	function consultar($uid,$ot){
		//echo $uid;
		global $base;		
		$sql="SELECT * from pruebas where id='$uid'";
		//echo $sql;
		$result=mysql_query($sql,conectarBd());
		$fila=mysql_fetch_array($result);
		$id_prueba=$fila['id'];
		/****************************************************************************************/
		$sql="SELECT * FROM prueba_funcional";
		$result=mysql_query($sql,conectarBd());
		$row2=mysql_fetch_array($result);
		$i=1;
		//se llama a la funcion de datos adicionales
		$contadorRep1=datos($ot);
		?>
		<center>
		<form id="form2" name="form2" method="post" action="guarda_test.php">
		<input type="hidden" name="usuario" value="<?=$_COOKIE["usuario"]?>" />
		<input type="hidden" name="fecha_fin" id="hiddenField" value="<?=date("Y-m-d");?>"/>
		<input type="hidden" name="hora_fin" id="hiddenField" value="<?=date("H:i",time());?>"/>
		<input type="hidden" name="id_prueba" value="<?=$id_prueba;?>" />
		<input type="hidden" name="ot" value="<?=$ot;?>" />
		<input type="hidden" name="contadorRep" value="<?=$contadorRep1;?>" />        
		  <table width="808" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="2" bgcolor="#999999" class="Estilo1">Check List (Funcional) </td>
              <td width="383" class="Estilo1" bgcolor="#999999">Check List (Cosmetico) </td>
            </tr>
            <tr>
              <td width="82" valign="top" align="center" class="style7"><div class="Estilo2" style="border:#999999 solid medium; background-color:#CCCCCC; width:60px; height:60px; text-align:center"><strong><?=$contadorRep1;?></strong></div></td>
              <td width="347"><div align="center">
                <table border="0" cellspacing="0" cellpadding="0" style="margin-left:20px">
                  <tr bgcolor="#999999">
                    <td bgcolor="#CCCCCC" class="Estilo1">Descripci&oacute;n</td>
                    <td bgcolor="#CCCCCC" class="Estilo1">Valor</td>
                  </tr>
                  <?					
								do{
									$name="funcional[".$i."]";
									?>
                  <tr class="style7">
                    <td align="left"><?=$row2['des'];?></td>
                    <td><div align="center">
                      <input type="checkbox" name="<?=$name;?>" value="<?=$row2['des'];?>"  />
                    </div></td>
                    <!--onchange="validacion(this)"-->
                  </tr>
                  <?
									$i=$i+1;
								}while($row2=mysql_fetch_array($result));
			?>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                </table>
                <!--fin formulario-->
              </div></td>
              <?
					$sql="SELECT * FROM prueba_cosmetica order by id limit 0,30";
					$result1=mysql_query($sql,conectarBd());
					$row3=mysql_fetch_array($result1);
					$i=1;
					?>
              <td valign="top"><!--formulario check cosmetico-->
                  <div align="center">
                    <table border="0" cellspacing="0" cellpadding="0" style="margin-left:20px" id="f3">
                      <tr bgcolor="#999999">
                        <td bgcolor="#CCCCCC" class="Estilo1">Descripción</td>
                        <td bgcolor="#CCCCCC" class="Estilo1">Valor</td>
                      </tr>
                      <?			
								do{
									$name="cosmetica[".$i."]";
									//$name="funcional[".$i."]";
									?>
                      <tr class="style7">
                        <td align="left"><?=$row3['des'];?></td>
                        <td><div align="center">
						   <input type="checkbox" name="<?=$name;?>" value="<?=$row3['des'];;?>" />
                        </div></td>
                      </tr>
                      <?
									$i=$i+1;
								}while($row3=mysql_fetch_array($result1));
					?>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      </table>
                    <!--fin formulario-->                     
                  </div></td>
            </tr>
            <tr>
              <td colspan="3"><div align="center">
                  <table width="808" height="39" border="0" cellspacing="0" cellpadding="0">
                    <tr class="style7">
                      <td width="426" bgcolor="#CCCCCC">Observaciones</td>
                      <td width="382" bgcolor="#CCCCCC"><strong>Status del Test:</strong>
                      <select name="statusCalidad" class="Estilo1">
                        <option value="-------" selected="selected">-------</option>                        
                        <option value="OK">OK</option>
                        <option value="NOK">NOK</option>
                        <option value="PDC">PDC</option>
                      </select></td>
                    </tr>
                    <tr class="style7">
                      <td bgcolor="#FFFFFF"><textarea name="observaciones" cols="50" rows="3"></textarea></td>
                      <td bgcolor="#FFFFFF" valign="middle" align="center"><input type="submit" name="Submit2" value="Terminar Proceso de Control de Calidad" /></td>
                    </tr>
                  </table>
              </div></td>
            </tr>            
            <tr>
            	<td colspan="3">&nbsp;</td>
            </tr>
            <!--<tr>
              <td colspan="3">
              <div class="style7" style="border:#999999 solid medium; background-color:#F0F0F0; width:808px; height:80px; text-align:center; overflow:auto;">
        	  	<div align="left">Historial de Observaciones:</div>
		      </div>              </td>
            </tr>-->
          </table>
          </form>
		</center>        
        <br />	
<?
	}
?>
<?
	function datos($ot){
		global $base;
		$sql="SELECT equiposrep.*,codfallas.descripcion FROM equiposrep, codfallas WHERE ot='$ot' and codfallas.codigo=equiposrep.diag1";
		//$sql="Select * from equiposrep where ot='$ot'";
		$result4=mysql_query($sql,conectarBd());
		$row=mysql_fetch_array($result4);
		//consulta hacia las reparaciones
		$sql1="SELECT * FROM rep_efectuada WHERE ot ='$ot'";
		$result5=mysql_query($sql1,conectarBd());
		$rowx=mysql_fetch_array($result5);
		$i=0;
		do
		{
			$reparacion[$i]=$rowx['clave_rep']."-".$rowx['des'];
			$i=$i+1;
		}
		while($rowx=mysql_fetch_array($result5));
		?>
			<center>
				<table width="808" border="0" id="t1" name="t1" cellpadding="0" cellspacing="0" >
					<tr class="Estilo1">
						<td colspan="3" bgcolor="#999999"><div align="left" class="Estilo1">Datos del Equipo OT #: <?=$row['ot'];?></div></td>
					    <td bgcolor="#999999"><div align="right"><span class="Estilo1">Fecha:
					      <?=date("Y-m-d");?>
				        Hora:
<?=date(" H:i",time());?>
				        </span></div></td>
					</tr>
					<tr bordercolor="#000000">
						<td width="152" bgcolor="#CCCCCC" class="style7"><div align="left">Repar&oacute;</div></td>
					  <td width="212" class="style7"><div align="center">
					    <div align="center">
                          <?=$row['repara'];?>
                        </div>
					  </div></td>
						<td bgcolor="#CCCCCC" width="134" rowspan="3" class="style7">Reparacion Efectuada</td>
						<td width="305" class="style7"><div align="left">
                          <?=$reparacion[0];?>
                        </div></td>
					</tr>
					<tr bordercolor="#000000">
						<td bgcolor="#CCCCCC" class="style7"><div align="left">Modelo</div></td>
						<td class="style7"><div align="center">
						  <div align="center">
                            <?=$row['modelo'];?>
                          </div>
						</div></td>
						<td class="style7"><div align="left">
                          <?=$reparacion[1];?>
                        </div></td>
					</tr>
					<tr bordercolor="#000000">
						<td bgcolor="#CCCCCC" class="style7"><div align="left">Status General </div></td>
						<td class="style7"><div align="center">
                          <?=$row['statusgral']?>
                        </div></td>
						<td class="style7"><div align="left">
                          <?=$reparacion[2];?>
                        </div></td>
					</tr>
					<tr bordercolor="#000000">
						<td rowspan="2" bgcolor="#CCCCCC" class="style7">Falla Reportada</td>
						<td class="style7"><div align="left">
                          <?=$row['diag1'];?>
						  .-
  <?=$row['descripcion'];?>
                        </div></td>
						<td bgcolor="#CCCCCC" class="style7">Reporto:</td>
						<td class="style7"><?=$_SESSION["loginUsuarioBounce"];?></td>
					</tr>
					<tr bordercolor="#000000">
						<td class="style7"><? if($row['diag2']==""){
								echo "--";
							}else{
								$row['diag2'];?>.-<?=$row['descripcion'];
							}?>						</td>
						<td bgcolor="#CCCCCC" class="style7">&nbsp;</td>
						<td class="style7">&nbsp;</td>
					</tr>
					<?
					if($row['modelo']=="BB7100i"){
					?>
					<tr>
						<td colspan="4" bgcolor="#999999" class="style7">&nbsp;</td>
					</tr>
					<tr>
						<td bgcolor="#CCCCCC" class="style7">Equipo Blackberry </td>
						<td colspan="3" class="style7">
							<div align="left">
						<?
								echo "Equipo con BATERIA: ".$row['bateria']."<br>";
								echo "Equipo con TAPA: ".$row['tapa']."<br>";
								echo "Equipo con SIM: ".$row['sim']."<br>";	
								echo "Estado de la SIM: ".$row['sim_diag'];		
							?></div></td>
					</tr>
					<?
					}
					?>
				</table>
</center>
		<?
		$contadorRep=$row['contadorRep'];
		return $contadorRep;
	}//fin funcion datos	
?>
</body>
</html>
