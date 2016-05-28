<?php
session_start();
class Handler{
	public $method = [];
	public $params = "";
	
	public function __construct(){
		$this->parseUrl();
		$this->params = $_GET;
		//print_r($this->method); echo "</br>";
		//print_r($this->params); echo "</br>";
	}
	
	private function parseUrl() {
		$url = $_GET["_req"];
		$url = strtolower($url);
		$url = rtrim($url, '/');
		$url = explode('/', $url);
		$this->method = $url;
		unset($_GET["_req"]);
	}
	
	private function parseParam(){
		$ret = "";
		foreach($this->params as $x => $x_value) {
		    $ret = $ret. "&". $x . "=" . $x_value;
		}
		$ret[0] = '?';
		$this->params = $ret;
	}
}

function forward($base, $method, $data = NULL){
	
	// our system always have 1 method name in url
	if(count($method) === 1){
		//if(count($params)) $this->parseParam();
			
		switch ($method[0]) {
			case "":
				include_once './home/home.php';
				break;
				
			case "home":
				include_once './home/home.php';
				break;
				
			case "login":
				if(isset($_SESSION["id"])) failed("You Are Already Logged In");
				include_once './user/login.php';
				break;
				
			case "signup":
				if(isset($_SESSION["id"])) failed("You Are Already Logged In");
				include_once './user/signup.php';
				break;
				
			case "account":
				if(!isset($_SESSION["id"])) failed("You are not logged in");
				$view = file_get_contents('http://localhost/');
				break;
			case "sell":
				if(!isset($_SESSION["id"])){
					failed("You are not logged in");
				}
				include_once './product/sell.php';
				break;
				
			case "item":
				getItem($base);
				break;
			
			case "products":
				getProducts($base);
				break;
				
			case "category":
				$view = file_get_contents('http://localhost/');
				break;
			
			case "profile":
				//echo "profile";
				include_once './user/profile.php';
				break;
				
			case "error":
				include_once './error.php';
				break;
				
			default:
				failed("WRONG URL");
				break;
		}
	}
	else{
		echo "URL FORMAT ERROR";
	}
}

include_once 'common.php';

