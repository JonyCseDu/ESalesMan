<?php
//echo "OK";
session_start();
foreach ($_POST as $key => $val){
	if($val == "") unset($_POST[$key]);
}

$url = $_POST["url"];
unset($_POST["url"]);


function  failed($msg){
	//echo $msg;
	$_SESSION["fail"] = $msg;
	header("Location: http://localhost/presentation/error");
	exit;
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

function uploadImage($target_dir, $id=0){
	
	if (!file_exists($target_dir) && !mkdir($target_dir, 0777, true)) {
		failed("image upload failed : directory can't create");
	}
	
	$imageFileType = pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION);
	$target_file = $target_dir . $id . ".". $imageFileType;
	//echo $target_file . "</br>";
	
	
	// Check if image file is a actual image or fake image
	$check = getimagesize($_FILES["image"]["tmp_name"]);
	if($check == false)  failed("image upload failed : File is not an image");
	
	
	// Check file size
	if ($_FILES["image"]["size"] > 500000)  failed("image upload failed : File size too large");
	
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		failed("image upload failed : Sorry, only JPG, JPEG, PNG & GIF files are allowed");	
	}
	
	// now upload
	if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
		return $id . ".". $imageFileType;
	} else {
		failed("image upload failed : Sorry, there was an error uploading your file");
	}	
}
