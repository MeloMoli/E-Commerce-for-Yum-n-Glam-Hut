<?php
	include '../../Conn.php';
	$userID = $_POST['userID'];
	$query1 = "SELECT prodID, qtyProd FROM tbl_cartlist WHERE userID ='".$userID."' AND status ='ChckOut'";
	$result1 = mysqli_query($conn, $query1);
	$res = [];
	if (mysqli_num_rows($result1)>0) {
		foreach ($result1 as $value1) {
			$query2 = "SELECT prodName, prodPrice FROM tbl_fooddetails WHERE prodID ='".$value1['prodID']."'";
			$query3 = "SELECT prodName, prodPrice FROM tbl_clothedetails WHERE prodID ='".$value1['prodID']."'";
			$query4 = "SELECT prodName, prodPrice FROM tbl_cosmeticdetails WHERE prodID ='".$value1['prodID']."'";
			$result2 = mysqli_query($conn, $query2);
			$result3 = mysqli_query($conn, $query3);
			$result4 = mysqli_query($conn, $query4);
			
			if (mysqli_num_rows($result2)>0) {
				foreach ($result2 as $value2) {
					$query5 = "SELECT prodPicture FROM tbl_foodpicture WHERE prodID = '".$value1['prodID']."'";
					$query8 = "SELECT totalStocks FROM tbl_foodsales WHERE prodID ='".$value1['prodID']."' AND totalStocks >= 0";
					$result5 = mysqli_query($conn, $query5);
					$result8 = mysqli_query($conn, $query8);
					if (mysqli_num_rows($result8)>0) {
						foreach($result5 as $value5){
							foreach($result8 as $value8){
								$foodResult = array_merge($value1, $value2, $value5, $value8);
								array_push($res, $foodResult);
							}
						}
						
					}else{
						echo $value2['prodName']." No Stocks left.";
					}
					
				}
			}elseif (mysqli_num_rows($result3)>0) {
				foreach ($result3 as $value3) {
					$query6 = "SELECT prodPicture FROM tbl_clothepicture WHERE prodID = '".$value1['prodID']."'";
					$query9 = "SELECT totalStocks FROM tbl_clothesales WHERE prodID ='".$value1['prodID']."' AND totalStocks >= 0";
					$result6 = mysqli_query($conn, $query6);
					$result9 = mysqli_query($conn, $query9);
					if (mysqli_num_rows($result9)>0) {
						foreach($result6 as $value6){
							foreach($result9 as $value9){
								$clothesResult = array_merge($value1, $value3, $value6, $value9);
								array_push($res, $clothesResult);
							}
						}
						
					}else{
						echo $value3['prodName']." No Stocks left.";
					}
				}
			}elseif (mysqli_num_rows($result4)>0) {
				foreach ($result4 as $value4) {
					$query7 = "SELECT prodPicture FROM tbl_cosmeticpicture WHERE prodID = '".$value1['prodID']."'";
					$query10 = "SELECT totalStocks FROM tbl_cosmeticsales WHERE prodID ='".$value1['prodID']."' AND totalStocks >= 0";
					$result7 = mysqli_query($conn, $query7);
					$result10 = mysqli_query($conn, $query10);
					if (mysqli_num_rows($result10)>0) {
						foreach($result7 as $value7){
							foreach($result10 as $value10){
								$cosmeticsResult = array_merge($value1, $value4, $value7, $value10);
								array_push($res, $cosmeticsResult);
							}
						}
						
					}else{
						echo $value4['prodName']." No Stocks left.";
					}
				}
			}
		}
		echo json_encode($res);
	}


?>