<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$state=$_REQUEST["state"];	
	$getOnlyStateDetail=array();
	
	$dataObj = new UserClass(); 
	

		    $result = $dataObj-> getOnlystateDetail($state);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$getOnlyStateDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$getOnlyStateDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
		
?>