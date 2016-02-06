<?php

$con = mysql_connect('localhost', 'webclient', '12345678');

$DB_CONNECTED = false;

if (!$con) {
	$DB_CONNECTED = false;
} else {
	$db_selected = mysql_select_db("bookstore");

	if (!$db_selected) {
    	$DB_CONNECTED = false;
	} else {
		$DB_CONNECTED = true;
	}
}

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


$type = $_POST['type'];
$email = $_POST['email'];
$showPassword = isset($_POST['show'])?$_POST['show']:"";

if ($email == null || $email == "") {
	echo "Please specify an email";
} else if ($DB_CONNECTED) {
	 $sql = "";
	 $newPassword = randomPassword();

     if ($showPassword == 'show') {
         $msg = 'Your temporary password is: '. $newPassword;
         $msg = wordwrap($msg,70);

         // send email
         try {
            mail($email,"Bookstore ".$type." temporary password",$msg);
         } catch (Exception $e) {
            //Email server is not set;
         }
         echo $newPassword;
     } else {
         if ($type == 'Customer') {
             $sql="UPDATE customers SET password='$newPassword' WHERE emailAddress='$email'";
         } else if ($type == 'Admin') {
             $sql="UPDATE admins SET password='$newPassword' WHERE emailAddress='$email'";
         } else {
             $sql="UPDATE stores SET password='$newPassword' WHERE username='$email'";
         }

         $update = mysql_query($sql);

         $sql = "";
         if ($type == 'Customer') {
             $sql="SELECT custID FROM customers WHERE password='$newPassword' and emailAddress='$email'";
         } else if ($type == 'Admin') {
             $sql="SELECT adminID FROM admins WHERE password='$newPassword' and emailAddress='$email'";
         } else {
             $sql="SELECT storeID FROM stores WHERE password='$newPassword' and username='$email'";
         }

         $update = mysql_query($sql);

         $isChanged = false;

         if (0 < mysql_fetch_assoc($update)) {
             $msg = 'Your temporary password is: '. $newPassword;
             $msg = wordwrap($msg,70);

             // send email
             $value = mail($email,"Bookstore ".$type." temporary password",$msg);
             error_log("****MAIL function return value****" .$value);
             echo "Your temporary password has been emailed to you.";

             $isChanged = true;
         }

         if (!$isChanged) {
             echo "Unable to reset the password";
         }
     }

} else {
    echo "Unable to reset the password at this moment. Please try again";
}
?>