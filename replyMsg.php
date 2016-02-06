<?php

$toAddress = $_POST['email'];
$mailMessage = $_POST['modalMessage'];
$mid = $_POST['modalID'];

// first update

//echo "======mid = " . $mid . " replyText = ".$mailMessage;

define('DB_NAME', 'bookstore');
define('DB_USER', 'webclient');
define('DB_PASSWORD', '12345678');
define('DB_HOST', 'localhost');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db(DB_NAME, $link);

if(!$db_selected) {
    die('Can\'t use ' . DB_NAME . ': ' . mysql_error());
}

$sql="UPDATE messages SET replied= '1', status='Read',replyTime=now(), replyText= '". $mailMessage . "' WHERE msgID='" .$mid . "';";

echo $sql;

    if(!mysql_query($sql)) {
        die('Error: ' . mysql_error());
    }
    else { 
        
        echo "<html>  <head> 
        <script type='text/javascript'>
            alert('Branch Updated Successfully');
            window.location.href='message.php';
        </script>
        </head> </html> ";
                            
    }
    mysql_close();

/*
require 'PHPMailer/PHPMailerAutoload.php';

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

*/

?>