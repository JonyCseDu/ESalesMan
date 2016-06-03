<?php
include_once '../action.php';


// check user login
if(!isset($_SESSION["id"])) failed("Please Login Before Purchasing anything");

// compute total cost
$ara = array();
if(isset($_COOKIE["cart"])) $ara = unserialize($_COOKIE["cart"]);

// echo "checkout : ";
// print_r($ara);

$cost = 0;
foreach ($ara as $id => $cart){
	$cost += $cart["buyit_price"] * $cart["quantity"];
}
//echo $cost;

// check with credit
$user = jsonSend('http://localhost/business/user/get_user', ["id" => $_SESSION["id"]]);
$user = json_decode($user, true);
if(isset($user["fail"])) failed("failed in getting User Info");
if($user["credit"] < $cost) failed("Sorry you don't have enough credit... Please recharge from your Account");

// process cart
$ret = jsonSend('http://localhost/business/other/process_cart',
		["user_id" => $_SESSION["id"], "password"=>$_SESSION["password"], "cost" => $cost, "data" => json_encode($ara)]);
// echo "cart process returns: " . $ret;
$ret = json_decode($ret, true);
if(isset($ret["fail"])) failed($ret["fail"]);

// reset cart
setcookie("cart", "", time()-3600, "/");

if($_POST["action"] != "buy_it"){
	failed("Checkout Success");
}




