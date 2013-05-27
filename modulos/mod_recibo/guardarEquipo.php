<?php
    //print_r($_POST);
    
    $cap=$_POST['cap'];
    $fnextel=$_POST['guia'];
    $esn=$_POST['serie'];
    $imei=$_POST['imei'];
    $modelo=$_POST['modelo'];
    $recibe=$_POST['recibe'];
    $fecharec=date("Y-m-d");
    $diagnostico1=$_POST['diagnostico1'];
    $diagnostico2=$_POST['diagnostico2'];
    $obs=$_POST['obs'];
    $process=$_POST['proceso'];
    $activacion=$_POST['activacion'];
    $identificador=$_POST['identificador'];
    
    $sql="INSERT INTO equiposrep (cap, fnextel, esn, imei, modelo, recibe, fecharec, diag1, diag2, obs, status,fecha_activacion,clasificacion,process,statusgral) values ('$cap','$fnextel','$esn','$imei','$modelo','$recibe', '$fecharec', '$diagnostico1','$diagnostico2','$obs','In Repair','".$activacion."','".$identificador."','Bounce','REC')";
    $res=mysql_query($sql,conectarBd());
    
    if($res){
        //se busca la diferencia para obtener la garantia del equipo
        $sqlGarantia="SELECT DATEDIFF('".$fecharec."','".$activacion."') AS garantia";
        $resGarantia=mysql_query($sqlGarantia,conectarBd());
        $rowGarantia=mysql_fetch_array($resGarantia);
        if($rowGarantia["garantia"]>180){
            echo "<div style='border-top:1px solid #FF0000;border-bottom:1px solid #FF0000;height:20px;padding:5px;background:#F5A9A9;font-size:14px;color:#000;'>Equipo Fuera de GARANTIA !</div>";
        }        
        echo "<script type='text/javascript'> alert('Registro Guardado'); registrarEquipo(); </script>";
    }else{
        echo "<div style='border-top:1px solid #FF0000;border-bottom:1px solid #FF0000;height:20px;padding:5px;background:#F5A9A9;font-size:14px;color:#000;'>Error al GUARDAR la informacion</div>";
    }
    
    
    
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
    
    
    //modificacion de campos nuevos para blackberry
    //$tat=$_POST['date'];		
    /*
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
    }*/
?>