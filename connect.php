<?php
$username = "student_11903685";
$password = "AQ4tcJWTm3lo";
$hostname = "localhost";  

// Create connection
$conn = mysqli_connect($hostname , $username, $password);
$selected = mysql_select_db("Sensor Tabel", $conn);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}
    echo "Connected successfully";
?>