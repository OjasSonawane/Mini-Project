<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "modern_eats";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database,3307);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
echo "Connected successfully!";

?>
