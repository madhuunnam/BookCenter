<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$SignUpDetail=array();
	
  	$custID=$_POST['custID'];
	$storeName=$_POST['storeName'];
    $isbn=$_POST['isbn'];
	
    
	
	
	
	$dataObj = new UserClass();
	
		    $result = $dataObj-> getHoldDateTimeDetail($storeName,$isbn);
			if($result==true)
		    {
                 while( $row =  mysql_fetch_assoc($result) )
			     {
				   $HoldDate = $row["HoldDate"];
                   $DueHold = $row["DueHold"];			   
								
				    $result1=$dataObj->updateHolditDetail($custID,$storeName,$isbn);
				 	
				     if($result1)
				     {	
                          $result2=$dataObj->updateDueHoldDetail($storeName,$isbn,$HoldDate,$DueHold);
                      	  if($result2)
				          {		   
						       ResponseClass::ResponseMessage("1","Record Successfully Inserted","True");				
				          }
				          else
				          {
					            ResponseClass::ResponseMessage("2","Record Not Inserted","false");
				          }
	                
			          }
				 }
			}
			


		
?>