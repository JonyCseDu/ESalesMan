<?php
session_start();
print_r($_POST);
foreach ($_POST as $key => $val){
	if($val == "") unset($_POST[$key]);
}

$url = $_POST["url"];
unset($_POST["url"]);


$func = "none";
if(endsWith($url, "process_cart")) $func = "process_cart";

if($func == "process_cart"){
	if(!isset($_SESSION["id"])){
		failed("You are not logged in");
	}
	else{
		$_POST["user_id"] = $_SESSION["id"];
		$_POST["password"] = $_SESSION["password"];
	}
}

// $_POST = ["user_id" => 1, "password"=>"tow", "cost" => 100, "product_ids" => "json", "quantities" => "json"];
// $url = 'http://localhost/business/other/process_cart';

$ret = jsonSend($url, $_POST);
echo $ret;
$ret = json_decode($ret, true);

if(isset($ret["fail"])){
	if($func == "process_cart") failed("process_cart Failed");

}

else{
	
	if($func == "process_cart"){
		failed("process_cart Success");
	}
	//else echo "none </br>";
}


function jsonSend($url, $data){
	$json = json_encode($data);
	//$json = array("json" => $json);
	//echo $json;
	 
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

function endsWith($url, $str){
	if(strlen($str)>strlen($url)) return false;
	for($i=strlen($str)-1, $j=strlen($url)-1 ; $i>=0; $i--, $j--){
		if($str[$i] != $url[$j]) return false;
	}
	return true;
}

function  failed($msg){
	$_SESSION["fail"] = $msg;
	header("Location: http://localhost/presentation/error");
	exit;
}


