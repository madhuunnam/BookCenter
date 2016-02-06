<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$getbranchDetail=array();
	
	$BranchID = $_POST['BranchID'];
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> getBranchDetailByID($BranchID);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$getbranchDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$getbranchDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
		
?>