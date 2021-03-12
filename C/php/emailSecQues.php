<?php
    include '../../Conn.php';
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+\-=\[\]{};\':\"\\|,.<>\/?';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    $userID = $_GET['u'];
    $query1 = "SELECT * FROM tbl_customerdetails WHERE userID = '".$userID."'";
    $result1 = mysqli_query($conn, $query1);
    if (mysqli_num_rows($result1)>0) {
        foreach ($result1 as $value1) {
            $query2 = "SELECT * FROM tbl_customerpersoinfo WHERE userID = '".$value1['userID']."'";
            $result2 = mysqli_query($conn, $query2);
            foreach ($result2 as $value2) {
            $name = $value2['firstName']." ".$value2['lastName'];
            $message = "Dear ".$name.", <br/><br/>      We heard that you are having some trouble in logging in. For now we will give you a temporary password, ".randomPassword()." ,you must change the password immediately for you to shop again. Thank you for trusting yum n glam hut. Have a great day. <br/>For more concern: Click <a href= helpcentre.php>Help Centre</a><br/>This is an auto-email from Yum n' Glam Hut. Please do not reply to this email.";

            require('..\\..\\PHPMailer-master\\src\\PHPMailer.php');
            require('..\\..\\PHPMailer-master\\src\\SMTP.php');
            require('..\\..\\PHPMailer-master\\src\\Exception.php');

            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->IsSMTP(); 

            $mail->CharSet="UTF-8";
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPDebug = 1; 
            $mail->Port = 465 ; //465 or 587

            $mail->SMTPSecure = 'ssl';  
            $mail->SMTPAuth = true; 
            $mail->IsHTML(true);

            //Authentication
            $mail->Username = "prtl.email0001@gmail.com";
            $mail->Password = "Sampl3mai1";

            //Set Params
            $mail->SetFrom("prtl.email0001@gmail.com");
            $mail->AddAddress($value1['emailAddress']);
            $mail->Subject = "Account Created";
            $mail->Body = $message;


            if(!$mail->Send()) {
                $msg = "Can't connect to SERVER";
            echo "<script type='text/javascript'>alert('$msg');</script>";
             } else {
                header('location:../../index.php');
                
             }
            }
        }
    }
    
?>