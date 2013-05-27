<?
	/*
	//sacamos los datos del usuario para ver si tiene acceso a esta parte
	$nivel_usuario=$_COOKIE['nivel'];
	//echo $nivel;
	//niveles de acceso a esta pagina
	$nivel_pag=array(0,1,3);
	for($i=0;$i<count($nivel_pag);$i++){
		//comparamos el nivel del usuario
		if(!in_array($nivel_usuario,$nivel_pag)){
		?>
			<script language="javascript">
				alert('Este modulo se encuentra en mantenimiento');
				history.back();
			</script>
		<?
		}
	}
	*/
?>
<script language="javascript" src="javascript/ajax_rep.js"></script>
<script language="javascript" src="javascript/funciones.js"></script>
<style type="text/css">
<!--
.style1 {color: #000000;font-size: 12px;font-family: Verdana, Arial, Helvetica, sans-serif;}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 9px;color: #999999;}
.style3 {color: #FFFFFF}
a:link {color: #666666;text-decoration: none;}
a:visited {text-decoration: none;color: #666666;}
a:hover {text-decoration: underline;color: #CCCCCC;}
a:active {text-decoration: none;color: #666666;}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;color: #FFFFFF;}
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
.style8 {color: #990000}
.style11 {color: #000000;font-weight: bold;}
.style5 {font-family: Geneva, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 16px; }
.Estilo50 {color: #FFFFFF}
.style8 {color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style10 {font-size: 12px}
.style11 {color: #990000}
.style12 {color: #000099}
.style13 {color: #993333}
.Estilo52 {font-family: Arial, Helvetica, sans-serif;font-size: 14px;color: #000000;}
/*esquinas*/
.roundedcornr_box_603736 {background: url(../img/esquinas/roundedcornr_603736_tl.png) no-repeat top left;}
.roundedcornr_top_603736 {background: url(../img/esquinas/roundedcornr_603736_tr.png) no-repeat top right;}
.roundedcornr_bottom_603736 {background: url(../img/esquinas/roundedcornr_603736_bl.png) no-repeat bottom left;}
.roundedcornr_bottom_603736 div {background: url(../img/esquinas/roundedcornr_603736_br.png) no-repeat bottom right;}
.roundedcornr_content_603736 {background: url(../img/esquinas/roundedcornr_603736_r.png) top right repeat-y;}
.roundedcornr_top_603736 div,.roundedcornr_top_603736,
.roundedcornr_bottom_603736 div, .roundedcornr_bottom_603736 {width: 100%;height: 10px;font-size: 1px;}
.roundedcornr_content_603736, .roundedcornr_bottom_603736 {margin-top: -19px;}
.roundedcornr_content_603736 { padding: 0 10px; }
/*otro rectangulo*/
.roundedcornr_box_327247 {background: url(../img/img_r/roundedcornr_327247_tl.png) no-repeat top left;}
.roundedcornr_top_327247 {background: url(../img/img_r/roundedcornr_327247_tr.png) no-repeat top right;}
.roundedcornr_bottom_327247 {background: url(../img/img_r/roundedcornr_327247_bl.png) no-repeat bottom left;}
.roundedcornr_bottom_327247 div {background: url(../img/img_r/roundedcornr_327247_br.png) no-repeat bottom right;}
.roundedcornr_content_327247 {background: url(../img/img_r/roundedcornr_327247_r.png) top right repeat-y;}
.roundedcornr_top_327247 div,.roundedcornr_top_327247,
.roundedcornr_bottom_327247 div, .roundedcornr_bottom_327247 {width: 100%;	height: 15px;
	font-size: 1px;
}
.roundedcornr_content_327247, .roundedcornr_bottom_327247 {
	margin-top: -19px;
}
.roundedcornr_content_327247 { padding: 0 15px; }
.Estilo53 {font-family: Verdana, Arial, Helvetica, sans-serif;font-weight: bold;}
.colorNegro{color:#000;}
.divBtn{font-size: 12px;width: 145px;height: 15px;padding: 5px;background: #f0f0f0;border: 1px solid #CCC;}
.divBtn:hover{background: #e1e1e1;cursor: pointer;}
/**/
-->
</style>

<div style="margin: 0px;">

<table width="100%" border="0" cellspacing="">
  <tr>
    <td style="text-align: center;height: 15px;padding: 5px;background: #f0f0f0;border: 1px solid #CCC;"><a href="javascript:cargarInformacion()" class="Estilo52"><span class="colorNegro"><strong>Listar Equipos a Reparar</strong></span></a></td>
  </tr>
</table>
<div class="divBtn" onclick="cargarInformacion()">Listar Equipos a Reparar</div>


<span id="texto" name="texto">
<p align="center" style="margin-top: 10%;">Reparacion de Equipos</p>
</span>
<span name="texto">
</span>

<p class="style13">&nbsp;</p>
<hr />
<p align="center" class="style2">IQelectronics SA de CV &copy;</p>
</div>
