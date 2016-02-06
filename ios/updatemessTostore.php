<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$SignUpDetail=array();

	
	$tid = $_POST['tid'];
	$store_message = $_POST['store_message'];
	
	
	
	$dataObj = new UserClass();
	
		    $result = $dataObj-> updateMessTostore($tid,$store_message);
			
				if($result=true)
				{		
						 ResponseClass::ResponseMessage("1","Send message to store","True");				
				}
				else
				{
					     ResponseClass::ResponseMessage("2","Record Not updated","false");
				}
	 
				
	 


		
?>