
<?php
    // Connect to MySQL
    include("connect.php");

    //mysqli_query($conn, "insert into sensTest (temperature, humidity) values ('".$_GET["temp"]."','".$_GET["hum"]."')");
    mysqli_query($conn, "insert into Data_Tabel (sensorID, Value) values ('1', '".$_GET["temp"]."')");
    mysqli_query($conn, "insert into Data_Tabel (sensorID, Value) values ('2', '".$_GET["hum"]."')");

?>
