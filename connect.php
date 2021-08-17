<?php
$servername = "localhost";
$username = "student_11903685";
$password = "AQ4tcJWTm3lo";
$dbname = "student_11903685";  

// Create connection
$conn = new mysqli($servername,$username,$password,$dbname);

// Check connection
if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
}
?>