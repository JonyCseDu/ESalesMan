<?php
include_once 'common.php';

function check_account($data){
	$ret = jsonSend("get_specific/Cart/", ["id" => $data["transaction_id"], "ret1" => "cost"]);
	$ret = json_decode($ret, true);
	if($ret["cost"] >= $data["cost"]){
		unset($data["cost"]);
	}
	else{
		failed("YOU PAID MINMUM THAN EXPECTED");
	}
}

function processQuantity($data){
	$data = json_decode($data, true);
	
	$quantity = array();
	foreach ($data as $cart){
		$tmp = jsonSend("get_specific/Product", ["id" => $cart["id"], "ret1" => "quantity"]);
		$tmp = json_decode($tmp, true);
		$tmp = $tmp["quantity"];
		
		if($tmp < $cart["quantity"]) failed("Not Enough " . $cart["name"] . " Cart process failed");
		//echo $cart["id"] . " => " . $tmp . " => " . $cart["quantity"] .'</br>';
		array_push($quantity, ["id" => $cart["id"], "quantity" => ($tmp - $cart["quantity"])]);
	}
	
	foreach ($quantity as $val){
		$id = $val["id"];
		jsonSend("update_item/Product/$id", ["quantity" => $val["quantity"]]);
	}
}

// $_POST = ["user_id" => 1, "password"=>"tow", "cost" => 100, "data" => "json"];
// $url = 'http://localhost/business/other/process_cart';

function process_cart($data){
	if(check_user($data["user_id"], $data, TRUE)){
		// update product amount
		processQuantity($data["data"]);
		
		// update credit
		check_credit($data["user_id"], $data["cost"]);
		add_credit($data["user_id"], -$data["cost"]);
	
		$ret = jsonSend("add_item/Cart/", $data);
		$ret = json_decode($ret, true);
		if(isset($ret["success"])) success("cart processing success");
		else failed($ret["fail"]);
	}
	else{
		failed("Verification failed");
	}
}

// $_POST = ["id" => 1];
// $url = 'http://localhost/business/other/get_cart';

function get_cart($data){
	$id = $data["id"];
	echo jsonSend("get_item/Cart/$id");
}

function check_duplicate_transaction($transaction_id){
	$ret = jsonSend("get_specific/Transaction", ["transaction_id" => $transaction_id, "ret1" => "id"]);
	$ret = json_decode($ret, true);
	//print_r($ret);
	if(!$ret["fail"]){
		failed("duplicate");
	}
}

// $_POST = ["user_id" => 1, "password"=>"tow", "transaction_id" => "bkash_1"];
// $url = 'http://localhost/business/other/add_transaction';

function add_transaction($data){
	//print_r($data);
	if(check_user($data["user_id"], $data, TRUE)){
		//echo $transaction_id;
		$ret = jsonSend("get_specific/Transaction", ["transaction_id" => $data["transaction_id"], "ret1" => "cost"]);
		//echo $ret;
		$ret = json_decode($ret, true);
		$cost = $ret["cost"];
		
		if(isset($ret["fail"])) failed("NO SUCH TRANSACTION");
		else{ 
			$ret = jsonSend("drop_items/Transaction",  ["transaction_id" => $data["transaction_id"]]);
			echo $ret;
			$ret = json_decode($ret, true);
			if(isset($ret["fail"])) failed("Error in droping transaction");
		}
		
		$ret = add_credit($data["user_id"], $cost);
		echo json_encode($ret);
	}
	else{
		failed("Verification failed");
	}
}

// $_POST = ["table" => "product", "name"=>"asus"];
// $url = 'http://localhost/business/other/search_name';

function search_name($data){
	$table = $data["table"];
	unset($data["table"]);
	echo jsonSend("search_name/$table/", $data);
}

function get_notification($data){
	$ret = jsonSend("get_specific/Notification",  ["user_id" => $data["user_id"]]);
	echo $ret;
}

function drop_notification($data){
// 	echo "drop";
	//print_r($data);
	$id = jsonSend("get_specific/Notification",  ["user_id" => $data["user_id"], "product_id" => $data["product_id"], "ret1" => "id"]);
	//echo $id;
	$id = json_decode($id, true);
	if(!isset($id["fail"])){
		$id = $id["id"];
		echo jsonSend("drop_items/Notification",  ["id" => $id]);
	}
	
}

function send_notification($data){
	//print_r($data);
	if(isset($data["product_id"])){
		$ret = jsonSend("get_specific/Notification",  ["user_id" => $data["user_id"], "product_id" => $data["product_id"], "ret1" => "id"]);
		//echo $ret;
		$ret = json_decode($ret, true);
		if(!isset($ret["fail"])){
			failed("already send");
		}
	}
	echo jsonSend("add_item/Notification",  $data);
}

function get_code($data){
	//print_r($data);
	$ret = jsonSend("get_specific/Verify",  ["hash" => $data["hash"], "ret1" => "email"]);
	$ret = json_decode($ret, true);
	if(isset($ret["fail"])){
		failed("NO such hash");
	}
	else{
		echo json_encode(["email" => $ret["email"]]);
	}
}

function new_code($data){
	$hash = md5($data["email"]);
	$ret = jsonSend("add_item/Verify",  ["email"=>$data["email"], "hash" => $hash]);
	//echo $ret;
	$ret = json_decode($ret, true);
	if(!isset($ret["fail"])){
		echo json_encode(["hash" => $hash]);
	}
	else failed("Email verify failed");
}

