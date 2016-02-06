<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$storeName=$_REQUEST["storeName"];	
	$getReviewdetail=array();
	
	$dataObj = new UserClass(); 
	

		    $result = $dataObj-> getNoOfReviewDetail($storeName);
			if (mysql_num_rows($result) > 0)
             {
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$getReviewDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$getReviewDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
			}else {
		$_SESSION['registrationfail'] = "Oops error";
		ResponseClass::ResponseMessage("0","This Storename not a review","False");
	}
		
?>