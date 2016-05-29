<?php
include_once './../action.php';
//$_POST["reg_date"] = new DateTime();
$image = $_FILES["image"]["name"];

$ret = jsonSend($url, $_POST);
echo $ret;
$ret = json_decode($ret, true);

if(isset($ret["fail"])){
	failed("Signup Failed: User Name or Password Error");
}

else{
	$_SESSION['id'] = $ret["id"];
	$_SESSION['name'] = $ret["name"];
	$_SESSION['password'] = $_POST["password"];
	
	$id = $ret["id"];
	if($image != ""){
		// 		echo "image adding";
		$ret = uploadImage("/var/www/html/assets/img/user/", $id);
		$ret = "http://localhost/assets/img/user/" . $ret;
		echo $ret . "ok";
		$ret = jsonSend('http://localhost/business/user/update_account', ["id" => $id, "old_password" => $_POST["password"], "image" => $ret]);
		echo $ret;
		$ret = json_decode($ret, true);
		if(isset($ret["fail"])){
			failed("fail : Profile picture upload failed but account created");
		}
	}
	
	header("Location: http://localhost/presentation/");
	exit;
}




