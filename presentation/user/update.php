<?php
include_once '../action.php';
if(!isset($_SESSION["id"])){
	failed("Sorry! You need to log in");
}

// $_POST = ["user_id" => 1, "password"=>"tow", "transaction_id" => "bkash_1"];
// $url = 'http://localhost/business/other/add_transaction';
if($_POST["transaction_id"] != ""){
	$ret = jsonSend('http://localhost/business/other/add_transaction', 
			["user_id" => $_SESSION["id"], "password"=>$_POST["old_password"], "transaction_id" => $_POST[transaction_id]]);
	echo $ret;
	$ret = json_decode($ret, true);
	if(isset($ret["fail"])) failed($ret["fail"]);
	else echo "Transaction Success";
	unset($_POST["transaction_id"]);
}

foreach ($_POST as $key => $val){
	unset($_POST["key"]);
}

// $_POST = ["id"=>"1", "old_password" => "jony", "name" => "tow", "email" => "tow@gmail.com", "password" => "tow", "phone" => "012", "image" => "image"];
// $url = 'http://localhost/business/user/update_account';

if(count($_POST) > 1){
	$_POST["id"] = $_SESSION["id"];
	$ret = jsonSend('http://localhost/business/user/update_account', $_POST);
	echo $ret;
	$ret = json_decode($ret, true);
	if(isset($ret["fail"])) failed("update account failed");
	
}

header("Location: http://localhost/presentation/profile");
exit;

