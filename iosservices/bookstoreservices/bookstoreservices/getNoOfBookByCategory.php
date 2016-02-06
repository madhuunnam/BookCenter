<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$storeName=$_REQUEST["storeName"];	
	$getNoOfBookCategoeyDetail=array();
	
	$dataObj = new UserClass(); 
	

		    $result = $dataObj-> getNumberOfBookByCategoryDetail($storeName);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$getNoOfBookCategoeyDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$getNoOfBookCategoeyDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
		
?>