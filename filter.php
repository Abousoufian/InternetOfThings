<?php
    // Connect to MySQL
    include("connect.php");

    //disable notification
    //error_reporting(error_reporting() & ~E_NOTICE);

    $filter = $_POST['filter'];   //filter om de kolom te kiezen
    $descending = $_POST['descending'];   //asencding of descending ordenen (staat nu op ID)
    $dateBegin = $_POST['dateBegin'];
    $dateEnd = $_POST['dateEnd'];

    //als descendingending niet is aangevinkt standaard op ascending zetten
    if (empty($_POST["descending"])) {
        $descending = "ASC";
    }

    if (!empty($_POST['filter'])) 
    {     //kijkt als data verstuurt is
      //als temperatuur is gekozen enkel de temp en de id tonen
      if ($_POST['filter'] == "temp") 
      {

        if (!empty($_POST['dateBegin']) and !empty($_POST['dateEnd'])) 
        {
          //$sql = "SELECT ID,Temperature,date FROM sensTest WHERE date >= '".$dateBegin."' AND date <= '".$dateEnd."' ORDER BY ID ".$descending."";
          $sql = "SELECT Sensoren Tabel.sensorName,  Data_Tabel.Value,  Data_Tabel.Time,  Data_Tabel.IP adress FROM Sensoren Tabel JOIN Data_Tabel ON Sensoren Tabel.ID = Data_Tabel.sensorID WHERE Sensoren Tabel.sensorName = 'Temperature' Data_Tabel.Time >= '".$dateBegin."' AND Data_Tabel.Time <= '".$dateEnd."' ORDER BY Data_Tabel.Time ".$descending." ";
        }
        else
        {
          //$sql = "SELECT ID,Temperature,date FROM sensTest ORDER BY ID ".$descending."";
          $sql = "SELECT Sensoren Tabel.sensorName, Data_Tabel.Value, Data_Tabel.Time, Data_Tabel.IP adress FROM Sensoren Tabel JOIN Data_Tabel ON Sensoren Tabel.ID = sensor_data.sensorID WHERE Sensoren Tabel.sensorName = 'Temperature' ORDER BY Data_Tabel.Time ".$descending." ";
        }

        $result = $conn->query($sql);
        //print de data
        if ($result->num_rows > 0) 
        {
          echo "<table class='table table-hover table-bordered'><thead><tr><th>sensor type</th><th>waarde</th><th>datum</th><th>IP adres</th></tr></thead><tbody>";

          while ($row = $result->fetch_assoc()) 
          {
            echo "<tr><td>".$row["sensNaam"]."</td><td>" . $row["waarde"]. "</td><td>" . $row["date"]. "</td><td>".$row["IP"]."</td></tr>";
          }
          echo "</tbody></table>";
        }

        else {
          echo "0 results (possible error)";
        }
      }
      //als er gekozen wordt voor vochtigheid
      elseif ($_POST['filter'] == "hum") {
        if (!empty($_POST['dateBegin']) and !empty($_POST['dateEnd'])) {
          //$sql = "SELECT ID,Humidity,date FROM sensTest WHERE date >= '".$dateBegin."' AND date <= '".$dateEnd."' ORDER BY ID ".$descending."";
          $sql = "SELECT Sensoren Tabel.sensorName, Data_Tabel.Value, Data_Tabel.Time, Data_Tabel.IP adress FROM Sensoren Tabel JOIN Data_Tabel ON Sensoren Tabel.ID = sensor_data.sensorID WHERE Sensoren Tabel.sensorName = 'Humidity' Data_Tabel.Time >= '".$dateBegin."' AND Data_Tabel.Time <= '".$dateEnd."' ORDER BY Data_Tabel.Time ".$descending." ";
        }
        else{
          //$sql = "SELECT ID,Humidity,date FROM sensTest ORDER BY ID ".$descending."";
          $sql = "SELECT Sensoren Tabel.sensorName, Data_Tabel.Value, Data_Tabel.Time, Data_Tabel.IP adress FROM Sensoren Tabel JOIN Data_Tabel ON Sensoren Tabel.ID = sensor_data.sensorID WHERE Sensoren Tabel.sensorName = 'Humidity' ORDER BY Data_Tabel.Time ".$descending." ";
        }
        $result = $conn->query($sql);
        //print de tabel
        if ($result->num_rows > 0) {
          echo "<table class='table table-hover table-bordered'><thead><tr><th>sensor type</th><th>waarde</th><th>datum</th><th>IP adres</th></tr></thead><tbody>";

          while ($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["sensNaam"]."</td><td>" . $row["waarde"]. "</td><td>" . $row["date"]. "</td><td>".$row["IP"]."</td></tr>";
          }
          echo "</tbody></table>";
        }

        else {
          echo "0 results (possible error)";
        }
      }

  }

  //als er geen filter is gekozen
  else {
    if (!empty($_POST['date1']) and !empty($_POST['dateEnd'])) {
      //$sql = "SELECT * FROM sensTest WHERE date >= '".$dateBegin."' AND date <= '".$dateEnd."' ORDER BY ID ".$descending."";
      $sql = "SELECT Sensoren Tabel.sensorName, Data_Tabel.Value, Data_Tabel.Time, Data_Tabel.IP adress FROM Sensoren Tabel JOIN Data_Tabel ON Sensoren Tabel.ID = sensor_data.sensorID WHERE Data_Tabel.Time >= '".$dateBegin."' AND Data_Tabel.Time <= '".$dateEnd."' ORDER BY Data_Tabel.Time ".$descending." ";
    }
    else{
      $sql = "SELECT Sensoren Tabel.sensorName, Data_Tabel.Value, Data_Tabel.Time, Data_Tabel.IP adress FROM Sensoren Tabel JOIN Data_Tabel ON Sensoren Tabel.ID = sensor_data.sensorID ORDER BY Data_Tabel.Time ".$descending." ";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<table class='table table-hover table-bordered'  style='text-align:center;'><thead><tr><th>sensor type</th><th>waarde</th><th>date</th><th>IP adres</th></tr></thead><tbody>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["Sensoren Tabel.sensorName"]."</td><td>" . $row["waarde"]. "</td><td>." . $row["date"]. ".</td><td>".$row["IP"]."</td></tr>";
      }
      echo "</tbody></table>";
    }
    else {
      echo "0 results (possible error)";
    }
  }

//$sql = "SELECT * FROM sensTest WHERE date >= '".$dateBegin."' AND date <= '".$dateEnd."' ORDER BY ID ".$descending."";

?>