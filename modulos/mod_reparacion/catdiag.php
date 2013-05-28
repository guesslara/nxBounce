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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>
<? 
	$n=$_GET["n"]; // numero de diagnostico
	$p=$_GET["p"];	
?>
function ponclave(clave,desc){
	/*alert("llego");*/
	opener.document.frm.<?="cl".$n;?>.value = clave
	opener.document.frm.<?="ds".$n;?>.value = desc
	window.close() 
} 
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Catalogo de Diagnosticos</title>
<style type="text/css">
<!--
.style9 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #FFFFFF; font-weight: bold; }
.style10 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td bgcolor="#990000" class="style9">Catalogo de Diagnosticos</td>
  </tr>
</table>
<?
	$sql="SELECT * FROM coddiagnostico";
	$result=mysql_query($sql,conectarBd());
?> 
<span class="style10"><!--NO existe--></span>
<form id="form1" name="form1" method="post" action="">
<table width="100%" border="0" cellspacing="1">
    <tr>
      <td bgcolor="#333333" class="style9">Clave</td>
      <td bgcolor="#333333" class="style9">Descripcion</td>
    </tr>
    <?
	$color=="#D9FFB3";
	$i=1;
	while($row=mysql_fetch_array($result))
		{
?>
    <tr>
      <td bgcolor="<? echo $color; ?>"><?= $row["clave"]; ?></td>
      <td bgcolor="<? echo $color; ?>"><a href="#" onclick="ponclave('<?= $row["clave"]; ?>','<?= $row["descripcion"]; ?>')"><?= $row["descripcion"]; ?></a></td>
    </tr>
    <?
	if ($color=="#D9FFB3") 
		$color="#FFFFFF";
	else 
		$color="#D9FFB3";
	}
?>
  </table>
</form>
<p>&nbsp;  </p>
</body>
</html>