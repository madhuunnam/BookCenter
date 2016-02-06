<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$from_date=$_REQUEST["from_date"];
	$to_date=$_REQUEST["to_date"];
    $custID=$_REQUEST["custID"];
	
	$TransactionDetail=array(); 
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> DatewiseGetDataforTrans($from_date,$to_date,$custID); 
		
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$TransactionDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$TransactionDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
			
	
		
?>