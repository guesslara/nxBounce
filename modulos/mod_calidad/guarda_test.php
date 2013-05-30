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
	
	$base="db_iqe_ref";
	//recibimos las variables
	$fecha=$_POST['fecha_fin'];
	$horamod=$_POST['hora_fin'];
	$reporto=strtoupper($_POST['usuario']);
	$usuario=$_POST['usuario'];
	$observaciones=$_POST['observaciones'];
	$status=$_POST['statusCalidad'];
	$id_prueba=$_POST['id_prueba'];
	$ot=$_POST['ot'];
	$contadorRep=$_POST['contadorRep'];	
	if($status=="NOK"){
		//actualiza a equipos rep
		//$sql="UPDATE equiposrep set status_rep='WIP',statusgral='REP' where ot='$ot'";
		//NUEVA ACTUALIZACION 08-09-2008
		//SOBRE EL STATUS CAMBIA DE WIP A NOK PARA QUE TAMBIEN EN LAS REPARACIONES SE
		//PUEDA BUSCAR COMO EL STATUS NOK
		$contadorRep=$contadorRep+1;
		$sql="UPDATE equiposrep set status_rep='NOK',statusgral='REP',status_cc='NOK',contadorRep=".$contadorRep." where ot='$ot'";
		//mandar mensaje de observacion
		mysql_query($sql,conectarBd());
		$sql="UPDATE pruebas set status='NOK' where ot='$ot'";
		mysql_query($sql,conectarBd());
	}elseif($status=="PDC"){
		$sql="UPDATE equiposrep set statusgral='PDC',status_cc='PDC' where ot='$ot'";
		mysql_query($sql,conectarBd());
		$sql="UPDATE pruebas set status='PDC' where ot='$ot'";
		mysql_query($sql,conectarBd());
	}elseif($status=="OK"){
		$sql="UPDATE equiposrep set statusgral='EMP',status_despacho='PEMP',status_cc='OK' where ot='$ot'";
		mysql_query($sql,conectarBd());
		$sql="UPDATE pruebas set status='OK' where ot='$ot'";
		mysql_query($sql,conectarBd());
		/*actualizamos los status para el nuevo mensaje*/
		$sql_act_status="UPDATE equiposrep set status='awaiting shipment' where ot='$ot'";
		mysql_query($sql_act_status,conectarBd());		
	}
	
	/*Actualizamos la tabla pruebas*/
	$sql="UPDATE pruebas set status='$status',fecha='$fecha',hora='$horamod',reporto='$reporto',observaciones='$observaciones' where id='$id_prueba'";
	mysql_query($sql,conectarBd());
	//proceso para guardar las pruebas*/
	
	if($_POST['funcional']<>""){
		foreach ($_POST['funcional'] as $id_funcional){ 
			$id_funcional;//."<br>"; 
			//se extrae el id de la prueba funcional y se prepara para guardarse
			$sql="SELECT * FROM prueba_funcional WHERE des='$id_funcional'";
			$result=mysql_query($sql,conectarBd());
			$row=mysql_fetch_array($result);
			$id_f=$row['id'];
			$array_funcional.=$id_f=$row['id']."|";
		}
	}
	$sql="INSERT INTO detalle_prueba_funcional (id_pruebas,id_prueba_funcional,val_funcional) values('$id_prueba','$array_funcional','1')";
	$result1=mysql_query($sql,conectarBd());
	if(mysql_affected_rows()<1){
		echo "<script language='javascript'>alert('Error al Guardar');<script>";
	}
	
	if($_POST['cosmetica']<>""){
		foreach ($_POST['cosmetica'] as $id_cosmetica){ 
			$id_cosmetica;//."<br>";
			//se extrae el id d ela prueba cosmetica y se prepara para guardarse
			$sql="SELECT * FROM prueba_cosmetica WHERE des='$id_cosmetica'";
			$result1=mysql_query($sql,conectarBd());
			$row1=mysql_fetch_array($result1);
			$id_c=$row1['id'];
			$array_cosmetica.=$id_c=$row1['id']."|";
		}
	}
	$sql="INSERT INTO detalle_prueba_cosmetica (id_prueba,id_prueba_cosmetica,val_cosmetica) values('".$id_prueba."','".$array_cosmetica."','1')";
	$result2=mysql_query($sql,conectarBd());
	if(mysql_affected_rows()<1){
		echo "<script language='javascript'>alert('Error al Guardar');</script>";
	}
	//redireccionamos a otra pagina
	header("Location: ctrolcalidad.php");
	exit;
?>