<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$SignUpDetail=array();
if(isset($_POST['storeName']) && isset($_POST['comment'])  && isset($_POST['HelpFull']))
{   	
	
	$storeName = $_POST['storeName'];
	$comment = $_POST['comment'];
	$HelpFull = $_POST['HelpFull'];
	
	
	
	$dataObj = new UserClass();
	
		    $result = $dataObj-> insertReviewHelp($storeName,$comment,$HelpFull);
				if($result)
				{		
						 ResponseClass::ResponseMessage("1","Record Successfully Inserted","True");				
				}
				else
				{
					     ResponseClass::ResponseMessage("2","Record Not Inserted","True");
				}
	 
				
	 
}else {
		$_SESSION['registrationfail'] = "Some Data Missing";
		ResponseClass::ResponseMessage("3","Some Data Missing","False");
	}

		
?>