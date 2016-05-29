<?php
include_once 'action.php';
echo "OK";
print_r($_POST);
echo "OK";

// setcookie("cart", "", time()-3600, "/");

$cart = ["name" => $_POST["name"], "quantity" => $_POST["quantity"], "buyit_price" => $_POST["buyit_price"],
"image" => $_POST["image"]];

if($cart["quantity"]>0){
	$ara = array();
	if(isset($_COOKIE["cart"])){
		$ara = unserialize($_COOKIE["cart"]);
		if(isset($ara[$_POST["id"]])){
			$ara[$_POST["id"]]["quantity"] += $cart["quantity"];
		}
		else $ara[$_POST["id"]] = $cart;
	}
	else $ara[$_POST["id"]] = $cart;
	
	setcookie("cart", serialize($ara), time()+3600, "/");
	
	print_r(unserialize($_COOKIE["cart"]));
}

header("Location: " . $_POST["url"]);
exit;


