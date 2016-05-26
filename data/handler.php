<?php
include_once "jsonHandler.php";

function failed($msg){
	$ret = array();
	$ret["fail"] = $msg;
	echo json_encode($ret);
	exit();
}

function success($msg){
	$ret = array();
	$ret["success"] = $msg;
	echo json_encode($ret);
	exit();
}

class Handler{
	private $method = [];
	private $params = "";
	private $jHandler = NULL;
	
	public function __construct($host, $user, $pass, $dbName){
		$this->jHandler = new jsonHandler($host, $user ,$pass, $dbName);
		$this->parseUrl();
		$this->params = $_GET;
	}
	
	private function parseUrl() {
		$url = $_GET["_req"];
		$url = rtrim($url, '/');
		$url = explode('/', $url);
		$this->method = $url;
		unset($_GET["_req"]);
	}
	
	public function getService($json = NULL){
		if($this->method[0] == ""){
			failed("NO SERVICE REQUEST");
		}
		
		else if($this->method[0] == "get_all_category"){
			
			$this->jHandler->service($this->method[0], NULL, NULL);
		}
		
		else if($this->method[0] == "create_db"){
			$this->jHandler->service($this->method[0]);
		}
		
		else if($this->method[0] == "drop_db"){
			$this->jHandler->service($this->method[0]);
		}
		
		
		else if($this->method[0] == "add_item"){
			if(count($this->method) !== 2){
				failed("WRONG URL");
			}
			$this->jHandler->service($this->method[0], $json, $this->method[1]);
		}
		
		else if($this->method[0] == "update_item"){
			if(count($this->method) !== 3){
				failed("WRONG URL");
			}
			$this->jHandler->service($this->method[0], $json, $this->method[1], $this->method[2]);
		}
		
		
		else if($this->method[0] == "get_item"){
			if(count($this->method) !== 3){
				failed("WRONG URL");
			}
			$this->jHandler->service($this->method[0], NULL, $this->method[1], $this->method[2]);
		}
		
		else if($this->method[0] == "get_items"){
			if(count($this->method) !== 2){
				failed("WRONG URL");
			}
			$this->jHandler->service($this->method[0], $json, $this->method[1]);
		}
		
		else if($this->method[0] == "search_name"){
			if(count($this->method) !== 2){
				failed("WRONG URL");
			}
			$this->jHandler->service($this->method[0], $json, $this->method[1]);
		}
		
		
		else if($this->method[0] == "get_specific"){
			//failed("specific");
			if(count($this->method) !== 2){
				failed("WRONG URL");
			}
			$this->jHandler->service($this->method[0], $json, $this->method[1]);
		}
		
		else if($this->method[0] == "drop_items"){
			if(count($this->method) !== 2){
				failed("WRONG URL");
			}
			$this->jHandler->service($this->method[0], $json, $this->method[1]);
		}
		else{
			failed("WRONG URL");
		}
	}
}