<?php
include_once './../action.php';
// echo getcwd() . "\n";
// echo "OK";
// send to business layer
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
	failed("Success : Product Add Success");
	exit;
}




