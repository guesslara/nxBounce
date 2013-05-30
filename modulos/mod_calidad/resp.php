<?
	$pag=$_SERVER['PHP_SELF'];
	$ot=$_GET['ot'];
	$status=$_GET['status'];
	//base de datos
	$base="db_iqe_ref";
	include("../php/conectarbase.php");
	$sql="SELECT * FROM equiposrep WHERE ot='$ot'";
	//echo $sql;
	$result=mysql_db_query($base,$sql);
	$row=mysql_fetch_array($result);
	//FUNCION
?>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td bgcolor="#CC3333"><div align="center" class="style12"><span class="style10"> <a href="/omega/calidad/ctrolcalidad.php">Equipos en Ctrol de Calidad</a> | Buscar Equipos | Estadisticas</span></div></td>
  </tr>
</table>
<!--FORMULARIO-->
<br />
<form name="form1" id="form1" action="pruebas.php?action=mostrar" method="post">
<table width="25%" border="0" align="left" cellspacing="1" style="margin-left:20px" cellpadding="0" >
  <tr>
    <td width="61%" bgcolor="#999999" class="Estilo1"><div align="center">OT</div></td>
	<TD width="39%" bgcolor="#999999" class="Estilo1"><div align="center">Modelo</div></td>
  </tr>
  <tr>
  	<td class="style7" align="center"><?=$row['ot'];?><input name="ot" type="hidden" value="<?=$row['ot'];?>" /></td>
	<td class="style7" align="center"><?=$row['modelo']?><input name="modelo" type="hidden" value="<?=$row['modelo'];?>" /></td>
  </tr>
  <tr>
  	<td colspan="2">&nbsp;</td>
  </tr>
  <tr>
  	<td colspan="2" bgcolor="#999999">
  	  <div align="right" class="Estilo2">
  	    <input name="enviar" type="submit" class="style7" value="Capturar Pruebas" />
      </div>	</td>
   </tr>
</table>
</form>
<?
	if($_GET['action']=="mostrar"){
		//se inserta en la primera tabla
		$ot=$_POST['ot'];
		$modelo=$_POST['modelo'];
		$sql="INSERT INTO pruebas (ot,modelo,vsoftware,status) VALUES('$ot','$modelo','-','CC')";
		//echo $sql;
		$result=mysql_db_query($base,$sql);
		if($result==false){
			echo "Error, al Guardar la Orden de Trabajo, con el Test";
		}
?>
	<br /><br /><br /><br />
	<center>
		<table border="0" cellspacing="1" cellpadding="0">
			<tr>
				<td class="style7">Pruebas a Realizar</td>
			</tr>
		</table>
	</center>
<?
	$sql="SELECT * from pruebas";
	$result=mysql_db_query($base,$sql);
	$row1=mysql_fetch_array($result);
	//datos de la tabla
	?>
	<center>
		<table border="0" cellspacing="1" cellpadding="0">
			<tr>
				<td class="style7"><?=$row['ot'];?></td>
				<td class="style7"><?=$row['modelo'];?></td>
			</tr>
		</table>
	</center>
	<br />
	<?
		$sql="SELECT * FROM prueba_funcional";
		$result=mysql_db_query($base,$sql);
		$row2=mysql_fetch_array($result);
		$i=1;
	?>
	
	<form name="frm2" id="frm2" action="" method="post">
		<table border="1" cellspacing="1" cellpadding="0" style="margin-left:20px">
			<tr bgcolor="#999999">
				<td class="Estilo1">Descripción</td>
				<td class="Estilo1">Valor</td>
			</tr>
	<?
		while($row2=mysql_fetch_array($result)){
			$name="chk".$i;
			?>
			<tr class="style1">
				<td><?=$row2['des'];?></td>
				<td><input type="checkbox" name="chk1" /></td>
			</tr>
			<?
			$i=$i+1;
		}
	?>		
		<tr>
			<td colspan="2"><div align="right">
			  <input type="submit" name="Submit" value="Enviar" />
		    </div></td>
		</tr>
		</table>
	</form>
<?	
	}//cierra if
?>
