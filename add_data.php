
<?php

    // Connect to MySQL
    include("connect.php");
    $ID = $_GET["ID"];
    $Value = $_GET["Value"];
    $Ip_addr= $_GET["IP_adress"];
    //insert data in database
    mysqli_query($conn, "insert into Data_Tabel (sensorID, Value, IP_adress) values ('$ID', '$Value', '$Ip_addr')");
?>
