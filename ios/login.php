<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$emailAddress=$_REQUEST["emailAddress"];
	$password=$_REQUEST["password"];
	$LoginDetail=array();
	
	$dataObj = new UserClass();
	 if(isset($_POST['emailAddress']) || isset($_POST['password']))
    {   	
	
	$emailAddress = $_POST['emailAddress'];
	$password = $_POST['password'];
	
	

		    $result = $dataObj-> getLoginDetail($emailAddress,$password);
			
			 if (mysql_num_rows($result) > 0)
             {
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$LoginDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$LoginDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
	
	}else {
		$_SESSION['registrationfail'] = "Oops error";
		ResponseClass::ResponseMessage("0","somthing wrong","False");
	}
	}else {
		$_SESSION['registrationfail'] = "Oops error";
		ResponseClass::ResponseMessage("3","Data Missing","False");
	}

		
?>