<?php
//  $_POST = ["category_id" => $data["category_id"], "name" => $data["name"]
// $url = 'http://localhost/business/product/get_thumbnail';
function get_thumbnail(&$data){
	$ret = jsonSend("get_items/Product", $data);
	echo $ret;
	$ret = json_decode($ret, true);
}

// $_POST = ["id"=>"1"];
// $url = 'http://localhost/business/product/get_product';
function get_product(&$data){
	$id = $data["id"];
	echo jsonSend("get_item/Product/$id");
}

function check_duplicate(&$data){
	
}

// $_POST = ["category_name"=>"c1", "user_id" => "1", "name" => "p1", "min_price" => "10",
// 		"buyit_price" => "20", "quantity" => "5", "image" => "image", "additional_info" => "json"];
// $url = 'http://localhost/business/product/add_product';

function add_product(&$data){
	//echo "ok";
	$data["category_id"] = get_catagory_id($data, "category_name", TRUE);
	
	if($data["category_id"] === FALSE) failed("NO CATAGORY");
	//check_user($data);
	
	check_duplicate($data);
	//print_r($data);
	
	//now add product
	echo jsonSend("add_item/Product", $data);
}

// $_POST = ["id" => 1, "category_name"=>"c4", "user_id" => "1", "name" => "p1", "min_price" => "10",
// 		"buyit_price" => "200", "quantity" => "5", "image" => "image", "additional_info" => "json"];
// $url = 'http://localhost/business/product/update_product';

function update_product(&$data){
	$data["category_id"] = get_catagory_id($data, "category_name", TRUE);
	if($data["category_id"] === FALSE) failed("NO CATAGORY");
	
	//check_owner($data);
	
	$id = $data["id"];
	unset($data["id"]);
	// now update
	echo jsonSend("update_item/Product/$id", $data);
}

function buy(&$data){
	$id = $data["id"];
	unset($data["id"]);
	
	$ret = jsonSend("get_specific/Product/", ["id"=>$id, "ret1" => "quantity"]);
	echo $ret;
	$ret = json_decode($ret, true);
	echo $ret;
	$quantity = $ret["quantity"];
	
	if($quantity > 0){
		$data["quantity"] = $quantity - 1;
		print_r($data);
		echo jsonSend("update_item/Product/$id", $data);
	}
	else{
		failed("STOCK FINISHED");
	}
}

// $_POST = ["user_id" => 1, "best_price" => 100];
// $url = 'http://localhost/business/product/bid';

function bid(&$data){
	$id = $data["id"];
	unset($data["id"]);

	$ret = jsonSend("get_specific/Product/", ["id"=>$id, "ret1" => "quantity"]);
	echo $ret;
	$ret = json_decode($ret, true);
	echo $ret;
	$quantity = $ret["quantity"];

	if($quantity > 0){
		$data["quantity"] = $quantity - 1;
		print_r($data);
		echo jsonSend("update_item/Product/$id", $data);
	}
	else{
		failed("STOCK FINISHED");
	}
}

