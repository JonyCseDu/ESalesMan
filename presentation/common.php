<?php
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

function getItem(){
	if(isset($_GET["id"])){
		$tmp = ["id" => $_GET["id"]];
		$url = 'http://localhost/business/product/get_product';
		include_once './product/item.php';
	}
	else{
		failed("Product Id Absent");
	}

}

//  $_POST = ["category_id" => $data["category_id"], "name" => $data["name"]
// $url = 'http://localhost/business/product/get_thumbnail';

function getProducts(){
	$tmp = ["category_id" => $_GET["category_id"], "name" => $_GET["name"]];
	$url = 'http://localhost/business/product/get_product';
	//print_r($tmp);
	include_once './product/products.php';
	
}

