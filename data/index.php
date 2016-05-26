<?php
include_once 'handler.php';

$host = "localhost";
$user = "root";
$pass = "root";
$dbName = "ESalesMan";

$json = file_get_contents('php://input') or NULL;
// $json = '{"id":"1","ret1":"password"}';
// failed("data get $json");
$handler = new Handler($host, $user, $pass, $dbName);
$handler->getService($json);

//$jHandler = new jsonHandler($host, $user ,$pass, $dbName);


// $jHandler->service("create_db"); -> success / fail
// $jHandler->service("drop_db"); -> success / fail
// $jHandler->service("add_item", '{"name":"jony","password":"jony","email":"jony@gmail.com"}', "User"); -> success / fail
// $jHandler->service("update_item", '{"name":"rony","password":"rony","email":"rony@gmail.com"}', "User", 1); -> success / fail

// $jHandler->service("get_item", NULL, "User", 1); -> data / fail
// $jHandler->service("get_items", '{"name":"jony"}', "User"); -> data / fail
// $jHandler->service("get_specific", '{"name":"jony", "ret1":"id", "ret2":"name"}', "User"); -> data / fail
// $jHandler->service("drop_items", '{"name":"jony"}', "User"); -> success / fail