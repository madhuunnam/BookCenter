<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$SignUpDetail=array();
  	
    $storeName = $_POST['storeName'];
	$custID = $_POST['custID'];
	$title = $_POST['title'];
	
	
	
	$dataObj = new UserClass();
	       $result1 = $dataObj-> getisbnbytitle($title);
			if($result1==true)
		    {
                 while( $row =  mysql_fetch_assoc($result1) )
			     {
				   $isbn = $row["isbn"];	
                        $result2=$dataObj->updateQuantity($storeName,$isbn);
                         if($result2==true)
                         {
							  $result3 = $dataObj-> insertboorwtrans($storeName,$custID,$title);
			            	   if($result3)
				                {	
							         $result4 = $dataObj-> gettransactionid();
			                           if($result4==true)
		                               {
                                            while( $row =  mysql_fetch_assoc($result4) )
			                                 {
				                                 $tid = $row["tid"];
                                                 $transTime = $row["transTime"];
 												 
							                    
                                     	        $result5 = $dataObj-> insertoutitemDetail($storeName,$custID,$isbn,$title,$tid,$transTime);
										        if($result5==true)
		                                        {	
											      $result6=$dataObj->updateitemDuedate($custID,$storeName,$isbn,$tid,$transTime);
                                                    if($result6==true)
		                                           {											
                                                    												
						                               ResponseClass::ResponseMessage("1","Record Successfully Inserted","True");				
				                                 }
				                                 else
				                                 {
					                                     ResponseClass::ResponseMessage("2","Record Not Inserted","True");
				                                 }
												  
												} 
						                     }
                 						 
				                 }
			                }
						 }
				 }
			}
		                 
	 
				
	 


		
?>