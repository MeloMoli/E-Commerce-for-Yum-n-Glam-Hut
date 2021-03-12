<?php
	include '../../Conn.php';

	$userID = $_POST['userID'];
	$username = $_POST['username'];
	$emailAddress = $_POST['emailAddress'];
	$password = $_POST['password'];

	$firstName = $_POST['firstName'];
	$middleName = $_POST['middleName'];
	$lastName = $_POST['lastName'];
	$suffix = $_POST['suffix'];

	$gender = $_POST['gender'];
	$dateBirth = $_POST['dateBirth'];

	$cellphone = $_POST['cellphone'];
	$telephone = $_POST['telephone'];

	$houseNum = $_POST['houseNum'];
	$street = $_POST['street'];
	$baranggay = $_POST['baranggay'];
	$city = $_POST['city'];
	$postalCode = $_POST['postalCode'];

	$passwordHash = password_hash($password, PASSWORD_DEFAULT);
	date_default_timezone_set('Asia/Manila');
	$date = date("Y-m-d");
	$dateSixty= date("Y-m-d", strtotime($date. ' + 60 days'));

		$query1 = "SELECT * FROM tbl_customerdetails WHERE cellphone ='".$cellphone."'";
		$result1 = mysqli_query($conn, $query1);
		$query8 = "SELECT * FROM tbl_customerdetails WHERE emailAddress ='".$emailAddress."'";
		$result8 = mysqli_query($conn, $query8);
		$query9 = "SELECT * FROM tbl_customeraccount WHERE username ='".$username."'";
		$result9 = mysqli_query($conn, $query9);

		if (mysqli_num_rows($result1)>0) {
			echo "cellphone";
		}elseif (mysqli_num_rows($result8)>0) {
			echo "emailAddress";
		}elseif (mysqli_num_rows($result9)>0) {
			echo "username";
		}else{

			$query2 = 'INSERT INTO tbl_customeraccount(userID, username, custpassword) VALUES ("'.$userID.'","'.$username.'","'.$passwordHash.'")';
			$query3 = 'INSERT INTO tbl_customeraccountstatus(userID, timesLocked, passwordExpiry, remarks) VALUES ("'.$userID.'","0","'.$dateSixty.'","new")';
			$query4 = 'INSERT INTO tbl_customeraddress1(userID, houseNum, streetName) VALUES ("'.$userID.'","'.$houseNum.'","'.$street.'")';
			$query5 = 'INSERT INTO tbl_customeraddress2(userID, baranggay, city, postalCode, country) VALUES ("'.$userID.'","'.$baranggay.'","'.$city.'","'.$postalCode.'","Philippines")';
			$query6 = 'INSERT INTO tbl_customerdetails(userID, cellphone, emailAddress) VALUES ("'.$userID.'","'.$cellphone.'","'.$emailAddress.'")';
			$query7 = 'INSERT INTO tbl_customerpersoinfo(userID, firstName, middleName, lastName, suffix, gender, dateOfBirth, telePhone) VALUES ("'.$userID.'","'.$firstName.'","'.$middleName.'","'.$lastName.'","'.$suffix.'","'.$gender.'","'.$dateBirth.'","'.$telephone.'")';
			mysqli_query($conn, $query2);
			mysqli_query($conn, $query3);
			mysqli_query($conn, $query4);
			mysqli_query($conn, $query5);
			mysqli_query($conn, $query6);
			mysqli_query($conn, $query7);
			echo "good";
		}
	


?>