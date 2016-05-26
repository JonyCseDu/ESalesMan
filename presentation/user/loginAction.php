<?php
include_once './../action.php';
// echo getcwd() . "\n";
// echo "OK";
// send to business layer
$ret = jsonSend($url, $_POST);
//echo $ret;
$ret = json_decode($ret, true);

if(isset($ret["fail"])){
	failed("Login Failed: User Name or Password Error");
}

else{
	$_SESSION['id'] = $ret["id"];
	$_SESSION['name'] = $ret["name"];
	$_SESSION['password'] = $ret["password"];
	
	header("Location: http://localhost/presentation/");
	exit;
}




