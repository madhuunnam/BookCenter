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
             $rand=rand(0,100); 
            $message = "Your password reset link send to your e-mail address.";
            $to=$emailAddress;
            $subject="Forget Password";
            $from = 'info@phpgang.com';
            $body='Hi, <br/> <br><br>Click here to reset your password is '.$rand.'   <br/> <br/>--<br>PHPGang.com<br>Solve your problems.';
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $data=mysql_query("UPDATE customers SET password='$rand' WHERE emailAddress='$to'");
            if(mail($to,$subject,$body,$headers))
              {
                 $SignUpDetail[]= $data; 
                 ResponseClass::successResponseInArray("Alldetails",$SignUpDetail,"1","Please Check email to send password","True");
              
		  }
		  else
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