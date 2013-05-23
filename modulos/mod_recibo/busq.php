<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Recibo de Equipo</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 9px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #CCCCCC;
}
.style5 {font-family: Geneva, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 16px; }
.Estilo50 {color: #FFFFFF}
body {
	margin-top: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
a:link {
	color: #FFFFFF;
}
a:hover {
	color: #FFFF00;
}
a:visited {
	color: #CCCCCC;
}
.style8 {color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style10 {font-size: 12px}
.style4 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
}
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo51 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style13 {font-size: 9px}
-->
</style>
</head>
<body>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td bgcolor="#CC3333"><div align="center" class="style8"><span class="style10"><a href="regeqpo.php">Registro de Equipo</a> | <a href="findeqp.php">Buscar Equipos</a> | <a href="asignaeqpo.php">Asignar Equipos</a></span></div></td>
  </tr>
</table>
<?	
  		$crite=$_POST["crite"];
		$dato=$_POST["dato"];
		$fini=$_POST["dato1"];
		$ffin=$_POST["dato2"];
		if (($crite=="ot") or ($crite=="fnextel")){
			//echo $crite."--".$dato;		
			include("../php/conectarbase.php");
			$sql="SELECT * FROM equiposrep WHERE ".$crite."='".$dato."'";
			$result=mysql_db_query("db_iqe_ref",$sql);
			//echo $sql;
			$num=mysql_num_rows($result);
			$row=mysql_fetch_array($result);
			if($num==0){
?>
<table width="297" border="0" align="center" cellspacing="1" bordercolor="#333333">
  <tr>
    <th bgcolor="#990000" scope="row"><span class="style13">.</span></th>
  </tr>
  <tr>
    <th><div align="center" class="Estilo51">No se encontro ningun registro</div>
    </th>
  </tr>
  <tr>
    <th bgcolor="#990000" scope="row"><div align="right" class="style13">.</div>
    </th>
  </tr>
</table>
<?
			}   //if($num==0)
			else{
?> .
<table width="568" border="1" align="center" cellspacing="0" bordercolor="#333333">
  <tr>
    <th colspan="4" bgcolor="#990000" scope="row"><span class="style4">Detalle del equipo: -> 
      <?= $row["ot"];?></span></th>
  </tr>
  <tr>
    <th width="159" bgcolor="#CCCCCC" class="style7" scope="row">Cap</th>
    <th width="165" scope="row" class="style5"><?= $row["cap"];?></th>
    <th width="85" bgcolor="#CECFCE" class="style7" scope="row">Folio Nextel </th>
    <th width="141" scope="row"><span class="style5">
      <?= $row["fnextel"];?>
    </span></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" scope="row"><span class="style7">OT IQ</span></th>
    <th colspan="3" bgcolor="#D9FFB3" scope="row"><span class="style5">
      <?= $row["ot"];?>
    </span></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" scope="row"><span class="style7">
      <label> ESN </label>
    </span>    <div align="left" class="style7"></div></th>
    <th bgcolor="#FFFFFF" scope="row"><div align="left"><span class="style7">
      <?= $row["esn"];?>
    </span></div></th>
    <th colspan="2" bgcolor="#FFFFFF" scope="row"><span class="style7">serie</span></th>
  </tr>
  
  <tr>
    <th bgcolor="#CCCCCC" scope="row"><span class="style7">IMEI </span></th>
    <th colspan="3" bgcolor="#D9FFB3" scope="row"><div align="left" class="style7">
      <?= $row["imei"];?>
    </div></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" scope="row"><span class="style7">Handset description</span></th>
    <th colspan="3" scope="row"><div align="left" class="style5">
      <?= $row["modelo"];?>
    </div></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" scope="row"><span class="style7">Coment t consumer </span></th>
    <th colspan="3" bgcolor="#D9FFB3" scope="row"><div align="left" class="style7">
      <?= $row["comment"];?>
    </div></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" scope="row"><span class="style7"> Recive date </span></th>
    <th colspan="3" bgcolor="#FFFFFF" scope="row"><div align="left" class="style7">
      
        <div align="left">
          <input name="fecharec" type="hidden" id="fecharec" value="<?=date('Y-m-d');?>" />
          <?= $row["fecharec"];?>
          </div>
    </div></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" class="Estilo51" scope="row">Status General</th>
    <th colspan="3" bgcolor="#D9FFB3" scope="row"><div align="left" class="style5"><?= $row["statusgral"];?></div></th>
  </tr>
  
  <tr>
    <th bgcolor="#CCCCCC" class="style7" scope="row">Ship date </th>
    <th colspan="3" class="style7" scope="row"><div align="left"><?= $row["shipdate"];?>
      </div>
    </label></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" class="style7" scope="row">Ship Carrier </th>
    <th colspan="3" bgcolor="#D9FFB3" class="style7" scope="row"><div align="left">
      <?= $row["shipcarrier"];?>
    .</div></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" class="style7" scope="row">Ship tracking number </th>
    <th colspan="3" class="style7" scope="row"><div align="left">
      <?= $row["shiptracking"];?>
    .</div></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" class="style7" scope="row">Process</th>
    <th colspan="3" bgcolor="#D9FFB3" class="style7" scope="row"><div align="left">
      <?= $row["process"];?>
    </div></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" class="style7" scope="row">CAP id </th>
    <th colspan="3" class="style7" scope="row"><div align="left">
      <?= $row["cap"];?>
    </div>    </th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" class="style7" scope="row">Supervisor</th>
    <th colspan="3" bgcolor="#D9FFB3" class="style7" scope="row"><div align="left">
      <?= $row["supervisor"];?>
    </div></th>
  </tr>
  <tr>
    <th bgcolor="#CCCCCC" class="style7" scope="row">Address</th>
    <th colspan="3" class="style7" scope="row"><div align="left">
      <?= $row["direccion"];?>
    </div></th>
  </tr>
  <tr>
    <th colspan="4" bgcolor="#990000" class="style7" scope="row"></th>
  </tr>
</table>
<?
  			}
		}     //cierra el else de if($num==!null)
		else{
		//$crite=$_POST["crite"];
		//$dato=$_POST["dato"];
		//echo $crite."--".$dato;
		include("../php/conectarbase.php");
		$sql="SELECT * FROM `equiposrep` WHERE `fecharec` BETWEEN '$fini' AND '$ffin'";
		$result=mysql_db_query("db_iqe_ref",$sql);
		echo $sql;
		//echo "<center>Los datos fueron enviados correctamente</center>";
		
?>
</p>
<table width="1186" border="0" align="center" cellspacing="1" bordercolor="#333333">
  <tr>
    <th colspan="15" bgcolor="#990000" scope="row"><span class="style4">Equipos encontrados </span></th>
  </tr>
  <tr>
    <th width="29" bgcolor="#CCCCCC" class="style7" scope="row">CAP</th>
    <th width="29" bgcolor="#CCCCCC" class="style7" scope="row">folio</th>
    <th width="63" bgcolor="#CCCCCC" scope="row"><span class="style7">ESN</span></th>
    <th width="64" bgcolor="#CCCCCC" scope="row"><span class="style7">IMEI </span></th>
    <th width="126" bgcolor="#CCCCCC" scope="row"><span class="style7">Handset description</span></th>
    <th width="68" bgcolor="#CCCCCC" class="style7" scope="row">Coments to Consumer</th>
    <th width="87" bgcolor="#CCCCCC" class="style7" scope="row">Recive Date</th>
    <th width="70" bgcolor="#CCCCCC" class="style7" scope="row">Status</th>
    <th width="135" bgcolor="#CCCCCC" class="style7" scope="row">Ship Date </th>
    <th width="76" bgcolor="#CCCCCC" class="style7" scope="row">Ship carrier</th>
    <th width="124" bgcolor="#CCCCCC" class="style7" scope="row">Ship tracking number </th>
    <th width="105" bgcolor="#CCCCCC" scope="row"><span class="style7">Process</span></th>
    <th width="55" bgcolor="#CCCCCC" scope="row"><span class="style7">Cap id</span></th>
    <th bgcolor="#CCCCCC" scope="row"><span class="style7">Supervisor</span></th>
    <th width="69" bgcolor="#CCCCCC" class="style7" scope="row">Address</th>
  </tr>
  <?	
  $i=1;
		while($row=mysql_fetch_array($result)){
?>
  <tr>
    <th class="style7" scope="row"><?= $row["cap"];?></th>
    <th class="style7" scope="row">&nbsp;</th>
    <th class="style7" scope="row"><?= $row["esn"];?></th>
    <th class="style7" scope="row"><?= $row["imei"];?></th>
    <th class="style7" scope="row">&nbsp;</th>
    <th class="style7" scope="row"><?= $row["id"];?></th>
    <th class="style7" scope="row">&nbsp;</th>
    <th class="style7" scope="row">&nbsp;</th>
    <th class="style7" scope="row">&nbsp;</th>
    <th class="style7" scope="row">&nbsp;</th>
    <th class="style7" scope="row">&nbsp;</th>
    <th class="style7" scope="row"><?= $row["fnextel"];?></th>
    <th class="style7" scope="row"><?= $row["modelo"];?></th>
    <th width="40" class="style7" scope="row"><?= $row["fecharec"];?></th>
  </tr>
  <?
	}}
?>
  <tr>
    <th colspan="15" bgcolor="#990000" class="style7" scope="row"></label></th>
  </tr>
</table>
<p align="center" class="style5"></p>
<p align="center" class="style5">&nbsp;</p>
<hr />
<p align="center" class="Estilo1">IQelectronics
</body>
</html>