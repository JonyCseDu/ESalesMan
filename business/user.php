<?php

// $_POST = ["email" => "jony@gmail.com", "password" => "jony"];
// $url = 'http://localhost/business/user/login';

function login($data){
	// get password
	$ret = jsonSend("get_specific/User", ["email" => $data["email"], "ret1" => "id", "ret2" => "password", "ret3" => "name", "ret4" => "verified"]);
	//echo $ret;
	$ret = json_decode($ret, true);
	$data["password"] = trim($data["password"]);
	if($ret["verified"] != "yes") failed("You are not verified User Please Verify your Email");
	
	if(password_verify($data["password"], $ret["password"])){
		//unset($ret["password"]);
		$ret = json_encode($ret);
		echo $ret;
	}
	else{
		failed("wrong user name or password") ;
	}
}

// $_POST = ["id" => 1];
// $url = 'http://localhost/business/user/get_user';

function get_user($data){
	$id = $data["id"];
	echo jsonSend("get_item/User/$id");
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
		// hash password
		$pass = trim($data["password"]);
		$data["password"] = password_hash($pass, PASSWORD_BCRYPT);
		
		
		$ret = jsonSend("add_item/User", $data);
		$ret = json_decode($ret, true);
		//print_r($ret);
		if(isset($ret["success"])){
			$data["password"] = $pass;
			
			success("You Have Successfully signed up");
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

function update_account($data){
	//echo "update account";
	if(count($data) == 0) echo "NO DATA </br>";
	
	$ret = jsonSend("get_specific/User", ["id" => $data["id"], "ret1" => "password"]);
	$ret = json_decode($ret, true);
	//print_r($ret);
	//print_r($data);
	
	if(password_verify($data["old_password"], $ret["password"])){
		$id = $data["id"];
		unset($data["id"]);
		unset($data["old_password"]);
		
		echo jsonSend("update_item/User/$id", $data);
		
	}
	
	else{
		failed("WRONG PASSWORD");
	}
}

function update_verify($data){
	$ret = jsonSend("get_specific/User", ["email" => $data["email"], "ret1" => "id"]);
	$ret = json_decode($ret, true);
	$id = $ret["id"];
	echo jsonSend("update_item/User/$id", ["verified" => "yes"]);
}

