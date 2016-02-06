<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$SignUpDetail=array();
if(isset($_POST['firstName']) && isset($_POST['lastName'])  && isset($_POST['emailAddress']) && isset($_POST['password']) )
{   	
	
	$firstName = $_POST['firstName'];
	$middleName =$_POST['middleName'];
	$lastName = $_POST['lastName'];
	$addrStNum =$_POST['addrStNum'];
	$addrL2 =$_POST['addrL2'];
	$city =$_POST['city'];
    $state =$_POST['state'];
	$zip =$_POST['zip'];
    $emailAddress =$_POST['emailAddress'];
	$telephoneNumber =$_POST['telephoneNumber'];
	$otherPhone =$_POST['otherPhone'];
	$cardNumber =$_POST['cardNumber'];
	$cardType =$_POST['cardType'];
	$cardExp =$_POST['cardExp'];
	$cardCode =$_POST['cardCode'];
	$cardName =$_POST['cardName'];
	$billingAddr =$_POST['billingAddr'];
	
	
	
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