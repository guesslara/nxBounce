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
?>
<script type="text/javascript" src="js/fucniones1.js"></script>
<style type="text/css">
<!--
.Estilo1 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;font-weight: bold;}
.style1 {color: #000000;font-size: 12px;font-family: Verdana, Arial, Helvetica, sans-serif;}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 9px;color: #999999;}
.style3 {color: #FFFFFF}
a:link {color: #FFFFFF;text-decoration: none;}
a:visited {text-decoration: none;color: #CCCCCC;}
a:hover {text-decoration: underline;color: #FFFF00;}
a:active {text-decoration: none;color: #FF0000;}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;color: #FFFFFF;}
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
.style8 {color: #990000}
-->
</style>
<div id="divGAsignacion"></div>
<?	
	if($_POST["action"]=="asignarEquipos"){		
	
	$sql="SELECT * FROM equiposrep where repara=''";
	$result=mysql_query($sql,conectarBd());
	$i=0;
?><br>
<table width="951" border="0" align="center" cellspacing="1" cellpadding="1" bordercolor="#333333">
	<tr>
		<th colspan="9" bgcolor="#999999" scope="row"><span class="style4">Listado de Equipos por Asignar</span></th>
	</tr>
	<tr>
		<th width="96" bgcolor="#CCCCCC" scope="row"><span class="style7"># GUIA</span></th>
		<th width="83" bgcolor="#CCCCCC" scope="row"><span class="style7">Imei</span></th>
		<th width="107" bgcolor="#CCCCCC" scope="row"><span class="style7">ESN</span></th>
		<th width="75" bgcolor="#CCCCCC" scope="row"><span class="style7">Modelo</span></th>
		<th width="93" bgcolor="#CCCCCC" scope="row"><span class="style7">f. de Recibo </span></th>
		<th width="119" bgcolor="#CCCCCC" scope="row" colspan="2"><span class="style7">CAP </span></th>            
		<th width="159" bgcolor="#CCCCCC" scope="row"><span class="style7">Asignar a: </span></th>		
	</tr>
<?
  	while($fila=mysql_fetch_array($result)){
		if($i % 2 == 0){
			$bgcolor = "#F0F0F0";
		}else{
			$bgcolor = "FFFFFF";
		}	
		$nf="form".$i;
		$nc="cboTecnico".$i;
?>
	<form id="form" name="<?=$nf?>" method="post" action="asignaeqpo.php" onSubmit="return validaAsignacion()" >
	<tr><input name="fechainirep" type="hidden" id="fechainirep" value="<?=date('Y-m-d');?>" />
		<th scope="row" class="style7" bgcolor="<?=$bgcolor;?>"><?=$fila['fnextel'];?>&nbsp;</th>
		<th scope="row" class="style7" bgcolor="<?=$bgcolor;?>"><?=$fila['imei'];?>&nbsp;<input type="hidden" name="ot" value="<?=$fila['imei'];?>" /></th>
		<th scope="row" class="style7" bgcolor="<?=$bgcolor;?>"><input name="esn" type="hidden" id="esn1" value="<?=$fila['esn'];?>" ><?=$fila['esn'];?>&nbsp;</th>
		<th scope="row" class="style7" bgcolor="<?=$bgcolor;?>"><?=$fila['modelo'];?>&nbsp;</th>
		<th bgcolor="<?=$bgcolor;?>" class="style7" scope="row"><?=$fila['fecharec'];?>&nbsp;</th>
		<th scope="row" class="style7" bgcolor="<?=$bgcolor;?>" colspan="2"><?=$fila['cap'];?>&nbsp;</th>						
		<th bgcolor="<?=$bgcolor;?>" class="style7" scope="row">
		<select name="<?=$nc;?>" id="<?=$nc;?>" onchange="guardarAsignacion('<?=$fila['id'];?>','<?=$i;?>')">
			<option value="" selected="selected">Selecciona...</option>
<?			
		require("../../includes/config.inc.php");
		$sql1="SELECT * FROM ".$tabla_usuarios." WHERE nivel_acceso=3 ";
		//$sql1="SELECT * FROM ".$tabla_usuarios."";
		$result1=mysql_query($sql1,conectarBd());
		while($row=mysql_fetch_array($result1)){
?>
			<option value="<?=$row[3].'.'.$row[4];?>"><?=$row[3].'.'.$row[4];?></option>
<?
		}
?>
		</select></th>		
	</tr>
	</form>
<?
	$i=$i+1;
	}
?>
</table>
<?
	}else if($_POST["action"]=="listarAsignaciones"){
?><br>
<table width="656" border="0" align="center" cellspacing="1" bordercolor="#333333">
  <tr>
    <th colspan="5" bgcolor="#999999" scope="row"><span class="style4">Equipo Registrado</span></th>
  </tr>
  <tr>
    <th width="142" bgcolor="#CCCCCC" scope="row"><span class="style7">Imei</span></th>
    <th width="142" bgcolor="#CCCCCC" scope="row"><span class="style7">Serial</span></th>
    <th width="340" bgcolor="#CCCCCC" scope="row"><span class="style7">Tecnico </span>    </th>
    <th width="136" bgcolor="#CCCCCC" scope="row"><span class="style7">Fecha ini. Rep</span></th>
    <th width="25" bgcolor="#CCCCCC" scope="row">&nbsp;</th>
  </tr>
<?				
		$sql3="SELECT * FROM equiposrep WHERE status_rep='DIAG' ORDER BY id";
		$result3=mysql_query($sql3,conectarBd());
		while($row3=mysql_fetch_array($result3)){
?>
  <tr>
    <th class="style7" scope="row" style="height: 15px;padding: 5px;border-bottom: 1px solid #CCC;"><?=$row3['imei'];?></th>
    <th class="style7" scope="row" style="height: 15px;padding: 5px;border-bottom: 1px solid #CCC;"><?=strtoupper($row3['esn']);?></th>
    <th class="style7" scope="row" style="height: 15px;padding: 5px;border-bottom: 1px solid #CCC;"><?=$row3['repara'];?></th>
    <th class="style7" scope="row" style="height: 15px;padding: 5px;border-bottom: 1px solid #CCC;"><?=$row3['fechainirep'];?></th>
    <th class="style7" scope="row" style="height: 15px;padding: 5px;border-bottom: 1px solid #CCC;"><a href="#" onclick="eliminaAsig('del','<?=$row3["id"];?>')" style="color:blue;">Eliminar</th>
  </tr>
<?
	}
?>
  <tr>
    <th colspan="5" bgcolor="#990000" class="style7" scope="row"></label></th>
  </tr>
</table>
<?
	}
?>
<!--fin nueva forma-->
<!---
<table width="656" border="0" align="center" cellspacing="1" bordercolor="#333333">
  <tr>
    <th colspan="4" bgcolor="#999999" scope="row"><span class="style4">Equipo Registrado</span></th>
  </tr>
  <tr>
    <th width="142" bgcolor="#CCCCCC" scope="row"><span class="style7">ESN</span></th>
    <th width="340" bgcolor="#CCCCCC" scope="row"><span class="style7">Tecnico </span>    </th>
    <th width="136" bgcolor="#CCCCCC" scope="row"><span class="style7">Fecha ini. Rep</span></th>
    <th width="25" bgcolor="#CCCCCC" scope="row">&nbsp;</th>
  </tr>
<?		
		/*include("../php/conectarbase.php");		
		$sql3="SELECT * FROM equiposrep WHERE status_rep='DIAG' ORDER BY ot";
		$result3=mysql_db_query("db_iqe_ref",$sql3);
		while($row3=mysql_fetch_array($result3)){*/
?>
  <tr>
    <th class="style7" scope="row"><$row3['esn'];?></th>
    <th class="style7" scope="row"><$row3['repara'];?></th>
    <th class="style7" scope="row"><$row3['fechainirep'];?></th>
    <th class="style7" scope="row"><a href="asignaeqpo.php?del=del&id=<$row3['esn'];?>"><img src="../img/del.png" alt="del" width="16" height="16" border="0" /></a></th>
  </tr>
<?
	//}
?>
  <tr>
    <th colspan="4" bgcolor="#990000" class="style7" scope="row"></label></th>
  </tr>
</table>
-->
<hr color="#990000"/>
<p align="center" class="style2 style8">IQelectronics SA de CV &copy; </p>
<div align="center"></div>
