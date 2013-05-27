<?PHP
/**
*
*	XAJAX Datagrid
*	@author Timothy Lorens (icebrkr@cyberdyne.org) 02/01/2007
*	@version	$Author: icebrkr $ $Revision: 84 $ $Date: 2007-04-04 13:17:56 -0400 (Wed, 04 Apr 2007) $
*	@package Core
*
*/

class clsDataGrid
{

	/**
	*	@access private
	*	@var Resource Database connection rsource
	*/
	private $_resDB;

	/**
    *	@access private
    *	@var Integer SQL WHERE clause
    */
	private $_strWhere;

	/**
    *	@access private
    *	@var Integer SQL LIMIT offset
    */
	private $_intOffset;

	/**
    *	@access private
    *	@var Integer SQL LIMIT clause
    */
	private $_intLimit;

	/**
    *	@access private
    *	@var String SQL ORDER BY column name
    */
	private $_strOrderCol;

	/**
    *	@access private
    *	@var String SQL ORDER BY sort direction ASC or DESC
    */
	private $_strSortDir;

	/**
    *	@access private
    *	@var Array Header associated column names.
    */
	private $_aryDBColumns;

	/**
    *	@access private
    *	@var Integer Total number of rows returned from query.
    */
	private $_intTotalRows;

	/**
    *	@access private
    *	@var String	HTML valid table NAME property
    */
	private $_strTableName;

	/**
    *	@access private
    *	@var String	HTML valid table ID property
    */
	private $_strTableID;

	/**
    *	@access private
    *	@var String Table/Datagrid Style (table.css)
    */
	private $_strTableStyle;

	/**
    *	@access private
    *	@var String HTML Footer
    */
	private $_strFooter;

	/**
    *	@access private
    *	@var Array Datagrid column headers
    */
	private $_aryColumnHeaders;

	/**
    *	@access private
    *	@var Array HTML string used for setting javascript events; onClick, OnFocus, OnBlur Any valid HTML parameter for a <td> tag.
    */
	private $_aryHeaderEvents;

	/**
    *	@access private
    *	@var String HTML string used for setting style='' or width='' of the header row Any valid HTML parameter for a <td> tag.
    */
	private $_strHeaderStyle;

	/**
    *	HTML string used for setting style='' or width='' of the header row.
    *	Any valid HTML parameter for a <td> tag.
    *	@access private
    *	@var String
    */
	private $_strHeaderRowStyle;

	/**
    *	@access private
    *	@var String HTML string used for setting style='' or width='' of the header row. Any valid HTML parameter for a <td> tag.
    */
	private $_strNavRowStyle;

	/**
    *	HTML string used for setting style='' or width='' for each column containing data
    *	Any valid HTML parameter for a <td> tag.
    *	@access private
    *	@var Array
    */
	private $_aryColumnStyles;

	/**
    *	HTML string used for setting style='' or width='' for all the rows containing data
    *	Any valid HTML parameter for a <td> tag.
    *	@access private
    *	@var Array
    */
	private $_strRowStyle;

	/**
    *	HTML string used for setting style='' or width='' for every cell
    *	Any valid HTML parameter for a <td> tag.
    *	@access private
    *	@var Array
    */
	private $_strCellStyle;

	/**
    *	@access private
    *	@var String CSS
    */
	private $_strStyleEven;

	/**
    *	@access private
    *	@var String CSS
    */
	private $_strCellOdd;

	/**
    *	Max number of grid columns
    *	@access private
    *	@var Integer
    */
	private $_intNumColumns;


	/**
    *	Datagrid HTML rows.
    *	@access private
    *	@var Array
    */
	private $_aryRows;


	/*************************************
	*
	*	MAGIC FUNCTIONS
	*
	*************************************/

	/**
    *	DataGrid Class Constructor
    *	@access Public
    *
    */
	public function __construct()
	{
		$this->_resDB			= NULL;
		$this->_strTableName	= NULL;
		$this->_strTableID		= NULL;
		$this->_strTableStyle	= NULL;
		$this->_strFooter		= NULL;
		$this->_aryColumnHeaders = array();
		$this->_aryHeaderEvents	= NULL;
		$this->_strHeaderStyle	= NULL;
		$this->_aryColumnStyles = array();
		$this->_strRowStyle		= NULL;
		$this->_aryDBColumns	= array();
		$this->_intNumColumns	= NULL;
		$this->_intTotalRows 	= NULL;
		$this->_aryRows			= array();
		$this->_strWhere		= NULL;
		$this->_intOffset		= 0;
		$this->_intLimit		= 25;
		$this->_strOrderBy		= NULL;

	} // END __construct


	/**
    *	DataGrid Class Deconstructor
    *	@access Public
    *
    */
	public function __destruct()
	{
		unset($this->_resDB);
		unset($this->_strTableName);
		unset($this->_strTableID);
		unset($this->_strTableStyle);
		unset($this->_strFooter);
		unset($this->_aryColumnHeaders);
		unset($this->_aryHeaderEvents);
		unset($this->_strHeaderStyle);
		unset($this->_aryColumnStyles);
		unset($this->_strRowStyle);
		unset($this->_aryDBColumns);
		unset($this->_intNumColumns);
		unset($this->_intTotalRows);
		unset($this->_aryRows);
		unset($this->_strWhere);
		unset($this->_intOffset);
		unset($this->_intLimit);
		unset($this->_strOrderBy);

	} // END __destruct


	/*************************************
	*
	*	SETTERS
	*
	*************************************/

	/**
    *	setDBHandle
    *
    *	@access Public
    *	@param Resource MySQL DB Handle
    *
    */
	public function setDBHandle($resDB)
	{
		$this->_resDB = $resDB;

	} // END setDBHandle


	/**
    *	setWhere
    *
    *	@access Public
    *	@param Integer Number of rows to display
    */
	public function setWhere($strWhere)
	{
		$this->_strWhere = (string)$strWhere;
	} // END setWhere


	/**
    *	setLimit
    *
    *	@access Public
    *	@param Integer Number of rows to display
    */
	public function setLimit($intLimit)
	{
		$this->_intLimit = (int)$intLimit;
	} // END setLimit


	/**
    *	setOffset
    *
    *	@access Public
    *	@param Integer DB starting row/offset
    */
	public function setOffset($intOffset)
	{
		$this->_intOffset = (int)$intOffset;
	} // END setOffset


	/**
    *	setOrderCol
    *
    *	@access Public
    *	@param Integer DB starting row/offset
    */
	public function setOrderCol($strCol)
	{
		$this->_strOrderCol = (string)trim($strCol);
	} // END setOrderCol


	/**
    *	setSortDir
    *
    *	@access Public
    *	@param Integer DB starting row/offset
    */
	public function setSortDir($strOrder)
	{
		if ($strOrder == "ASC" || $strOrder=="DESC")
		{
			$this->_strSortDir = (string)trim($strOrder);
		}
		else
		{
			$this->_strSortDir = "ASC";
		}
	} // END setSortDir


	/**
    *	setDBColumns
    *
    *	@access Public
    *	@param Array Database columns to associate with table headers
    *
    */
	public function setDBColumns($aryDBCols)
	{
		while (list($key,$val) = each ($aryDBCols))
		{
			$this->_aryDBColumns[] = $val;
		}
	} // END setDBColumns


	/**
    *	setTableName
    *
    *	@access Public
    *	@param String HTML Table NAME property
    */
	public function setTableName($strName)
	{
		$this->_strTableName = trim($strName);
	} // END setTableName


	/**
    *	setTableID
    *
    *	@access Public
    *	@param String HTML Table ID property
    *
    */
	public function setTableID($strID)
	{
		$this->_strTableID = ' ' . trim($strID) . ' ';
	} // END setTableID


	/**
    *	setColumnHeaders
    *
    *	@access Public
    *	@param String CSS Class Name
    *
    */
	public function setColumnHeaders($aryColHdrs)
	{
		while (list($key,$val) = each ($aryColHdrs))
		{
			$this->_aryColumnHeaders[] = $val;
		}
	} // END setColumnHeaders


	/**
    *	setColumnHeader
    *
    *	@access Public
    *	@param String CSS Class Name
    *
    */
	public function setColumnHeader($intIndex,$strHeader)
	{
		$this->_aryColumnHeaders[$intIndex] = trim($strHeader);
	} // END setColumnHeader


	/**
    *	setHeaderEvents
    *
    *	@access Public
    *	@param String CSS Class Name
    *
    */
	public function setHeaderEvents($aryHdrEvnts)
	{
		while (list($key,$val) = each ($aryHdrEvnts))
		{
			$this->_aryHeaderEvents[] = $val;
		}
	} // END setHeaderEvents


	/**
    *	setHeaderEvent
    *
    *	@access Public
    *	@param String CSS Class Name
    *
    */
	public function setHeaderEvent($intIndex,$strEvent)
	{
		$this->_aryHeaderEvents[$intIndex] = $strEvent;
	} // END setHeaderEvent


	/**
    *	setTableStyle
    *
    *	@access Public
    *	@param String CSS Class Name
    *
    */
	public function setTableStyle($strTableStyle)
	{
		$strTableStyle = ' ' . trim($strTableStyle) . ' ';
		$this->_strTableStyle = (string)$strTableStyle;

	} // END setTableStyle


	/**
    *	setHeaderStyle
    *
    *	@access Public
    *	@param String CSS Class Name
    *
    */
	public function setHeaderStyle($strHeaderStyle)
	{
		$strHeaderStyle = ' ' . trim($strHeaderStyle) . ' ';
		$this->_strHeaderStyle = (string)$strHeaderStyle;

	} // END setHeaderStyle


	/**
    *	setHeaderStyle
    *
    *	@access Public
    *	@param String CSS Class Name
    *
    */
	public function setHeaderRowStyle($strHeaderRowStyle)
	{
		$strHeaderRowStyle = ' ' . trim($strHeaderRowStyle) . ' ';
		$this->_strHeaderRowStyle = (string)$strHeaderRowStyle;

	} // END setHeaderStyle


	/**
    *	setCellStyle
    *
    *	@access Public
    *	@param String CSS Class Name
    *
    */
	public function setCellStyle($strCellStyle)
	{
		$this->_strCellStyle = ' ' . trim($strCellStyle);
	} // END setCellStyle



	/**
    *	setNavRowStyle
    *
    *	@access Public
    *	@param String CSS Class Name
    *
    */
	public function setNavRowStyle($strStyle)
	{
		$this->_strNavRowStyle = ' ' . trim($strStyle);
	} // END setNavRowStyle



	/**
    *	setNumColumns
    *
    *	@access Public
    *	@param Integer $intNumCols Number of columns to display
    *
    */
	public function setNumColumns($intNumCols)
	{
		$this->_intNumColumns = (int)$intNumCols;

	} // END setNumColumns


	/**
    *	setNumRows
    *
    *	@access Public
    *	@param Integer $intNumCols Number of rows to display
    *
    */
	public function setNumRows($intNumRows)
	{
		$this->_intNumRows = (int)$intNumRows;

	} // END setNumRows


	/**
    *	setTotalRows
    *
    *	@access Public
    *	@param Integer $intNumCols Total number of rows returned from SQL
    *
    */
	public function setTotalRows($intTotalRows)
	{
		$this->_intTotalRows = (int)$intTotalRows;

	} // END setTotalRows


	/**
    *	setRowStyle
    *
    *	@access Public
    *	@param String CSS
    *
    */
	public function setRowStyle($strStyle)
	{
		$this->_strRowStyle = ' ' . trim($strStyle);
	} // END setRowStyle


	/**
    *	setStyleEven
    *
    *	@access Public
    *	@param String CSS
    *
    */
	public function setStyleEven($strStyle)
	{
		$this->_strStyleEven = ' ' . trim($strStyle);
	} // END setStyleEven


	/**
    *	setStyleOdd
    *
    *	@access Public
    *	@param String CSS
    *
    */
	public function setStyleOdd($strStyle)
	{
		$this->_strStyleOdd = ' ' . trim($strStyle);
	} // END setStyleOdd




	/*************************************
	*
	*	GETTERS
	*
	*************************************/

	/**
    *	getTableStyle
    *
    *	@access Public
    *	@param String CSS Class Name
    *
    */
	public function getTableStyle()
	{
		return (string)$this->_strTableStyle;

	} // END setTableStyle


	/**
    *	getTableName
    *
    *	@access Public
    *	@param String Table's NAME property
    *
    */
	public function getTableName()
	{
		return (string)$this->_strTableName;

	} // END setTableName


	/**
    *	getTableID
    *
    *	@access Public
    *	@param String Table's ID property
    *
    */
	public function getTableID()
	{
		return (string)$this->_strTableID;

	} // END setTableID


	/**
    *	getHeaderStyle
    *
    *	@access Public
    *	@param String CSS Class Name
    *
    */
	public function getHeaderStyle()
	{
		return (string)$this->_strHeaderStyle;

	} // END getHeaderStyle


	/**
    *	getHeaderRowStyle
    *
    *	@access Public
    *	@param String CSS Class Name
    *
    */
	public function getHeaderRowStyle()
	{
		return (string)$this->_strHeaderRowStyle;

	} // END getHeaderRowStyle


	/**
    *	getRowStyle
    *
    *	@access Public
    *	@param String CSS Class Name
    *
    */
	public function getRowStyle()
	{
		return (string)$this->_strRowStyle;

	} // END getRowStyle


	/**
    *	getCellStyle
    *
    *	@access Public
    *	@param String CSS Class Name
    *
    */
	public function getCellStyle()
	{
		return (string)trim($this->_strCellStyle);

	} // END getCellStyle


	/**
    *	getRowStyle
    *
    *	@access Public
    *	@param String CSS
    *
    */
	public function getStyleEven()
	{
		return (string)$this->_strStyleEven;

	} // END getStyleEven


	/**
    *	getStyleOdd
    *
    *	@access Public
    *	@param String CSS
    *
    */
	public function getStyleOdd()
	{
		return (string)$this->_strStyleOdd;

	} // END getStyleOdd


	/**
    *	getHeaderEvent
    *
    *	@access Public
    *	@return String
    *
    */
	public function getHeaderEvent($intIndex)
	{
		if (isset($this->_aryHeaderEvents[$intIndex]))
		{
			$strEvent = ' ' . trim($this->_aryHeaderEvents[$intIndex]) . ' ';
		}
		else
		{
			$strEvent = "";
		}
		return (string)$strEvent;
	} // END getHeaderEvent




	/*************************************
	*
	*	PUBLIC METHODS
	*
	*************************************/

	/**
	*	Add row to the datagrid.
    *	@access Public
    *
    */
	public function addRow($aryCols)
	{
		$aryHTML = array();
		$intIndex = 0;
		$intRow = count($this->_aryRows);

		if ($this->_strStyleEven != NULL && $this->_strStyleOdd != NULL)
		{
			if ($intRow & 1)
			{
				$rowStyle = $this->_strStyleEven;
			}
			else
			{
				$rowStyle = $this->_strStyleOdd;
			}
		}
		else
		{
			if ($this->_strRowStyle != NULL)
			{
				$rowStyle = $this->getRowStyle();
			}
		}

		$trID = ' id="row_' . $intRow . '"';
		$aryHTML[] = '<tr' . $trID . $rowStyle . '>';
		while (list($key,$val) = each ($aryCols))
		{
			$tdID = ' id="cell_'. $intRow . '_' . $intIndex .'"';
			$aryHTML[] = '<td' . $tdID . $this->_strCellStyle . '>' . $val . '</td>';
			$intIndex++;
		}
		$aryHTML[] = '</tr>';

		$this->_aryRows[] = join('',$aryHTML);

	} // END addRow


	/**
	*	Returns entire HTML formatted datagrid
    *	@access Public
    *	@return String HTML
    */
	public function renderDataGrid()
	{
		$aryHTML = array();

		if ($this->_strTableName != NULL)
		{
			$tblName = ' name="' . $this->getTableName() . '"';
		}

		if ($this->_strTableID != NULL)
		{
			$tblID = ' id="' . $this->getTableID() . '"';
		}

		$aryHTML[] = '<table' . $this->getTableStyle() . $tblID . '>';

		$aryHTML[] = $this->_renderColumnHeaders();
		$aryHTML[] = $this->_renderRows();
		$aryHTML[] = $this->_renderNavigation();

		$aryHTML[] = '</table>';

		return join('',$aryHTML);
	}



	/*************************************
	*
	*	PRIVATE METHODS
	*
	*************************************/

	/**
	*	Returns entire HTML formatted column headers
    *	@access Public
    *	@return String HTML
    */
	private function _renderColumnHeaders()
	{
		$aryHTML = array();
		$intIndex = 0;

		$aryHTML[] = '<tr' . $this->getHeaderRowStyle() . '>';

		while (list($key,$val) = each ($this->_aryColumnHeaders))
		{
			if ($this->getHeaderEvent($intIndex) != "")
			{
				$strHeaderEvent = $this->getHeaderEvent($intIndex);
			}

			$sorter = ' <img alt="Sort Asc" src="/images/sortup.gif" title="Ascending" style="cursor: pointer;" onClick="xajax_showDataGrid(0,' . $this->_intLimit .  ',\'' . $this->_aryDBColumns[$intIndex] . '\',\'ASC\',\''  . addslashes($this->_strWhere) . '\'); return false;" /><img alt="Sort Desc" src="/images/sortdown.gif" title="Descending" style="cursor: pointer;" onClick="xajax_showDataGrid(0,' . $this->_intLimit .  ',\'' . $this->_aryDBColumns[$intIndex] . '\',\'DESC\',\''  . addslashes($this->_strWhere) . '\'); return false;" />';
			//$grabber = '<td><img src="/images/grid-blue-split.gif" /></td>';

			$tdID = ' id="hdr_'. $intIndex .'"';
			$aryHTML[] = '<td ' . $tdID . $strHeaderEvent . $this->getHeaderStyle()  . '>' . $val . $sorter . '</td>';
			$intIndex++;
		}
		$aryHTML[] = '</tr>';

		return join('',$aryHTML);

	} // END _renderColumnHeaders


	/**
	*	Returns entire HTML formatted rows
    *	@access Public
    *	@return String HTML
    */
	private function _renderRows()
	{
		for($cnt = 0; $cnt < $this->_intLimit; $cnt++)
		{
			$aryHTML[] = $this->_aryRows[$cnt];
		}

		return join('',$aryHTML);

	} // END _renderRow


	/**
	*
	*	Not sure how this will work
	*/
	private function _renderNavigation()
	{
		$next = $this->_intOffset + $this->_intLimit;

		if ($next > $this->_intTotalRows)
		{
			$next = $this->_intTotalRows;
		}

		$prev = $this->_intOffset - $this->_intLimit;
		$end = $this->_intTotalRows - $this->_intLimit;

		$aryHTML[] = '<tr><td align="center" colspan="' . count($this->_aryColumnHeaders) . '">';
		$aryHTML[] = '<table cellpadding=0 cellspacing="0" style="border:0px; padding:0px; margin:0px; width:100%;"><tr' . $this->_strNavRowStyle  . '><td align="left" width="33%"  style="padding-left: 5px;">Rows: ' . ($this->_intOffset+1) . ' to ' . $next . ' of ' . $this->_intTotalRows .'</td><td align="center" width="33%">';


		// Jump to begining button
		if ($this->_intOffset > 0)
		{
			$aryHTML[] = '<a href="#" onClick="xajax_showDataGrid(0,' . $this->_intLimit .  ',\'' . $this->_strOrderCol . '\',\'' . $this->_strSortDir . '\',\'' . addslashes($this->_strWhere) . '\'); return false;"><img alt="Home" Title="First Record" border="0" src="/images/arrow_home.gif" /></a>';
		}
		else
		{
			$aryHTML[] = '<img alt="Home" Title="First Record" src="/images/arrow_home_disabled.gif" />';
		}

		// Previous page button
		if ($this->_intOffset > 0)
		{
			$aryHTML[] = '<a href="#" onClick="xajax_showDataGrid(' . $prev . ',' . $this->_intLimit .  ',\'' . $this->_strOrderCol . '\',\'' . $this->_strSortDir . '\',\'' . addslashes($this->_strWhere) . '\'); return false;"><img alt="Right" Title="Next Page" border="0" src="/images/arrow_left.gif" /></a>';
		}
		else
		{
			$aryHTML[] = '<img alt="Left" Title="Previous Page" src="/images/arrow_left_disabled.gif" />';
		}


		// Next page button
		if ($next < $this->_intTotalRows)
		{
			$aryHTML[] = '<a href="#" onClick="xajax_showDataGrid(' . $next . ',' . $this->_intLimit . ',\'' . $this->_strOrderCol . '\',\'' . $this->_strSortDir . '\',\'' . addslashes($this->_strWhere) . '\'); return false;"><img alt="Right" Title="Next Page" border="0" src="/images/arrow_right.gif" /></a>';
		}
		else
		{

			$aryHTML[] = '<img alt="Right" Title="Next Page" src="/images/arrow_right_disabled.gif" />';
		}

		//  Jump to End button
		if ($next < $this->_intTotalRows)
		{
			$aryHTML[] = '<a href="#" onClick="xajax_showDataGrid(' . $end . ',' . $this->_intLimit .  ',\'' . $this->_strOrderCol . '\',\'' . $this->_strSortDir . '\',\'' . addslashes($this->_strWhere) . '\'); return false;"><img alt="End" title="Last Record" border="0" src="/images/arrow_end.gif" /></a>';
		}
		else
		{
			$aryHTML[] = '<img alt="End" title="Last Record" src="/images/arrow_end_disabled.gif" />';
		}

		$aryHTML[] = '</td><td align="right" width="33%" style="padding-right: 5px; ">Page ' . ceil($next / $this->_intLimit) . ' of ' . ceil($this->_intTotalRows / $this->_intLimit) . '</td></tr></table></td></tr>';

		return join('',$aryHTML);
	}

} // END clsDataGrid
?>
