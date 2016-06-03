<?php
include_once './../action.php';
// print_r($_POST);
$json = array();
foreach ($_POST as $key => $val){
	if($key[0] == '_'){
		$json[substr($key, 1)] = $val;
		unset($_POST[$key]);
	}
	if(count($json) > 0){
		$_POST["additional_info"] = json_encode($json);
	}
}

print_r($_POST);

$image = $_FILES["image"]["name"];

if(isset($_SESSION["id"])){
	$_POST["user_id"] = $_SESSION["id"];
}
else{
	failed("Please Log In to Add a Product");
}
$ret = jsonSend($url, $_POST);
echo $ret;
$ret = json_decode($ret, true);

if(isset($ret["fail"])){
	failed("Sorry! " . $ret["fail"]);
}

else{
	$ret = jsonSend('http://localhost/business/product/get_product_id', ["user_id" => $_SESSION["id"], "name" => $_POST["name"]]);
	$ret = json_decode($ret, true);
	// 	echo "OK => " . $ret["id"];
	$id = $ret["id"];
	if($image != ""){
		
// 		echo "image adding";
		$ret = uploadImage("/var/www/html/assets/img/products/", $id);
		$ret = "http://localhost/assets/img/products/" . $ret;
		$ret = jsonSend('http://localhost/business/product/update_product', ["id" => $id, "image" => $ret]);
		// echo $ret;
		$ret = json_decode($ret, true);
		if(isset($ret["fail"])){
			failed("fail : image upload failed but product added");
			exit;
		}
	}
	header("Location: http://localhost/presentation/item?id=" . $id);
	exit;
}




