<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$city=$_REQUEST["city"];
	$state=$_REQUEST["state"];
	
	$zipcodeDetail=array();
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> getOnlyStateCityZipcodeDetail($state,$city);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$zipcodeDetail[]= $row;
					}
							
					ResponseClass::successResponseInArray("Alldetails",$zipcodeDetail,"1","Successfully Response","True");
				}
				 
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
		
?>