<?php
	include '../../Conn.php';
	$userID = $_POST['userID'];
	$prodID = $_POST['prodID'];
	$qty = $_POST['qty'];

	$query1 = "SELECT * FROM tbl_cartlist WHERE userID ='".$userID."' AND prodID ='".$prodID."'";
	$result1 = mysqli_query($conn, $query1);

	if(mysqli_num_rows($result1)>0){
		$query2 = "UPDATE tbl_cartlist SET qtyProd ='".$qty."' WHERE prodID = '".$prodID."' AND userID = '".$userID."'";
		mysqli_query($conn, $query2);
		echo "updated";
	}else{
		$query3 = "SELECT cartNum FROM tbl_cartlist WHERE userID = '".$userID."'";
		$result3 = mysqli_query($conn, $query3);
		if (mysqli_num_rows($result3)>0) {
			$query4 = "SELECT cartNum FROM tbl_cartlist WHERE userID = '".$userID."' ORDER BY cartNum DESC LIMIT 1";
			$result4 = mysqli_query($conn, $query4);
			foreach ($result4 as $value4) {
				$cartNum = $value4['cartNum'] + 1;
				$query5 = "INSERT INTO tbl_cartlist(userID, cartNum, prodID, qtyProd) VALUES ('".$userID."','".$cartNum."','".$prodID."','".$qty."')";
				mysqli_query($conn, $query5);
				echo "added";
			}
		}else{
			$query6 = "INSERT INTO tbl_cartlist(userID, cartNum, prodID, qtyProd) VALUES ('".$userID."','1','".$prodID."','".$qty."')";
			mysqli_query($conn, $query6);
			echo "added";
		}
		
	}
?>