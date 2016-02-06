<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$state=$_REQUEST["state"];
	$type=$_REQUEST["type"];
	$typeno=$_REQUEST["typeno"];
	$BookDetail=array();
	
	$dataObj = new UserClass();
	if(empty($type) && empty($typeno) && empty($state)) 
	{
		$_SESSION['registrationfail'] = "Some Data Missing";
		ResponseClass::ResponseMessage("3","Some Data Missing","False");
		
	}
	else 
	{

		    $result = $dataObj-> getBook_StoreDetailByState_title($type,$typeno,$state);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$BookDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$BookDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
	}
		
?>