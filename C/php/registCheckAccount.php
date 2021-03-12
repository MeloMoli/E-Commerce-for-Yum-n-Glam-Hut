<?php
	include '../../Conn.php';

	$username = $_POST['username'];
	$emailAddress = $_POST['emailAddress'];

	$query1 = "SELECT * FROM tbl_customeraccount WHERE username ='".$username."'";
	$query2 = "SELECT * FROM tbl_customerdetails WHERE emailAddress ='".$emailAddress."'";

	$result1 = mysqli_query($conn, $query1);
	$result2 = mysqli_query($conn, $query2);

	if(mysqli_num_rows($result1)>0){
		echo "username";
	}elseif (mysqli_num_rows($result2)>0) {
		echo "emailAddress";
	}
?>