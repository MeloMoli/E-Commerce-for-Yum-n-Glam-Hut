<?php
	include '../../Conn.php';

	$userID = $_POST['userID'];
	$orderID = $_POST['orderID'];

	$query1 = "SELECT * FROM tbl_ordernum WHERE userID = '".$userID."' AND orderID ='".$orderID."'";
	$result1 = mysqli_query($conn, $query1);
	$query2 = "SELECT * FROM tbl_shippingdetails WHERE userID = '".$userID."' AND orderID = '".$orderID."'";
	$result2 = mysqli_query($conn, $query2);
	$res = [];
	if(mysqli_num_rows($result1)>0){
		foreach($result1 as $value1){
			foreach ($result2 as $value2) {
				$result = array_merge($value1, $value2);
				array_push($res, $result);
			}
			
		}
		echo json_encode($res);
	}
?>