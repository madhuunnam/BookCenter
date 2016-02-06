<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$category=$_REQUEST["category"];
	$getOnlyCatDetail=array();
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> getOnlyCategoryDetail($category);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$getOnlyCatDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$getOnlyCatDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
		
?>