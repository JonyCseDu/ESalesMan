<?php
session_start();
print_r($_POST);
foreach ($_POST as $key => $val){
	if($val == "") unset($_POST[$key]);
}

// $_POST = ["id"=>"1"];
// $url = 'http://localhost/business/product/get_product';

$url = $_POST["url"];
unset($_POST["url"]);

// itemlisting extra
// $_POST["user_id"]; //$_COOKIE["id"]
// $_POST["image"] = "image";


$func = "none";
if(endsWith($url, "login")) $func = "login";
else if(endsWith($url, "signup")) $func = "signup";
else if(endsWith($url, "add_product")) $func = "add_product";

if($func == "add_product"){
	if(!isset($_SESSION["id"])){
		failed("You are not logged in");
	}
	else $_POST["user_id"] = $_SESSION["id"];
	
	// add image
	$target_dir = "./img/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
	echo $target_file;
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["image"]["tmp_name"]);
		if($check !== false) {
			
		} else {
			failed("file not image");
		}
	}
}


// send to business layer
$ret = jsonSend($url, $_POST);
echo $ret;
$ret = json_decode($ret, true);

if(isset($ret["fail"])){
	if($func == "login") failed("Login Failed");
	else if($func == "signup") failed("Signup Failed");
	else if($func == "add_product") failed("Add Product Failed");
}

else{
	$_SESSION['id'] = $ret["id"];
	$_SESSION['name'] = $ret["name"];
	$_SESSION['password'] = $ret["password"];
	
	if($func == "login"){
		header("Location: http://localhost/presentation/");
		exit;
	}
	
	else if($func == "signup"){
		header("Location: http://localhost/presentation/");
		exit;
	}
	
	else if($func == "add_product"){
		//failed("product add Success");
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


