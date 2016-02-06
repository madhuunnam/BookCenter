<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$getProfileDetail=array();
	
	
	$firstName=$_POST['firstName'];
	$middleName = $_POST['middleName'];
	$lastName = $_POST['lastName'];
	$addrStNum = $_POST['addrStNum'];
	$addrL2=$_POST['addrL2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$otherPhone = $_POST['otherPhone'];
	$telephoneNumber = $_POST['telephoneNumber'];
	$cardNumber = $_POST['cardNumber'];
	$cardType = $_POST['cardType'];
	$cardExp = $_POST['cardExp'];
	$cardCode = $_POST['cardCode'];
	$cardName = $_POST['cardName'];
	$billingAddr = $_POST['billingAddr'];
    $homeLib = $_POST['homeLib'];
	$emailAddress = $_POST['emailAddress'];
	
	$dataObj = new UserClass(); 
	 
	 $result = $dataObj-> updateProfile($firstName,$middleName,$lastName,$addrStNum,$addrL2,$city,$state,$zip,$otherPhone,$telephoneNumber,$cardNumber,$cardType,$cardExp,$cardCode,$cardName,$billingAddr,$homeLib,$emailAddress);
      //$result = $dataObj-> updateProfile1($firstName,$middleName,$lastName,$emailAddress);		
		if($result)
		{		
	          $result1 = $dataObj-> GetProfileDetail1($firstName,$middleName,$lastName,$addrStNum,$addrL2,$city,$state,$zip,$otherPhone,$telephoneNumber,$cardNumber);
				  while($row = mysql_fetch_assoc($result1))
				  {
						$getProfileDetail[]= $row;
			      }
				  ResponseClass::successResponseInArray("PofileData",$getProfileDetail,"1","Profile Update successfully ","True");
				
	   }
	  else
	  {
			   $_SESSION['registrationfail'] = "There's something going wrong, Try Later";
			  ResponseClass::ResponseMessage("2","Profile update not successfully","False");
	 }
		
?>