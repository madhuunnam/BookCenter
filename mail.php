<?php
require 'PHPMailer/PHPMailerAutoload.php';
$toAddress = $_POST['email'];
$mailMessage = $_POST['modalMessage'];
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'customerreview.care1234@gmail.com';
$mail->Password = '4321erac';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->From = 'customerreview.care1234@gmail.com';
$mail->FromName = 'Care1234';
$mail->addAddress($toAddress, '');
$mail->WordWrap = 50;
$mail->isHTML(true);
$mail->Subject = 'Reply from Care1234';
$mail->Body    = $mailMessage;
if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
else {
	 echo 'Mail successfully sent';
	 //header( 'Location: msg.php?s=1');
	 //$location = '/msg.php';
	 //header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);
}
?>