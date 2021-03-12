<?php
	include '../../Conn.php';

	$username = $_POST['username'];

	$query1 = "SELECT * FROM tbl_customeraccount WHERE username = '".$username."'";
	$query2 = "SELECT * FROM tbl_ownerinfo WHERE username = '".$username."'";
	$result1 = mysqli_query($conn, $query1);
	$result2 = mysqli_query($conn, $query2);
	$res = [];
	if(mysqli_num_rows($result1)>0){
		foreach($result1 as $value1){
			$query3 = "SELECT * FROM tbl_customersecurityquesans WHERE userID = '".$value1['userID']."'";
			$result3 = mysqli_query($conn, $query3);
			if (mysqli_num_rows($result3)>0) {
				foreach($result3 as $value3){
					array_push($res, $value3);
				}
			}else{
				echo "You dont have any security question.";
			}
			
		}
		echo json_encode($res);
	}else if(mysqli_num_rows($result2)>0){
		foreach($result2 as $value2){
			$query4 = "SELECT * FROM tbl_ownerinfo WHERE userID = '".$value2['userID']."'";
			$result4 = mysqli_query($conn, $query4);
			foreach($result4 as $value4){
				header('location: preResetPass.php?ema='.$value4['emailAdd']);
			}
		}
	}else{
		echo "username not found";
	}

?>