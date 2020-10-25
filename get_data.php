<?php 
$MyUsername = "student_11903685";
$MyPassword = "AQ4tcJWTm3lo";
$MyHostname = "localhost";

$conn = mysqli_connect($MyHostname , $MyUsername, $MyPassword);
$sql = "SELECT * FROM DHT11";

$result = mysqli_query($connect, $sql);

$date = array();
$temp = array();
$hum = array();

while( $data = mysqli_fetch_array($result) ) { 

	$datum[] = $data['date'];
	$temp[] = $data['temperature']; 
	$hum[] = $data['humidity'];
	
}

mysqli_close($connect);

$json = array('datum' => $datum, 'temp' => $temp, 'hum' => $hum);

echo json_encode($json);

?>