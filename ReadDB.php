<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/dbread.css">
    <link rel="icon" href="img/bluepark-logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  </head>
  <body>

  <header>
    <a href="index.html"><img src="img/bluepark-logo.png" class="logo"></a>
        <ul>
            <li><a href="index.html#home">HOME</a></li>
            <li><a href="index.html#about">THE-TEAM</a></li>
            <li><a href="index.html#contact">CONTACTS</a></li>
      <li><a href="logon/login.html">LOG IN</a></li>
        </ul>
<a href="index.html"><img src="img/bluepark-logo.png" class="logo"></a>
</header>

<?php
// Begin session for user data
session_start();
$servername = "rds-mysql-bluepark.ckcalsncefzg.us-west-1.rds.amazonaws.com";
// REPLACE with your Database name
$dbname = "Bluepark";
// REPLACE with Database user
$username = "Client";
// REPLACE with Database user password
$password = "";

$availableSpaces = 0;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT ID, lot_name, IsOccupied, Cost FROM parking_data ORDER BY ID DESC";

echo '<table cellspacing="5" cellpadding="5">
      <tr> 
        <td>ID</td> 
        <td>Location</td> 
        <td>Occupied</td> 
        <td>Cost</td> 
      </tr>';
 
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_ID = $row["ID"];
        $row_lot_name = $row["lot_name"];
        $row_IsOccupied = $row["IsOccupied"];
        $row_Cost = $row["Cost"];
        // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
      
        // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 4 hours"));
      
        // Count how many spaces are free
        $availableSpaces += $row_IsOccupied;

        // Print table
        echo '<tr> 
                <td>' . $row_ID . '</td> 
                <td>' . $row_lot_name . '</td> 
                <td>' . $row_IsOccupied . '</td> 
                <td>$' . $row_Cost . '</td> 
              </tr>';
    }
    $result->free();

    // Echo title with how many spaces available
    echo '<p style="color: white">Welcome ' . $_SESSION['name'] . '</p>';
    echo "<div><h1>There are currently</h1>";
    echo '<h1 style="color: #0170FE">' . $availableSpaces . '</h1>';
    echo "<h1>free spaces.</h1></div>";
    echo "<hr>";
}

$conn->close();
?> 
</table>
</body>
</html>