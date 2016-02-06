<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$custID=$_REQUEST["custID"];
	
	
	$membershipDetail=array();
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> getmembershipDetail($custID);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$membershipDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$membershipDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("0","There is no data","False");
				}
		
?>