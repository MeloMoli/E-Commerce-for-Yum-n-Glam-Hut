<?php
	include '../../Conn.php';

	$userID = $_POST['userID'];
	$quesOne = $_POST['quesOne'];
	$quesTwo = $_POST['quesTwo'];
	$ansOne = $_POST['ansOne'];
	$ansTwo = $_POST['ansTwo'];

	$query1 = 'INSERT INTO tbl_customersecurityquesans(userID, ques1, ans1, ques2, ans2) VALUES ("'.$userID.'","'.$quesOne.'","'.$ansOne.'","'.$quesTwo.'","'.$ansTwo.'")';
	mysqli_query($conn, $query1);
	echo "Your account is almost complete. For now try your new account to start shopping.";
?>