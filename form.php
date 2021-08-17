<?php

// Connect to MySQL
include("connect.php");

function getUserIP() 
{
    if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0)
        {
            $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($addr[0]);
        } 
        else 
        {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    else 
    {
        return $_SERVER['REMOTE_ADDR'];
    }
}

$IP = getUserIP();

//insert into database
if(!empty($_POST)) 
{
    date_default_timezone_set('Europe/Brussels');
    $dateS = date('m/d/Y h:i:s', time());
    $temp = $_POST['Temperature'];
    $hum = $_POST['Humidity'];
    mysqli_query($conn, "insert into Data_Tabel (sensorID, Value,IP_adress) values ('1', '$temp','$IP')");
    mysqli_query($conn, "insert into Data_Tabel (sensorID, Value,IP_adress) values ('2', '$hum','$IP')");

    echo "data is added in database:";
    echo "<br>";
    echo "Time stamp : ".$dateS."</br>";
    echo "Temperature : ".$temp."°C</br>";
    echo "Humidity : ".$hum."%</br>";
    echo "IP adress : ".$IP."%</br>";
}
?>