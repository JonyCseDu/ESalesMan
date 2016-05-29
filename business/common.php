<?php

function add_credit($id, $credit){
	$ret = jsonSend("get_specific/User", ["id" => $id, "ret1" => "credit"]);
	$ret = json_decode($ret, true);
	if(isset($ret["fail"])) failed($ret["fail"]);
	if($ret["credit"] != NULL){
		$credit += $ret["credit"];
	}
	if($credit < 0) failed("NOT ENOUGH CREDIT");
	$ret = jsonSend("update_item/User/$id", ["credit" => $credit]);
	$ret = json_decode($ret, true);
	
	if(isset($ret["fail"])) failed($ret["fail"]);
	else return $ret;
}

function check_credit($id, $credit){
	$ret = jsonSend("get_specific/User", ["id" => $id, "ret1" => "credit"]);
	$ret = json_decode($ret, true);
	if(isset($ret["fail"])) failed($ret["fail"]);
	if($ret["credit"] != NULL){
		return ($ret["credit"] >= $credit);
	}
	else{
		failed("not enough credit");
	}
}

function check_user($id, &$data, $isUserNeeded = FALSE){
	if($data["user_id"] != $id){
		failed("you are not verified for this action");
	}
	// get password
	$ret = jsonSend("get_specific/User", ["id" => $data["user_id"], "ret1" => "password"]);
	$ret = json_decode($ret, true);
	//print_r($ret);
	
	// match password 
	if(password_verify($data["password"], $ret["password"])){
		unset($data["password"]);
		if($isUserNeeded == FALSE) unset($data["user_id"]);
		return TRUE;
	}
	else{
		failed("wrong password");
	}
}

function get_catagory_id(&$data, $name, $unset = FALSE){
	if(isset($data[$name])){
		if($data[$name] != ""){
			$ret = jsonSend("get_specific/Category", ["name" => $data[$name], "ret1" => "id"]);
			$ret = json_decode($ret, true);
			if($unset === TRUE) unset($data[$name]);
				
			if(isset($ret["fail"])){
				if($ret["fail"]) return FALSE;
				else failed($ret["fail"]);
			}
			else{
				return  $ret["id"];
			}
		}
		else return FALSE;
	}
	else return FALSE;
}

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

function jsonSend($url, $data = NULL){
	$url = "localhost/data/" . $url;
	//echo "$url </br>";
	$json = json_encode($data) or NULL;
	//$json = array("json" => $json);
	//echo $json . "</br>";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec($ch);

	// close curl resource to free up system resources
	curl_close($ch);
	return $output;
}