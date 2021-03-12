<?php
	include '../../Conn.php';
	$userID = $_POST['userID'];
	$ncr = ['Caloocan City', 'Las Pinas City', 'Las Piñas City', 'Makati City', 'Malabon City', 'Mandaluyong City', 'Manila City', 'Marikina City', 'Muntinlupa City', 'Navotas City', 'Paranaque City', 'Parañaque City', 'Pasay City', 'Pasig City', 'Pateros City', 'Quezon City', 'San Juan City', 'Taguig City', 'Valenzuela City'];
	$clbrzn = ['Batangas City', 'Cavite City', 'Laguna City', 'Quezon City', 'Rizal City', 'Lucena City'];
	$query1 = "SELECT city FROM tbl_customeraddress2 WHERE userID = '".$userID."'";
	$result1 = mysqli_query($conn, $query1);
	if(mysqli_num_rows($result1)>0){
		foreach($result1 as $value1){
			if (in_array($value1['city'], $ncr)){
				echo "ncr";
			}elseif (in_array($value1['city'], $clbrzn)){
				echo "clbrzn";
			}
		}
	}
	
?>