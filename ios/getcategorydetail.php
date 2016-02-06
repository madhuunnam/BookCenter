<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$CategoryDetail=array();
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> getCategoryDetail();
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$CategoryDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$CategoryDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
		
?>