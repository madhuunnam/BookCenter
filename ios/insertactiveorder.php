<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$SignUpDetail=array();
  	
    $storeName = $_POST['storeName'];
	$custID = $_POST['custID'];
	$title = $_POST['title'];
	
	
	
	$dataObj = new UserClass();
	
		    $result = $dataObj-> insertactiveDetail($storeName,$custID,$title);
				if($result)
				{		
						 ResponseClass::ResponseMessage("1","Record Successfully Inserted","True");				
				}
				else
				{
					     ResponseClass::ResponseMessage("2","Record Not Inserted","True");
				}
	 
				
	 


		
?>