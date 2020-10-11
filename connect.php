<?php
$MyUsername = "student_11903685";
$MyPassword = "AQ4tcJWTm3lo";
$MyHostname = "localhost";  

// Create connection
$conn = mysqli_connect($MyHostname , $MyUsername, $MyPassword);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}
    echo "Connected successfully";
?>