<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$storeName=$_REQUEST["storeName"];	
	$storeassociations=array();
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> getStoreAssociationsDetail($storeName);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$storeassociations[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$storeassociations,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
		
?>