<?php
	include '../../Conn.php';

	$username = $_POST['username'];
	$password = $_POST['password'];

	$query1 = 'SELECT username, password FROM tbl_ownerinfo WHERE username = "'.$username.'"';
	$query2 = 'SELECT username, custpassword FROM tbl_customeraccount WHERE username = "'.$username.'"';
	$result1 = mysqli_query($conn, $query1);
	$result2 = mysqli_query($conn, $query2);

	if (mysqli_num_rows($result1)>0) {
		$row1 = mysqli_fetch_array($result1);
		if ($password == $row1['password']) {
			echo "match";
		}else{
			echo "does not match";
		}
	}elseif (mysqli_num_rows($result2)>0) {
		$row2 = mysqli_fetch_array($result2);
		if (password_verify($password, $row2['custpassword'])) {
			echo "match";
		}else{
			echo "does not match";
		}
	}
?>