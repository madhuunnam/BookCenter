<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
//	$SignUpDetail=array();
if(isset($_POST['isbn']) && isset($_POST['bookTitle'])  && isset($_POST['custID']) && isset($_POST['overallStars']) && isset($_POST['comment']) && isset($_POST['helpful']))
{   	
	
	$isbn= $_POST['isbn'];
	$bookTitle= $_POST['bookTitle'];
	$custID = $_POST['custID'];
	$overallStars = $_POST['overallStars'];
	$comment = $_POST['comment'];
	$helpful = $_POST['helpful'];

	$dataObj = new UserClass();
	
		    $result = $dataObj->getbookReviewdetail($isbn,$bookTitle,$custID,$overallStars,$comment,$helpful);
				if($result)
				{		
						 ResponseClass::ResponseMessage("1","Record Successfully","True");				
				}
				else
				{
					     ResponseClass::ResponseMessage("2","Record Not successfully","True");
				}			
	 
}else {
		$_SESSION['registrationfail'] = "Some Data Missing";
		ResponseClass::ResponseMessage("3","Some Data Missing","False");
	}

		
?>