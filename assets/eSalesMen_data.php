<?php

$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "ESalesMen";

$json = ["Description"];
$json = json_encode($json);

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($conn == false) {
    die("Connection failed: " . $conn->connect_error);
}
else{
	echo "connected";
}

$sql = "INSERT INTO Category(name) VALUES ('All Category')";

if ($conn->query($sql) === TRUE) {
    echo "OK <br>";
} else {
    echo "Error: " . $sql . " -> " . $conn->error . "<br>";
}

$sql = "INSERT INTO Category(name, parent_id, additional_info) VALUES ('Electronics', 1, '$json')";

if ($conn->query($sql) === TRUE) {
    echo "OK <br>";
} else {
    echo "Error: " . $sql . " -> " . $conn->error . "<br>";
}

$sql = "INSERT INTO Category(name, parent_id, additional_info) VALUES ('Food', 1, '$json')";

if ($conn->query($sql) === TRUE) {
    echo "OK <br>";
} else {
    echo "Error: " . $sql . " -> " . $conn->error . "<br>";
}

$sql = "INSERT INTO Category(name, parent_id, additional_info) VALUES ('Cloth', 1, '$json')";

if ($conn->query($sql) === TRUE) {
    echo "OK <br>";
} else {
    echo "Error: " . $sql . " -> " . $conn->error . "<br>";
}

$sql = "INSERT INTO Category(name, parent_id, additional_info) VALUES ('Property', 1, '$json')";

if ($conn->query($sql) === TRUE) {
    echo "OK <br>";
} else {
    echo "Error: " . $sql . " -> " . $conn->error . "<br>";
}

$sql = "INSERT INTO Category(name, parent_id, additional_info) VALUES ('Sporting Good', 1, '$json')";

if ($conn->query($sql) === TRUE) {
    echo "OK <br>";
} else {
    echo "Error: " . $sql . " -> " . $conn->error . "<br>";
}

$sql = "INSERT INTO Category(name, parent_id, additional_info) VALUES ('Everything Else', 1, '$json')";

if ($conn->query($sql) === TRUE) {
    echo "OK <br>";
} else {
    echo "Error: " . $sql . " -> " . $conn->error . "<br>";
}




$json = ["Processor", "Ram", "GPU",  "Screen Size", "Resulation", "Color", "Vendor"];
$json = json_encode($json);

$sql = "INSERT INTO Category(name, parent_id, additional_info) VALUES ('Smart Phone', 2, '$json')";

if ($conn->query($sql) === TRUE) {
    echo "OK <br>";
} else {
    echo "Error: " . $sql . " -> " . $conn->error . "<br>";
}



$sql = "INSERT INTO Category(name, parent_id, additional_info) VALUES ('Laptop', 2, '$json')";

if ($conn->query($sql) === TRUE) {
    echo "OK <br>";
} else {
    echo "Error: " . $sql . " -> " . $conn->error . "<br>";
}


$sql = "INSERT INTO Category(name, parent_id, additional_info) VALUES ('Note Book', 2, '$json')";

if ($conn->query($sql) === TRUE) {
    echo "OK <br>";
} else {
    echo "Error: " . $sql . " -> " . $conn->error . "<br>";
}

$conn->close();

