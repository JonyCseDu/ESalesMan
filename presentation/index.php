<?php
//include_once './front/project/home.php';
session_start();
$base = "http://localhost/presentation";

include_once './handler.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);

//echo "hello </br>";
$hadler = new Handler($_GET["_req"]);

forward($base, $hadler->method, $data);

