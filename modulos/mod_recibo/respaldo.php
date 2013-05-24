<?php
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