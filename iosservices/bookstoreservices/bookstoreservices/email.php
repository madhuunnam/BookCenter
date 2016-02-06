<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$SignUpDetail=array();
    if(isset($_POST['emailAddress']))
    {   	
	
	$emailAddress = $_POST['emailAddress'];
	
	
	
	
	$dataObj = new UserClass();
	 $result1 = $dataObj-> CheckMail($emailAddress);
	 
	   if (mysql_num_rows($result1) > 0)
       {
          $length=8;
		  $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
          $password = substr( str_shuffle( $chars ), 0, $length );
          //$password1= sha1($password); //Encrypting Password
          $query = mysql_query("UPDATE customers SET password='$password' WHERE emailAddress='$emailAddress'");
          if($query){
               $to = $emailAddress;
               $subject = 'Your New Password...';
               $message = 'Hello User Your new password : '.$password.'  E-mail: '.$emailAddress.' Now you can login with this email and password.';

              if(mail($to, $subject, $message ))
              {
                 $SignUpDetail[]= $query; 
                 ResponseClass::successResponseInArray("Alldetails",$SignUpDetail,"1","Please Check email to send password","True");
              }
		  }else
		   {
			 $_SESSION['fail'] = "There's something going wrong, Try Later";
			 ResponseClass::ResponseMessage("0","There is no data","False");
		  }
				
	 
}else {
		$_SESSION['registrationfail'] = "Oops error";
		ResponseClass::ResponseMessage("2","Email Not Exits","False");
	}
}else {
		$_SESSION['registrationfail'] = "Oops error";
		ResponseClass::ResponseMessage("3","Data Missing","False");
	}


		
?>