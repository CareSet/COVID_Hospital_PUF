<?php


/**
 * This is a simple PDO style MySql object.
 * NOTE, THIS IS A SINGLETON INSTANCE, it will need to be called via DB::get()
 */
class DB
{


	private $_database = null;
	private static $_instance = null;


	private function __construct($host,$database,$user,$password)
	{
		 $this->_database = new PDO("mysql:host=$host;dbname=$database", $user, $password,
			[
				PDO::MYSQL_ATTR_LOCAL_INFILE => TRUE,
			]
		);
		 $this->_database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	}

	/**
	 * Get Raw pdo object
	 * @return MySQL-PDO Object raw MySQL-PDO Object 
	 */
	public function getPdo() { return $this->_database; }


	/**
	 * One Stop shop for querying. will support any SQL command
	 * @param  string  $query     query string to run
	 * @param  array   $variables pdo variables, support both standard array and associated array
	 * @param  boolean $commit    will commit after the execution or wait
	 * @return vary               depending on the type of query, it will return an object array or true/false 
	 */
	public function query($query,$variables=[],$commit=true)
	{
		$result_array = array ();

		//begin transaction
		$this->_database->beginTransaction ();

		$stmt = $this->_database->prepare ( $query );

		try {
			if($stmt == null)
			{
				if(class_exists('Logger'))
				{
					Logger::error('Invalid Query: '.$query);
				}
				return false;
			}
			$stmt->setFetchMode ( PDO::FETCH_ASSOC );
		} catch ( Exception $e ) {
			
			$stmt = null;

			if(class_exists('Logger'))
			{
				Logger::error('Invalid Query: '.$query,false);
			}
			return false;
		}


		if (is_array ( $variables ) && (count ( $variables ) > 0)) {
			$stmt->execute ( $variables );
		} else
			$stmt->execute ();

		if ($stmt->errorCode () !== '00000') {
			
			$error_message = $stmt->errorInfo ()[2];
			
			$stmt = null;

			if(class_exists('Logger'))
			{
				Logger::error('DB Error: '.$error_message,false);
			}
			return false;
		}

		while ($stmt && ($row = $stmt->fetch ()) !== false ) {
			$result_array[] = $row;
		}

		if($commit)
			$this->_database->commit();

		$stmt = null;

		if (empty ( $result_array ))
		{
			return true;
		}

		return $result_array;
	}


	/**
	 * Similar to $this->query, this will run any type of sql statement, but will return each row back to the $callback function.
	 * This style of query is preferred on big sql data return since it will not have to create the whole array table
	 * @param  string $query     sql statement to run
	 * @param  array $variables  pdo array variables. support simple array and associate array
	 * @param  [type] $callback  call-back function to call on each row
	 * @return boolean           true/false if execution was successful
	 */
	public function anonymous_query($query, $variables = null,$callback = null)
	{

		$stmt = $this->_database->prepare ( $query );

		try {
			if($stmt == null)
			{
				if(class_exists('Logger'))
				{
					Logger::error('Invalid Query: '.$query);
				}
				return false;
			}
			$stmt->setFetchMode ( PDO::FETCH_ASSOC );
		} catch ( Exception $e ) {
			
			$stmt = null;

			if(class_exists('Logger'))
			{
				Logger::error('Invalid Query: '.$query);
			}
			return false;
		}


		if (is_array ( $variables ) && (count ( $variables ) > 0)) {
			$stmt->execute ( $variables );
		} else
			$stmt->execute ();

		if ($stmt->errorCode () !== '00000') {
			
			$error_message = $stmt->errorInfo ()[2];
			
			$stmt = null;

			if(class_exists('Logger'))
			{
				Logger::error('DB Error: '.$error_message);
			}
			return false;
		}


		if($callback!=null)
		{
			while ($stmt && ($row = $stmt->fetch ()) !== false ) {
				call_user_func_array($callback,array($row));
			}
		}

		$stmt = null;

		return true;
	}

	/**
	 * On MySQL INSERT statement, this will return the last primary id value. On MySQL, this must be ran within the same TRANSACTION.
	 * To use this successfully, run $this->query() with commit = false, then call this function, then call $this->commit()
	 * @return int primary key of last insert
	 */
	public function get_last_id()
	{
		 return $this->_database->lastInsertId();
	}

	/**
	 * Force a transaction commit
	 * @return boolean if committed or failed
	 */
	public function commit()
	{
		return $this->_database->commit();
	}

	/**
	 * Destory the mysql object. This will force the deconstructor to be called, forcing the connection to be disconnected
	 */
	public function close()
	{
		$this->_database = null;
		self::$_instance = null;
	}

	/**
	 * This is a singleton instance. this will fetch this DB Object
	 * @param  string $host     database host
	 * @param  string $database schema name
	 * @param  string $user     user name
	 * @param  string $password password
	 * @return DB  		        This DB object
	 */
	public static function get($host=null,$database=null,$user=null,$password=null)
	{
		if(self::$_instance === null) 
		{
			try {
				self::$_instance = new DB($host,$database,$user,$password);
			}
			catch(PDOException $e)
		    {
		    	if(class_exists('Logger'))
		    	{
		    		Logger::error($e->getMessage());
		    	}
		    	return null;
		    }
		}
		return self::$_instance;
	}
}

?>
