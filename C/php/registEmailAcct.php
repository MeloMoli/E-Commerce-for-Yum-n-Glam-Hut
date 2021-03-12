<?php
    $userID = $_GET['userID'];
    $name = $_GET['name'];
    $emaAdd = $_GET['emaAdd'];
    $message = "Dear ".$name.", <br/><br/>      Congratulations! You have created your account. You can now try to <a href='localhost/yumnglamhu/'>login</a> your account and shop with us. <br/><br/>    Thank you and have a great day.     This is an auto-email from Yum n' Glam Hut. Please do not reply to this email.";

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
    $mail->AddAddress($emaAdd);
    $mail->Subject = "Account Created";
    $mail->Body = $message;


    if(!$mail->Send()) {
        $msg = "Can't connect to SERVER";
    echo "<script type='text/javascript'>alert('$msg');</script>";
     } else {
        header('location:../securityQues.php?u='.$userID);
        
     }
?>