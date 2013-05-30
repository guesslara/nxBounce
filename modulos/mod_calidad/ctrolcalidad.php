<?
	//leemos la cookie
	session_start();
	//print_r($_SESSION);
	$usuario=$_SESSION["loginUsuarioBounce"];
	$base="db_iqe_ref";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link type="text/css" rel="stylesheet" href="calendar.css">
<link type="text/css" rel="stylesheet" href="../style.css" />
<script type="text/javascript" src="javascript/ajaxCalidad.js"></script>
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script>
	var keyCode
	function tecla(e){
		if(window.event)keyCode=window.event.keyCode;
		else if(e){ 
			keyCode=e.which;			
			//alert(keyCode)
			if(keyCode==13){
				listarRadiosCC('<?=$usuario;?>','buscar','--');
			}	
		}	
	}
</script>
<script>
function pulsar(e) {
  // averiguamos el código de la tecla pulsada (keyCode para IE y which para Firefox)
  var tecla = (document.all) ? e.keyCode :e.which;
  // si la tecla no es 13 devuelve verdadero,  si es 13 devuelve false y la pulsación no se ejecuta
  return (tecla=13);
}
</script>
<style type="text/css">
<!--
body {margin: 0px;}
.Estilo1 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;font-weight: bold;}
.style1 {color: #000000;font-size: 12px;font-family: Verdana, Arial, Helvetica, sans-serif;}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 9px;color: #999999;}
.style3 {color: #FFFFFF}
a:link {color: #000000;	text-decoration: none;}
a:visited {text-decoration: none;color: #000000;}
a:hover {text-decoration: underline;color: #666;}
a:active {text-decoration: none;color: #000000;}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;color: #FFFFFF;}
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
.style8 {color: #990000}
.style11 {color: #000000;font-weight: bold;}
.style10 {font-size: 12px}
.style12 {color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; }
.blanco{color:#FFFFFF; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
.negro{color:#000;}
-->
</style>
</head>
<body onload="listarRadiosCC('<?=$usuario;?>','todos','--')" onkeypress="tecla(event)">
<div style="width: 100%;height: 20px;padding: 9px;text-align: center;background: #f0f0f0;border: 1px solid #CCC;font-size: 12px;font-weight: bold;"><a href="ctrolcalidad.php" style="text-decoration: none;" title="Equipos en Control de Calidad">Equipos en Control de Calidad</a></div>
<div style="width:960; margin:10px 10px 0 10px;">
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><a href="javascript:listarRadiosCC('<?=$usuario;?>','todos','--')">Equipos en CC</a></li>
    <li class="TabbedPanelsTab" tabindex="0"><a href="javascript:listarRadiosCC('<?=$usuario;?>','NOK','--')">Equipos como NOK</a></li>
    <li class="TabbedPanelsTab" tabindex="0"><a href="javascript:listarRadiosCC('<?=$usuario;?>','PDC','--')">Equipos como PDC</a></li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
<!----><br />
<table width="864" align="center" cellpadding="0" cellspacing="0">	
<tr>
		<td>
		<form id="form1" name="form1" method="post" action="ctrolcalidad.php">
        <input name="user" type="hidden" value="<?=$usuario;?>" />
        <input name="filtro" type="hidden" value="buscar" />
		<table width="370" height="29" border="0" align="left" cellspacing="1" bordercolor="#333333">
			<tr>
				<th width="105" bgcolor="#CCCCCC"><span class="style7">Buscar ESN</span></th>
				<th colspan="2"><div align="left">
					<input name="esn" type="text" id="esn" size="30" onkeypress="return pulsar(event)" />
				</div>
				<th width="65" colspan="2"><input type="button" name="button2" id="button2" value="Buscar" onclick="listarRadiosCC('<?=$usuario;?>','buscar','--')" /></th>
		    </tr>
		  </table>
		</form>
		</td>
	</tr>
</table>
<div id="listado"></div>
<!---->    
    </div>
    <div class="TabbedPanelsContent">
<!----><br />
<table width="864" align="center" cellpadding="0" cellspacing="0">	
<tr>
		<td>
		<form id="form1" name="form1" method="post" action="ctrolcalidad.php">
        <input name="user" type="hidden" value="<?=$usuario;?>" />
        <input name="filtro" type="hidden" value="buscar" />
		<table width="370" height="29" border="0" align="left" cellspacing="1" bordercolor="#333333">
			<tr>
				<th width="105" bgcolor="#CCCCCC"><span class="style7">Buscar ESN</span></th>
				<th colspan="2"><div align="left">
					<input name="esn" type="text" id="esn" size="30" onkeypress="return pulsar(event)" />
				</div>
				<th width="65" colspan="2"><input type="button" name="button2" id="button2" value="Buscar" onclick="listarRadiosCC('<?=$usuario;?>','buscar','--')" /></th>
		    </tr>
		  </table>
		</form>
		</td>
	</tr>
</table>    
    <div id="listadoNOK"></div></div>
<!---->    
    <div class="TabbedPanelsContent">
<!----><br />
<table width="864" align="center" cellpadding="0" cellspacing="0">	
<tr>
		<td>
		<form id="form1" name="form1" method="post" action="ctrolcalidad.php">
        <input name="user" type="hidden" value="<?=$usuario;?>" />
        <input name="filtro" type="hidden" value="buscar" />
		<table width="370" height="29" border="0" align="left" cellspacing="1" bordercolor="#333333">
			<tr>
				<th width="105" bgcolor="#CCCCCC"><span class="style7">Buscar ESN</span></th>
				<th colspan="2"><div align="left">
					<input name="esn" type="text" id="esn" size="30" onkeypress="return pulsar(event)" />
				</div>
				<th width="65" colspan="2"><input type="button" name="button2" id="button2" value="Buscar" onclick="listarRadiosCC('<?=$usuario;?>','buscar','--')" /></th>
		    </tr>
		  </table>
		</form>
		</td>
	</tr>
</table>    
    <div id="listadoPDC"></div>
<!---->    
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
<!--<table width="864" align="center" cellpadding="0" cellspacing="0">	
<tr>
		<td>
		<form id="form1" name="form1" method="post" action="ctrolcalidad.php">
        <input name="user" type="hidden" value="<?$usuario;?>" />
        <input name="filtro" type="hidden" value="buscar" />
		<table width="370" height="29" border="0" align="left" cellspacing="1" bordercolor="#333333">
			<tr>
				<th width="105" bgcolor="#CCCCCC"><span class="style7">Buscar ESN</span></th>
				<th colspan="2"><div align="left">
					<input name="esn" type="text" id="esn" size="30" onkeypress="return pulsar(event)" />
				</div>
				<th width="65" colspan="2"><input type="button" name="button2" id="button2" value="Buscar" onclick="listarRadiosCC('<?$usuario;?>','buscar','--')" /></th>
		    </tr>
		  </table>
		</form>
		</td>
	</tr>
</table>
<div id="listado"></div>-->

<p align="center" class="style2 style8">IQelectronics SA de CV &copy;</p>
<div align="center"></div>
</body>
</html>
