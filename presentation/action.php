<?php
//echo "OK";
session_start();
foreach ($_POST as $key => $val){
	if($val == "") unset($_POST[$key]);
}

$url = $_POST["url"];
unset($_POST["url"]);


function  failed($msg){
	//echo $msg;
	$_SESSION["fail"] = $msg;
	header("Location: http://localhost/presentation/error");
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