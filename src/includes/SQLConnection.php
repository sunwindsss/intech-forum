<?php
class MySQLConnection {
	private $connection;
	
	public function __construct($server, $username, $password, $database) {
		$this->connection = mysqli_connect($server, $username, $password, $database);
		
		if (!$this->connection) {
			throw new Exception("Database connection failed: " . mysqli_connect_error());
		}
		
		mysqli_set_charset($this->connection, "utf8");
	}
	
	public function __destruct() {
		if ($this->connection) {
			mysqli_close($this->connection);
		}
	}
	
	public function sendQuery($query) {
		$result = mysqli_query($this->connection, $query);
		if (!$result) {
			throw new Exception("Query failed: " . mysqli_error($this->connection) . " Query: " . $query);
		}
		return $result;
	}
	
	public function selectAndLock($selectQuery, $forUpdate = FALSE) {
		if ($forUpdate) {
			return $this->sendQuery("SELECT $selectQuery FOR UPDATE;");
		} else {
			return $this->sendQuery("SELECT $selectQuery;");
		}
	}
	
	public function fetchRow($queryResult, $forUpdate = FALSE) {
		return mysqli_fetch_assoc($queryResult);
	}
	
	public function fetchRowFields($queryResult) {
		return mysqli_fetch_row($queryResult);
	}
	
	public function getLastInsertID() {
		return mysqli_insert_id($this->connection);
	}
	
	public function escapeString($string) {
		return mysqli_real_escape_string($this->connection, $string);
	}
	
	public function startTransaction() {
		mysqli_autocommit($this->connection, FALSE);
	}
	
	public function commit() {
		mysqli_commit($this->connection);
		mysqli_autocommit($this->connection, TRUE);
	}
	
	public function rollback() {
		mysqli_rollback($this->connection);
		mysqli_autocommit($this->connection, TRUE);
	}

	public function close() {
		if ($this->connection) {
			mysqli_close($this->connection);
			$this->connection = null;
		}
	}

}
?>
