<? header("Cache-Control: no-store, no-cache, must-revalidate");?>
<?
	session_start();
	session_cache_limiter('nocache,private');
	if($_GET['action']=="listarRadiosCCalidad"){
		$user=$_GET['user'];
		$filtro=$_GET['filtro'];
		$esn=$_GET['esn'];
		listarRadiosCC($user,$filtro,$esn);
	}
	function listarRadiosCC($user,$filtro,$esn){		
		//configuracion de la clase
		include("../../clases/adob/adodb.inc.php");
		$adodb = ADONewConnection('mysql');		
		include("../../includes/config.inc.php");
		//se comprueba si se realiza la conexion con el servidor
		if(!$adodb->Connect($host,$usuario,$pass,$db)){
			echo "Error al conectar con la base de datos.";			
		}else{
			/*nuevo contenido*/
			$RegistrosAMostrar=30;
			$i=0;
			 //estos valores los recibo por GET
			 if(isset($_GET['pag'])){
			 	$RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
			 	$PagAct=$_GET['pag'];
			  //caso contrario los iniciamos
			 }else{
			 	$RegistrosAEmpezar=0;
			 	$PagAct=1;
			 }
			 //consultas a realizar
			 if($filtro=="todos"){
				 $sqlNueva="SELECT * FROM equiposrep WHERE statusgral like 'CC' order by tat LIMIT $RegistrosAEmpezar, $RegistrosAMostrar";
				 $sqlNueva1="SELECT * FROM equiposrep WHERE statusgral like 'CC' order by tat";
			 }else if($filtro=="PDC"){
			 	 $sqlNueva="SELECT * FROM equiposrep WHERE status_cc like 'PDC' order by tat LIMIT $RegistrosAEmpezar, $RegistrosAMostrar";
				 $sqlNueva1="SELECT * FROM equiposrep WHERE status_cc like 'PDC' order by tat";								 	
			 }else if($filtro=="NOK"){
				 $sqlNueva="SELECT * FROM equiposrep WHERE status_cc like 'NOK' order by tat LIMIT $RegistrosAEmpezar, $RegistrosAMostrar";
				 $sqlNueva1="SELECT * FROM equiposrep WHERE status_cc like 'NOK' order by tat";								 	
			 }else if($filtro=="buscar"){
				 $sqlNueva="SELECT * FROM equiposrep WHERE statusgral like 'CC' and esn='".$esn."' order by tat LIMIT $RegistrosAEmpezar, $RegistrosAMostrar";				 
				 $sqlNueva1="SELECT * FROM equiposrep WHERE statusgral like 'CC' and esn='".$esn."' order by tat";
			 }
			 /*echo $sqlNueva;
			 echo "<br>";
			 echo $sqlNueva1;*/
			 $rs=$adodb->Execute($sqlNueva);
			 $rs1=$adodb->Execute($sqlNueva1);
			 //******--------determinar las páginas---------******//
			 $NroRegistros=$rs1->RecordCount();
			 $PagAnt=$PagAct-1;
			 $PagSig=$PagAct+1;
			 $PagUlt=$NroRegistros/$RegistrosAMostrar;
			
			 //verificamos residuo para ver si llevará decimales
			 $Res=$NroRegistros%$RegistrosAMostrar;
			 // si hay residuo usamos funcion floor para que me devuelva la parte entera, SIN REDONDEAR, y le sumamos una unidad para obtener la ultima pagina
			 if($Res>0) $PagUlt=floor($PagUlt)+1;
			 ?>
				<br />
          <div align="center" style="margin-left:10px;">
					<table width="864" border="0" cellspacing="0" cellpadding="1">
<!--<tr>
							  <td colspan="8"><div align="left" class="style8">Radios en Control de Calidad</div></td>
							</tr>-->
							<tr>
								<td colspan="8" align="left">
			<?                    
			//desplazamiento
			 ?>
				   <a href="javascript:Pagina('1','<?=$user;?>','todos','--')" title="Primero" style="cursor:pointer;">Primero</a>
			  <?
			 if($PagAct>1){ 
			 ?>
					 <a href="javascript:Pagina('<?=$PagAnt;?>','<?=$user;?>','todos','--')" title="Anterior" style="cursor:pointer;">Anterior</a>
			  <?
			  }
			 echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>";
			 if($PagAct<$PagUlt){
			 ?>
				  <a href="javascript:Pagina('<?=$PagSig;?>','<?=$user;?>','todos','--')" title="Siguiente" style="cursor:pointer;">Siguiente</a>
			 <?
			 }
			 ?>     
				  <a href="javascript:Pagina('<?=$PagUlt;?>','<?=$user;?>','todos','--')" title="Ultimo" style="cursor:pointer;">Ultimo</a>				 				                     </td>
                </tr>
                <tr>
                	<td colspan="3"><div align="right" style="width:auto; float:left; margin-top:6px;" class="style8">Mostrando: <?=$rs->RecordCount();?> resultados de <?=$rs1->RecordCount();?></div></td>
                    <td colspan="5"><div align="right" style="width:auto; margin-top:6px;" class="style8">Usuario: <?=$user;?></div></td>
                    </tr>
                <tr>
				  <td colspan="8"><hr color="#990000"></hr></td>
				</tr>
                <tr>
                    <th width="90" bgcolor="#CCCCCC" scope="row"><span class="style7">OT</span></th>
                    <th width="89" bgcolor="#CCCCCC" scope="row"><span class="style7">F. NEXTEL</span></th>
                    <th width="124" bgcolor="#CCCCCC" scope="row"><span class="style7">ESN</span> </th>
                  <th width="159" bgcolor="#CCCCCC" scope="row"><span class="style7">IMEI </span></th>
                  <th width="71" bgcolor="#CCCCCC" scope="row"><span class="style7">Modelo</span></th>
                    <th width="115" bgcolor="#CCCCCC" scope="row"><span class="style7">F. de Recibo </span></th>
                  <th width="125" bgcolor="#CCCCCC" scope="row"><span class="style7">TAT </span></th>
                  <th width="75" bgcolor="#CCCCCC" scope="row"><span class="style7">STATUS </span></th>
                  </tr>  
			<?
						$color=="#FFFFFF";
						$i=1;
						while($row=$rs->FetchNextObject()){						
							$nombre="Form".$i;						
			?>
				<tr>
				  <td bgcolor="<?=$color;?>" class="style10">
					<div align="center"><a href="pruebas.php?action=nuevo&ot=<?=$row->OT;?>" class="Estilo51"><?=$row->OT?></a><input type="hidden" name="numRc" value="<?=$row->OT;?>" /></div></td>
				  <td bgcolor="<?=$color;?>" class="style10">
				    <div align="center"><?=$row->FNEXTEL;?></div></td>
				  <td bgcolor="<?=$color;?>" class="style10">
					<div align="center"><?= $row->ESN;?></div></td>
                  <td bgcolor="<?=$color;?>" class="style10">
					<div align="center"><?= $row->IMEI;?></div></td>
                  <td bgcolor="<?=$color;?>" class="style10">
					<div align="center"><?= $row->MODELO;?></div></td>    
				  <td width="115" bgcolor="<?=$color;?>"><div align="center"><?= $row->FECHAREC;?></div></td>
				  <td width="125" bgcolor="<?=$color;?>">
				  <div align="center"><?=$row->TAT;?></div></td>
                  <td width="75" bgcolor="<?=$color;?>">
				  <div align="center"><?=$row->STATUSGRAL;?></div></td>
				</tr>	
			<?
							if ($color=="#F0F0F0") //d9ffb3
								$color="#ffffff";
							else 
								$color="#F0F0F0";
						
						$i=$i+1;
						}
			?>				
				<tr>
				  <td colspan="8"><hr color="#000000"></td>
				</tr>
			</table>
</div>
            <br />
<?			
			$rs->Close();
			$rs1->Close();
			$adodb->Close();
		}//fin if	
	}
?>	