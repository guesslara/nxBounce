<?
	//proceso para la actualizacion de los datos
	include("../php/conectarbase.php");
	$base="db_iqe_ref";
	/*******Proceso de Borrado*******/
	if($_GET['action']=="eliminar"){
		eliminar();
	}
	
	function eliminar(){
		global $base;
		$id_prueba=$_GET['id_prueba'];
		$id_detalle_prueba=$_GET['id_detalle_prueba'];
		$tabla=$_GET['t'];
		$ot=$_GET['ot'];
		if($tabla=="detalle_prueba_funcional"){
			$campo="id_pruebas";
			$campo1="id_prueba_funcional";
		}elseif($tabla=="detalle_prueba_cosmetica"){
			$campo="id_prueba";
			$campo1="id_prueba_cosmetica";
		}
		$sql3="Delete from ".$tabla. " where ".$campo."='".$id_prueba."' and ".$campo1."='".$id_detalle_prueba."'";
		mysql_db_query($base,$sql3);
		if(mysql_affected_rows()<1){
			echo "<script language='javascript'>alert('Error al eliminar');</script>";
		}else{
			header("Location: pruebas.php?action=nuevo&ot=$ot");
			exit;
		}
	}
	
	if($_GET['action']=="borrar"){
		$id_prueba=$_GET['id_prueba'];
		$id_detalle_prueba=$_GET['id_detalle_prueba'];
		$tabla=$_GET['t'];
		$ot=$_GET['ot'];
		//confirmacion
		echo "<script language='javascript'>
		if(confirm('¿Esta seguro de borrar esta prueba?')){
			window.location.href='$pag?action=eliminar&id_prueba=$id_prueba&id_detalle_prueba=$id_detalle_prueba&t=$tabla&ot=$ot';
		}else{
			window.location.href='pruebas.php?action=nuevo&ot=$ot';
		}
		</script>";
	}elseif($_GET['action']=="actualizar"){
		/********************************/
		$fecha=$_POST['fecha_fin'];
		$horamod=$_POST['hora_fin'];
		//echo $reporto=strtoupper($_POST['reporto'])."<br>";
		$usuario=$_POST['usuario'];
		$observaciones=$_POST['observaciones'];
		$status=$_POST['statusCalidad'];
		$id_prueba=$_POST['id_prueba'];
		$ot=$_POST['ot'];
		//consultas hacia la base de datos
		
		//se recuperan de nuevo los checks
		if($_POST['funcional']<>""){
			foreach ($_POST['funcional'] as $id_funcional){
				$id_funcional."<br>";
				$sql="select * from prueba_funcional where des='$id_funcional'";
				//echo "<br>";
				$result=mysql_db_query($base,$sql);
				$fila=mysql_fetch_array($result);
				//se extrae el id de la tabla prueba_funcional
				$id_prueba_funcional=$fila['id'];
				//echo "<br>";
				//se busca en la tabla dettale_prueba_funcional
				$sql="select * from detalle_prueba_funcional where id_pruebas='$id_prueba' and id_prueba_funcional='$id_prueba_funcional'";
				$result1=mysql_db_query($base,$sql);
				//echo "<br>";
				$filas_encontradas=mysql_num_rows($result1);
				//echo "<br>";
				if($filas_encontradas==0){
					//si no hay ningun registro coincidente
					//se procede a la insercion de los datos en la tabla detalle_prueba_funcional
					$sql="INSERT INTO detalle_prueba_funcional (id_pruebas,id_prueba_funcional,val_funcional) values('$id_prueba','$id_prueba_funcional','1')";
					$result2=mysql_db_query($base,$sql);
					
					if(mysql_affected_rows()<1){
						echo "<script language='javascript'>alert('Error al Guardar');</script>";
					}
					//}else{
					/*echo "Actualizar datos<br>";
					echo $sql2="DELETE from detalle_prueba_funcional where id_pruebas='$id_prueba' and id_prueba_funcional='$id_prueba_funcional'";*/
				}
				
			}//fin foreach
		
		}
		
		if($_POST['cosmetica']<>""){
			/*PRUEBAS COSMETICAS*/
			foreach ($_POST['cosmetica'] as $id_cosmetica){
				$sql="select * from prueba_cosmetica where des='$id_cosmetica'";
				//echo "<br>";
				$result=mysql_db_query($base,$sql);
				$fila=mysql_fetch_array($result);
				//se extrae el id de la tabla prueba_funcional
				$id_prueba_cosmetica=$fila['id'];
				//echo "<br>";
				//se busca en la tabla dettale_prueba_funcional
				$sql="select * from detalle_prueba_cosmetica where id_prueba='$id_prueba' and id_prueba_cosmetica='$id_prueba_cosmetica'";
				$result1=mysql_db_query($base,$sql);
				//echo "<br>";
				$filas_encontradas=mysql_num_rows($result1);
				//echo "<br>";
				if($filas_encontradas==0){
					//si no hay ningun registro coincidente
					//se procede a la insercion de los datos en la tabla detalle_prueba_funcional
					$sql="INSERT INTO detalle_prueba_cosmetica (id_prueba,id_prueba_cosmetica,val_cosmetica) values('$id_prueba','$id_prueba_cosmetica','1')";
					$result2=mysql_db_query($base,$sql);
					
					if(mysql_affected_rows()<1){
						echo "<script language='javascript'>alert('Error al Guardar');</script>";
					}
				}
			}//fin foreach
		}
		
		
		//actualizacion a la tabla pruebas
		$sql4="update pruebas set status='$status',fecha='$fecha',hora='$horamod',reporto='$usuario',observaciones='$observaciones' where id='$id_prueba'";
		mysql_db_query($base,$sql4);
		//FALTAN LOS DEMAS STATUS PARA ACTUALIZAR Y REGRESAR LOS DATOSA REPARACION
		if($status=="NOK"){
			//actualiza a equipos rep
			//$sql="UPDATE equiposrep set status_rep='WIP',statusgral='REP' where ot='$ot'";
			//NUEVA ACTUALIZACION 08-09-2008
			//SOBRE EL STATUS CAMBIA DE WIP A NOK PARA QUE TAMBIEN EN LAS REPARACIONES SE
			//PUEDA BUSCAR COMO EL STATUS NOK
			$sql="UPDATE equiposrep set status_rep='NOK',statusgral='REP',status_cc='NOK' where ot='$ot'";
			//mandar mensaje de observacion
			mysql_db_query($base,$sql);
			$sql="UPDATE pruebas set status='NOK' where ot='$ot'";
			mysql_db_query($base,$sql);
		}elseif($status=="PDC"){
			$sql="UPDATE equiposrep set statusgral='PDC',status_cc='PDC' where ot='$ot'";
			mysql_db_query($base,$sql);
			$sql="UPDATE pruebas set status='PDC' where ot='$ot'";
			mysql_db_query($base,$sql);
		}elseif($status=="OK"){
			$sql="UPDATE equiposrep set statusgral='EMP',status_despacho='PEMP',status_cc='OK' where ot='$ot'";
			mysql_db_query($base,$sql);
			$sql="UPDATE pruebas set status='OK' where ot='$ot'";
			mysql_db_query($base,$sql);
		}
		//se redirecciona a otra pagina
		header("Location: pruebas.php?action=nuevo&ot=$ot");
		exit;
	}	
?>