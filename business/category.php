<?php

// $_POST = ["id"=>"1"];
// $url = 'http://localhost/business/category/get_category';

function get_category($data){
	$id = $data["id"];
	echo jsonSend("get_item/Category/$id");
}

// $url = 'http://localhost/business/category/get_category';

function get_additional_info($id){
	echo jsonSend("get_specific/Category/", ["id" => $id, "ret1" => "additional_info"]);
}

// $_POST = ["id"=>"1"];
// $url = 'http://localhost/business/category/get_category_name';
function get_category_name($data){
	$id = $data["id"];
	echo jsonSend("get_specific/Category/", ["id" => $id, "ret1" => "name"]);
}

// $url = 'http://localhost/business/category/get_all_category';
function get_all_category(){
	echo jsonSend("get_all/Category", ["ret1" => "id", "ret2" => "name"]);
}

// $url = 'http://localhost/business/category/get_child_category';
function get_child_category($data){
	//echo "called";
	$ret = jsonSend("get_specific/Category/", ["id" => $data["id"], "ret1" => "id", "ret2" => "name"]);
	$ret = json_decode($ret, true);
	
	if(isset($ret["fail"])){
		$ret = [["id" => $data["id"], "name"=> "No Category"]];
	}
	else{
		$ret = [$ret];
		$tmp = jsonSend("get_specific/Category/", ["parent_id" => $data["id"], "ret1" => "id", "ret2" => "name"]);
		$tmp = json_decode($tmp, true);
		if(!isset($tmp["fail"]) && count(tmp) > 0){
			//if(count(tmp) == 1) $tmp = [$tmp];
			foreach ($tmp as $val){
				array_push($ret, $val);
			}
			
		}
	}
	
	
	echo json_encode($ret);
}


// $_POST = ["user_id"=>"1", "password" => "tow", "name" => "c4", "parent" => "c1", "image" => "image"];
// $url = 'http://localhost/business/category/add_category';


function add_category(&$data){
	check_user(1, $data);
	if(get_catagory_id($data, "name") === FALSE){
		//echo "ok";
		// get parent
		if($data["parent"] === ""){
			unset($data["parent"]);
			//print_r($data);
		}
		else{
			$data["parent_id"] = get_catagory_id($data, "parent", TRUE);
			if($data["parent_id"] === FALSE){
				failed("NO SUCH PARENT CATAGORY");
			}
			unset($data["parent"]);
			//print_r($data);
		}
		
		
		//now add catagory
		echo jsonSend("add_item/Category", $data);
	}
	else{
		failed("The Category is already exist");
	}
}

// $_POST = ["user_id"=>"1", "password" => "tow", "old_name" => "c4", "name" => "c5", "parent" => "c3", "image" => "image"];
// $url = 'http://localhost/business/category/update_category';

function update_category(&$data){
	check_user(1, $data);
	// get id
	if($id = get_catagory_id($data, "old_name", TRUE)){
		// check new name
		if(get_catagory_id($data, "name") === FALSE){
			// check parent
			if($data["parent"] === ""){
				unset($data["parent"]);
				//print_r($data);
			}
			else{
				$data["parent_id"] = get_catagory_id($data, "parent", TRUE);
				if($data["parent_id"] === FALSE){
					failed("NO SUCH PARENT CATAGORY");
				}
				unset($data["parent"]);
				//print_r($data);
			}
			// now update
			echo jsonSend("update_item/Category/$id", $data);
		}
		else{
			failed("Choose another name for the catagory");
		}
	}
	else{
		failed("NO SUCH CATAGORY TO UPDATE");
	}
}