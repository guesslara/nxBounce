<?
	//include("../../clases/funcionesComunes.php");
	class modeloEnsamble{
		
		private function conectarBd(){
			require("../../includes/config.inc.php");
			$link=mysql_connect($host,$usuario,$pass);
			if($link==false){
				echo "Error en la conexion a la base de datos";
			}else{
				mysql_select_db($db);
				return $link;
			}				
		}
		
		public function actualizaReg($imei,$serial,$lote,$clave,$status,$statusProceso,$statusDesensamble,$statusIngenieria,$id){
			echo "<br><br>Datos encontrados...........................<br><br>";
			echo "<br>".$sqlUp="update equipos set imei='".$imei."',serial='".$serial."',lote='".$lote."',mfgdate='".$clave."',status='".$status."',statusProceso='".$statusProceso."',statusDesensamble='".$statusDesensamble."',statusIngenieria='".$statusIngenieria."' where id_radio='".$id."'";
			$resUp=mysql_query($sqlUp,$this->conectarBd());
			if(mysql_affected_rows() >= 1){
				echo "Informacion Actualizada";
			}else{
				echo "Sin cambios en el registro";
			}
		}
		
		public function verificaUsuario($usuarioMod,$passMod){
			echo $sqlVer="Select * from userdbnextel where usuario='".$usuarioMod."' and pass='".md5($passMod)."' and nivel_acceso in (0,1,2,5,6)";
			$resVer=mysql_query($sqlVer,$this->conectarBd());
			$rowVer=mysql_fetch_array($resVer);
			$datos[0]=mysql_num_rows($resVer);
			if(mysql_num_rows($resVer)==0){
				echo "Informaci&oacute;n Incorrecta";				
			}else{
				$datos[1]=$rowVer["nombre"]." ".$rowVer["apaterno"];				
				echo "<script type='text/javascript'> $(\"#ventanaDialogo\").hide(); </script>";
				echo "<script type='text/javascript'> $(\"#transparenciaGeneral\").hide(); </script>";
				//se manda la informacion a una caja de texto en el formulario para su uso
				echo "<script type='text/javascript'>$('#datosUsuarioCambio').show(); </script>";
				echo "<script type='text/javascript'> document.getElementById('txtNombreModifico').value='".$rowVer["nombre"]." ".$rowVer["apaterno"]."'; </script>";
				echo "<script type='text/javascript'> $('#btnGuardar').show();</script>";				
				echo "<script type='text/javascript'> $('#txtComentariosCambio').show(); </script>";
				echo "<script type='text/javascript'> $('#divDescripcion').show(); </script>";
				echo "<script type='text/javascript'> comienzaEdicion(); </script>";
			}			
		}
		
		public function buscarEquipo2($imei,$filtro){
			($filtro=="serial") ? $filtro="esn" : $filtro="imei";
			//$objFunciones=new funcionesComunes();
			$sqlBuscar="select * from equiposrep where ".$filtro."='".$imei."'";
			$resBuscar=mysql_query($sqlBuscar,$this->conectarBd());
			//filtro para buscar en equipos enviados
			//$sqlBuscar1="select * from equipos_enviados where ".$filtro."='".$imei."'";
			//$resBuscar1=mysql_query($sqlBuscar1,$this->conectarBd());
			if(mysql_num_rows($resBuscar)==0 ){
				echo "<div style='margin-top:20px;border-top:1px solid #FF0000;border-bottom:1px solid #FF0000;background:#F5A9A9;height:20px;padding:9px;'>Error: ".$filtro." ($imei) no encontrado en la Base de Datos.</div>";
			}else{				
?>
				<style type="text/css">
				.estiloTitulosDatos{background: #f0f0f0;border: 1px solid #CCC; height: 20px;padding: 5px;font-weight: bold;font-size: 10px;text-align: left;}
				.estiloDatosBusqueda{border-bottom: 1px solid #CCC;text-align: left;font-size: 10px;border-right: 1px solid #CCC;}
				.divCajaPrincipal{width: 600px;margin: 0 auto 0 auto;height: auto;background: #FFF;border: 1px solid #CCC;}
				.divCajaPrincipalTitulo{position: relative; width: 200px;height: 25px;padding: 5px;background: #f0f0f0;border: 1px solid #a4a4a4;top: -15px;left:20px;text-align: left;color:#2E2E2E;font-weight: bold;font-size: 12px;}
				.divAdvertencia{margin-top:3px;height:20px;padding: 6px;background: #F3F781;border-bottom: 1px solid #FF8000;border-top:1px solid #FF8000;color: red;}
				.divNoReg{margin-top:3px;height:20px;padding: 6px;background: #82FA58;border: 1px solid green;margin: 0 auto 0 auto;width: 600px;margin-top: 5px;}
				</style>
<?
				
				$sqlEquipos="SELECT * FROM equiposrep where ".$filtro."='".$imei."' ORDER BY id DESC";				
				$resEquipos=mysql_query($sqlEquipos,$this->conectarBd());				
				//$rowEquipos=mysql_fetch_array($resEquipos);				
				$regsEncontrados=mysql_num_rows($resEquipos);				
				
				echo "<div class='divNoReg'>Registros encontrados: ".$regsEncontrados."</div>";
				//consulta para la bitacora
				//$sqlBitacora="SELECT id_detalle, id_radio, f_registro, h_registro, descripcion, nombre, apaterno FROM (detalle_ing INNER JOIN cat_procesos ON detalle_ing.id_proc = cat_procesos.id_proc) INNER JOIN userdbnextel ON detalle_ing.id_personal = userdbnextel.ID where id_radio='".$rowEquipos['id_radio']."'";
				//$resBitacora=mysql_query($sqlBitacora,$this->conectarBd());
				//$rowBitacora=mysql_fetch_array($resBitacora);
				if(mysql_num_rows($resEquipos) != 0){
					while($rowEquipos=mysql_fetch_array($resEquipos)){
?>
					<div style="clear: both;margin-bottom: 10px;">&nbsp;</div>
					<div class="divCajaPrincipal">
						<div class="divCajaPrincipalTitulo">Equipo en Proceso</div>
						<table width="90%" align="center" border="0" cellpadding="1" cellspacing="1" style="background: #FFF;">
							<tr>
								<td width="28%" class="estiloTitulosDatos">Imei</td>
								<td width="35%" class="estiloDatosBusqueda" style="border-top:1px solid #CCC;"><span id="datos_imei"><?=$rowEquipos['imei'];?></span></td>
								<td width="35%" align="center" class="estiloTitulosDatos">Modelo</td>											
							</tr>
							<tr>
								<td class="estiloTitulosDatos">Serie</td>
								<td class="estiloDatosBusqueda"><span id="datos_serial"><?=strtoupper($rowEquipos['esn']);?></span></td>
								<td rowspan="7"><div style="margin: 0 auto 0 auto; width: 150px;border:1px solid #CCC; background:#f0f0f0; height:60px; font-size:36px; text-align:center; padding:15px;"><?=$rowEquipos['modelo'];?></div></td>											
							</tr>
							<tr>
								<td class="estiloTitulosDatos">Sim</td>
								<td class="estiloDatosBusqueda"><span id="datos_serial"><?=strtoupper($rowEquipos['sim']);?></span></td>									
							</tr>
							<tr>
								<td class="estiloTitulosDatos"># Gu&iacute;a</td>
								<td class="estiloDatosBusqueda"><span id="datos_lote"><?=$rowEquipos['fnextel'];?></span></td>											
							</tr>
							<tr>
								<td class="estiloTitulosDatos">MFGDate</td>
								<td class="estiloDatosBusqueda"><span id="datos_clave"><?=$rowEquipos['mfgdate'];?></span></td>											
							</tr>
							<tr>
								<td class="estiloTitulosDatos">Fecha Activaci&oacute;n</td>
								<td class="estiloDatosBusqueda"><span id="datos_clave"><?=$rowEquipos['fecha_activacion'];?></span></td>
							</tr>
							<tr>
								<td class="estiloTitulosDatos">Clasificaci&oacute;n</td>
								<td class="estiloDatosBusqueda"><span id="datos_clave"><?=$rowEquipos['clasificacion'];?></span></td>
							</tr>
						</table><br>
					</div>	
					<div style="clear: both;margin-bottom: 15px;">&nbsp;</div>
					<div class="divCajaPrincipal">	
						<div class="divCajaPrincipalTitulo">Control Interno:</div>
						<table width="90%" align="center" border="0" cellpadding="1" cellspacing="1" style="background: #FFF;">
							<tr>
								<td width="28%" class="estiloTitulosDatos">Status</td>
								<td width="70%" class="estiloDatosBusqueda" style="border-top:1px solid #CCC;"><span id="datos_imei"><?=$rowEquipos['status'];?></span></td>									
							</tr>
							<tr>
								<td class="estiloTitulosDatos">Status Reparaci&oacute;n</td>
								<td class="estiloDatosBusqueda"><span id="datos_serial"><?=$rowEquipos['status_rep'];?></span></td>									
							</tr>								
							<tr>
								<td class="estiloTitulosDatos">Status A. Calidad</td>
								<td class="estiloDatosBusqueda"><span id="datos_lote"><?=$rowEquipos['status_cc'];?></span></td>											
							</tr>
							<tr>
								<td class="estiloTitulosDatos">Status Empaque</td>
								<td class="estiloDatosBusqueda"><span id="datos_clave"><?=$rowEquipos['status_despacho'];?></span></td>											
							</tr>							
						</table><br>
					</div>	
					<div style="clear: both;margin-bottom: 15px;">&nbsp;</div>
					<div class="divCajaPrincipal">	
						<div class="divCajaPrincipalTitulo">Envio Previo:</div>
						<table width="90%" align="center" border="0" cellpadding="1" cellspacing="1" style="background: #FFF;">
							<tr>
								<td width="28%" class="estiloTitulosDatos">Empaque interno</td>
								<td width="70%" class="estiloDatosBusqueda" style="border-top:1px solid #CCC;"><span id="datos_imei"><?=$rowPrevio["id_empaque"];?></span></td>									
							</tr>								
						</table><br>
						<div style="clear: both;margin-bottom: 5px;">&nbsp;</div>
					</div>	
					<div style="clear: both;margin-bottom: 15px;">&nbsp;</div>
						
					<div style="clear: both;margin-bottom: 5px;">&nbsp;</div>
<?
					}
				}
			}
		}
		
		public function buscarEquipo($imei,$filtro){			
			$objFunciones=new funcionesComunes();			
			$sqlBuscar="select * from equipos where ".$filtro."='".$imei."'";
			$resBuscar=mysql_query($sqlBuscar,$this->conectarBd());
			if(mysql_num_rows($resBuscar)==0){
				echo "<br><strong>Error: imei ($imei) no encontrado en la Base de Datos</strong>.";
			}else{
				if($filtro=="imei"){
					$regsNoEnviar=$objFunciones->buscarNoEnviar($imei);
				}else if($filtro=="serial"){
					$regsNoEnviar=$objFunciones->buscarSerieNoEnviar($imei);
				}
				//buscarSerieNoEnviar
				if($regsNoEnviar==0){			
					$rowBuscar=mysql_fetch_array($resBuscar);
					//se extrae el modelo
					$sqlModelo="select * from cat_modradio where id_modelo='".$rowBuscar['id_modelo']."'";				
					$resModelo=mysql_query($sqlModelo,$this->conectarBd());
					$rowModelo=mysql_fetch_array($resModelo);
					//se busca el imei en la tabla empaque items
					$sqlPrevio="select * from empaque_items where ".$filtro."='".$imei."'";
					$resPrevio=mysql_query($sqlPrevio,$this->conectarBd());
					$rowPrevio=mysql_fetch_array($resPrevio);
?>
				<input type="hidden" name="txtId" id="txtId" value="<?=$rowBuscar['id_radio']?>" />
				<table width="98%" border="0" cellpadding="1" cellspacing="1" style="margin:5px;font-size:11px;">					
					<tr>
						<td colspan="2"><i>Resumen para el parametro buscado: <strong><?=$imei;?></strong></i></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					
					<tr>
						<td colspan="2"><div id="datosUsuarioCambio" style="display:none;" ><input type="text" name="txtNombreModifico" id="txtNombreModifico"/></div></td>
					</tr>
					<tr>
						<td colspan="2"><div id="divDescripcion" style="display:none;">Descripci&oacute;n del cambio:<br></div><textarea rows="4" cols="40" name="txtComentariosCambio" id="txtComentariosCambio" style="display:none;" /></td>
					</tr>					
					<!--<tr>
						<td colspan="2" align='right'><div style="height:25px; padding:5px;text-align:right;"><a href="#" title="Modificar Informacion" style="color:blue; text-decoration:none;" onclick="abrirCampos()">Modificar Informaci&oacute;n</a>&nbsp;&nbsp;&nbsp;<input type="button" id="btnGuardar" style="display:none;" value="Guardar Cambios" /></div></td>
					</tr>-->					
					<tr>
						<td colspan="2">
						<fieldset><legend style="font-weight:bold; font-style:italic;">Resumen del Equipo:</legend>
							<table width="98%" border="0" cellpadding="1" cellspacing="1" style="margin:5px;">
								<tr>
									<td width="20%">Imei</td>
									<td width="43%"><span id="datos_imei"><?=$rowBuscar['imei'];?></span><input type='text' style='display:none;' name='txt_mod_imei' id='txt_mod_imei' value='<?=$rowBuscar['imei'];?>' /></td>
									<td width="17%" align="center">Modelo</td>
									<td width="5%">&nbsp;</td>
								</tr>
								<tr>
									<td>Serie</td>
									<td><span id="datos_serial"><?=$rowBuscar['serial'];?></span><input type='text' style='display:none;' name='txt_mod_serial' id='txt_mod_serial' value='<?=$rowBuscar['serial'];?>' /></td>
									<td rowspan="7"><div style="border:1px solid #CCC; background:#f0f0f0; height:45px; font-size:36px; text-align:center; padding:15px;"><?=$rowModelo['modelo'];?></div></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>Sim</td>
									<td><span id="datos_sim"><?=$rowBuscar['sim'];?></span><input type='text' style='display:none;' name='txt_mod_sim' id='txt_mod_sim' value='<?=$rowBuscar['sim'];?>' /></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>Lote</td>
									<td><span id="datos_lote"><?=$rowBuscar['lote'];?></span><input type='text' style='display:none;' name='txt_mod_lote' id='txt_mod_lote' value='<?=$rowBuscar['lote'];?>' /></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>MFGDate</td>
									<td><span id="datos_clave"><?=$rowBuscar['mfgdate'];?></span><input type='text' style='display:none;' name='txt_mod_clave' id='txt_mod_clave' value='<?=$rowBuscar['mfgdate'];?>' /></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>Movimiento</td>
									<td><span id="datos_movimiento"><?=$rowBuscar['num_movimiento'];?></span><input type='text' style='display:none;' name='txt_mod_movimiento' id='txt_mod_movimiento' value='<?=$rowBuscar['num_movimiento'];?>' /></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td><strong>Linea de Ensamble</strong></td>
									<td><span id="datos_movimiento"><?=$rowBuscar['lineaEnsamble'];?></span><input type='text' style='display:none;' name='txt_mod_movimiento' id='txt_mod_movimiento' value='<?=$rowBuscar['lineaEnsamble'];?>' /></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>									
								</tr>
							</table>
						</fieldset>
						</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
						<fieldset><legend style="font-weight:bold; font-style:italic;">Control interno</legend>
							<table width="98%" border="0" cellpadding="1" cellspacing="1" style="margin:5px;">
								<tr>
									<td width="20%">Status</td>
									<td width="65%"><span id="datos_status"><?=$rowBuscar['status'];?></span><input type='text' name='txt_mod_status' style='display:none;' id='txt_mod_status' value='<?=$rowBuscar['status'];?>' /></td>
								</tr>
								<tr>
									<td>Status Proceso</td>
									<td><span id="datos_statusProceso"><?=$rowBuscar['statusProceso'];?></span><input type='text' name='txt_mod_statusProceso' style='display:none;' id='txt_mod_statusProceso' value='<?=$rowBuscar['statusProceso'];?>' /></td>
								</tr>
								<tr>
									<td>Status Desensamble</td>
									<td><span id="datos_statusDesensamble"><?=$rowBuscar['statusDesensamble'];?></span><input type='text' name='txt_mod_statusDesensamble' style='display:none;' id='txt_mod_statusDesensamble' value='<?=$rowBuscar['statusDesensamble'];?>' /></td>
								</tr>
								<tr>
									<td>Status Diagnostico</td>
									<td><span id="datos_statusDiagnostico"><?=$rowBuscar['statusDiagnostico'];?></span><input type='text' name='txt_mod_statusDiagnostico' style='display:none;' id='txt_mod_statusDiagnostico' value='<?=$rowBuscar['statusDiagnostico'];?>' /></td>
								</tr>
								<tr>
									<td>Status Almacen</td>
									<td><span id="datos_statusAlmacen"><?=$rowBuscar['statusAlmacen'];?></span><input type='text' name='txt_mod_statusAlmacen' style='display:none;' id='txt_mod_statusAlmacen' value='<?=$rowBuscar['statusAlmacen'];?>' /></td>
								</tr>
								<tr>
									<td>Status Ingenieria</td>
									<td><span id="datos_statusIngenieria"><?=$rowBuscar['statusIngenieria'];?></span><input type='text' name='txt_mod_statusIngenieria' style='display:none;' id='txt_mod_statusIngenieria' value='<?=$rowBuscar['statusIngenieria'];?>' /></td>
								</tr>
								<tr>
									<td>Status Empaque</td>
									<td><span id="datos_statusEmpaque"><?=$rowBuscar['statusEmpaque'];?></span><input type='text' name='txt_mod_statusEmpaque' style='display:none;' id='txt_mod_statusEmpaque' value='<?=$rowBuscar['statusEmpaque'];?>' /></td>
								</tr>
								<tr>
									<td>Status IQ</td>
									<td><span id="datos_statusIq"><?=$rowBuscar['statusIQ'];?></span><input type='text' name='txt_mod_statusIq' id='txt_mod_statusIq' style='display:none;' value='<?=$rowBuscar['statusIQ'];?>' /></td>
								</tr>
							</table>
						</fieldset>
						</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
						<fieldset><legend style="font-weight:bold; font-style:italic;">Informaci&oacute;n Previa del Envio</legend>
							<table width="98%" border="0" cellpadding="1" cellspacing="1" style="margin:5px;">
								<tr>
									<td width="35%">Empaque Interno</td>
									<td width="65%"><?=$rowPrevio["id_empaque"];?></td>
								</tr>
								<tr>
									<td>Caja</td>
									<td><?=$rowPrevio["id_caja"];?></td>
								</tr>
								<tr>
									<td>Fecha</td>
									<td><?=$rowPrevio["fecha"];?></td>
								</tr>
								<tr>
									<td>Hora</td>
									<td><?=$rowPrevio["hora"];?></td>
								</tr>
							</table>
						</fieldset>
						</td>
					</tr>
				</table>				
<?
				}else{
					echo "<br><span style='color:#FF0000'>El imei (".$imei.") ESTA CLASIFICADO COMO NO ENVIAR, retirelo y entreguelo al ALMACEN.</span><br>";
				}
			}
		}
		
		
		public function actualizaDatosEquipoEnsamble($imei){
			echo "<br><br>Validando Datos...........................";
			$validacion=$this->validaStatusBaseDatos($imei);
			echo "<br><br>Procesando Datos...........................";
			if($validacion==true){			
				echo "<br>".$sqlEquipoEnsamble="UPDATE equipos set statusIngenieria='ING_OK',statusProceso='Empaque' where imei='".$imei."'";
				$resEquipoEnsamble=mysql_query($sqlEquipoEnsamble,$this->conectarBd());
				if(mysql_affected_rows() >=1 ){
					echo "<script type='text/javascript'> alert('Equipo actualizado en la Base de Datos'); limpiaCaja();</script>";
				}else{
					echo "<script type='text/javascript'> alert('Error al actualizar la informacion del equipo on imei ($imei)'); limpiaCaja();</script>";
				}
			}else{
				echo "<br><br><strong style='color:#F00;font-size:16px;'>Verifique el status del imei ($imei) y/o Tarjeta.</strong>";
				echo "<script type='text/javascript'>limpiaCaja();</script>";
			}
		}
		
		public function validaStatusBaseDatos($imei){
			$sqlImei="SELECT * from equipos where imei='".$imei."'";
			$resImei=mysql_query($sqlImei,$this->conectarBd());
			$rowImei=mysql_fetch_array($resImei);
			if($rowImei['status']=="En Proceso" && $rowImei['statusProceso']=="waitING" && $rowImei['statusDesensamble']=="OK" && $rowImei['statusIngenieria']==""){
				$validacion=true;
			}else{
				$validacion=false;
			}
			return $validacion;
		}
		
		
		public function actualizaDatos($equipos,$proceso,$usuarioEnsamble){			
			//se extrae el id del radio
			echo "<br>Procesando Datos...........................";
			$equipos=explode(",",$equipos);
			for($i=0;$i<count($equipos);$i++){
				echo "<br>".$sqlRadio="SELECT id_radio FROM equipos WHERE imei='".$equipos[$i]."'";
				$resRadio=mysql_query($sqlRadio,$this->conectarBd());
				$rowRadio=mysql_fetch_array($resRadio);
				$id_Radio=$rowRadio['id_radio'];
				$sql_insert1="INSERT INTO detalle_ing (id_proc,id_personal,id_radio,status,id_falla,f_registro,h_registro,observaciones)";
				$sql_insert2=" VALUES('".$proceso."','".$usuarioEnsamble."','','Ok','0','".date("Y-m-d")."','".date("H:i:s")."','---')";
				echo "<br>".$sqlEnsamble=$sql_insert1.$sql_insert2;
			}			
		}
	}//fin de la clase
?>