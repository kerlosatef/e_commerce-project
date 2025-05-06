<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "e_commerce";

$connection = new mysqli($servername, $username, $password, $dbname, 3307); // قم بتحديد المنفذ 3307

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>