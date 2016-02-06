<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$SignUpDetail=array();
  	
    $storeName = $_POST['storeName'];
	$custID = $_POST['custID'];
	$title = $_POST['title'];
	$isbn = $_POST['isbn'];
	
	
	
	$dataObj = new UserClass();
	
	    $result=$dataObj->Checkholdit($storeName,$isbn);
		if(mysql_fetch_array($result) ){
			   $result4=$dataObj->Checkholdit1($storeName,$isbn,$custID);
			   if(mysql_fetch_array($result4) ){
				       ResponseClass::ResponseMessage("0","You are allready HoldIT","True");
			    }
			    else{
	              $result1 = $dataObj-> insertHolditDetail($storeName,$custID,$title,$isbn);
				  if($result1)
				  {		
						 ResponseClass::ResponseMessage("1","Successfully HoldIT","True");				
				  }
				  else
				  {
					     ResponseClass::ResponseMessage("2","Record Not Inserted","True");
				  }
			 }
		}
		else{
			$result2 = $dataObj-> insertHolditDetail1($storeName,$custID,$title,$isbn);
				if($result2)
				{		
						 ResponseClass::ResponseMessage("1","Successfully HoldIT","True");				
				}
				else
				{
					     ResponseClass::ResponseMessage("2","Record Not Inserted","True");
				}
		}
	 
				
	 


		
?>