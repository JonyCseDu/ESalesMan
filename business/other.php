<?php
include_once 'common.php';

function check_account(&$data){
	$ret = jsonSend("get_specific/Cart/", ["id" => $data["transaction_id"], "ret1" => "cost"]);
	$ret = json_decode($ret, true);
	if($ret["cost"] >= $data["cost"]){
		unset($data["cost"]);
	}
	else{
		failed("YOU PAID MINMUM THAN EXPECTED");
	}
}

// $_POST = ["user_id" => 1, "password"=>"tow", "cost" => 100, "product_ids" => "json", "quantities" => "json"];
// $url = 'http://localhost/business/other/process_cart';

function process_cart(&$data){
	if(check_user($data["user_id"], $data, TRUE)){
		// check cart with session
		// check and deduce amount
		check_credit($data["user_id"], $data["cost"]);
		add_credit($data["user_id"], -$data["cost"]);
	
		echo jsonSend("add_item/Cart/", $data);
	}
	else{
		failed("Verification failed");
	}
	
	
}

// $_POST = ["id" => 1];
// $url = 'http://localhost/business/other/get_cart';

function get_cart(&$data){
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

// $_POST = ["user_id" => 1, "password"=>"tow", "cost" => 100, "transaction_id" => "bkash_1"];
// $url = 'http://localhost/business/other/add_transaction';

function add_transaction(&$data){
	if(check_user($data["user_id"], $data, TRUE)){
		check_duplicate_transaction($data["transaction_id"]);
		
		$ret = jsonSend("add_item/Transaction/", $data);
		$ret = json_decode($ret, true);
		if($ret["success"]){
			echo "success";
			add_credit($data["user_id"], $data["cost"]);
		}
		else failed($ret["fail"]);
	}
	else{
		failed("Verification failed");
	}
}


function search_name($data){
	$table = $data["table"];
	unset($data["table"]);
	echo jsonSend("search_name/$table/", $data);
}

function get_notification(&$data){
	echo "LOGGED IN </br>";
}

function send_notification(&$data){
	echo "LOGGED IN </br>";
}