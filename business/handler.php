<?php

include_once 'common.php';

class Handler{
	private $method = [];
	private $params = "";
	private $sendBase = NULL;
	
	public function __construct($sendBase){
		$this->sendBase = $sendBase;
		$this->parseUrl();
		$this->params = $_GET;
		//print_r($this->method); echo "</br>";
		//print_r($this->params); echo "</br>";
	}
	
	private function parseUrl() {
		$url = $_GET["_req"];
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
	
	private function dumpfile($data){
		$myfile = fopen("post.txt", "w") or die("Unable to open file!");
		$txt = "";
		foreach ($data as $key => $value){
			$txt = $txt . $key . " " . $value . "\n";
		}
		fwrite($myfile, $txt);
		fclose($myfile);
	}
	
	private function specialCheck($tok){
		if(strtolower($tok) == "and" || strtolower($tok) == "or") failed("Malicious data");
		for($i=0; $i<strlen($tok); $i++){
			if($tok[$i]=="+" || $tok[$i]=="-" || $tok[$i]=="!" || $tok[$i]=="+" || $tok[$i]=="#" || $tok[$i]=="/"){
				failed("Some Special Character found Which we don't support");
			}
		}
	}
	
	private function check($val){
		$token = strtok($string, " \t\n");
		while ($token !== false)
		{
			$this->specialCheck($token);
			$token = strtok(" \t\n");
		}
	}
	
	private function checkSql($data){
		foreach ($data as $key => $val){
			$this->check($key);
			$this->check($val);
		}
	}
	
	private function getJson($json){
		if($json != NULL){
			$data = json_decode($json, true);
			 //$this->dumpfile($data);
			 $this->checkSql($data);
			return $data;
		}
		else {
			 //$this->dumpfile("no data");
			return NULL;
		}
	}
	
	
	
	public function getService($json = NULL){
		//print_r($this->method);
		
		if(count($this->method) >= 2){
			$data = $this->getJson($json); // POST json data to dictionary
			//print_r($data);
			//if(count($data) == 0) failed("NO JSON DATA");
			
			if($this->method[0] == "user"){
				include_once 'user.php';
				
				if($this->method[1] == "login"){
					login($data);
				}
				else if($this->method[1] == "signup"){
					signup($data);
				}
				else if($this->method[1] == "get_user"){
					
					get_user($data);
				}
				else if($this->method[1] == "update_account"){
					update_account($data);
				}
				else if($this->method[1] == "update_verify"){
					update_verify($data);
				}
				else{
					failed("NO SUCH SERVICE IN USER");
				}
			}
			
			else if($this->method[0] == "product"){
				//echo $this->method[1];
				include_once 'product.php';
				if($this->method[1] == "get_thumbnail"){
					get_thumbnail($data);
				}
				else if($this->method[1] == "get_product"){
					get_product($data);
				}
				else if($this->method[1] == "get_auction"){
					get_auction($data);
				}
				else if($this->method[1] == "get_product_id"){
					get_product_id($data);
				}
				else if($this->method[1] == "add_product"){
					add_product($data);
				}
				else if($this->method[1] == "update_product"){
					echo "updating...";
					update_product($data);
				}
				else if($this->method[1] == "buy"){
					buy($data);
				}
				else if($this->method[1] == "bid"){
					bid($data);
				}
				else if($this->method[1] == "get_bid"){
					get_bid($data);
				}
				else if($this->method[1] == "get_last_bid_user"){
					get_last_bid_user($data);
				}
				else{
					failed("NO SUCH SERVICE IN Product");
				}
			}
			
			else if($this->method[0] == "category"){
				include_once 'category.php';
				if($this->method[1] == "get_all_category"){
					get_all_category();
				}
				else if($this->method[1] == "get_child_category"){
					get_child_category($data);
				}
				else if($this->method[1] == "get_category"){
					get_category($data);
				}
				else if($this->method[1] == "get_additional_info"){
					get_additional_info($this->method[2]);
				}
				else if($this->method[1] == "add_category"){
					add_category($data);
				}
				else if($this->method[1] == "update_category"){
					update_category($data);
				}
				else if($this->method[1] == "get_category_name"){
					get_category_name($data);
				}
				
				else{
					failed("NO SUCH SERVICE IN Category");
				}
			}
			
			else if($this->method[0] == "other"){
				include_once 'other.php';
				if($this->method[1] == "search_name"){
					$data = $_GET;
					search_name($data);
				}
				
				else if($this->method[1] == "process_cart"){
					process_cart($data);
				}
				else if($this->method[1] == "get_cart"){
					get_cart($data);
				}
				
				else if($this->method[1] == "add_transaction"){
					add_transaction($data);
				}
				
				else if($this->method[1] == "get_notification"){
					get_notification($data);
				}
				
				else if($this->method[1] == "send_notification"){
					send_notification($data);
				}
				else if($this->method[1] == "drop_notification"){
					drop_notification($data);
				}
				else if($this->method[1] == "new_code"){
					new_code($data);
				}
				else if($this->method[1] == "get_code"){
					get_code($data);
				}
				
				else{
					failed("NO SUCH SERVICE IN Other");
				}
			}
			else echo "WRONG URL </br>";
		}
		else{
			echo "NOT ENOUGH ARG </br>";
		}
	}
}