<?php
	include '../../Conn.php';

	$orderID = $_POST['orderID'];
	$userID = $_POST['userID'];
	$amt = $_POST['amt'];
	$pm = $_POST['pm'];
	date_default_timezone_set('Asia/Manila');
	$date = date("Y-m-d");
	$time = date("H:i:s");
	$dateFrom = date("Y-m-d", strtotime($date. ' + 3 days'));
	$dateTo = date("Y-m-d", strtotime($date. ' + 8 days'));
	$dateThree = $dateFrom."-".$dateTo;
	

	$query1 = "INSERT INTO tbl_paymentstatus(userID, orderID, paymentMethod, statusPayment) VALUES ('".$userID."','".$orderID."','".$pm."','Not Paid')";
	mysqli_query($conn, $query1);
	$query2 = "INSERT INTO tbl_ordernum(orderDate, orderTime, orderID, userID, amt, paymentMethod) VALUES('".$date."','".$time."','".$orderID."','".$userID."','".$amt."','".$pm."')";
	mysqli_query($conn, $query2);
	$query2 = "INSERT INTO tbl_orderstatus(orderID, status) VALUES('".$orderID."','to approved')";
	mysqli_query($conn, $query2);
	$query3 = "INSERT INTO tbl_shippingdetails(orderID, userID, dateOrdered, deliveryDateRange, status) VALUES('".$orderID."','".$userID."','".$date."','".$dateThree."','to approved')";
	mysqli_query($conn, $query3);


	
?>