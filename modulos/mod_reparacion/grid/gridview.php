<?
	require_once('dgCommon.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>iCE Breakers XAJAX Datagrid</title>
		<?
			$xajax->printJavascript("/javascript/");
		?>
	</head>

	<body>
		<center>
			<div id="dataGrid" align="center"></div>
			<script type="text/javascript">
				xajax_showDataGrid();
			</script>
		</center>
	</body>
</html>
