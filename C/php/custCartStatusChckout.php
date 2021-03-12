<?php
	include '../../Conn.php';

	$userID = $_POST['userID'];
	$prodID = $_POST['prodID'];
	$status = "ChckOut";

	$query1 = "UPDATE tbl_cartlist SET status ='".$status."' WHERE userID = '".$userID."' AND prodID = '".$prodID."'";
	mysqli_query($conn, $query1);
	

?>