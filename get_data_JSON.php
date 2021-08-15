<?php

$connect = mysqli_connect("localhost","student_11903685","AQ4tcJWTm3lo","student_11903685");
$sql1 = "SELECT Sensoren Tabel.sensorName, Data_Tabel.Value,  Data_Tabel.Time FROM Sensoren Tabel JOIN Data_Tabel ON Sensoren Tabel.ID = Data_Tabel.sensorID WHERE Sensoren Tabel.sensorName = 'Temperature' ";
$sql2 = "SELECT Sensoren Tabel.sensorName Data_Tabel.Value,  Data_Tabel.Time FROM Sensoren Tabel JOIN Data_Tabel ON Sensoren Tabel.ID = Data_Tabel.sensorID WHERE Sensoren Tabel.sensorName = 'Humidity' ";

$result1 = mysqli_query($connect,$sql1);
$result2 = mysqli_query($connect,$sql2);

while ($data1 = mysqli_fetch_array($result1) ) {
		$temp[] = $data1['Value'];
		$datum[] = $data1['Time'];
}

while ($data2 = mysqli_fetch_array($result2) ) {
		$hum[] = $data2['Value'];
}


mysqli_close($connect);

$json = array('datum' => $datum, 'temp' => $temp, 'hum' => $hum);


echo json_encode($json);
?>