<?

/** \brief Class to generate a table dynamically
 *
 * The ScrollTable class generate dynamically a table
 *
 * @package XajaxGrid
 */

class ScrollTable{
	/**
	 * <i>integer</i> Number of columns for the table.
	 */
		var $n_cols; //


	/**
	 * <i>string</i> Row of table to display the search form.
	 */
	var $search;


	/**
	 * <i>string</i> Content of the table top
	 */
	var $top; //


	/**
	 * <i>string</i> Content of the table headers
	 */
		var $header; //


	/**
	 * <i>string</i> Content of each table row
	 */
	var $rows;


	/**
	 * <i>string</i> Content of table footer
	 */
		var $footer; //


	/**
	 * <i>string</i> Style for table row
	 */
	var $rowStyle;


	/**
	 * <i>string</i> Attributes for each table column
	 */
	var $colAttrib;


	/**
	 * <i>integer</i> It contains the limit of records to show in the SQL sentence executed
	 */
	var $limit;


	/**
	 * <i>integer</i> It contains the initial record to show in the SQL sentence executed
	 */
	var $start;


	/**
	 * <i>string</i> It contains the filter of the SQL sentence executed
	 */
	var $filter;


	/**
	 * <i>integer</i> It contains the total number of rows to show
	 */
	var $numRowsToShow;


	/**
	 * <i>integer</i> It contains the total number of rows of the SQL sentence executed
	 */
	var $numRows;


	/**
	 * <i>string</i> It is the content to search in a SQL sentence
	 */
	var $content;


	/**
	 * <i>string</i> It is the field to organize the data of the table
	 */
	var $order;


	/**
	 * Constructor.
	 *
	 * @param integer $cols: Amount of columns of the table
	 * @param integer $start: initial record to show
	 * @param integer $limit: final record to show
	 * @param string  $filter: field name of the database table.
	 * @param integer $numRows: number of total rows of the search
	 * @param string  $content: content to search
	 * @param string  $order: field to organize the data of the table
	 */
	function ScrollTable($cols, $start = 0, $limit, $filter = null, $numRows = 0, $content = null, $order = null){
		$this->n_cols = $cols;
		$this->limit = $limit;
		$this->numRows = $numRows;
		$this->numRowsToShow = ROWSXPAGE;
		$this->start = $start;
		$this->top = '<table class="adminlist" border="1">';
		$this->rowStyle = "row1";
		$this->filter = $filter;
		$this->content = $content;
		$this->order = $order;


		$this->setFooter();
	}


	/**
	* Set a header Table with attributes on the variable "header" of the class.
	*
	* @param string 	$class		the clas style
	* @param array  	$options		array that contain the labels for the headers.
	* @param array 	$attribs		array that contain the attributes for the headers.
	* @param array		$events		array that contain the events on this labels.
	* @param boolean	$edit			Flag to determine if column Edit is showed.
	* @param boolean	$delete		Flag to determine if column Delete is showed.
	* @return none
	*
	*/

	function setHeader($class,$headers,$attribs,$events,$edit=true,$delete=true){


		$ind = 0;
		$this->header = '<tr>';
		foreach($headers as $value)
		{
			$this->header .= '
			<th '.$attribs[$ind].' class="'.$class.'">';
// 				if(!empty($events[$ind])){
// 					$this->header .= '<a href="?" '.$events[$ind].'>'.$value.'</a>';
// 				}else{
// 					$this->header .= $value;
// 				}
			$this->header .= $value;

			if ($value!="")
			{
				$this->header .= '
					<img src="/images/sortup.gif" title="Ascending" style="cursor: pointer;" '.str_replace("ORDERING","ASC",$events[$ind]).'>
					<img src="/images/sortdown.gif" title="Descending" style="cursor: pointer;" '.str_replace("ORDERING","DESC",$events[$ind]).'>
				</th>';
			}

			$ind++;
		}

		if($edit)
			$this->header .= '
				<th style="text-align: center" class="'.$class.'" width="5%">
					Edit
				</th>';

		if($delete)
			$this->header .= '
				<th style="text-align: center" class="'.$class.'" width="5%">
					Delete
				</th>';

		$this->header .= '
			</tr>';
	}

	/**
	* Set the attributes for the table columns.
	*
	* @param array 	$attribsCols		array that contain the attributes for the headers.
	* @return none
	*
	*/

	function setAttribsCols($attribsCols){
		$this->colAttrib = $attribsCols;
	}

	/**
	* Add each row generates dynamically from database records obtained
	*
	* @param string 	$table		Table name of data base
	* @param array 	$arr			Array with the data extracted in the SQL Sentence
	* @param boolen	$edit			Flag to determine if column Edit is showed.
	* @param boolen	$delete		Flag to determine if column Delete is showed.
	* @param string	$divName		Name div to display the grid.
	* @param array		$fields		Array with all field's name.
	* @return none
	*
	*/

	function addRow($table,$arr,$edit=true,$delete=true,$divName="grid",$fields=null){

		$nameRow = $divName."Row".$arr[0];
	   $row = '<tr id="'.$nameRow.'" class="'.$this->rowStyle.'" >'."\n";
		$ind = 0;

		foreach ($arr as $key => $value) {
			$nameCell = $nameRow."Col".$ind;
			if ($key != 'id')
		   	{
		   		if ($edit)
		   		{
					$row .= '<td id="'.$nameCell.'" style="cursor: pointer;" '.$this->colAttrib[$ind-1].' onDblClick="xajax_editField(\''.$table.'\',\''.$fields[$ind-1].'\',\''.$nameCell.'\',\''.$value.'\',\''.$arr[0].'\');return false">'.$value.'</td>'."\n";
				}
				else
				{
					$row .= '<td id="'.$nameCell.'" '.$this->colAttrib[$ind-1].'>'.$value.'</td>'."\n";
				}
			}
   			$ind++;
		}

		if($edit)
			$row .= '
					<td align="center" width="5%">
						<a href="?" onClick="xajax_edit('.$arr[0].',\''.$table.'\');return false;"><img src="images/edit.png" border="0"></a>
					</td>';
		if($delete)
			$row .= '
					<td align="center" width="5%">
						<a href="?" onClick="if (confirm(\'Esta seguro de eliminar este registro?\'))  xajax_delete(\''.$arr[0].'\',\''.$table.'\',\''.$divName.'\');return false;"><img src="images/trash.png" border="0"></a>
					</td>';

		$row .= "</tr>\n";
		$this->rows .= $row;

		if($this->rowStyle == "row0") $this->rowStyle = "row1"; else $this->rowStyle = "row0";

	}


	/**
	* Add each row generates dynamically from database records obtained without Edit and Delete columns
	*
	* @param string 	$table		Table name of data base
	* @param array 	$arr			Array with the data extracted in the SQL Sentence
	* @return none
	*
	*/

	function addRow2($table,$arr){

	   $row = '<tr class="'.$this->rowStyle.'" >';
		$ind = 0;

	   foreach ($arr as $key => $value) {
	   	if($key != 'id')
   			$row .= '<td '.$this->colAttrib[$ind-1].'>'.$value.'</td>';
   		$ind++;
		}

		$row .= "</tr>";
		$this->rows .= $row;

		if($this->rowStyle == "row0") $this->rowStyle = "row1"; else $this->rowStyle = "row0";

	}


	/**
	* Add the line with the search form and the button to add a new record
	*
	* @param string 	$table		Table name of data base
	* @param array 	$fieldsFromSearch 	Its contains the values from "SELECT" search form.
	* @param array		$fieldsFromSearchShowAs	 Its contains the labels show in the "SELECT" search form.
	* @param boolen	$withNewButton	If = 0, then not print the "New Record" button.
	* @return none
	*
	*/

	function addRowSearch($table,$fieldsFromSearch,$fieldsFromSearchShowAs, $withNewButton = 1){
		$ind = 0;
		$this->search = '
			<table width="99%" border="0">
			<tr>
				<td align="left" width="10%">';
				if($withNewButton){
					$this->search .= '<button id="submitButton" onClick="xajax_add(\''.$table.'\');return false;">Add Record</button>';
				}
		$this->search .= '
				</td>
				<td>&nbsp;</td>
				<td align="right" width="30%" nowrap>
				Search : &nbsp;<input type="text" size="30" id="searchContent" name="searchContent">
				&nbsp;&nbsp;By &nbsp;
					<select id="searchField" name="searchField">
						<option value="'.null.'"> - Select field - </option>';
					foreach ($fieldsFromSearchShowAs as $value) {
						$this->search .= '<option value="'.$fieldsFromSearch[$ind].'">'.$value.'</option>';
						$ind++;
					}
		$this->search .= '
					</select>
				&nbsp;&nbsp;<button id="submitButton" onClick="xajax_showGrid(0,'.$this->numRowsToShow.',document.getElementById(\'searchField\').value,document.getElementById(\'searchContent\').value,document.getElementById(\'searchField\').value);return false;">Search</button>
				</td>

			</tr>
		</table>';
	}


	/**
	* Add the footer of the table (Grid), that its contains the record information such as number of records, previos, next and final,  totals records, etc. Each one with its link when it is posible.
	*
	*/
	function setFooterold()
	{
		$next_rows = $this->start + $this->limit;
		$previos_rows = $this->start - $this->limit;

		if ($next_rows>$this->numRows)
		{
			$next_rows = $this->numRows;
		}

		if ($previos_rows<0)
		{
			$previos_rows = 0;
		}

		if ($this->numRows < 1)
		{
			$this->start = -1;
		}

		$this->footer = '</table>';

		$this->footer .= '
		<table class="adminlist">
			<tr>
				<th colspan="'.$this->n_cols.'">
					<span class="pagenav">';

					$this->footer .= ' [ ' . ($this->start+1) . ' to ' . $next_rows .' of '. $this->numRows .' ] ';

					if ($this->start>0)
					{
						$this->footer .= '<a href="?" onClick=\'xajax_showGrid(0,'.$this->limit.',"'.$this->filter.'","'.$this->content.'","'.$this->order.'");return false;\'><< First</a>';
					}
					else
					{
						$this->footer .= '<< First';
					}

					$this->footer .= '</span><span class="pagenav">';

					if ($this->start >0)
					{
						$this->footer .= '
						<a href="?" onClick=\'xajax_showGrid('.$previos_rows.','.$this->limit.',"'.$this->filter.'","'.$this->content.'","'.$this->order.'");return false;\'>< Previous</a>';
					}
					else
					{
						$this->footer .= '< Previous';
					}

					$this->footer .= '</span><span class="pagenav">';

					$this->footer .= " :: ";

					$this->footer .= '</span><span class="pagenav">';

					if ($next_rows < $this->numRows)
					{
						$this->footer .= '<a href="?" onClick=\'xajax_showGrid('.$next_rows.','.$this->limit.',"'.$this->filter.'","'.$this->content.'","'.$this->order.'");return false;\'>Next ></a>';
					}
					else
					{
						$this->footer .= 'Next >';
					}

					$this->footer .= '</span><span class="pagenav">';

					if ($next_rows < $this->numRows)
					{
						$this->footer .= '<a href="?" onClick=\'xajax_showGrid('.($this->numRows - $this->limit).','.$this->limit.',"'.$this->filter.'","'.$this->content.'","'.$this->order.'");return false;\'>Last >></a>';
					}
					else
					{
						$this->footer .= 'Last >></span>';
					}
				$this->footer .= '		</th>
									</tr>
								</table>';

		/*
		$this->footer .= $this->search = '

			<table width="99%" border="0">

			<tr>
				<td width="25%" align="left">&nbsp;</td>
				<td width="50%" align="center"><div id="msgZone">&nbsp;</div></td>
				<td width="25%" align="right">
					<!-- <button id="submitButton" onClick="xajax_showGrid(0,'.MAXROWSXPAGE.');return false;">Show All</button> -->
				</td>
			</tr>
		</table>'; */

	}


	function setFooter()
	{
		$next_rows = $this->start + $this->limit;
		$previos_rows = $this->start - $this->limit;

		if ($next_rows>$this->numRows)
		{
			$next_rows = $this->numRows;
		}

		if ($previos_rows<0)
		{
			$previos_rows = 0;
		}

		if ($this->numRows < 1)
		{
			$this->start = -1;
		}

		$this->footer = '</table>';

		$this->footer .= '
		<table class="adminlist">
			<tr>
				<th colspan="'.$this->n_cols.'">
					<span class="pagenav">';

					$this->footer .= 'Page: '.round($next_rows / $this->limit).' of '.round($this->numRows / $this->limit).' ( ' . ($this->start+1) . ' through ' . $next_rows .' ) ';

					if ($this->start>0)
					{
						$this->footer .= '<a href="?" onClick=\'xajax_showGrid(0,'.$this->limit.',"'.$this->filter.'","'.$this->content.'","'.$this->order.'");return false;\'><img alt="Home" Title="First Record" border="0" src="/images/arrow_home.gif" /></a>';
					}
					else
					{
						$this->footer .= '<img alt="Home" Title="First Record" src="/images/arrow_home_disabled.gif" />';
					}

					$this->footer .= '</span><span class="pagenav">';

					if ($this->start >0)
					{
						$this->footer .= '
						<a style="" href="?" onClick=\'xajax_showGrid('.$previos_rows.','.$this->limit.',"'.$this->filter.'","'.$this->content.'","'.$this->order.'");return false;\'><img alt="Right" Title="Next Page" border="0" src="/images/arrow_left.gif" /></a>';
					}
					else
					{
						$this->footer .= '<img alt="Left" Title="Previous Page" src="/images/arrow_left_disabled.gif" />';
					}

					$this->footer .= '</span><span class="pagenav">';

					$this->footer .= '</span><span class="pagenav">';

					if ($next_rows < $this->numRows)
					{
						$this->footer .= '<a style="" href="?" onClick=\'xajax_showGrid('.$next_rows.','.$this->limit.',"'.$this->filter.'","'.$this->content.'","'.$this->order.'");return false;\'><img alt="Right" Title="Next Page" border="0" src="/images/arrow_right.gif" /></a>';
					}
					else
					{
						$this->footer .= '<img alt="Right" Title="Next Page" src="/images/arrow_right_disabled.gif" />';
					}

					$this->footer .= '</span><span class="pagenav">';

					if ($next_rows < $this->numRows)
					{
						$this->footer .= '<a href="?" onClick=\'xajax_showGrid('.($this->numRows - $this->limit).','.$this->limit.',"'.$this->filter.'","'.$this->content.'","'.$this->order.'");return false;\'><img alt="End" title="Last Record" border="0" src="/images/arrow_end.gif" /></a>';
					}
					else
					{
						$this->footer .= '<img alt="End" title="Last Record" src="/images/arrow_end_disabled.gif" /></span>';
					}



				$this->footer .= ' ( Total: '. $this->numRows .' )
				</th>
			</tr>
		</table>';
		/*
		$this->footer .= $this->search = '
			<table width="99%" border="0">
			<tr>
				<td width="25%" align="left">&nbsp;</td>
				<td width="50%" align="center"><div id="msgZone">&nbsp;</div></td>
				<td width="25%" align="right">
					<!-- <button id="submitButton" onClick="xajax_showGrid(0,'.MAXROWSXPAGE.');return false;">Show All</button> -->
				</td>
			</tr>
		</table>';*/

	}



	/**
	* It combines the variables $this->search . $this->top . $this->header . $this->rows . $this->footer to create the table with the data.
	*
	*/

	function render(){
		$table = $this->search . $this->top . $this->header . $this->rows . $this->footer;

		return $table;
	}

}

/**
 * Class Table for general intentions
 *
 * @package XajaxGrid
 */
class Table {

	/**
	* Headers of table
	* @param string 	$tableTitle		Title of table
	* @return string
	*/
	function Top($tableTitle = "tableTitle"){
		$table = '
			<table width="98%" border="1" align="center" class="adminlist">
			<tr>
				<th align="right" valign="center">
					<img src="images/close.png" onClick=\'javascript:document.getElementById("formDiv").style.visibility="hidden";return false;\' title="Close Window" style="cursor: pointer; height: 16px;">
				</th>
			</tr>
			<tr ><td><fieldset><legend>'.$tableTitle.'</legend>';

		return $table;
	}

	/**
	* Footer of table
	* @return string
	*/
	function Footer(){
		$table = '
			</fieldset>
			</td></tr>
			</table><br>';
		return $table;
	}
}

/**
 * Class Table for general intentions
 *
 * @package XajaxGrid
 */
class TableA {

	/**
	* Headers of table
	* @param string 	$tableTitle		Title of table
	* @return string
	*/
	function Top($tableTitle = "tableTitle"){
		$table = '
			<table border="0" width="98%">
			<tr ><td>';

		return $table;
	}

	/**
	* Footer of table
	* @return string
	*/
	function Footer(){
		$table = '
			</td></tr>
			</table><br>';
		return $table;
	}
}

?>
