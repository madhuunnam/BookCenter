<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$name=$_REQUEST["name"];
	$namevalue=$_REQUEST["namevalue"];
	$type=$_REQUEST["type"];
	

	$OrgDetail=array();
	
	$dataObj = new UserClass();
	if(empty($name)&& empty($namevalue) && empty($type)) 
	{
		$_SESSION['registrationfail'] = "Some Data Missing";
		ResponseClass::ResponseMessage("3","Some Data Missing","False");
		
	}
	else 
	{

		    $result = $dataObj-> getOrganizationNamebytype($name,$namevalue,$type);
			
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$OrgDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$OrgDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
			
}
		
?>