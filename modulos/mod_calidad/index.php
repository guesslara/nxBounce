<?
	//sacamos los datos del usuario para ver si tiene acceso a esta parte
	$nivel_usuario=$_COOKIE['nivel'];
	//echo $nivel;
	//niveles de acceso a esta pagina
	$nivel_pag=array(0,1,4);
	for($i=0;$i<count($nivel_pag);$i++){
		//comparamos el nivel del usuario
		if(!in_array($nivel_usuario,$nivel_pag)){
		?>
			<script language="javascript">
				history.back();
			</script>
		<?
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Control de Calidad</title>
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
.colorNegro{color:#000;}
-->
</style>
</head>
<body>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td bgcolor="#999999"><div align="center" class="style8"><span class="style10"> <a href="ctrolcalidad.php"><span class="colorNegro"><strong>Equipos en Ctrol de Calidad</strong></span></a> <!--| <a href="/omega/calidad/ctrolcalidad.php">Estadisticas</a>--></span></div></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center" class="style5">Control de Calidad</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<hr />
<p align="center" class="Estilo1">IQelectronics
</body>
</html>
