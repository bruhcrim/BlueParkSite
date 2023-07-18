<?php

session_start();

// Define database and user details
$servername = "rds-mysql-bluepark.ckcalsncefzg.us-west-1.rds.amazonaws.com";
$dbname = "Bluepark";
$username = "login";
$dbpassword = "";

// Create connection
$conn = new mysqli($servername, $username, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ( !isset($_POST["email"], $_POST["password"])) {
        exit('Please fill email and password fields!');
    }

    //Look for entered email
    if ($stmt = $conn->prepare('SELECT ID, password FROM users WHERE email = ?')) {
        $stmt->bind_param('s', $_POST["email"]);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password);
            $stmt->fetch();

            //verify if password is correct
            if (password_verify($_POST['password'], $password)) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['email'];
                $_SESSION['ID'] = $id;
                echo 'Welcome ' . $_SESSION['name'] . '!';
                header("Location: ../readDB.php");
            } else {
                echo 'Incorrect password';
            }
        } else {
            echo 'Incorrect email';
        }
        $stmt->close();
    }
}

// Close connection
$conn->close();
?>

