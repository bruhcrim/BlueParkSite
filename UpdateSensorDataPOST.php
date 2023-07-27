<?php

// Define database and user details
$servername = "rds-mysql-bluepark.ckcalsncefzg.us-west-1.rds.amazonaws.com";
$dbname = "Bluepark";
$username = "ESP8266";
$password = "password12345";

// Use HTTP GET request method and get data from it
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST["ID"];
    $lot_name = $_POST["lot_name"];
    $IsOccupied1 = $_POST["IsOccupied1"];
    $IsOccupied2 = $_POST["IsOccupied2"];
    $IsOccupied3 = $_POST["IsOccupied3"];
    $Cost = $_POST["Cost"];

    // Create new mysqli instance
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // Create SQL query with the data recieved
    // INSERT statement
    //$sql = "INSERT INTO parking_data (ID, lot_name, IsOccupied1, Cost) VALUES ('".$ID."', '".$lot_name."', '".$IsOccupied1."', '".$Cost."')";
    
    // UPDATE statement
    $sql = "UPDATE parking_data SET IsOccupied = $IsOccupied1 WHERE ID = 1";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "UPDATE parking_data SET IsOccupied = $IsOccupied2 WHERE ID = 2";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "UPDATE parking_data SET IsOccupied = $IsOccupied3 WHERE ID = 3";

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
    echo "No data posted with HTTP POST.";
}