<?php
function getUserIP() {
    if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
            $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($addr[0]);
        } else {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
$IP = getUserIP();

$servername = "localhost";
$username = "student_11903685";
$password = "AQ4tcJWTm3lo";
$dbname = "student_11903685";

// Create connection
$conn = new mysqli($servername,$username,$password,$dbname);

//insert into database
if(!empty($_POST)) {
  date_default_timezone_set('Europe/Brussels');
 $dateS = date('m/d/Y h:i:s', time());
 $temp = $_POST['Temperature'];
 $hum = $_POST['Humidity'];
 mysqli_query($conn, "insert into Data_Tabel (sensorID, Value,IP adress) values ('1', '$temp','$IP')");
 mysqli_query($conn, "insert into Data_Tabel (sensorID, Value,IP adress) values ('2', '$hum','$IP')");


echo "data is toegevoegd aan de database:";
 echo "datum : ".$dateS."</br>";
 echo "temperatuur : ".$temp."°C</br>";
 echo "vochtigheid : ".$hum."%</br>";
 echo "IP adress : ".$IP."%</br>";
}
?>