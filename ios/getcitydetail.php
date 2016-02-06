<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$state=$_REQUEST["state"];	
	$CityDetail=array();
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> getCityDetail($state);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$CityDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$CityDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
		
?>