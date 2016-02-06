<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$emailAddress=$_REQUEST["emailAddress"];
	
	
	$ProfileDetail=array();
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> GetCustomerDetail($emailAddress);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$ProfileDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$ProfileDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
		
?>