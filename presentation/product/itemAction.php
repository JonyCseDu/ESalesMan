<?php
include_once '../action.php';
// echo getcwd();
// print_r($_POST); 

if(!isset($_SESSION["id"])){
	failed("Login or Register to buy anything");
}

if($_POST["action"] == "add_to_cart"){
	include_once '../cart/addCartAction.php';
}

else if($_POST["action"] == "buy_it"){
	
	if(isset($_POST["bid"])) unset($_POST["bid"]);
	print_r($_POST);
	
	//save cart
	$tmpCart = NULL;
	if(isset($_COOKIE["cart"])){
		$tmpCart = unserialize($_COOKIE["cart"]);
// 		setcookie("cart", "", time()-3600, "/");
// 		setcookie("cart", "", time()-3600, "/");
	}
	
	// reset cart
	include_once '../cart/addCartAction.php';
	//pirnt_r($ara);
	include_once '../cart/checkOutAction.php';
	
	
	if($tmpCart) setcookie("cart", serialize($tmpCart));
	header("Location: " . "http://localhost/presentation/item?id=" . $_POST["id"]);
	exit;
}


else if($_POST["action"] == "notify"){
	
	//echo "drop notification :";
	$ret = jsonSend("http://localhost/business/other/drop_notification", ["user_id" => $_POST["user_id"], "product_id" => $_POST["id"]]);
	$ret = json_decode($ret, true);
	if($ret["fail"]) failed($ret["fail"]);

	if(isset($_POST["bid"])) unset($_POST["bid"]);
	//print_r($_POST);

	//save cart
	$tmpCart = NULL;
	if(isset($_COOKIE["cart"])){
		$tmpCart = unserialize($_COOKIE["cart"]);
		// 		setcookie("cart", "", time()-3600, "/");
		// 		setcookie("cart", "", time()-3600, "/");
	}

	// reset cart
	include_once '../cart/addCartAction.php';
	//pirnt_r($ara);
	include_once '../cart/checkOutAction.php';


	if($tmpCart) setcookie("cart", serialize($tmpCart));
	// 	header("Location: " . "http://localhost/presentation/item?id=" . $_POST["id"]);
	// 	exit;
	
	
}

else if($_POST["action"] == "bid"){
	// $_POST = ["product_id" => 1, "user_id" => 1, "best_price" => 100];
	// $url = 'http://localhost/business/product/bid';
	
	$ret = jsonSend('http://localhost/business/product/bid', ["product_id" => $_POST["id"], "user_id" => $_SESSION["id"], "bid_price" => $_POST["bid"]]);
	echo $ret;
	$ret = json_decode($ret, true);
	if(isset($ret["fail"])) failed("Sorry Bidding failed");
	else{
		header("Location: " . "http://localhost/presentation/item?id=" . $_POST["id"]);
		exit;
	}
}
