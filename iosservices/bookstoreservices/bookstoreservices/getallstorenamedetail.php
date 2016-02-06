<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$zip=$_REQUEST["zip"];
	 
	$storenameDetail=array();
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> getstorenamedetail($zip);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$storenameDetail[]= $row;
					}
							
					ResponseClass::successResponseInArray("Alldetails",$storenameDetail,"1","Successfully Response","True");
				}
				
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
		
?>