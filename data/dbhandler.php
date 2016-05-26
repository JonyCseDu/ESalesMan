<?php

class DbHandler{
	public $conn;
	public $dbName;
	
	// on success set $conn , if not exist create a dabase 
   	public function __construct ( $host=NULL, $user=NULL, $pass=NULL, $dbName=NULL ){
   		if( !($this->conn = mysqli_connect( $host, $user, $pass) ) ){
   			failed("Error in DATABSE host or user name or password");
   		}
   		else{
   			$tmp;
   			if(!($tmp = mysqli_connect( $host, $user, $pass, $dbName) ) ){
   				//echo 'Creating DB '. "</br>";
   				$this->runSql("CREATE DATABASE ". $dbName);
   				$this->conn = mysqli_connect( $host, $user, $pass, $dbName);
   			}
   			else{
   				$this->conn = $tmp;
   				//echo "DB INITIALIZATION SUCCESS<br/>";
   			}
   		}
	}

	public function __destruct(){
	    if( ! mysqli_close($this->conn) ){
	    	failed("Error in DATABSE host or user name or password");
	    }
	}

	// on success return success message
	public function add_row($table, $key, $val, $type){
		if(sizeof($key) != sizeof($val) || sizeof($val) != sizeof($type)){
			failed("INTERNAL ERROR IN SEARCH PARAMETER");
		}

		$sql = "INSERT INTO $table (";
		for($i=0; $i<sizeof($key); $i++){
			if($i > 0) $sql = $sql . ", ";
			$sql = $sql . "$key[$i]";
		}
		$sql = $sql . ") VALUES (";
		for($i=0; $i<sizeof($key); $i++){
			if($i > 0) $sql = $sql . ", ";
			if($type[$i] == "s"){
				$sql = $sql . "'" . $val[$i] . "'";
			}
			else $sql = $sql . $val[$i];
		}
		$sql = $sql . ")";
		//echo "$sql<br/>";

		if ($this->conn->query($sql) === FALSE) {
			//echo $this->conn->error ;
			failed($this->conn->error);
		}
		else{
			success("ADD SUCCESS");
		}
	}

	public function update_row($table, $key, $val, $type, $id){
		if(sizeof($key) != sizeof($val) || sizeof($val) != sizeof($type)){
			failed("INTERNAL ERROR IN SEARCH PARAMETER");
		}

		$sql = "UPDATE $table SET ";
		$size = sizeof($key);
		for($i=0; $i<$size; $i++){
			$sql = $sql . "$key[$i] = ";
			if($type[$i] == "s"){
				$sql = $sql . "'" . $val[$i] . "'";
			}
			else $sql = $sql . $val[$i];
			if($i != $size-1) $sql =  $sql . ", ";
			//else echo "failed";
		}
		$sql = $sql . " WHERE id = $id";
		//echo "$sql<br/>";

		if ($this->conn->query($sql) === FALSE) {
			failed($this->conn->error);
		}
		else{
			success("UPDATE SUCCESS");
		}

	}

	public function get_row($table,  $id){
		if(sizeof($key) != sizeof($val) || sizeof($val) != sizeof($type)){
			failed("INTERNAL ERROR IN SEARCH PARAMETER");
		}

		$sql = "SELECT * FROM $table Where id = $id";
		//echo "$sql<br/>";

		$result = $this->conn->query($sql);
		//echo $this->conn->error;

		if ($result->num_rows == 1) {
		    return $result;
		} else{
			failed("NO DATA");
		}
	}

	public function get_rows($table, $name){
		if(sizeof($key) != sizeof($val) || sizeof($val) != sizeof($type)){
			failed("INTERNAL ERROR IN SEARCH PARAMETER");
		}

		$sql = "SELECT * FROM $table Where name like '$name%'";
		//echo $sql;
		//echo "$sql<br/>";
		$result = $this->conn->query($sql);
		//echo $this->conn->error;

		if ($result->num_rows > 0) {
		    return $result;
		} else{
			failed("NO DATA");
		}
	}
	
	public function get_specific($table, $key, $val, $type, $tar){
		if(sizeof($key) != sizeof($val) || sizeof($val) != sizeof($type)){
			failed("INTERNAL ERROR IN SEARCH PARAMETER");
		}
		if(sizeof($tar) == 0) $tar = "*";
		else{
			$tmp = "";
			$size = sizeof($tar);
			for($i=0; $i<$size; $i++){
				$tmp = $tmp . $tar[$i];
				if($i != $size-1) $tmp =  $tmp . ", ";
			}
			$tar = $tmp;
			//echo "$tar <br>";
		}
		$sql = "SELECT $tar FROM $table Where ";
		$size = sizeof($key);
		for($i=0; $i<$size; $i++){
			$sql = $sql . "$key[$i] = ";
			if($type[$i] == "s"){
				$sql = $sql . "'" . $val[$i] . "'";
			}
			else $sql = $sql . $val[$i];
			if($i != $size-1) $sql =  $sql . ", ";
		}
		//echo "$sql<br/>";
		$result = $this->conn->query($sql);
		//echo $this->conn->error;
	
		if ($result->num_rows > 0) {
			return $result;
		} else{
			failed("NO DATA");
		}
	}
	
public function drop_items($table, $key, $val, $type){
		if(sizeof($key) != sizeof($val) || sizeof($val) != sizeof($type)){
			failed("INTERNAL ERROR IN SEARCH PARAMETER");
		}

		$sql = "DELETE FROM $table Where ";
		$size = sizeof($key);
		for($i=0; $i<$size; $i++){
			$sql = $sql . "$key[$i] = ";
			if($type[$i] == "s"){
				$sql = $sql . "'" . $val[$i] . "'";
			}
			else $sql = $sql . $val[$i];
			if($i != $size-1) $sql =  $sql . ", ";
			//else echo "failed";
		}
		//echo "$sql<br/>";
		$result = $this->conn->query($sql);
		//echo $this->conn->error;
	
		if ($result === true) {
			success("DROP SUCCESS");
		} else{
			failed($this->conn->error);
		}
	} 

	public function runSql($sql){
		//echo $sql . "</br>";
		$result =  $this->conn->query($sql);
		return  $result;
		// 		if ($this->conn->query($sql) === TRUE) {
		// 			//echo "sql run successfully";
		// 			return true;
		// 		} else {
		// 			//echo "Error running sql: " . $conn->error;
		// 			return false;
		// 		}
	}
}
