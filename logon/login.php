<?php

// Define database and user details
$servername = "rds-mysql-bluepark.ckcalsncefzg.us-west-1.rds.amazonaws.com";
$dbname = "Bluepark";
$username = "ESP8266";
$password = "password12345";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Close connection
$conn->close();
?>

