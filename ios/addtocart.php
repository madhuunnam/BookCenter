<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$addToCartDetail=array();
if(isset($_POST['isbn']) && isset($_POST['quantity']))
{   	
	
	$isbn = $_POST['isbn'];
	$quantity = $_POST['quantity'];
	
	
	$dataObj = new UserClass();
		    $result = $dataObj-> AddTocart($isbn,$quantity);
				if($result == true)
				{	 	
					
						$addToCartDetail[]= $result;
					
					ResponseClass::successResponseInArray("Alldetails",$addToCartDetail,"1"," update Successfully added","True");
				
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