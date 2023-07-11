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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare and execute SQL statement
    $sql = "INSERT INTO users (username, email, password)
    VALUES ('".$username."', '".$email."', '".$password."')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// Close connection
$conn->close();
?>

