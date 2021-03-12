<?php
	include "../../Conn.php";

	$user = $_GET['user'];
	date_default_timezone_set('Asia/Manila');
	$date = date("Y-m-d H:i:s");
	$query1 = 'SELECT userID FROM tbl_ownerinfo WHERE username ="'.$user.'"';
	$query2 = 'SELECT userID FROM tbl_customeraccount WHERE username = "'.$user.'"';
	
	$result1 = mysqli_query($conn, $query1);
	$result2 = mysqli_query($conn, $query2);

	if (mysqli_num_rows($result1)>0) {
		$row1 = mysqli_fetch_array($result1);
		$query3 = "INSERT INTO tbl_historylogadmin(dateLog, userID, actionLog) VALUES ('".$date."','".$userID."','login')";
		mysqli_query($conn, $query3);
		header('location: ../../O/admin.php?u='.$row1['userID']);
	}elseif (mysqli_num_rows($result2)>0) {
		$row2 = mysqli_fetch_array($result2);
		$query4 = "INSERT INTO tbl_historylogcust(dateLog, userID, actionLog) VALUES ('".$date."','".$userID."','login')";
		mysqli_query($conn, $query4);
		header('location: ../customer.php?u='.$row2['userID']);
	}
?>