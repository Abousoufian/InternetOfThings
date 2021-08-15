
<?php
	//connecting
	$connect = mysqli_connect("localhost","student_11903685","AQ4tcJWTm3lo","student_11903685");
	$query = "SELECT * FROM sensTest ORDER BY id desc";
	$result = mysqli_query($mysqli, $query);
	//output
	$output = '';
	$output .= '<div id="table-header" style="max-width:100%; height:50px;" ><h1 id="table-interface" style:"padding10px;" >tabel</h1></div>';
	$output .= "
		<table class='table table-bordered'>
			<tr>
				<th width='5%'>ID</th>
				<th width='55%'>DATUM</th>
				<th width='20%'>TEMPERATUUR</th>
				<th width='20%'>VOCHTIGHEID</th>
			</tr>
	";
	while( $row = mysqli_fetch_array($result) ) {

				$output .= "
					<tr>
				<td>  {$row['ID']}  </td>
				<td>  {$row['Time']}  </td>
				<td>  {$row['Temperature']}  </td>
				<td>  {$row['Humidity']}  </td>
					</tr>
		";
	}
	$output .= '</table>';
	echo $output;
?>