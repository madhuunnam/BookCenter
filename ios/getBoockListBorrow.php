<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
   $type=$_REQUEST["type"];
	$storeName=$_REQUEST["storeName"];
	$b1=$_REQUEST["b1"];
	$b2=$_REQUEST["b2"];
	$b3=$_REQUEST["b3"];
	$b4=$_REQUEST["b4"];
	$b5=$_REQUEST["b5"];
	$b6=$_REQUEST["b6"];
	$b7=$_REQUEST["b7"];
	$b8=$_REQUEST["b8"];
	$b9=$_REQUEST["b9"];
	$b0=$_REQUEST["b0"];
	
	

	
	$TransactionDetail=array(); 
	
	$dataObj = new UserClass();
	

		 $result = $dataObj-> getBookListBorrowDetail($type,$storeName,$b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8,$b9,$b0); 
		
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