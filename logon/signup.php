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
    // Check if email is already used, if so tell the user and if not continue
    if ($stmt = $conn->prepare('SELECT id, password from users WHERE email = ?')) {
        $stmt->bind_param('s', $_POST["email"]);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo 'Email already used, please use another email address!';
        } else {
            //Create the new user and also hash the password to store in the database
            if ($stmt = $conn->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)')) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->bind_param ('sss', $_POST['username'], $password, $_POST['email']);
                $stmt->execute();
                // Send user back to login page
                header("Location: login.html");
            } else {
                echo 'Could not prepare statement!';
            }
        }
    }
}
// Close connection
$conn->close();
?>

