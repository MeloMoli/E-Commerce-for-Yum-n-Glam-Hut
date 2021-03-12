<?php
	include '../../Conn.php';

	$prodID = $_POST['prodID'];
	$query1 = 'SELECT prodID, prodName, prodType, prodDescription, prodPrice FROM tbl_fooddetails WHERE prodID ="'.$prodID.'"';
	$query2 = 'SELECT prodID, prodName, prodType, prodDescription, prodPrice FROM tbl_clothedetails WHERE prodID ="'.$prodID.'"';
	$query3 = 'SELECT prodID, prodName, prodType, prodDescription, prodPrice FROM tbl_cosmeticdetails WHERE prodID ="'.$prodID.'"';
	

	$result1 = mysqli_query($conn, $query1);
	$result2 = mysqli_query($conn, $query2);
	$result3 = mysqli_query($conn, $query3);
	

	$res=[];

	if (mysqli_num_rows($result1)>0) {
		foreach ($result1 as $value1) {
			$query4 = "SELECT prodSales, totalStocks FROM tbl_foodsales WHERE prodID='".$value1['prodID']."'";
			$query5 = "SELECT prodPicture FROM tbl_foodpicture WHERE prodID='".$value1['prodID']."'";
			$query20 = "SELECT remarks FROM tbl_foodbatch WHERE prodID='".$value1['prodID']."'";
			$result4 = mysqli_query($conn, $query4);
			$result5 = mysqli_query($conn, $query5);
			$result20 = mysqli_query($conn, $query20);
			foreach ($result4 as $value4) {
				foreach ($result5 as $value5) {
					foreach ($result20 as $value20) {
						$resultOne = array_merge($value1, $value4, $value5, $value20);
						array_push($res, $resultOne);
					}
				}
			}
		}

		echo json_encode($res);
	}elseif (mysqli_num_rows($result2)>0) {
		foreach ($result2 as $value2) {
			$query6 = "SELECT prodSales, totalStocks FROM tbl_clothesales WHERE prodID='".$value1['prodID']."'";
			$query7 = "SELECT prodPicture FROM tbl_clothepicture WHERE prodID='".$value1['prodID']."'";
			$result6 = mysqli_query($conn, $query6);
			$result7 = mysqli_query($conn, $query7);
			foreach ($result6 as $value6) {
				foreach ($result7 as $value7) {
					$resultTwo = array_merge($value2, $value6, $value7);
					array_push($res, $resultTwo);
				}
			}
		}

		echo json_encode($res);
	}elseif (mysqli_num_rows($result3)>0) {
		foreach ($result3 as $value3) {
			$query8 = "SELECT prodSales, totalStocks FROM tbl_clothesales WHERE prodID='".$value1['prodID']."'";
			$query9 = "SELECT prodPicture FROM tbl_clothepicture WHERE prodID='".$value1['prodID']."'";
			$result8 = mysqli_query($conn, $query8);
			$result9 = mysqli_query($conn, $query9);
			foreach ($result8 as $value8) {
				foreach ($result9 as $value9) {
					$resultThree = array_merge($value3, $value8, $value9);
					array_push($res, $resultThree);
				}
			}
		}

		echo json_encode($res);
	}
?>