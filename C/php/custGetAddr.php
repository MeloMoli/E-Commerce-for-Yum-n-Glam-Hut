<?php
	include '../../Conn.php';

	$userID = $_POST['userID'];

	$query1 = "SELECT * FROM tbl_customeraddress1 WHERE userID = '".$userID."'";
	$query2 = "SELECT * FROM tbl_customeraddress2 WHERE userID = '".$userID."'";
	$query3 = "SELECT cellphone FROM tbl_customerdetails WHERE userID = '".$userID."'";
	$query4 = "SELECT firstName, lastName FROM tbl_customerpersoinfo WHERE userID = '".$userID."'";

	$result1 = mysqli_query($conn, $query1);
	$result2 = mysqli_query($conn, $query2);
	$result3 = mysqli_query($conn, $query3);
	$result4 = mysqli_query($conn, $query4);

	$res = [];
	if(mysqli_num_rows($result1)>0){
		foreach ($result1 as $value1) {
			foreach ($result2 as $value2) {
				foreach ($result3 as $value3) {
					foreach ($result4 as $value4) {
						$result = array_merge($value1, $value2, $value3, $value4);
						array_push($res, $result);
					}
				}
			}
		}
		echo json_encode($res);
	}
?>