<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail2 = 'nimesh@gmail.com';
if(isset($_POST['send']))
{
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'Healthybyte@gmail.com';
    $mail->Password = 'miexhxavtovwzdbm';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('Healthybyte@gmail.com');
    $mail->addAddress($_POST['email']);

    $mail->isHTML(true);
    $mail->Subject = "Welcome";
    $mail->Body = "Hello";

    $mail->send();

    echo "<script>alert('Send Email');</script>";


}

?>