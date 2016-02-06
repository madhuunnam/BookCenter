<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$type=$_REQUEST["type"];
	
	$LookupDirecyoryDetail=array();
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> getLookupDirecyoryDetail($type);
			
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$LookupDirecyoryDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$LookupDirecyoryDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
		
?>