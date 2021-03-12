<?php
	include '../../Conn.php';
	$userID = $_POST['userID'];
	$query1 = "SELECT orderID FROM tbl_ordernum WHERE userID = '".$userID."' ORDER BY orderID DESC LIMIT 1";
	$result1 = mysqli_query($conn, $query1);

	if (mysqli_num_rows($result1)>0) {
		$row1 = mysqli_fetch_array($result1);
		$orderID = $row1['orderID'];
		
		echo $orderID;
	}else{
		
		echo "no orders";
	}
?>