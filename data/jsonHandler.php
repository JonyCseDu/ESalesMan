<?php
include_once "dbhandler.php";

class jsonHandler{
	private $mydb;
	private $key, $type, $val, $id, $ret;
	private $job, $table;
	
	public function __construct($host, $user, $pass, $dbName){
		//echo "ok </br>";
		$this->mydb = new DbHandler($host, $user ,$pass, $dbName);
		$this->reset();
	}
	
	public function service($action, $json = NULL, $table = NULL, $id = NULL){
		$this->reset($table, $id);
		$data = json_decode($json, true);
		
		
		if($json != NULL){
			//$data = json_decode($json, true);
			//print_r($data);
			$this->handleJson($data);
		}
		
		switch ($action) {
			case "get_all":
				//print_r ($this->ret); 
				$result = $this->mydb->get_specific($this->table, $this->key, $this->val, $this->type, $this->ret);
				$this->dumpJson($result);
				break;
			
			case "get_thumbnail":
				//print_r ($data);
				$result = $this->mydb->get_thumbnails("Product", $this->val[0], $this->val[1]);
				$this->dumpJson($result, true);
				break;
				
			case "get_item":
				$result = $this->mydb->get_row($this->table, $this->id);
				$this->dumpJson($result);
				break;
			
			case "get_specific":
					$result = $this->mydb->get_specific($this->table, $this->key, $this->val, $this->type, $this->ret);
					$this->dumpJson($result);
					break;
				
			case "search_name":
// 				echo $this->table;
// 				echo $data["name"];
				$this->search_name($this->table, $data["name"]);
				break;
				
			case "get_items":
				$result = $this->mydb->get_rows($this->table, $this->val[0]);
				$this->dumpJson($result);
				break;
				
			case "add_item":
				$this->mydb->add_row($this->table, $this->key, $this->val, $this->type);
				break;
	
			case "update_item":
				$this->mydb->update_row($this->table, $this->key, $this->val, $this->type, $this->id);
				break;
				
			case "update_bid":
				$this->update_bid($data["product_id"], $data["user_id"], $data["bid_price"]);
				break;
				
			case "drop_items":
				$this->mydb->drop_items($this->table, $this->key, $this->val, $this->type, $this->id);
				break;
				
			case "create_db":
				$this->create_db();
				break;
				
			case "drop_db":
				$this->drop_db();
				break;
	
			default:
				failed("NO SUCH SERVICE");
		}
	}
	
	private function update_bid($product_id, $user_id, $bid_price){
		$sql = "UPDATE Price SET bid_price=$bid_price WHERE product_id=$product_id AND user_id=$user_id";
		//echo $sql;
		if($this->mydb->runSql($sql)){
			success("Bidding success");
		}
		else{
			failed("Bidding failed");
		}
	}
	
	private function isRet($str){
		return  (strlen($str)>=3 && $str[0] == "r" && $str[1] == "e"  && $str[2] == "t");
	}
	
	public function handleJson($data = NULL){
		
			foreach($data as $ind => $value){
				//echo "$ind <br>";
				if($this->isRet($ind)){
					//echo "OK";
					array_push($this->ret, $value);
				}
				else{
					array_push($this->key, $ind);
					array_push($this->val, $value);
					array_push($this->type, $this->getType($ind));
				}
				
			}
				
// 			for($i=0; $i<sizeof($this->key); $i++){
// 				echo $this->key[$i] . " - " . $this->val[$i] . " - " . $this->type[$i]. "<br/>";
// 			}
		
	}
	
	private function getType($ind){
		if(($ind == "name") || ($ind === "image") || ($ind === "email") || ($ind === "password")
				|| ($ind === "status") || ($ind === "additional_info") || ($ind === "phone") || ($ind === "transaction_id")
				|| ($ind === "data") || ($ind === "type") || ($ind === "last_date")
				|| ($ind === "reg_date") || ($ind === "hash")|| ($ind === "verified")) return "s";
		else return "i";
	}
	
	private function create_db(){
		// create table User
		$sql = "CREATE TABLE User (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(100) NOT NULL,
		password VARCHAR(256) NOT NULL,
		email VARCHAR(100) NOT NULL,
		phone VARCHAR(15),
		credit DOUBLE DEFAULT 0,
		image VARCHAR(100),
		reg_date VARCHAR(15) DEFAULT NULL,
		verified VARCHAR(15) 
		)";
	
		//echo $sql;
		if($this->mydb->runSql($sql) == FALSE){
			failed("DB CREATE TABLE User FAIL");
		}
	
		// create table Category
		$sql = "CREATE TABLE Category (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(100) NOT NULL,
	    parent_id INT(10) UNSIGNED,
		additional_info VARCHAR(300),
		image VARCHAR(100)
		)";
	
		//echo $sql;
		if($this->mydb->runSql($sql) == FALSE){
			failed("DB CREATE Catagory Transaction FAIL");
		}
	
		// create table Product
		$sql = "CREATE TABLE Product (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	    category_id INT(10) UNSIGNED NOT NULL,
		user_id INT(10) UNSIGNED NOT NULL,
		name VARCHAR(100) NOT NULL,
		type VARCHAR(10) NOT NULL,
	    buyit_price DOUBLE DEFAULT 0,
		quantity INT(10) UNSIGNED NOT NULL,
	    additional_info VARCHAR(500),
		image VARCHAR(100),
	    FOREIGN KEY (category_id) REFERENCES Category(id),
		FOREIGN KEY (user_id) REFERENCES User(id)
		)";
	
		//echo $sql;
		if($this->mydb->runSql($sql) == FALSE){
			failed("DB CREATE Product Transaction FAIL");
		}
		
		// create table Auction
		$sql = "CREATE TABLE Auction (
		id INT(10) UNSIGNED PRIMARY KEY,
	    start_price DOUBLE DEFAULT 0,
	    last_bid_price DOUBLE DEFAULT 0,
		num_of_bids INT(10) UNSIGNED DEFAULT 0,
		last_date VARCHAR(15) NOT NULL,
		FOREIGN KEY (id) REFERENCES Product(id)
		)";
		
		//echo $sql;
		if($this->mydb->runSql($sql) == FALSE){
			failed("DB CREATE Auction FAIL");
		}
	
		// create table Price
		$sql = "CREATE TABLE Price (
		product_id INT(10) UNSIGNED,
	    user_id INT(10) UNSIGNED,
	    bid_price DOUBLE DEFAULT 0,
		PRIMARY KEY (product_id, user_id),
		FOREIGN KEY (product_id) REFERENCES Product(id),
	    FOREIGN KEY (user_id) REFERENCES User(id)
		)";
	
		//echo $sql;
		if($this->mydb->runSql($sql) == FALSE){
			failed("DB CREATE Price Transaction FAIL");
		}
	
		// create table Cart
		$sql = "CREATE TABLE Cart (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	    user_id INT(10) UNSIGNED NOT NULL,
	    data VARCHAR(500) NOT NULL,
		cost DOUBLE DEFAULT 0,
	    FOREIGN KEY (user_id) REFERENCES User(id)
		)";
	
		//echo $sql;
		if($this->mydb->runSql($sql) == FALSE){
			failed("DB CREATE Cart Transaction FAIL");
		}
	
		// create table Transaction
		$sql = "CREATE TABLE Transaction (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		transaction_id VARCHAR(50) NOT NULL,
	    cost DOUBLE DEFAULT 0
		)";
	
		//echo $sql;
		if($this->mydb->runSql($sql) == FALSE){
			failed("DB CREATE TABLE Transaction FAIL");
		}
		
		
		// create table Verify
		$sql = "CREATE TABLE Verify (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		email VARCHAR(50) NOT NULL,
	    hash VARCHAR(50) NOT NULL
		)";
		
		//echo $sql;
		if($this->mydb->runSql($sql) == FALSE){
			failed("DB CREATE TABLE Verify FAIL");
		}
		
		
		// create table Notification
		$sql = "CREATE TABLE Notification (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		user_id UNSIGNED,
	    product_id UNSIGNED,
		data VARCHAR(500)
		)";
		
		//echo $sql;
		if($this->mydb->runSql($sql) == FALSE){
			failed("DB CREATE TABLE Notification FAIL");
		}
		
		success("ALL TABLE CREATED SUCCESSFULLY");
	}
	
	private function drop_db(){
	
		// drop table Price
		$sql = "DROP TABLE Price";
		//echo $sql . "</br>";
	
		if($this->mydb->runSql($sql) == FALSE){
			echo "DB DROP TABLE Price FAIL </br>";
		}
	
		// drop table Transaction
		$sql = "DROP TABLE Transaction";
		//echo $sql . "</br>";
	
		if($this->mydb->runSql($sql) == FALSE){
			echo "DB DROP TABLE Transaction FAIL </br>";
		}
	
		// drop table Cart
		$sql = "DROP TABLE Cart";
		//echo $sql . "</br>";
	
		if($this->mydb->runSql($sql) == FALSE){
			echo "DB DROP TABLE Cart FAIL </br>";
		}
		
		// drop table Product
		$sql = "DROP TABLE Auction";
		//echo $sql . "</br>";
		
		if($this->mydb->runSql($sql) == FALSE){
			echo "DB DROP TABLE Auction FAIL </br>";
		}
		
		// drop table Notification
		$sql = "DROP TABLE Notification";
		//echo $sql . "</br>";
		
		if($this->mydb->runSql($sql) == FALSE){
			echo "DB DROP TABLE Notification FAIL </br>";
		}
		
		// drop table Verify
		$sql = "DROP TABLE Verify";
		//echo $sql . "</br>";
		
		if($this->mydb->runSql($sql) == FALSE){
			echo "DB DROP TABLE Verify FAIL </br>";
		}
	
		
	
		// drop table Product
		$sql = "DROP TABLE Product";
		//echo $sql . "</br>";
	
		if($this->mydb->runSql($sql) == FALSE){
			echo "DB DROP TABLE Product FAIL </br>";
		}
	
		// drop table Category
		$sql = "DROP TABLE Category";
		//echo $sql . "</br>";
	
		if($this->mydb->runSql($sql) == FALSE){
			echo "DB DROP TABLE Catagory FAIL </br>";
		}
		
		// drop table user
		$sql = "DROP TABLE User";
		//echo $sql . "</br>";
		
		if($this->mydb->runSql($sql) == FALSE){
			echo "DB DROP TABLE User FAIL </br>";
		}
		success("ALL TABLE DROPPED");
	}
	
	private function reset($table=NULL, $id=NULL){
		$this->table = $table;
		$this->id = $id;
		$this->key = array();
		$this->type = array();
		$this->val = array();
		$this->ret = array();
	}
	
	private function get_all($table){
		//echo "data";
		return $this->mydb->runsql("SELECT name FROM $table Where 1"); // % _
	}
	
	private function search_name($table, $term){
		$ret = array();
		$result = $this->get_all($table);
		//$this->dumpJson($result);

		while($row = $result->fetch_assoc()) {
			foreach ($row as $key => $value) {
				$distance = levenshtein(strtolower($term), strtolower(substr($value, 0, strlen($term))));
				//echo substr($value, 0, strlen($term)) ." : $distance <br/>";
				if($distance <= strlen($term) && $distance < 3){
					$ret[$value] =  $distance;
				}
				//echo "$this->key  $row[$this->key] <br/>";
			}
		}
		
		asort($ret); // sort showing best match first
		
		// now dump as json
		$tmp = array();
		$cnt = 0;
		foreach ($ret as $key => $value) {
			array_push($tmp, $key);
			$cnt++;
			if($cnt==5) break;
		}
		echo json_encode($tmp);
	}
	
	private function  dumpName(&$result)
	{
		$ret = array();
		while($row = $result->fetch_assoc()) {
			array_push($ret, $row["name"]);
		}
		if(count($ret) == 1) $ret = $ret[0];
		$json = json_encode($ret);
		//var_dump($json);
		echo $json;
	}
	
	
	private function dumpJson(&$result, $isThumbNail = false)
	{
		$ret = array();
		while($row = $result->fetch_assoc()) {
			array_push($ret, $row);
		}
		if(!$isThumbNail && count($ret) == 1) $ret = $ret[0];
		$json = json_encode($ret);
		//var_dump($json);
		echo $json;
	}
}
