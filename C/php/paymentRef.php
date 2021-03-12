<?php
	include '../../Conn.php';
	
	if(isset($_POST['btnUploads'])){
		$userId = $_POST['idfs'];
		$orderId = $_POST['typefs'];
		$name = $_FILES['file']['name'];

		$query1 = "SELECT * FROM tbl_paymentstatus WHERE userID = '".$userId."' AND orderID = '".$orderId."'";
		$result1 = mysqli_query($conn, $query1);
		if (mysqli_num_rows($result1)>0) {
			if (empty($name)){
				$src1 = '../Images/noDP.png';
				$query1 = "UPDATE tbl_paymentstatus SET pictureRef ='".$src1."' WHERE userID ='".$userId."' AND orderID = '".$orderId."'";
				$query2 = "UPDATE tbl_paymentstatus SET statusPayment = 'For Verification' WHERE userID ='".$userId."' AND orderID = '".$orderId."'";
				mysqli_query($conn, $query2);
				mysqli_query($conn,$query1) or die(mysqli_error($conn));
				move_uploaded_file($_FILES['file']['tmp_name'],'../../Images/noDP.png');
			}else{
				$src2 = '../Images/verify/'.$name;
				$query3 = "UPDATE tbl_paymentstatus SET pictureRef ='".$src2."' WHERE userID ='".$userId."' AND orderID = '".$orderId."'";
				$query4 = "UPDATE tbl_paymentstatus SET statusPayment = 'For Verification' WHERE userID ='".$userId."' AND orderID = '".$orderId."'";
				mysqli_query($conn, $query3);
				mysqli_query($conn,$query4) or die(mysqli_error($conn));
				move_uploaded_file($_FILES['file']['tmp_name'],'../../Images/verify/'.$name);
			}
			
		}
		header('location:../mypurchased.php?u='.$userId);
		
	};
?>