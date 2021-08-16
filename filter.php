<?php

    // Connect to MySQL
    include("connect.php");

    //disable notification
    //error_reporting(error_reporting() & ~E_NOTICE);

    $filter = $_POST['filter']; 
    $descending = $_POST['descending'];   
    $dateBegin = $_POST['dateBegin'];
    $dateEnd = $_POST['dateEnd'];

    //ascending is automatic enabled when descending is not selected
    if (empty($_POST["descending"])) 
    {
        $descending = "ASC";
    }

    //filter on temperature only
    if (!empty($_POST['filter'])) 
    {     
      if ($_POST['filter'] == "temp") 
      {

        if (!empty($_POST['dateBegin']) and !empty($_POST['dateEnd'])) 
        {
          $sql = "SELECT Sensoren_Tabel.SensorName,  Data_Tabel.Value,  Data_Tabel.Time,  Data_Tabel.IP_adress FROM Sensoren_Tabel JOIN Data_Tabel ON Sensoren_Tabel.ID = Data_Tabel.sensorID WHERE Sensoren_Tabel.SensorName = 'Temperature' AND Data_Tabel.Time >= '".$dateBegin."' AND Data_Tabel.Time <= '".$dateEnd."' ORDER BY Data_Tabel.Time ".$descending." ";
        }
        else
        {
          $sql = "SELECT Sensoren_Tabel.SensorName, Data_Tabel.Value, Data_Tabel.Time, Data_Tabel.IP_adress FROM Sensoren_Tabel JOIN Data_Tabel ON Sensoren_Tabel.ID = Data_Tabel.sensorID WHERE Sensoren_Tabel.SensorName = 'Temperature' ORDER BY Data_Tabel.Time ".$descending." ";
        }

        $result = $conn->query($sql);

        //data is been showed on website
        if ($result->num_rows > 0) 
        {
          echo "<table class='table table-hover table-bordered'><thead><tr><th>sensor type</th><th>Value</th><th>Time</th><th>IP_adress</th></tr></thead><tbody>";

          while ($row = $result->fetch_assoc()) 
          {
            echo "<tr><td>".$row["SensorName"]."</td><td>" . $row["Value"]. "</td><td>" . $row["Time"]. "</td><td>".$row["IP_adress"]."</td></tr>";
          }
          echo "</tbody></table>";
        }

        else 
        {
          echo "0 results (possible error)";
        }
      }

      //filter on humidity only
      elseif ($_POST['filter'] == "hum") 
      {
        if (!empty($_POST['dateBegin']) and !empty($_POST['dateEnd'])) 
        {
          $sql = "SELECT Sensoren_Tabel.SensorName, Data_Tabel.Value, Data_Tabel.Time, Data_Tabel.IP_adress FROM Sensoren_Tabel JOIN Data_Tabel ON Sensoren_Tabel.ID = Data_Tabel.sensorID WHERE Sensoren_Tabel.SensorName = 'Humidity' AND Data_Tabel.Time >= '".$dateBegin."' AND Data_Tabel.Time <= '".$dateEnd."' ORDER BY Data_Tabel.Time ".$descending." ";
        }
        else
        {
          $sql = "SELECT Sensoren_Tabel.SensorName, Data_Tabel.Value, Data_Tabel.Time, Data_Tabel.IP_adress FROM Sensoren_Tabel JOIN Data_Tabel ON Sensoren_Tabel.ID = Data_Tabel.sensorID WHERE Sensoren_Tabel.SensorName = 'Humidity' ORDER BY Data_Tabel.Time ".$descending." ";
        }

        $result = $conn->query($sql);

        //data is been showed on website
        if ($result->num_rows > 0) 
        {
          echo "<table class='table table-hover table-bordered'><thead><tr><th>sensor type</th><th>Value</th><th>datum</th><th>IP adres</th></tr></thead><tbody>";

          while ($row = $result->fetch_assoc()) 
          {
            echo "<tr><td>".$row["SensorName"]."</td><td>" . $row["Value"]. "</td><td>" . $row["Time"]. "</td><td>".$row["IP_adress"]."</td></tr>";
          }
          echo "</tbody></table>";
        }

        else 
        {
          echo "0 results (possible error)";
        }
      }

  }

  //No filter has been choosen
  else 
  {
    if (!empty($_POST['dateBegin']) and !empty($_POST['dateEnd'])) 
    {
      $sql = "SELECT Sensoren_Tabel.SensorName, Data_Tabel.Value, Data_Tabel.Time, Data_Tabel.IP_adress FROM Sensoren_Tabel JOIN Data_Tabel ON Sensoren_Tabel.ID = Data_Tabel.sensorID WHERE Data_Tabel.Time >= '".$dateBegin."' AND Data_Tabel.Time <= '".$dateEnd."' ORDER BY Data_Tabel.Time ".$descending." ";
    }
    else
    {
      $sql = "SELECT Sensoren_Tabel.SensorName, Data_Tabel.Value, Data_Tabel.Time, Data_Tabel.IP_adress FROM Sensoren_Tabel JOIN Data_Tabel ON Sensoren_Tabel.ID = Data_Tabel.sensorID ORDER BY Data_Tabel.Time ".$descending." ";
    }

    $result = $conn->query($sql);

    //data is been showed on website
    if ($result->num_rows > 0) 
    {
      echo "<table class='table table-hover table-bordered'  style='text-align:center;'><thead><tr><th>sensor type</th><th>Value</th><th>Time</th><th>IP_adres</th></tr></thead><tbody>";
      
      while ($row = $result->fetch_assoc()) 
      {
        echo "<tr><td>".$row["SensorName"]."</td><td>" . $row["Value"]. "</td><td>." . $row["Time"]. ".</td><td>".$row["IP_adress"]."</td></tr>";
      }
      echo "</tbody></table>";
    }
    else 
    {
      echo "0 results (possible error)";
    }
  }
?>