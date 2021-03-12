<?php
	include '../../Conn.php';
	$userID = $_POST['userID'];
	$orderID = $_POST['order'];
	$refNum = $_POST['refNum'];
	$query1 = "SELECT * FROM tbl_paymentstatus WHERE userID = '".$userID."' AND orderID = '".$orderID."'";
	$result1 = mysqli_query($conn, $query1);

	if(mysqli_num_rows($result1)>0){
		$query2 = "UPDATE tbl_paymentstatus SET referenceNum = '".$refNum."', status = 'For Verification' WHERE userID = '".$userID."' AND orderID = '".$orderID."'";
		mysqli_query($conn, $query2);
	}
?>