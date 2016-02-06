<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$type=$_REQUEST["type"];
	$typeno=$_REQUEST["typeno"];
	$state=$_REQUEST["state"];
	$city=$_REQUEST["city"];
	$BookDetail=array();
	
	$dataObj = new UserClass();
	if(empty($type) && empty($typeno) && empty($state) && empty($city)) 
	{
		$_SESSION['registrationfail'] = "Some Data Missing";
		ResponseClass::ResponseMessage("3","Some Data Missing","False");
		
	}
	else 
	{

		    $result = $dataObj-> getStateWiseStoreDetail($type,$typeno,$state,$city);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$BookDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$BookDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
	}
		
?>