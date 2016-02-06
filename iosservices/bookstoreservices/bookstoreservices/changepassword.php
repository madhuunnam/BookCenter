<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$ChnagePassDetail=array();
	
    if (isset($_POST['user1']) && isset($_POST['oldpwd']) && isset($_POST['newpwd']) && isset($_POST['repwd']))
	{
 	   $user1 = $_POST['user1'];
	   $oldpwd = $_POST['oldpwd'];
	   $newpwd = $_POST['newpwd'];
	   $repwd = $_POST['repwd'];
	
	   $dataObj = new UserClass();

		    $result = $dataObj-> ChngePasswordDetail($user1,$oldpwd,$newpwd,$repwd);
				if($result == true)
				{		
						$ChnagePassDetail[]= $result;
					ResponseClass::successResponseInArray("Alldetails",$ChnagePassDetail,"1","Password successfully updated","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
	 
}else {
		$_SESSION['registrationfail'] = "Some Data Missing";
		ResponseClass::ResponseMessage("3","Some Data Missing","False");
	}

		
?>