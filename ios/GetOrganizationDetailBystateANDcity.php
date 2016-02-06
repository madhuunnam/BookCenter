<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$state=$_REQUEST["state"];
	$city=$_REQUEST["city"];
	

	$OrgDetail=array();
	
	$dataObj = new UserClass();
	if(empty($state)&& empty($city)) 
	{
		$_SESSION['registrationfail'] = "Some Data Missing";
		ResponseClass::ResponseMessage("3","Some Data Missing","False");
		
	}
	else 
	{

		    $result = $dataObj-> GetOrganizationDetailBystateANDCity($state,$city);
			if (mysql_num_rows($result) > 0)
             {
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
			}else{
		                ResponseClass::ResponseMessage("0","There is no Data","False");
	               }
	}
		
?>