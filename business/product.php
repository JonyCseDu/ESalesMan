<?php
//  $_POST = ["category_id" => $data["category_id"], "name" => $data["name"]
// $url = 'http://localhost/business/product/get_thumbnail';
function get_thumbnail($data){
	$ret = get_child_catagory($data["category_id"]);
	$data["category_id"] = "( " . $ret . " )";
	//echo $data["category_id"];
	
	$ret = jsonSend("get_thumbnail/", $data);
	echo $ret;
	//$ret = json_decode($ret, true);
}

function get_child_catagory($id){
	$json = jsonSend("get_specific/Category/", ["parent_id" => $id,"ret1" => id]);
	//echo "OK". $json;
	$json = json_decode($json, true);

	$ret = $id;
	if(isset($json["fail"])) return $ret;
	
	foreach ($json as $val){
		$ret = $ret . ", " . get_child_catagory($val['id']);
	}
	
	//echo $ret;
	return $ret;
}

// $_POST = ["id"=>"1"];
// $url = 'http://localhost/business/product/get_product';
function get_product($data){
	$id = $data["id"];
	echo jsonSend("get_item/Product/$id");
}

// $_POST = ["id"=>"1"];
// $url = 'http://localhost/business/product/get_auction';
function get_auction($data){
	//echo "auction called";
	$id = $data["id"];
	echo jsonSend("get_item/Auction/$id");
}




// $_POST = [""user_id""=>"1", "name"=>"jony"];
// $url = 'http://localhost/business/product/get_product_id';
function get_product_id($data){
	//print_r($data);
	echo jsonSend("get_specific/Product/", ["user_id"=>$data["user_id"], "name"=>$data["name"], "ret1"=>"id"]);
}


// $_POST = ["category_name"=>"c1", "user_id" => "1", "name" => "p1", "min_price" => "10",
// 		"buyit_price" => "20", "quantity" => "5", "image" => "image", "additional_info" => "json"];
// $url = 'http://localhost/business/product/add_product';

function add_product($data){	
	$ret = jsonSend("get_specific/Product/", ["user_id"=>$data["user_id"], "name"=>$data["name"], "ret1"=>"id"]);
	
	//echo "get id returns : " . $ret ."</br>";
	$ret = json_decode($ret, true);
	if(!isset($ret["fail"])) failed("Product already Added");
	
	// separate auction data
	$auction = NULL;
	if($data["type"] == "auction"){
		$auction = ["start_price" => $data["start_price"], "last_date" => $data["last_date"]];
		unset($data["start_price"]);
		unset($data["last_date"]);
	}
	
	//now add product
	$ret = jsonSend("add_item/Product", $data);
	//echo $ret;
	
	if($auction != NULL){
		$product_id = jsonSend("get_specific/Product/", ["user_id"=>$data["user_id"], "name"=>$data["name"], "ret1"=>"id"]);
		$product_id = json_decode($product_id, true);
		$product_id = $product_id["id"];
		$auction["id"] = $product_id;
		//echo "auction :";
		echo jsonSend("add_item/Auction", $auction);
	}
	else echo $ret;
}


// $_POST = ["id" => 1, "category_name"=>"c4", "user_id" => "1", "name" => "p1", "min_price" => "10",
// 		"buyit_price" => "200", "quantity" => "5", "image" => "image", "additional_info" => "json"];
// $url = 'http://localhost/business/product/update_product';

function update_product($data){
	if(isset($data["category_id"])){
		$data["category_id"] = get_catagory_id($data, "category_name", TRUE);
		if($data["category_id"] === FALSE) failed("NO CATAGORY");
	}
	//check_owner($data);
	
	$id = $data["id"];
	unset($data["id"]);
	// now update
	echo jsonSend("update_item/Product/$id", $data);
}

function buy($data){
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


function get_bid($data){
	$ret = jsonSend("get_specific/Price/", ["product_id" => $data["product_id"], "user_id" => $data["user_id"], "ret1" => "bid_price"]);
	echo $ret;
	//$ret = json_decode($ret, true);
}

function get_last_bid_user($data){
	//print_r($data);
	$ret = jsonSend("get_specific/Price/", ["product_id" => $data["product_id"], "bid_price" => $data["last_bid_price"], "ret1" => "user_id"]);
	echo $ret;
	//$ret = json_decode($ret, true);
}

// $_POST = ["product_id" => 1, "user_id" => 1, "bid_price" => 100];
// $url = 'http://localhost/business/product/bid';

function bid($data){
	$ret = jsonSend("get_specific/Price/", ["product_id" => $data["product_id"], "user_id" => $data["user_id"], "ret1" => "bid_price"]);
	//echo $ret;
	$ret = json_decode($ret, true);
	
	// users first bid
	if(isset($ret["fail"])){
		$ret = jsonSend('add_item/Price/', $data);
	}
	else{
		//print_r($data);
		$ret = jsonSend('update_bid/Price/', $data);
	}
	$ret = json_decode($ret, true);
	if(isset($ret["success"])){
		$ret = jsonSend('get_specific/Auction', ["id" => $data["product_id"], "ret1"=>"num_of_bids"]);
		$ret = json_decode($ret, true);
		$ret = $ret["num_of_bids"]+1;
		//echo $ret;
		echo jsonSend('update_item/Auction/'. $data["product_id"], ["num_of_bids" => $ret, "last_bid_price"=>$data["bid_price"]]);
	}
	else failed($ret["fail"]);
	
}

