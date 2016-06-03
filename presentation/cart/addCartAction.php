<?php
include_once 'action.php';


if($_POST["action"] == "add_item" || $_POST["action"] == "drop_item"){
	$ara = unserialize($_COOKIE["cart"]);
	
	if(isset($ara[$_POST["id"]])){
		if($_POST["action"] == "add_item") $ara[$_POST["id"]]["quantity"]++;
		else{
			$ara[$_POST["id"]]["quantity"]--;
			if($ara[$_POST["id"]]["quantity"] == 0) unset($ara[$_POST["id"]]);
		}
		setcookie("cart", serialize($ara), time()+3600, "/");
	}
	
	header("Location: " . "http://localhost/presentation/cart");
	exit;
}

// echo "OK";
// print_r($_POST);

// save cart in session
$cart = ["id" => $_POST["id"], "name" => $_POST["name"], "quantity" => $_POST["quantity"], "buyit_price" => $_POST["buyit_price"],
"image" => $_POST["image"]];

if($_POST["action"] == "buy_it"){
	$ara = array();
	$ara[$_POST["id"]] = $cart;
// 	echo "add cart: ";
// 	print_r($ara);
	if(isset($_COOKIE["cart"])) setcookie("cart", serialize($ara));
	else setcookie("cart", serialize($ara), time()+3600, "/");
}

else if($cart["quantity"]>0){
	$ara = array();
	if(isset($_COOKIE["cart"])){
		$ara = unserialize($_COOKIE["cart"]);
		if(isset($ara[$_POST["id"]])){
			$ara[$_POST["id"]]["quantity"] += $cart["quantity"];
		}
		else $ara[$_POST["id"]] = $cart;
	}
	else $ara[$_POST["id"]] = $cart;
	//print_r($ara);
	
	setcookie("cart", serialize($ara), time()+3600, "/");
	
	//print_r(unserialize($_COOKIE["cart"]));
}
if($_POST["action"] == "add_to_cart"){
	header("Location: " . "http://localhost/presentation/item?id=" . $_POST["id"]);
	exit;
}

// echo "OK";



