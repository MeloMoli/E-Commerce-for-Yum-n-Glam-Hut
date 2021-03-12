<?php
	include '../../Conn.php';

	$userID = $_POST['userID'];

	
	$query2 = "SELECT * FROM tbl_ordernum WHERE userID = '".$userID."'";
	
	
	$result2 = mysqli_query($conn, $query2);
	
	$res = [];
	if(mysqli_num_rows($result2)>0){
		foreach ($result2 as $value2) {
			$query1 = "SELECT * FROM tbl_orderstatus WHERE orderID = '".$value2['orderID']."'";
			$query3 = "SELECT * FROM tbl_orderlist WHERE orderID = '".$value2['orderID']."'";
			$query4 = "SELECT * FROM tbl_paymentstatus WHERE orderID = '".$value2['orderID']."'";
			$result1 = mysqli_query($conn, $query1);
			$result3 = mysqli_query($conn, $query3);
			$result4 = mysqli_query($conn, $query4);
			foreach ($result1 as $value1) {
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