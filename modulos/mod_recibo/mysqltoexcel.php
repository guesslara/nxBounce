<?php
	
	include("../php/mysql_excel.inc.php");
	
	$import=new HarImport();
	$import->openDatabase("localhost","root","iqemex","dbnxrefurbish");
	
	//To import the data from table
	$import->ImportDataFromTable("caps");
	
	//To import the data from sql query
	$name=$_POST['name'];
	$sql="SELECT * FROM caps ";
	$archivo=$name.".xls";
	$import->ImportData($sql,"myXls.xls",true);

	//To force to download
	//$import->ImportDataFromTable("graduate","",true);
	//Or
	//$import->ImportData($sql,"myXls.xls",true);

?>