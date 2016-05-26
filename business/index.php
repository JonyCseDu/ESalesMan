<?php
session_start();
include_once 'handler.php';


$json = file_get_contents('php://input') or NULL;
//echo "business logic gets : $json </br>";

$handler = new Handler("localhost/data/");
$handler->getService($json);
