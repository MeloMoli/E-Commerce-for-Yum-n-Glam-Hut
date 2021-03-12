<?php
	include '../../Conn.php';
	$query1 = "SELECT * FROM tbl_foodextradetails WHERE remarks = 'feat'";
	$query2 = "SELECT * FROM tbl_cosmeticsextradetails WHERE remarks = 'feat'";
	$query3 = "SELECT * FROM tbl_clothesextradetails WHERE remarks = 'feat'";

	$
	$result = mysqli_query($conn, $query);
	$r = [];
	if (mysqli_num_rows($result) > 0) {
		foreach ($result as $value) {
			array_push($r, $value);
		}
		echo json_encode($r);
	}
?>