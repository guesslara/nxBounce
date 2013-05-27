<?
	require('../includes/config.php');
	require('../classes/clsDB.php');
	require('../classes/clsDataGrid.php');
	require_once('../dgCommon.php');

	$commonDB = new clsDB($GLOBALS['DB']);

	/*
	*	getNumRows
	*
	*/
	function getNumRows($strColumn=NULL,$strValue=NULL)
	{
		GLOBAL $commonDB;

		// Possibly use memcache here?
		$query = "SELECT COUNT(*) AS numrows FROM equiposrep";
		if ($commonDB->query($query))
		{
			$row = $commonDB->fetchRow();
		}
		return $row['numrows'];
	} // END getNumRows


	/**
	*
	*	Primary Callback Function
	*
	*/
	function showDataGrid($intStart=0, $intLimit=25, $strOrderCol=NULL, $strSortDir="ASC", $strWhere=NULL)
	{
		GLOBAL $commonDB;

		$objResponse = new xajaxResponse();
		$objDataGrid = new clsDataGrid();

		$objDataGrid->setTableName('ibDataGrid');
		$objDataGrid->setTableStyle('style="width:80%; border: 2px solid #C3DAF9; color:#000; padding:0px; margin:0px;" cellspacing=0 cellpadding=0');
		$objDataGrid->setHeaderStyle('style="text-align: center; font-family: tahoma; font-size: 10px; border:0; margin:0; padding:3px; font-weight:bold; color:#000; background-image:url(images/mso-hd.gif); no-repeat; border-bottom: 1px solid #6593CF;"');
		$objDataGrid->setCellStyle('style="text-align: left; font-family: tahoma; font-size: 10px; color:#000; border:0; margin:0; padding:3px; border-bottom: 1px solid #DDECFE; border-left: 1px solid #F1EFE2"');
		$objDataGrid->setStyleEven('style="background: #F5F5F5; border:0; margin:0; padding:0;"');
		$objDataGrid->setStyleOdd('style="background: #fff; border:0; margin:0; padding:0;"');
		$objDataGrid->setNavRowStyle('style="font-family: tahoma; font-size: 10px; height: 20px; border:0; margin:0; padding:0px; font-weight:bold; color:#000; background-image:url(images/mso-hd.gif); no-repeat; border-top: 1px solid #6593CF;"');

		$objDataGrid->setLimit($intLimit);
		$objDataGrid->setOffset($intStart);
		$objDataGrid->setOrderCol($strOrderCol);
		$objDataGrid->setSortDir($strSortDir);

		$cols = array();
		$cols['ot']	= "OT";
		$cols['fnextel']= "Folio Nextel";
		$cols['esn']	= "Esn";
		$cols['imei']	= "Imei";
		$cols['modelo']	= "Modelo";
		
		$objDataGrid->setDBColumns( array_keys($cols) );
		$objDataGrid->setColumnHeaders( array_values($cols) );

		$query = 'SELECT
				' . join(', ',array_keys($cols)) . '
				FROM
					equiposrep';

		if ($strWhere != NULL)
		{
			$query .= ' WHERE ' . $strWhere;
		}

		if ($strOrderCol != NULL)
		{
			$query .= ' ORDER BY ' . $strOrderCol . ' ' . $strSortDir;
		}

		$query .= '	LIMIT ' . $intStart . ',' . $intLimit;

		if ($commonDB->query($query))
		{
			while($row = $commonDB->fetchRow())
			{
				$objDataGrid->addRow($row);
			}

			$objDataGrid->setTotalRows(getNumRows());

			$objResponse->assign('dataGrid', "innerHTML", $objDataGrid->renderDataGrid());
		}
		else
		{
			$objResponse->assign('dataGrid', "innerHTML", "No results found.");
		}

		return $objResponse;

	}

	$xajax->processRequest();
?>
