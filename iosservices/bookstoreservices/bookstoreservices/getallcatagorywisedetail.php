<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$zip=$_REQUEST["zip"];
	
	$catagorywiseDetail=array();
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> getcatagorywisedetail($zip);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$catagorywiseDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$catagorywiseDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
		
?>