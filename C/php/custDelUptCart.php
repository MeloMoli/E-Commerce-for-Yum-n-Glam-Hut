<?php
	include '../../Conn.php';
	$userID = $_POST['userID'];
	$prodID = $_POST['prodID'];

	$query1 = "SELECT * FROM tbl_cartlist WHERE userID ='".$userID."' AND prodID ='".$prodID."'";
	$result1 = mysqli_query($conn, $query1);

	if(mysqli_num_rows($result1)>0){
		$query2 = "DELETE FROM tbl_cartlist WHERE prodID = '".$prodID."' AND userID = '".$userID."'";
		mysqli_query($conn, $query2);
		echo "updated";
	}
?>