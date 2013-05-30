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
	//guardar reparacion
	//leemos los valores y asigna los nombres de las variables como en el formulario
	//$sqlA="UPDATE alm_omega SET existencias=existencias-1 WHERE id_prod LIKE '".$_GET['mod']."%'";
	foreach($_POST as $nombre_campo=>$valor){
		$asignacion="\$".$nombre_campo."='".$valor."';";
		eval($asignacion);
	}
	//fecha de termino
	$fecha_fin=$_POST['fecha_fin'];
	//orden de trabajo
	$ot=$_GET['ot'];
	//determina el tipo de consulta hacia la base de datos
	$consulta=$_GET['consulta'];
	/*todas las variables a usar son:
	$status-$observaciones-$cl1-$cl2-$cl3-$rcl1-$rcl2-$rcl3-$rcl4-$rcl5-$rcl6-$recl1-$recl2-$recl3-*/
	//variables para los diagnosticos
	$diag[0]=$cl1;
	$diag[1]=$cl2;
	$diag[2]=$cl3;
		
	$diag1[0]=$ds1;
	$diag1[1]=$ds2;
	$diag1[2]=$ds3;
	
	//variables para las refacciones
	$refac[0]=$rcl1;
	$refac[1]=$rcl2;
	$refac[2]=$rcl3;
	$refac[3]=$rcl4;
	$refac[4]=$rcl5;
	$refac[5]=$rcl6;
		
	$refac1[0]=$rds1;
	$refac1[1]=$rds2;
	$refac1[2]=$rds3;
	$refac1[3]=$rds4;
	$refac1[4]=$rds5;
	$refac1[5]=$rds6;
	//variables para la reparacion efectuada
	$repefec[0]=$recl1;
	$repefec[1]=$recl2;
	$repefec[2]=$recl3;
	$repefec1[0]=$reds1;
	$repefec1[1]=$reds2;
	$repefec1[2]=$reds3;
	//modificacion blackberry
	$sim_diag=$_POST['blackberrySim'];
	if($sim_diag==""){
		$sim_diag="Buen estado";
	}
		
	
	//actualizar el campo status en la tabla equiposrep
	$sql="update equiposrep set status_rep='$status',obsrep='$observaciones',fechafinrep='$fecha_fin',sim_diag='$sim_diag' where ot='$ot'";
	//echo $sql."<br>";
	mysql_query($sql,conectarBd());
	//se recogen las observaciones
	//falta actualizar las observaciones del formulario
/********************************************************************************************/	
	//compara para saber que accion va a realizar
	if($consulta=="insertar"){
		//insertar en repdiagnostico
		for($i=0;$i<=2;$i++){
			if($diag[$i]<>""){
				//echo "inserta en diagnostico $i<br>";
				$sql="INSERT INTO repdiagnostico (clavediag, ot,des,posicion) values ('$diag[$i]','$ot','$diag1[$i]','$i')";
				//echo $sql."<br>";
				mysql_query($sql,conectarBd());
			}else{
				$sql="INSERT INTO repdiagnostico (clavediag, ot,des,posicion) values ('-','$ot','-','$i')";
				mysql_query($sql,conectarBd());
			}
		}
		//insertar en rep_refac_utilizadas
		for($i=0;$i<=5;$i++){
			if($refac[$i]<>""){
				//echo "inserta en refaccion $i<br>";
				$sql="INSERT INTO rep_refac_utilizadas (claverefac, ot,des,posicion) values ('$refac[$i]','$ot','$refac1[$i]','$i')";
				//echo $sql."<br>";
				mysql_query($sql,conectarBd());
			}else{
				$sql="INSERT INTO rep_refac_utilizadas (claverefac, ot,des,posicion) values ('-','$ot','-','$i')";
				//echo $sql."<br>";
				mysql_query($sql,conectarBd());
			}
		}
		//insertar en rep_efectuada
		for($i=0;$i<=2;$i++){
			if($repefec[$i]<>""){
				//echo "inserta en reparacion $i<br>";
				$sql="INSERT INTO rep_efectuada (clave_rep, ot,des,posicion) values ('$repefec[$i]','$ot','$repefec1[$i]','$i')";
				//echo $sql."<br>";
				mysql_query($sql,conectarBd());
			}else{
				//echo "inserta en reparacion $i<br>";
				$sql="INSERT INTO rep_efectuada (clave_rep, ot,des,posicion) values ('-','$ot','-','$i')";
				//echo $sql."<br>";
				mysql_query($sql,conectarBd());
			}
		}
	}
	elseif($consulta=="actualizar"){
		//insertar en repdiagnostico
		for($i=0;$i<=2;$i++){
			//echo "inserta en diagnostico $i<br>";
			$sql="UPDATE repdiagnostico set clavediag='$diag[$i]',ot='$ot',des='$diag1[$i]' where ot='$ot' AND posicion='$i'";
			//echo $sql."<br>";
			mysql_query($sql,conectarBd());
		}//fin for
		/*************************/
		//insertar en rep_refac_utilizadas
		for($i=0;$i<=5;$i++){
			//echo "inserta en refaccion $i<br>";
			//$sql="INSERT INTO rep_refac_utilizadas (claverefac, ot,des) values ('$refac[$i]','$ot','$refac1[$i]')";
			$sql="UPDATE rep_refac_utilizadas set claverefac='$refac[$i]',ot='$ot',des='$refac1[$i]' where ot='$ot' AND posicion='$i'";
			//echo $sql."<br>";
			mysql_query($sql,conectarBd());
			
		}//fin for
		/**************************/
		//insertar en rep_efectuada
		for($i=0;$i<=2;$i++){
			//echo "inserta en reparacion $i<br>";
			//$sql="INSERT INTO rep_efectuada (clave_rep, ot,des) values ('$repefec[$i]','$ot','$repefec1[$i]')";
			$sql="UPDATE rep_efectuada set clave_rep='$repefec[$i]',ot='$ot',des='$repefec1[$i]' where ot='$ot' AND posicion='$i'";
			//echo $sql."<br>";
			mysql_query($sql,conectarBd());
		}//fin for
	}
	//se cambia el status general para ubicar donde esta el archivo
	if(($status=="Rep")||($status=="REP")){
		$sql="UPDATE equiposrep set statusgral='CC',status_cc='CC' where ot='$ot'";
		mysql_query($sql,conectarBd());
	}
	if(($status=="NoRep")){
		$sql="UPDATE equiposrep set statusgral='EMP',status_cc='SPC',status_despacho='EMP' where ot='$ot'";
		mysql_query($sql,conectarBd());
	}
	if(($status=="Scrap")){
		$sql="UPDATE equiposrep set statusgral='EMP',status_cc='SPC',status_despacho='EMP' where ot='$ot'";
		mysql_query($sql,conectarBd());
	}
	//actualizacion de inventarios en almacen omega +++++++++++++++++++++
	//$model=$_GET['mod'];
	//include("../php/connbaseAlm.php");
	//mysql_db_query("dbiqcd",$sqlA);
	//echo $sqlA;	
	//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	//se redirecciona a otra pagina
	echo "<script type='text/javascript'>alert('Datos de la Reparación Guardados.');<script>";	
	header("Location: index.php");
	exit;
?>