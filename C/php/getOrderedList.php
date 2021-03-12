<?php
	include '../../Conn.php';

	$orderID = $_POST['orderID'];
	$userID = $_POST['userID'];

	$query1 = "SELECT prodID, qty FROM tbl_orderlist WHERE orderID = '".$orderID."'";
	$result1 = mysqli_query($conn, $query1);
	$res = [];
	if(mysqli_num_rows($result1)>0){

		foreach($result1 as $value1){
			$query2 = "SELECT * FROM tbl_fooddetails WHERE prodID = '".$value1['prodID']."'";
			$result2 = mysqli_query($conn, $query2);
			if (mysqli_num_rows($result2)>0) {
				foreach($result2 as $value2){
					$query5 = "SELECT * FROM tbl_foodpicture WHERE prodID = '".$value2['prodID']."'";
					$result5 = mysqli_query($conn, $query5);
					foreach ($result5 as $value5) {
						$result = array_merge($value1, $value2, $value5);
						array_push($res, $result);
					}
				}
			}
			
			$query3 = "SELECT * FROM tbl_clothedetails WHERE prodID = '".$value1['prodID']."'";
			$result3 = mysqli_query($conn, $query3);
			if (mysqli_num_rows($result3)>0) {
				foreach($result3 as $value3){
					$query6 = "SELECT * FROM tbl_foodpicture WHERE prodID = '".$value3['prodID']."'";
					$result6 = mysqli_query($conn, $query6);
					foreach ($result6 as $value6) {
						$result = array_merge($value1, $value3, $value6);
						array_push($res, $result);
					}
				}
			}
			
			$query4 = "SELECT * FROM tbl_cosmeticdetails WHERE prodID = '".$value1['prodID']."'";
			$result4 = mysqli_query($conn, $query4);
			if (mysqli_num_rows($result4)>0) {
				foreach($result4 as $value4){
					$query7 = "SELECT * FROM tbl_foodpicture WHERE prodID = '".$value4['prodID']."'";
					$result7 = mysqli_query($conn, $query7);
					foreach ($result7 as $value7) {
						$result = array_merge($value1, $value4, $value7);
						array_push($res, $result);
					}
				}
			}
			
		}
		echo json_encode($res);
	}
?>	