<?php
	include '../../Conn.php';

	$query1 = "SELECT prodID, prodName, prodType, prodDescription, prodPrice FROM tbl_fooddetails WHERE prodType = 'Dessert'";
	$result1 = mysqli_query($conn, $query1);

	$res=[];

	if (mysqli_num_rows($result1)>0) {
		foreach ($result1 as $value1) {
			$query2 = "SELECT prodSales, totalStocks FROM tbl_foodsales WHERE prodID='".$value1['prodID']."'";
			$query3 = "SELECT prodPicture FROM tbl_foodpicture WHERE prodID='".$value1['prodID']."'";
			$query4 = "SELECT suppID FROM tbl_foodextradetail WHERE prodID = '".$value1['prodID']."'";
			$result2 = mysqli_query($conn, $query2);
			$result3 = mysqli_query($conn, $query3);
			$result4 = mysqli_query($conn, $query4);
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