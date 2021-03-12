<?php
	include '../../Conn.php';

	$userID = $_POST['userID'];
	$query1 = "SELECT * FROM tbl_customeraccount WHERE userID = '".$userID."'";
	$result1 = mysqli_query($conn, $query1);
	$res = [];

	if(mysqli_num_rows($result1)>0){
		foreach($result1 as $value1){
			array_push($res, $value1);
		}
		echo json_encode($res);
	}
?>