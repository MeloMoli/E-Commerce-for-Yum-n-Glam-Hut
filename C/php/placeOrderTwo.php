<?php
	include '../../Conn.php';
	$orderID = $_POST['orderID'];
	$userID = $_POST['userID'];
	$prodID = $_POST['prodID'];
	$qty = $_POST['qty'];

	$query1 = "SELECT * FROM tbl_foodsales WHERE prodID = '".$prodID."'";
	$query2 = "SELECT * FROM tbl_clothesales WHERE prodID = '".$prodID."'";
	$query3 = "SELECT * FROM tbl_cosmeticsales WHERE prodID = '".$prodID."'";
	$result1 = mysqli_query($conn, $query1);
	$result2 = mysqli_query($conn, $query2);
	$result3 = mysqli_query($conn, $query3);
	

	if (mysqli_num_rows($result1)>0) {
		$query21 = "SELECT batchNumber FROM tbl_foodbatch WHERE prodID = '".$prodID."' ORDER BY numStocks ASC LIMIT 1";
		$result21 = mysqli_query($conn, $query21);
		$row21 = mysqli_fetch_array($result21);
		$query7 = "UPDATE tbl_foodsales SET prodSales = prodSales + '".$qty."' WHERE prodID = '".$prodID."'";
		mysqli_query($conn, $query7);
		$query8 = "UPDATE tbl_foodsales SET totalStocks = totalStocks - '".$qty."' WHERE prodID = '".$prodID."'";
		mysqli_query($conn, $query8);
		$query20 = "UPDATE tbl_foodbatch SET numStocks = numStocks - '".$qty."' WHERE prodID = '".$prodID."' AND batchNumber = '".$row21['batchNumber']."'";
		mysqli_query($conn, $query20);
		$query4 = "INSERT INTO tbl_orderlist(orderID, prodID, qty) VALUES ('".$orderID."','".$prodID."','".$qty."')";
		mysqli_query($conn, $query4);
		$query6 = "DELETE FROM tbl_cartlist WHERE userID = '".$userID."' AND prodID = '".$prodID."'";
		mysqli_query($conn, $query6);
	}elseif (mysqli_num_rows($result2)>0) {
		$query9 = "UPDATE tbl_clothesales SET prodSales = prodSales + '".$qty."' WHERE prodID = '".$prodID."'";
		mysqli_query($conn, $query9);
		$query10 = "UPDATE tbl_clothesales SET totalStocks = totalStocks - '".$qty."' WHERE prodID = '".$prodID."'";
		mysqli_query($conn, $query10);
		$query4 = "INSERT INTO tbl_orderlist(orderID, prodID, qty) VALUES ('".$orderID."','".$prodID."','".$qty."')";
		mysqli_query($conn, $query4);
		$query6 = "DELETE FROM tbl_cartlist WHERE userID = '".$userID."' AND prodID = '".$prodID."'";
		mysqli_query($conn, $query6);
	}elseif (mysqli_num_rows($result3)>0) {
		$query11 = "UPDATE tbl_cosmeticsales SET prodSales = prodSales + '".$qty."' WHERE prodID = '".$prodID."'";
		mysqli_query($conn, $query11);
		$query12 = "UPDATE tbl_cosmeticsales SET totalStocks = totalStocks - '".$qty."' WHERE prodID = '".$prodID."'";
		mysqli_query($conn, $query12);
		$query4 = "INSERT INTO tbl_orderlist(orderID, prodID, qty) VALUES ('".$orderID."','".$prodID."','".$qty."')";
		mysqli_query($conn, $query4);
		$query6 = "DELETE FROM tbl_cartlist WHERE userID = '".$userID."' AND prodID = '".$prodID."'";
		mysqli_query($conn, $query6);
	}
	
	
?>