<?php
	include '../../Conn.php';

	$query1 = "SELECT * FROM tbl_customeraccount";
	$query2 = "SELECT userID FROM tbl_customeraccount ORDER BY userID DESC LIMIT 1";
	$result1 = mysqli_query($conn, $query1);
	$result2 = mysqli_query($conn, $query2);

	$res = [];

	if (mysqli_num_rows($result1)>0) {
		foreach ($result2 as $value2) {
			array_push($res, $value2);
		}
		echo json_encode($res);
	}else{
		echo "no cust";
	}
?>