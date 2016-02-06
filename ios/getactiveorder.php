<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$custID=$_REQUEST["custID"];
	
	
	$ActiveOrderDetail=array();
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> GetActiveOrderDetail($custID);
			 if (mysql_num_rows($result) > 0)
             {
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$ActiveOrderDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$ActiveOrderDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
			}else {
		ResponseClass::ResponseMessage("0","There is no ActiveOrder","False");
	}
		
?>