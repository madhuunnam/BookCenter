<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$SignUpDetail=array();
if(isset($_POST['firstName']) && isset($_POST['lastName'])  && isset($_POST['emailAddress']) && isset($_POST['password']) )
{   	
	
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$emailAddress = $_POST['emailAddress'];
	$password = $_POST['password'];
	
	
	$dataObj = new UserClass();
	 $result1 = $dataObj-> CheckMail($emailAddress);
	 
	 if(mysql_fetch_array($result1) ){
		 
		$_SESSION['result'] = "Some Data Missing";
		ResponseClass::ResponseMessage("0","Email already present","False");
		
	 }else{

		    $result = $dataObj-> insertSignUpDetail($firstName,$lastName,$emailAddress,$password);
				if($result == true)
				{		
					
						$SignUpDetail[]= $result;
					
					ResponseClass::successResponseInArray("Alldetails",$SignUpDetail,"1"," Customer information Successfully added","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
	 }
}else {
		$_SESSION['registrationfail'] = "Some Data Missing";
		ResponseClass::ResponseMessage("3","Some Data Missing","False");
	}

		
?>