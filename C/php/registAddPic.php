<?php
	include '../../Conn.php';
	if(isset($_POST['btnUptUploads'])){
		$id = $_POST['userIDPic'];
		$pic = $_POST['srcfu'];
		$name = $_FILES['file']['name'];
		$query3 = "SELECT userID FROM tbl_customerdetails WHERE userID ='".$id."'";
		$result3 = mysqli_query($conn, $query3);

		if (mysqli_nums_row($result3)>0) {
			if (empty($name)) {
				
				$query4 = "UPDATE tbl_customerdetails SET picture ='".$pic."' WHERE userID ='".$id."'";

				mysqli_query($conn,$query4) or die(mysqli_error($conn));
			}else{
				$src3 = '../Images/Profile Picture/'.$name;
				$query4 = "UPDATE tbl_customerdetails SET picture ='".$src3."' WHERE userID ='".$id."'";

				mysqli_query($conn,$query4) or die(mysqli_error($conn));
				move_uploaded_file($_FILES['file']['tmp_name'],'../../Images/Profile Picture/'.$name);
			}
		}
		header('location:../foodinventory.php');
	};

	if(isset($_POST['btnUploads'])){
		$id = $_POST['userIDPic'];
		$fullname = $_POST['fullname'];
		$ema = $_POST['emaAdd'];
		$name = $_FILES['file']['name'];
		

	
		if (empty($name)){
			$src1 = '../Images/noDP.png';
			$query1 = "UPDATE tbl_customerdetails SET picture ='".$src1."' WHERE userID ='".$id."'";
			mysqli_query($conn,$query1) or die(mysqli_error($conn));
			move_uploaded_file($_FILES['file']['tmp_name'],'../../Images/noDP.png');
		}else{
			$src2 = '../Images/Profile Picture/'.$name;
			$query2 = "UPDATE tbl_customerdetails SET picture ='".$src2."' WHERE userID ='".$id."'";

			mysqli_query($conn,$query2) or die(mysqli_error($conn));
			move_uploaded_file($_FILES['file']['tmp_name'],'../../Images/Profile Picture/'.$name);
		}
		
		
		header('location:registEmailAcct.php?userID='.$id.'&name='.$fullname.'&emaAdd='.$ema);
	};
?>