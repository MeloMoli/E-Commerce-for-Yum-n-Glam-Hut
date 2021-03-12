<?php
	include '../../Conn.php';

	$query1 = "SELECT * FROM tbl_orderstatus";
	$result1 = mysqli_query($conn, $query1);
	$res = [];
	if(mysqli_num_rows($result1)>0){
		foreach($result1 as $value1){
			$query2 = "SELECT * FROM tbl_ordernum WHERE orderID = '".$value1['orderID']."'";
			$result2 = mysqli_query($conn, $query2);
			foreach($result2 as $value2){
				$result = array_merge($value1, $value2);
				array_push($res, $result);
			}
		}
		echo json_encode($res);
	}
?>