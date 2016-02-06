<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$SignUpDetail=array();
if(isset($_POST['storeName']) && isset($_POST['cust_id'])  && isset($_POST['subject']) && isset($_POST['quality']) && isset($_POST['speed']) && isset($_POST['overallstars']) && isset($_POST['comment']))
{   	
	
	$storeName = $_POST['storeName'];
	$cust_id = $_POST['cust_id'];
	$subject = $_POST['subject'];
	$quality = $_POST['quality'];
	$speed = $_POST['speed'];
	$overallstars = $_POST['overallstars'];
	$comment = $_POST['comment'];
	
	
	
	
	$dataObj = new UserClass();
	
		    $result = $dataObj-> insertStoreReviewHelp($storeName,$cust_id,$subject,$quality,$speed,$overallstars,$comment);
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