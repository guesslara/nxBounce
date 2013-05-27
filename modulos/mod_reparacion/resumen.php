<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Resumen...</title>
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
	color: #FFFFFF;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #CCCCCC;
}
a:hover {
	text-decoration: underline;
	color: #FFFF00;
}
a:active {
	text-decoration: none;
	color: #FF0000;
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
-->
</style>
</head>

<body>
<form id="frm" name="frm" method="post" action="guardarep.php?ot=<?=$row[1];?>&consulta=<?=$consulta?>&mod=<?=$row['modelo'];?>" onsubmit="return confirmar()" >
<span class="Estilo1">Mostrando Informaci&oacute;n de:</span>
<?
	$esn=$_POST['esn'];
	include("../php/conectarbase.php");
	$sql="SELECT * FROM equiposrep WHERE esn='$esn'";
	//echo $SQL;
	$result=mysql_db_query("dbomega",$sql);
	$row=mysql_fetch_array($result);
	$num_rows = mysql_num_rows($result);
	if($num_rows==0){
	
	else{
	$ot=$row[1];	
?>
		<table width="837" border="0" align="center" cellspacing="1" bordercolor="#333333">
		  <tr>
			<th colspan="6" bgcolor="#990000" scope="row"><span class="style4">Datos del Equipo-- OT #: <?=$row[1];?><span class="style7">
				
			</span></span></th>
		  </tr>
		  <tr>
			<th width="112" bgcolor="#CCCCCC" class="style7">fol. NEXTEL</th>
			<th width="120" class="style7"><?=$row['fnextel'];?></th>
			<th width="76" bgcolor="#CCCCCC" class="style7">ESN</th>
			<th width="145" class="style7"><?=$row['esn'];?></th>
			<th width="72" bgcolor="#CCCCCC" class="style7">IMEI</th>
			<th width="253" class="style7"><?=$row['imei'];?></th>
		  </tr>
		  <tr>
			<th bgcolor="#CCCCCC" class="style7" scope="row">Modelo</th>
			<th class="style7" scope="row"><?=$row['modelo'];?></th>
			<th bgcolor="#CCCCCC" class="style7" scope="row">Fech. Rec.</th>
			<th class="style7" scope="row"><?=$row['fecharec'];?></th>
			<th rowspan="2" bgcolor="#CCCCCC" class="style7" scope="row">Falla Rep.</th>
			<th class="style7" scope="row"><?=$row['diag1'];?></th>
		  </tr>
		  <tr>
			<th bgcolor="#CCCCCC" class="style7" scope="row">Obs.</th>
			<th colspan="3" class="style7" scope="row"><div align="left"><?=$row['obs'];?>
			</div></th>
			<th class="style7" scope="row"><?=$row['diag2'];?></th>
		  </tr>
		  <tr>
			<th colspan="6" bgcolor="#FFFF00" class="Estilo1" scope="row">
		 <?
			$ftat=$row['tat'];
			$f=explode("-",$ftat);
			echo date("l d, F Y", mktime (0,0,0,$f[1],$f[2],$f[0]));
		 ?>   	</th>
		  </tr>
		  <tr>
			<th colspan="6" scope="row"><hr color="#990000"/></th>
		  </tr>
</table><br />
		<!--Datos Reparacion-->
		<table width="837" border="0" align="center" cellspacing="0" bordercolor="#000000">
    <tr>
      <th width="145" scope="row"><table width="539" border="0" cellspacing="1" bordercolor="#000000">
          <tr>
            <th colspan="5" bgcolor="#990000" class="style4" scope="row">Datos de Reparacion</th>
          </tr>
          <tr>
            <th width="15%" bgcolor="#CCCCCC" class="style7" scope="row">Fecha  Inicio</th>
            <th width="26%" class="style1" scope="row"><label>
              <?=$row['fecharec'];?>
            </label></th>
            <th width="18%" bgcolor="#CCCCCC" class="style7" scope="row">Status</th>
            <th width="41%" colspan="2" class="style7" scope="row"><label>
              <div align="left">
                <select name="status" id="select">
                  <option selected="selected">-</option>
                  <option>WIP</option>
                  <option>Rep</option>
                  <option>NoRep</option>
                  <option>Scrap</option>
                </select>
              </div>
            </label></th>
          </tr>
          <tr class="style7">
            <th bgcolor="#CCCCCC" class="style7" scope="row">Fecha fin</th>
            <th class="style1" scope="row"><label>
              <input type="hidden" name="hiddenField" id="hiddenField" value="<?=date("Y-m-d");?>"/><?=date("Y-m-d");?></label></th>
            <th rowspan="2" bgcolor="#CCCCCC" class="style7" scope="row">Observaciones</th>
            <th colspan="2" rowspan="2" class="style7" scope="row"><div align="left">
              <textarea name="observaciones" cols="18" rows="3" id="textfield14"></textarea>
            </div></th>
          </tr>
          <tr class="style7">
            <th bgcolor="#CCCCCC" class="style7" scope="row">Tecnico</th>
            <th class="style1" scope="row"><label>
              <?=$row['repara'];?>
            </label></th>
          </tr>
              </table></th>
      <th width="290" scope="row">
	  <!--Consulta hacia diagnostico-->
	  <?
	  	$sql="SELECT * FROM repdiagnostico WHERE ot='$ot'";
		//echo $sql;
		/*$result=mysql_db_query("dbomega",$sql);
		$row=mysql_fetch_array($result);*/
	  ?>
	  <table width="290" border="0" cellspacing="1">
        <tr>
          <th colspan="3" bgcolor="#990000" class="style4" scope="row">Diagnostico</th>
        </tr>
        <tr>
          <th width="7%" bgcolor="#CCCCCC" class="style7" scope="row">1</th>
          <th colspan="2" class="style7" scope="row">
            <div align="left">
            <a href="#" onclick="abreVentana('1')">
              <input name="cl1" type="text" id="cl1" size="5" />
              <input name="ds1" type="text" id="ds1" size="30" enable="enable"/>
            </a>            </div></th>
        </tr>
        <tr class="style7">
          <th bgcolor="#CCCCCC" class="style7" scope="row">2</th>
          <th width="11%" class="style7" scope="row"><label>
            <input name="cl2" type="text" id="cl2" size="5" />
          </label></th>
          <th width="82%" class="style7" scope="row"><div align="left"><a href="#" onclick="abreVentana('2')">
            <input name="ds2" type="text" id="ds2" size="30" enable="enable"/>
          </a></div></th>
        </tr>
        <tr class="style7">
          <th bgcolor="#CCCCCC" class="style7" scope="row">3</th>
          <th class="style7" scope="row"><label>
            <input name="cl3" type="text" id="cl3" size="5" />
          </label></th>
          <th class="style7" scope="row"><div align="left"><a href="#" onclick="abreVentana('3')">
            <input name="ds3" type="text" id="ds3" size="30" enable="enable"/>
          </a></div></th>
        </tr>
      </table>
	  <!--termina tabla diagnostico-->
	  </th>
    </tr>
    <tr>
      <th colspan="2" scope="row"><hr color="#990000"/></th>
    </tr>
    <tr>
      <th scope="row"><table width="543" border="0" cellspacing="1">
        <tr>
          <th colspan="6" bgcolor="#990000" class="style4" scope="row">Refacc. Utilizadas</th>
        </tr>
        <tr>
          <th width="4%" bgcolor="#CCCCCC" class="style7" scope="row">1</th>
          <th width="6%" class="style7" scope="row"><label>
            <input name="rcl1" type="text" id="rcl1" size="5" />
          </label></th>
          <th width="36%" class="style7" scope="row"><div align="left"><a href="#" onclick="abreVentanaRefaccion('1','<?=$row['modelo'];?>')">
            <input name="rds1" type="text" id="rds1" size="30" enable="enable"/>
          </a></div></th>
          <th width="3%" bgcolor="#CCCCCC" class="style7" scope="row">4</th>
          <th width="6%" class="style7" scope="row"><input name="rcl4" type="text" id="rcl4" size="5" /></th>
          <th width="45%" class="style7" scope="row"><div align="left"><a href="#" onclick="abreVentanaRefaccion('4','<?=$row['modelo'];?>')">
            <input name="rds4" type="text" id="rds4" size="30" enable="enable"/>
          </a></div></th>
        </tr>
        <tr class="style7">
          <th bgcolor="#CCCCCC" class="style7" scope="row">2</th>
          <th class="style7" scope="row"><label>
            <input name="rcl2" type="text" id="rcl2" size="5" />
          </label></th>
          <th class="style7" scope="row"><div align="left"><a href="#" onclick="abreVentanaRefaccion('2','<?=$row['modelo'];?>')">
            <input name="rds2" type="text" id="rds2" size="30" enable="enable"/>
          </a></div></th>
          <th bgcolor="#CCCCCC" class="style7" scope="row">5</th>
          <th class="style7" scope="row"><input name="rcl5" type="text" id="rcl5" size="5" /></th>
          <th class="style7" scope="row"><div align="left"><a href="#" onclick="abreVentanaRefaccion('5','<?=$row['modelo'];?>')">
            <input name="rds5" type="text" id="rds5" size="30" enable="enable"/>
          </a></div></th>
        </tr>
        <tr class="style7">
          <th bgcolor="#CCCCCC" class="style7" scope="row">3</th>
          <th class="style7" scope="row"><label>
            <input name="rcl3" type="text" id="rcl3" size="5" />
          </label></th>
          <th class="style7" scope="row"><div align="left"><a href="#" onclick="abreVentanaRefaccion('3','<?=$row['modelo'];?>')">
            <input name="rds3" type="text" id="rds3" size="30" enable="enable"/>
          </a></div></th>
          <th bgcolor="#CCCCCC" class="style7" scope="row">6</th>
          <th class="style7" scope="row"><input name="rcl6" type="text" id="rcl6" size="5" /></th>
          <th class="style7" scope="row"><div align="left"><a href="#" onclick="abreVentanaRefaccion('6','<?=$row['modelo'];?>')">
            <input name="rds6" type="text" id="rds6" size="30" enable="enable"/>
          </a></div></th>
        </tr>
      </table></th>
      <th scope="row"><table width="288" border="0" cellspacing="1">
        <tr>
          <th colspan="3" bgcolor="#990000" class="style4" scope="row">Rep. Efectuada</th>
        </tr>
        <tr>
          <th width="8%" bgcolor="#CCCCCC" class="style7" scope="row">1</th>
          <th width="11%" class="style7" scope="row"><label>
            <input name="recl1" type="text" id="recl1" size="5" />
          </label></th>
          <th width="81%" class="style7" scope="row"><div align="left"><a href="#" onclick="abreReparacionEfectuada('1','<?=$row['modelo'];?>')">
            <input name="reds1" type="text" id="reds1" size="30" enable="enable"/>
          </a></div></th>
        </tr>
        <tr class="style7">
          <th bgcolor="#CCCCCC" class="style7" scope="row">2</th>
          <th class="style7" scope="row"><label>
          <input name="recl2" type="text" id="recl2" size="5" />
          </label></th>
          <th class="style7" scope="row"><div align="left"><a href="#" onclick="abreReparacionEfectuada('2','<?=$row['modelo'];?>')">
            <input name="reds2" type="text" id="reds2" size="30" enable="enable"/>
          </a></div></th>
        </tr>
        <tr class="style7">
          <th bgcolor="#CCCCCC" class="style7" scope="row">3</th>
          <th class="style7" scope="row"><label>
            <input name="recl3" type="text" id="recl3" size="5" />
          </label></th>
          <th class="style7" scope="row"><div align="left"><a href="#" onclick="abreReparacionEfectuada('3','<?=$row['modelo'];?>')">
            <input name="reds3" type="text" id="reds3" size="30" enable="enable"/>
          </a></div></th>
        </tr>
      </table></th>
    </tr>
    <tr>
      <th colspan="2" class="Estilo1" scope="row"><hr color="#990000"/>        <label></label></th>
    </tr>
    <tr>
      <th bgcolor="#990000" class="Estilo1" scope="row"><span class="style4">Refurbished</span>
        <label>
        <input type="checkbox" name="refurbish" id="checkbox" />
        </label></th>
      <th class="Estilo1" scope="row"><input type="submit" name="Submit" value="Capturar Reparaci&oacute;n" /></th>
    </tr>
  </table>
<?
	}
?>		
</body>
</html>
