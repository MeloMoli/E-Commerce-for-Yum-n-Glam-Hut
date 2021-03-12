<?php
	include '../../Conn.php';
	$userID = $_POST['userID'];
	$query1 = "SELECT * FROM tbl_cartlist WHERE userID ='".$userID."'";
	$query2 = "SELECT COUNT(*) AS countRows FROM tbl_cartlist WHERE userID ='".$userID."'";
	$result1 = mysqli_query($conn, $query1);
	$result2 = mysqli_query($conn, $query2);
	$res = [];
	if (mysqli_num_rows($result1)>0) {
		$row = mysqli_fetch_assoc($result2);
		echo $row['countRows'];
	}else{
		echo "no badge";
	}


?>