<?php

// Define database and user details
$servername = "rds-mysql-bluepark.ckcalsncefzg.us-west-1.rds.amazonaws.com";
$dbname = "Bluepark";
$username = "login";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];
    header("Location: ../readDB.php");
}

// Close connection
$conn->close();
?>

