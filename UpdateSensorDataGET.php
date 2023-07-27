<?php

// Define database and user details
$servername = "rds-mysql-bluepark.ckcalsncefzg.us-west-1.rds.amazonaws.com";
$dbname = "Bluepark";
$username = "ESP8266";
$password = "password12345";

// Use HTTP GET request method and get data from it
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $ID = $_GET["ID"];
    $lot_name = $_GET["lot_name"];
    $IsOccupied = $_GET["IsOccupied"];
    $Cost = $_GET["Cost"];

    // Create new mysqli instance
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // Create SQL query with the data recieved
    // INSERT statement
    //$sql = "INSERT INTO parking_data (ID, lot_name, IsOccupied, Cost) VALUES ('".$ID."', '".$lot_name."', '".$IsOccupied."', '".$Cost."')";
    
    // UPDATE statement
    $sql = "UPDATE parking_data SET IsOccupied = $IsOccupied WHERE ID = $ID";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
// If no data send this message
else {
    echo "No data posted with HTTP GET.";
}