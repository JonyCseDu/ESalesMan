<?php
include_once './../action.php';
// echo getcwd() . "\n";
// echo "OK";
// send to business layer
$ret = jsonSend($url, $_POST);
//echo $ret;
$ret = json_decode($ret, true);

if(isset($ret["fail"])){
	failed("LogOut failed: Internal Error");
}

else{
	session_destroy();
    session_unset();
	
	header("Location: http://localhost/presentation/");
	exit;
}




