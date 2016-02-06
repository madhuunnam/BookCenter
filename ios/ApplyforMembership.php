<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	
	$custID = $_POST['custID'];
	$storeName = $_POST['storeName'];
	
	$dataObj = new UserClass();
	 $result1 = $dataObj-> CheckMailforMemberShip($custID,$storeName);
	 
	 if(mysql_fetch_array($result1) ){
		 
		ResponseClass::ResponseMessage("0","You are already a member of this store.","False");
		
	 }else{
	
		    $result = $dataObj-> insertMembershipDataforapply($custID,$storeName);
				if($result)
				{		
						 ResponseClass::ResponseMessage("1","Added membership successfully","True");				
				}
				else
				{
					     ResponseClass::ResponseMessage("2","Added membership not successfully","True");
				}
	 }
	 

		
?>