<?php

class Util
{
	//Actually connects to the database
	//Returns: A database object
	public static function db_connect()
	{
		// Load configuration as an array. Use the actual location of your configuration file
		$config = parse_ini_file(SITE_ROOT . 'backend/config.ini');
		$connection = new \mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);
		// If connection was not successful, handle  the error
		if (isset($connection->connect_error)) {
			// Handle error - notify administrator, log to a file, show an error screen, etc
			throw new Exception("Failed to connect to database", Constants::ERR_DB);
		}
		return $connection;
	}

	//Generates a unique id
	//Parameter: the database to generate the id from
	//Returns: A uuid
	public static function getUUID(\mysqli $db)
	{
		$result = $db->query("SELECT UUID()");
		if (!$result)
			throw new Exception("Database query failed", Constants::ERR_DB);
		return $result->fetch_assoc()["UUID()"];
	}

	//Gets the last id inserted into the database
	//Parameter: The database to get the id from
	//Returns: id
	public static function getLastID(mysqli $db)
	{
		return Util::queryW($db, "SELECT LAST_INSERT_ID()")->fetch_assoc()["LAST_INSERT_ID()"];
	}

	//Converts a sql result object to a php array
	//input:
	//  result - mysql result object
	//  fetch - the column to convert to an array (optional)
	//returns: php array containing the data
	public static function toArray(\mysqli_result $result, $fetch = null)
	{
		$rows = [];
		while ($row = $result->fetch_assoc()) {
			if (isset($fetch) && isset($row[$fetch]))
				$rows[] = $row[$fetch];
			else
				$rows[] = $row;
		}
		return $rows;
	}

	//runs a query on the database and caches
	//parameters:
	//  db - the database to query
	//  query - the query to run
	//returns: an sql result object
	public static function queryW(mysqli $db, $query)
	{
		self::$cnt++;
		$result = $db->query($query);
		//todo not sure if needed
		if (!$result)
			throw new \Exception("Database query failed: " . $db->error, Constants::ERR_DB);

		return $result;
	}

	private static $cache = [];
	static $cnt = 0, $tot = 0;

	//selects a single field from a table with ids
	//parameters:
	//  db - the database to select form
	//  table - the table name
	//  id - the id of the object (for example, user id, shift id, plant id etc)
	//  field - the column to select information from
	//returns: the value of the field for that object
	public static function selectF(mysqli $db, $table, $id, $field)
	{
		$query = "$table-$id-$field";
		self::$tot++;
		if (!array_key_exists($query, self::$cache)) {
			self::$cache[$query] = Util::queryW($db, "SELECT $field FROM $table WHERE id='$id'")->fetch_assoc()[$field];
		}
		return self::$cache[$query];
	}

	//escapes a sql string, allows nulls
	public static function escape(mysqli $db, $str)
	{
		if ($str === null)
			$str = 'NULL';
		else {
			$str = $db->escape_string($str);
			$str = "'$str'";
		}
		return $str;
	}

	//updates a single field in a table with ids
	//parameters:
	//  db - the database to update
	//  table - the table name
	//  id - the id of the object (for example, user id, shift id, plant id etc)
	//  field - the column to update
	//  value - the value to set the column to
	public static function updateF(mysqli $db, $table, $id, $field, $value)
	{
		$value = self::escape($db, $value);
		Util::queryW($db, "UPDATE $table SET $field=$value WHERE id='$id'");
	}

	//converts a mysql date to a php date
	public static function dateSQL2PHP($sqlDate)
	{
		if ($sqlDate)
			return DateTime::createFromFormat('Y-m-d', $sqlDate);
		return null;
	}

	//convert php date to mysql date
	public static function datePHP2SQL(DateTime $phpDate)
	{
		return $phpDate->format('Y-m-d');
	}

	//changes page
	public static function redirect($page)
	{
		$tokens = explode('#', $page);
		$hash = '';
		if (count($tokens) == 2) {
			$page = $tokens[0];
			$hash = $tokens[1];
		}
		header("Location: $page?" . http_build_query($_GET) . "#$hash");
		die();
	}

	//returns to prev url
	public static function returnPrevPage()
	{
		if (array_key_exists('srcURL', $_GET))
			$prev = $_GET['srcURL'];
		else
			$prev = $_SERVER['HTTP_REFERER'];
		self::redirect($prev);
	}

	//creates link js
	public static function linkStr($url, $clearParams = false, $clearSrc = false)
	{
		$actualURL = SUB_DIR . $url;
		return "javascript: setPage([], '$actualURL', '$clearParams', '$clearSrc')";
	}

	//guards agains calling null
	public static function guard($obj, $call, $param = null, $default = null)
	{
		if ($obj === null) return $default;
		if ($param === null) return $obj->{$call}();
		return $obj->{$call}($param);
	}

	public static function guardA($arr, $key, $default = null)
	{
		if ($arr === null) return $default;
		if (!array_key_exists($key, $arr)) return $default;
		return $arr[$key];
	}
}