<?php
session_start();

function jsonSend($url, $data){
	$json = json_encode($data);

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

function  failed($msg){
	$_SESSION["fail"] = $msg;
	header("Location: http://localhost/presentation/error");
	exit;
}

function getItem($base){
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$ret = jsonSend('http://localhost/business/product/get_product', ["id" => $id]);
		$ret = json_decode($ret, true);
		if(isset($ret["fail"])) failed("NO SUCH PRODUCT");
		else include_once './product/item.php';
	}
	else{
		failed("Product Id Absent");
	}

}

//  $_POST = ["category_id" => $data["category_id"], "name" => $data["name"]
// $url = 'http://localhost/business/product/get_thumbnail';

function getProducts($base){
	
	if(!isset($_GET["category_id"])){
		$_GET["category_id"] = 1;
		$_SESSION["left_panel"] = 1;
	}
	else $_SESSION["left_panel"] = $_GET["category_id"];
	$tmp = ["category_id" => $_GET["category_id"], "name" => $_GET["name"]];
	//echo "OK : " . $_SESSION["left_panel"];
	//print_r($tmp);
	include_once './product/products.php';
	
}

function emailVerify(){
	//echo "hash: ". $_GET["hash"];
	$ret = jsonSend('http://localhost/business/other/get_code', ["hash" => $_GET["hash"]]);
	//echo $ret;
	$ret = json_decode($ret, true);
	$ret = jsonSend("http://localhost/business/user/update_verify", $ret);
	//echo $ret;
	if(isset($ret["fail"])) failed($ret["fail"]);
	else include_once './user/login.php';
}

