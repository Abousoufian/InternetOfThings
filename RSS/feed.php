<?php
	
	// Connect to MySQL
    include("connect.php");
	
	$title = ["lastest value","average in 24h","minimum value","maximum value"];
		
	$stmtMM = $conn->prepare("Select MIN(Value), MAX(Value) FROM Data_Tabel Where SensorID = ?");
	$stmtAVG = $conn->prepare("Select FORMAT(AVG(Value),2) From Data_Tabel WHERE Time >= now() - INTERVAL 1 DAY AND SensorID = ?");
	$stmtLAST = $conn->prepare("Select Value From Data_Tabel WHERE SensorID = ? ORDER BY Time DESC LIMIT 1");
	$stmtNAME = $conn->prepare("Select Name FROM Sensoren_Tabel WHERE ID = ?");
	
	$stmtMM->bind_param('i',$i);
	$stmtAVG->bind_param('i',$i);
	$stmtLAST->bind_param('i',$i);
	$stmtNAME->bind_param('i',$i);
	
	header( "Content-type: text/xml");
	
	echo "<?xml version='1.0' encoding='UTF-8'?>
	<rss version='2.0'>
    
	<channel>
	<title>Sensor Statistics</title>
	<link>$link</link>
	<description>RSS feed Internet of Things</description>";
	
	for($i = 1; $i < 4; $i ++)
	{
		$stmtMM->execute();
		$stmtMM->store_result();
		$stmtMM->bind_result($value[2], $value[3]);
		$stmtMM->fetch();

		$stmtAVG->execute();
		$stmtAVG->store_result();	
		$stmtAVG->bind_result($value[1]);
		$stmtAVG->fetch();
		
		$stmtLAST->execute();
		$stmtLAST->store_result();
		$stmtLAST->bind_result($value[0]);
		$stmtLAST->fetch();
		
		$stmtNAME->execute();
		$stmtNAME->store_result();
		$stmtNAME->bind_result($name);
		$stmtNAME->fetch();
		
		for ($j = 0; $j < 4; $j++)
		{
			echo "<item>
						<category> $name </category>
						<title> $title[$j] </title>
						<link>$link</link>
						<description>$value[$j]</description>
					</item>";
		}
	}
	echo "</channel></rss>"; 
	
	$stmtMM->close();
	$stmtAVG->close();
	$stmtLAST->close();
	
	$conn->close();
?>