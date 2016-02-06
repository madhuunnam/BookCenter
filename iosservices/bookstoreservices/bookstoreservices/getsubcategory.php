<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$category=$_REQUEST["category"];	
	$SubCategoryDetail=array();
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> getSubCategoryDetail($category);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$SubCategoryDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$SubCategoryDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
		
?>