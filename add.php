<?php
   	include("connect.php");
   	
   	$link=Connection();

	$temperature=$_POST["Temperature"];
	$pressure=$_POST["Pressure"];
	$altitude=$_POST["Altitude"];

	$query = "INSERT INTO `Sensoren Tabel` (`temperature`, `pressure`, `altitude`) 
		VALUES ('".$temperature."','".$pressure."','".$altitude."')"; 
   	
   	mysql_query($query,$link);
	mysql_close($link);

   	header("Location: index.php");
?>
