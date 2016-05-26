<?php
session_start();
print_r($_POST);

foreach ($_POST as $key => $val){
	if($val == "") unset($_POST[$key]);
}
unset($_POST["category_id"]);

$url = 'http://localhost/business/product/get_thumbnail';

// send to business layer
$ret = jsonSend($url, $_POST);
echo $ret;
$ret = json_decode($ret, true);

if(isset($ret["fail"])){
	failed("NO ITEM FOUND");
}

else{
	$items = $ret;
	header("Location: http://localhost/presentation/products");
	exit;
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


