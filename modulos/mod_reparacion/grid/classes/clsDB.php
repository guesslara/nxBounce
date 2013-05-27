<?PHP
/**
*
*	Database Class.
*	@author Timothy Lorens (icebrkr@cyberdyne.org) 09/04/2006
*	@version $Author: icebrkr $ $Revision: 90 $ $Date: 2007-04-08 23:38:13 -0400 (Sun, 08 Apr 2007) $
*	@category Core
*	@package Database
*
*/

class clsDB
{
	/**
    *	Database connection rsource
    *	@access private
    *	@var Resource
    */
	private $_resDBConn		= "";

	/**
    *	Database query result
    *	@access private
    *	@var Resource
    */
	private $_resResults	= "";

	/**
    *	Database Server FQDN or IP address
    *	@access private
    *	@var String
    */
	private $_strDBServer	= "";

	/**
    *	Database Name
    *	@access private
    *	@var String
    */
	private $_strDBName		= "";

	/**
    *	Database User Name
    *	@access private
    *	@var String
    */
	private $_strDBUser		= "";

	/**
    *	Database Password
    *	@access private
    *	@var String
    */
	private $_strDBPassword	= "";

	/**
    *	File path in which to save log files.
    *	@access private
    *	@var String
    */
	private $_strLogPath		= "";

	/**
    *	Database Class debug level: 0=None, 1=Verbose 2=??
    *	@access private
    *	@var Integer
    */
	private $_intDebugLvl	= "0";

	/**
    *	Database Class devel-mode: 0=False/1=True.  Use dev database/tables instead of live data.
    *	@access private
    *	@var Integer
    */
	private $_intDevelMode	= "0";

	/**
    *	Database Class error reporting / messages
    *	@access private
    *	@var String
    */
	private $_aryErrorMsg	= array();

	/**
    *	Database Class numeric error code (0=None/OK)
    *	@access private
    *	@var Integer
    */
	private $_intErrorCode	= "0";

	/**
	*	Query 'start' Time
	*	@access private
	*	@var Integer
	*/
	private $_intStartTime	= "0";

	/**
	*	Query 'start' Time
	*	@access private
	*	@var Integer
	*/
	private $_intStopTime	= "0";


	/**
	*	Performance timer array
	*	@access private
	*	@var Array
	*/
	private $_aryPerformance = array();


	/**
	*
    *	Database Class Constructor
    *	@access Public
    *
    */
	public function __construct($aryConfig="")
	{
		//set_error_handler('errorHandler');
		set_exception_handler(array('clsDB','DBexceptionHandler'));

		if (is_array($aryConfig))
		{
			$this->setup($aryConfig);
			$this->connect();
		}


	}


	public function __destruct()
	{
		//mysqli_free_result($this->_resResults);
		//$this->disconnect();
	}


	//**********************************************************************************
	//**
	//**  METHODS
	//**
	//**********************************************************************************

	/**
	*	Connect
	*/
	public function connect($aryConfig="")
	{
		if (is_array($aryConfig))
		{
			$this->setup($aryConfig);
		}


		if ($this->getDBServer()=="")
		{
			throw new Exception("DB Server not set.");
		}

		if ($this->getDBUser()=="")
		{
			throw new Exception("DB User not set.");
		}

		if ($this->getDBPassword()=="")
		{
			throw new Exception("DB Password not set.");
		}

		$this->_intStartTimer = $this->_getMicroTime();
		$this->_resDBConn = mysqli_connect($this->getDBServer(),$this->getDBUser(),$this->getDBPassword(),$this->getDBName());
		$this->_intStopTimer = $this->_getMicroTime();
		$this->_aryPerformance['connect'] = $this->getQueryTime();
	} // END connect


	/**
	*	Disconnect
	*/
	public function disconnect()
	{
		switch($this->_strDBType)
		{
			case 'mysql':
				mysqli_close($this->_resDBConn);
				break;
			case 'mssql':
				break;
		}
	} // END disconnect


	/**
	*	Setup
	*/
	public function setup($aryConfig)
	{
		if(is_array($aryConfig))
		{
			foreach($aryConfig as $setting_key=>$setting_val)
			{
				switch(strtolower($setting_key))
				{
					case 'user':
						$this->setDBUser($setting_val);
						break;
					case 'password':
						$this->setDBPassword($setting_val);
						break;
					case 'dbserver':
						$this->setDBServer($setting_val);
						break;
					case 'dbname':
						$this->setDBName($setting_val);
						break;
					default:
						print("Unknown: $setting_key => $setting_val<BR>");
				}
			}
		}
		else
		{
			print("Config parameters not an array");
		}
	} // END setup


	/**
	*	Query
	*/
	public function query($query)
	{
		if (!$this->_resDBConn)
		{
			$this->connect();
		}

		$this->_intStartTime = $this->_getMicroTime();
		$this->_resResults = mysqli_query($this->_resDBConn,str_replace("\t",' ',trim($query)));
		$this->_intStopTime = $this->_getMicroTime();
		$this->_aryPerformance['query'] = $this->getQueryTime();

		if ($this->_resResults)
		{
			$aryTmp = split("[[:space:]]",strtolower(trim($query)));
			switch($aryTmp[0])
			{
				case 'insert':
				case 'replace':
					$ret = mysqli_insert_id($this->_resDBConn);
					break;
				case 'update':
				case 'delete':
					$ret = mysqli_affected_rows($this->_resDBConn);
					break;
				case 'select':
					$ret = mysqli_num_rows($this->_resResults);
					break;
			}
		}
		else
		{
			print(mysqli_error($this->_resDBConn));
			$ret = NULL;
		}

		return $ret;
	} // END query


	/**
	*	fetch_row
	*/
	public function fetchRow($return_type="assoc")
	{
		switch(strtolower($return_type))
		{
			case 'both':
				$this->_intStartTime = $this->_getMicroTime();
				$row = mysqli_fetch_array($this->_resResults);
				$this->_intStopTime = $this->_getMicroTime();
				$this->_aryPerformance['fetch_both'] = $this->getQueryTime();
				break;
			case 'array':
				$this->_intStartTime = $this->_getMicroTime();
				$row = mysqli_fetch_row($this->_resResults);
				$this->_intStopTime = $this->_getMicroTime();
				$this->_aryPerformance['fetch_array'] = $this->getQueryTime();
				break;
			case 'assoc':
				$this->_intStartTime = $this->_getMicroTime();
				$row = mysqli_fetch_assoc($this->_resResults);
				$this->_intStopTime = $this->_getMicroTime();
				$this->_aryPerformance['fetch_assoc'] = $this->getQueryTime();
				break;
			case 'object':
				$this->_intStartTime = $this->_getMicroTime();
				$row = mysqli_fetch_object($this->_resResults);
				$this->_intStopTime = $this->_getMicroTime();
				$this->_aryPerformance['fetch_object'] = $this->getQueryTime();
				break;
		}

		return $row;
	} // END fetch_row


	/**
	*
	*	fetchResults
	*
	*	Use carefully, could run server out of memory.
	*
	*	@param String Query to execute
	*	@return Array Results from query
	*
	*/
	function fetchResults($query)
	{
		if ($numrows = $this->query($query))
		{
			while($row = $conn->fetchRow())
			{
				$aryResults[] = $row;
			}
		}

		return $aryResults;
	} // END fetchResults();


	/*
	*	prepValues
	*/
	public function prepValues($aryValues,$retType="string")
	{
		$aryReturn = array();
		foreach($aryValues as $value_key=>$value_val)
		{
			if (!is_numeric($value_val))
			{
				$aryReturn[$value_key] = "'".mysqli_real_escape_string($this->_resDBConn,$value_val)."'";
			}
			else
			{
				$aryReturn[$value_key] = $value_val;
			}
		}

		if (strtolower($retType)=="string")
		{
			return join(', ',$aryReturn);
		}
		else
		{
			return $aryReturn;
		}

	} // END prepValues


	/*
	*	prepValue
	*/
	public function prepValue($value)
	{
		return "'" . mysqli_real_escape_string($this->_resDBConn,$value) . "'";
	} // END prepValue



	//**********************************************************************************
	//**
	//**  SETTERS
	//**
	//**********************************************************************************


	/**
	*	setDBUser
	*/
	public function setDBUser($strUser)
	{
		$this->_strDBUser = trim($strUser);
	} // END setUser


	/**
	*	setDBPassword
	*/
	public function setDBPassword($strPassword)
	{
		$this->_strDBPassword = trim($strPassword);
	} // END setPassword


	/**
	*	setDNServer
	*/
	public function setDBServer($strServer)
	{
		$this->_strDBServer = trim($strServer);
	} // END setDBServer


	/**
	*	setDNName
	*/
	public function setDBName($strName)
	{
		$this->_strDBName = trim($strName);
	} // END setDBName


	/**
	*	setLogPath
	*/
	public function setLogPath($strPath)
	{
		if (substr($strPath,-1) != "/")
		{
			$strPath .= "/";
		}
		$this->_strLogPath = $strPath;
	} // END setLogPath


	//**********************************************************************************
	//**
	//**  GETTERS
	//**
	//**********************************************************************************

	/**
	*	getDBUser
	*/
	public function getDBUser()
	{
		return $this->_strDBUser;
	} // END getUser


	/**
	*	getDBPassword
	*/
	public function getDBPassword()
	{
		return $this->_strDBPassword;
	} //END getPassword


	/**
	*	getDBServer
	*/
	public function getDBServer()
	{
		return $this->_strDBServer;
	} // END getDBServer


	/**
	*	getDBName
	*/
	public function getDBName()
	{
		return $this->_strDBName;
	} // END getDBName


	/**
	*	getLogPath
	*/
	public function getLogPath()
	{
		return $this->_strLogPath;
	} // END getDBName


	/**
	*	getQueryTime
	*/
	public function getQueryTime()
	{
		$time = $this->_intStopTime - $this->_intStartTime;
		$time = number_format($time,6)." secs";
		return $time;
	} // END getQueryTime


	/**
	* Number of fields returned from query
	*/
	public function getNumFields()
	{
		return mysqli_num_fields($this->_resResults);
	}

	/**
	* Seek to Offset
	*/
	public function seek($offset)
	{
		$ret = mysqli_data_seek($this->_resResults,$offset);
		return $ret;
	}

	/**
	*	Get field names that returned from query
	*
	*	@return array
	*/
	public function getFieldNames()
	{
		$aryTmp = array();
		foreach(mysqli_fetch_fields($this->_resResults) as $key=>$val)
		{
			if ($key == "name")
			{
				$aryTmp[] = $val;
			}
		}

		return  $arytTmp;
	}

	/**
	*	getPerformanceTimers
	*/
	public function getPerformanceTimers()
	{
		print("<center>");
		foreach($this->_aryPerformance as $perf_key=>$perf_val)
		{
			print("$perf_key: $perf_val<BR />");
		}
		print("</center>");

	}


	//**********************************************************************************
	//**
	//**  PRIVATE
	//**
	//**********************************************************************************

	/**
	*	setErrorStr
	*/
	private function setErrorStr($str)
	{
		$this->_aryErrorMsg[] = $str;
	} // END setErrorStr


	/**
	*	LogIT
	*/
	private function logit($strText)
	{
		$logname = $this->getLogPath()."clsDB.log";
		if (file_exists($logname))
		{
			$mode = 'a+';
		}
		else
		{
			$mode = "w+";
		}

		if ($fp = fopen($logname,$mode))
		{
			fwrite($fp,$strText);
		}

		fclose($fp);
	} // END LogIT


	/*
	*	_getMicroTime
	*/
	private function _getMicroTime()
	{
		list($usec, $sec) = explode(' ',microtime());
		return ((float)$usec + (float)$sec);
	} // END _getMicroTime


	/**
	*	errorHandler
	*/
	private function errorHandler($e)
	{
		print("Error trapped!");
	} // END errorHandler


	/**
	*	DBexceptionHandler
	*/
	public static function DBexceptionHandler($e)
	{
		print("Exception trapped!<BR>");
		print($e->getMessage());
	} // END DBexcaptionHandler


}

?>