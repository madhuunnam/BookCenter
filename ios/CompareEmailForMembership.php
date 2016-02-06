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
		 
		ResponseClass::ResponseMessage("1","You are already a member of this store.","False");
		
	 }
	 else{
		 ResponseClass::ResponseMessage("0","You are a New member of this store.","False");
	 }
?>