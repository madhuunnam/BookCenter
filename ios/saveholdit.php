<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$SignUpDetail=array();

    $store = $_POST['store'];
	$isbn = $_POST['isbn'];
	$custid = $_POST['custid'];
	
	
	$dataObj = new UserClass();
	
		    $result = $dataObj-> updateholditID($store,$isbn,$custid);
			
				if($result=true)
				{		
						 ResponseClass::ResponseMessage("1","successfully HoldIT","True");				
				}
				else
				{
					     ResponseClass::ResponseMessage("2","Record Not HoldIT","false");
				}
	 
				
	 


		
?>