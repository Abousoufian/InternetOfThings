<?php

// Connect to MySQL
include("connect.php");

$sql1 = "SELECT Sensoren_Tabel.SensorName, Data_Tabel.Value,  Data_Tabel.Time FROM Sensoren_Tabel JOIN Data_Tabel ON Sensoren_Tabel.ID = Data_Tabel.sensorID WHERE Sensoren_Tabel.SensorName = 'Temperature' ";
$sql2 = "SELECT Sensoren_Tabel.SensorName, Data_Tabel.Value,  Data_Tabel.Time FROM Sensoren_Tabel JOIN Data_Tabel ON Sensoren_Tabel.ID = Data_Tabel.sensorID WHERE Sensoren_Tabel.SensorName = 'Humidity' ";

$result1 = mysqli_query($conn,$sql1);
$result2 = mysqli_query($conn,$sql2);

while ($data1 = mysqli_fetch_array($result1))
{
		$temp[] = $data1['Value'];
		$datum[] = $data1['Time'];
}

while ($data2 = mysqli_fetch_array($result2))
{
		$hum[] = $data2['Value'];
}

mysqli_close($conn);

$json = array('datum' => $datum, 'temp' => $temp, 'hum' => $hum);

echo json_encode($json);
?>