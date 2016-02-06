<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$custID=$_REQUEST["custID"];

	
	
	
	$dataObj = new UserClass();
	

	 $result = $dataObj-> getquantity($custID);
	 if($result==true) {
     
       			
			while($row =  mysql_fetch_assoc($result))
			{
				
				 
			  	 $quantity = $row["quantity"];
				 
				 if($quantity>0)
				 {
					 
						 $getquantity[]= $row;
						 ResponseClass::successResponseInArray("Alldetails",$getquantity,"1","Book Available","True");
				 }
				 else{
					  ResponseClass::ResponseMessage("0","Book is not Available","False");

				 }
		
			}
	      
			
            


    
}else{
	  ResponseClass::ResponseMessage("2","Required field(s) is missing","False");
}
?>