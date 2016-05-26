<?php

// $_POST = ["email" => "jony@gmail.com", "password" => "jony"];
// $url = 'http://localhost/business/user/login';

function login(&$data){
	// get password
	$ret = jsonSend("get_specific/User", ["email" => $data["email"], "ret1" => "id", "ret2" => "password", "ret3" => "name"]);
	$ret = json_decode($ret, true);
	//print_r($ret);
	
	// match password
	if($ret["password"] === $data["password"]){
		//unset($ret["password"]);
		$ret = json_encode($ret);
		echo $ret;
	}
	else{
		failed("wrong user name or password") ;
	}
}

// $_POST = ["name" => "jony", "email" => "jony@gmail.com", "password" => "jony", "phone" => "012", "image" => "image"];
// $url = 'http://localhost/business/user/signup';

function signup(&$data){
	if(count($data) == 0) echo "NO DATA </br>";
	
	// get id
	$ret = jsonSend("get_specific/User", ["email" => $data["email"], "ret1" => "id"]);
	$ret = json_decode($ret, true);
	//print_r($ret);
	
	//now add item
	if(isset($ret["fail"])){
		$ret = jsonSend("add_item/User", $data);
		$ret = json_decode($ret, true);
		//print_r($ret);
		if(isset($ret["success"])){
			return login($data);
// 			success("You Have Successfully signed up");
		}
		else{
			failed($ret["fail"]);
		}
	}
	else{
		failed("The Eamil is already registered");
	}	
}

// $_POST = ["id"=>"1", "old_password" => "jony", "name" => "tow", "email" => "tow@gmail.com", "password" => "tow", "phone" => "012", "image" => "image"];
// $url = 'http://localhost/business/user/update_account';

function update_account(&$data){
	if(count($data) == 0) echo "NO DATA </br>";
	
	$ret = jsonSend("get_specific/User", ["id" => $data["id"], "ret1" => "password"]);
	$ret = json_decode($ret, true);
	//print_r($ret);
	//print_r($data);
	
	
	if($ret["password"] === $data["old_password"]){
		$id = $data["id"];
		unset($data["id"]);
		unset($data["old_password"]);
		
		echo jsonSend("update_item/User/$id", $data);
		
	}
	
	else{
		failed("WRONG PASSWORD");
	}
}

