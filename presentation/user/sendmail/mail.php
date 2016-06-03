<?php
require 'PHPMailerAutoload.php';
    
    /*$mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'user@example.com';                 // SMTP username
    $mail->Password = 'secret';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient*/

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->Username = 'im.towhidul@gmail.com';
    $mail->Password = 'artcelllNa23';
    $mail->setFrom('im.towhidul@gmail.com');
    $mail->addAddress('im.towhidul@yahoo.com'); // where $email is recipent mail
    $mail->Subject = 'Hi';
    $mail->Body ='kemon acho';
   
            //send the message, check for errors
     if (!$mail->send()) {
        echo "ERROR: " . $mail->ErrorInfo;
        } else {
        echo 'ok';
    }


?>