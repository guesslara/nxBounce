<?php
    /*
     *Clase para realizar los cambios en Reparacion
    */
class modelo{

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

    private function dameNivelUsuario($idUsuario){
        $sql="SELECT nivel_acceso FROM usuariosControl WHERE ID='".$idUsuario."'";
        $res=mysql_query($sql,$this->conectarBd());
        $row=mysql_fetch_array($res);
        return $row["nivel_acceso"];
    }
    
    private function dameNombreUsuario($idUsuario){
        $sql="SELECT nombre,apaterno FROM usuariosControl WHERE ID='".$idUsuario."'";
        $res=mysql_query($sql,$this->conectarBd());
        $row=mysql_fetch_array($res);
        return $row["nombre"].".".$row["apaterno"];
    }
    
    public function listarEquiposAReparar($idUsuario,$filtro,$imei){
        $nivel=$this->dameNivelUsuario($idUsuario);
        if($nivel==0 || $nivel==1){
            if($filtro=="todos"){
                if($imei=="N/A"){
                    $sql="SELECT * FROM equiposrep WHERE status_rep='DIAG' order by id DESC";
                }else{
                    $sql="SELECT * FROM equiposrep WHERE status_rep='DIAG' AND imei='".$imei."' order by id DESC";
                }
            }else{
                if($imei=="N/A"){
                    $sql="SELECT * FROM equiposrep WHERE status_rep='".$filtro."' order by id DESC";        
                }else{
                    $sql="SELECT * FROM equiposrep WHERE status_rep='".$filtro."' AND imei='".$imei."' order by id DESC";        
                }
                
            }            
        }else{
            $usuario=$this->dameNombreUsuario($idUsuario);
            if($filtro=="todos"){
                if($imei=="N/A"){
                    $sql="SELECT * FROM equiposrep WHERE repara='$usuario' and status_rep='DIAG' order by id DESC";        
                }else{
                    $sql="SELECT * FROM equiposrep WHERE repara='$usuario' and status_rep='DIAG' AND imei='".$imei."' order by id DESC";        
                }                
            }else{
                if($imei=="N/A"){
                    $sql="SELECT * FROM equiposrep WHERE repara='$usuario' and status_rep='".$filtro."' order by id DESC";        
                }else{
                    $sql="SELECT * FROM equiposrep WHERE repara='$usuario' and status_rep='".$filtro."' AND imei='".$imei."' order by id DESC";        
                }
                
            }            
        }
        //echo "<BR>".$sql;
        $res=mysql_query($sql,$this->conectarBd());
        if(mysql_num_rows($res)==0){
            echo "<br>( 0 ) registros encontrados.<br>";
        }else{
?>
            <style type="text/css">
                .estilosResultados{text-align: center;height: 15px;padding: 5px;border-bottom: 1px solid #CCC;}
                .estilosResultados:hover{background: skyblue;}
            </style>
            <table width="884" border="0" cellspacing="1" cellpadding="1" style="font-size: 10px;">       
                <tr>
                    <td width="82" style="height: 15px;padding: 5px;border: 1px solid #CCC;background: #f0f0f0;text-align: center;font-weight: bold;">Id</th>
                    <td width="100" style="height: 15px;padding: 5px;border: 1px solid #CCC;background: #f0f0f0;text-align: center;font-weight: bold;">Imei</th>
                    <td width="91" style="height: 15px;padding: 5px;border: 1px solid #CCC;background: #f0f0f0;text-align: center;font-weight: bold;">Serie</th>
                    <td widdth="140" style="height: 15px;padding: 5px;border: 1px solid #CCC;background: #f0f0f0;text-align: center;font-weight: bold;">Modelo</th>
                    <td width="66" style="height: 15px;padding: 5px;border: 1px solid #CCC;background: #f0f0f0;text-align: center;font-weight: bold;">F. de Recibo</th>
                    <td width="66" style="height: 15px;padding: 5px;border: 1px solid #CCC;background: #f0f0f0;text-align: center;font-weight: bold;">Acciones</th>
                </tr>
<?
            while($row=mysql_fetch_array($res)){
?>
                <tr class="estilosResultados">
                    <td width="82" style="text-align: center;height: 15px;padding: 5px;border-bottom: 1px solid #CCC;"><?=$row["id"];?></th>
                    <td width="100" style="text-align: center;height: 15px;padding: 5px;border-bottom: 1px solid #CCC;"><?=$row["imei"];?></th>
                    <td width="91" style="text-align: center;height: 15px;padding: 5px;border-bottom: 1px solid #CCC;"><?=$row["esn"];?></th>
                    <td width="140" style="text-align: center;height: 15px;padding: 5px;border-bottom: 1px solid #CCC;"><?=$row["modelo"];?></th>
                    <td width="66" style="text-align: center;height: 15px;padding: 5px;border-bottom: 1px solid #CCC;"><?=$row["fecharec"];?></th>
                    <td width="66" style="text-align: center;height: 15px;padding: 5px;border-bottom: 1px solid #CCC;"><a href="repeqpo.php?action=mostrar&esn=<?=$row["esn"];?>&status=<?=$row["status_rep"];?>&ot=<?=$row["ot"];?>" target="_blank" style="color:blue;text-decoration: none;">Diagnosticar</a></th>
                </tr>
<?
            }
?>
            </table>
<?
        }
    }
    
    public function listarEquipos($idUsuario){
        $pag=$_SERVER['PHP_SELF'];
?>
        <table align="center" width="900" border="0" cellpadding="0" cellspacing="0" style="font-size: 12px;margin-top: 10px;">	
            <tr>
		<td width="62%" style="text-align: left;border-bottom: 1px solid #CCC;">                    
                    <table width="370" border="0" align="left" cellspacing="1" bordercolor="#333333">
			<tr>
			    <th width="105" bgcolor="#CCCCCC">Buscar Imei</th>
                            <th colspan="2"><input type="text" name="esn" id="esn" onkeyup="buscarImei(event,'<?=$idUsuario;?>')" /></th>
			    <th width="65" colspan="2">&nbsp;</th>
                        </tr>
                    </table>                    
                </td>
		<td width="38%" style="border-bottom: 1px solid #CCC;">		                    
                    <table border="0" cellpadding="1" align="right">
                        <tr>
                            <td style="text-align: right;">Filtrar por:
                                <select name="filtro" id="filtro" onchange="mostrarEquiposReparacion('<?=$idUsuario;?>')">
                                    <option value="todos" selected="selected">todos</option>
                                    <option value="WIP">WIP</option>
                                    <option value="NoRep">NoRep</option>
                                    <option value="Scrap">Scrap</option>
                                    <option value="Rep">Rep</option>
                                </select>                                
                            </td>
                        </tr>
                    </table>                    
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"><div id="listadoEquiposReparacion"></div></td>
            </tr>
        </table>
<?
    }
}
?>