<?php
	include '../../Conn.php';

	$ques = $_POST['ques'];
	$ans = $_POST['ans'];
	$user = $_POST['userID'];

	$query1 = "SELECT * FROM tbl_customersecurityquesans WHERE userID = '".$user."'";
	$result1 = mysqli_query($conn, $query1);
	$res = [];
	if(mysqli_num_rows($result1)>0){
		foreach($result1 as $value1){
			if ($ques === $value1['ques1']) {
				if ($ans === $value1['ans1']) {
					echo "good";
				}else{
					echo "not good";
				}
			}elseif ($ques === $value1['ques2']) {
				if ($ans === $value1['ans2']) {
					echo "good";
				}else{
					echo "not good";
				}
			}
			
		}
	}else{
		echo "h";
	}

?>