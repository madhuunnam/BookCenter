<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$type=$_REQUEST["type"];
	$typeno=$_REQUEST["typeno"];
	$category=$_REQUEST["category"];
	
	$BookStoreDetail=array();
	
	$dataObj = new UserClass();
	if(empty($type) && empty($typeno) && empty($category))
	{
		$_SESSION['registrationfail'] = "Some Data Missing";
		ResponseClass::ResponseMessage("3","Some Data Missing","False");
		
	}
	else  
	{

		    $result = $dataObj-> getCategoryWiseBookANDStoreDetail($type,$typeno,$category);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$BookStoreDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$BookStoreDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
	}
		
?>