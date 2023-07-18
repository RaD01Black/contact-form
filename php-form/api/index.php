<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

if (
  isset($_POST['first_name']) && !empty($_POST['first_name']) &&
  isset($_POST['last_name']) && !empty($_POST['last_name']) &&
  isset($_POST['subject']) && !empty($_POST['subject']) &&
  isset($_POST['description']) && !empty($_POST['description'])
) {
  $firstName   = $_POST['first_name'];
  $lastName    = $_POST['last_name'];
  $subject     = $_POST['subject'];
  $description = $_POST['description'];

  $message = "
  <html>
  <body>
    <h1>New Contact Form Request</p>
    <h3>From:</h3>
    <p>$firstName $lastName</p>
    <h3>Subject: </h3>
    <p>$subject</p>
    <h3>Text:</h3>
    <p>$description</p>
  </body>
  </html>
  ";

  try {
    $mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.elasticemail.com';                //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'hamidrezarat@gmail.com';               //SMTP username
    $mail->Password   = '69D1E9D339754A5076BF4E2C4F52BC1681D0'; //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 2525;

    $mail->setFrom('hamidrezarat@gmail.com', 'Contact Form');
    $mail->addAddress('hamidrezafiroozi.a520@gmail.com', 'Hamidreza Firouzi');

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    
    $mail->send();
    echo "your contact request was successfully sent.";
  } catch (Exception $e) {
    echo "Message could not be sent.";
  }
} else {
  exit('please make sure all fields are provided.');
}