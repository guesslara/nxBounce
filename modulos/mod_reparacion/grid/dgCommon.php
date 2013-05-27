<?
	require_once('includes/xajax.inc.php');
	session_start();

	$xajax = new xajax("callbacks/cbDataGrid.php");
	$xajax->registerFunction("showDataGrid");
?>
