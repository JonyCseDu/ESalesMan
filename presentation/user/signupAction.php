<?php
include_once './../action.php';
//$_POST["reg_date"] = new DateTime();
$image = $_FILES["image"]["name"];

if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
	$_SESSION["error"] = "Invalid email format";
	header("Location: http://localhost/presentation/signup");
	exit;
}

$_POST["verified"] = "no";
$ret = jsonSend($url, $_POST);
echo $ret;
$ret = json_decode($ret, true);

if(isset($ret["fail"])){
	failed("Signup Failed: The Email is Already registered");
}

else{	
	$id = $ret["id"];
	if($image != ""){
		// 		echo "image adding";
		$ret = uploadImage("/var/www/html/assets/img/user/", $id);
		$ret = "http://localhost/assets/img/user/" . $ret;
		//echo $ret . "ok";
		$ret = jsonSend('http://localhost/business/user/update_account', ["id" => $id, "old_password" => $_POST["password"], "image" => $ret]);
		//echo $ret;
		$ret = json_decode($ret, true);
		if(isset($ret["fail"])){
			failed("fail : Profile picture upload failed but account created");
		}
	}
	
	$ret = jsonSend("http://localhost/business/other/new_code", ["email" => $_POST["email"]]);
	echo "new code : ". $ret;
	$ret = json_decode($ret, true);
	print_r($ret);
	if(isset($ret["fail"])){
		failed("failed in hash code genrateing");
	}
	
	//// send email
	echo getcwd();
	$hash = $ret["hash"];
	echo "hash : " .$hash;
	include_once 'mailer.php';
	$ret = SendEmail($_POST["email"], "Email Verify", "http://localhost/presentation/verify?hash=".$hash);
	
	if($ret == TRUE){
		failed("A Mail is Send to your Email Address, Please verify to login to our System");
	}
	else{
		failed("We couldn't Send Verification code to your Email");
	}
	
}




