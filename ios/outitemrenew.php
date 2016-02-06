<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$outitemDetail=array();
	
  	$custID=$_POST['custID'];
	$storeName=$_POST['storeName'];
    $isbn=$_POST['isbn'];
	$dueDate=$_POST['dueDate'];
	
    
	
	
	
	$dataObj = new UserClass();
	
		    $result = $dataObj-> updateoutdateDetail($custID,$storeName,$isbn,$dueDate);
			if($result==true)
		    {	   			
				    $result1=$dataObj-> updateDuedateDetail($custID,$storeName,$isbn,$dueDate);
				 	
				          if($result1)
				           {	
					           $result2 = $dataObj-> GetOutItemDetail($custID);
							   if($result2)
				                {	
                                   while($row = mysql_fetch_assoc($result2))
					               {
									   $renewCount = $row['renewCount'];
									   if($renewCount>=2)
									   {
										  $result3=$dataObj-> updatestatusDetail($custID,$storeName,$isbn); 
									   }
						               $OutitemDetail[]= $row;
					                }
					               ResponseClass::successResponseInArray("Alldetails",$OutitemDetail,"1","Record Successfully updated","True");    
								  
						      		
				                 }
				                 else
				                  {
					                    ResponseClass::ResponseMessage("2","Record Not updated","false");
				                  }
	                             
						   }
						  
		    }
			else
			{
	                 ResponseClass::ResponseMessage("2","Required field(s) is missing","False");
             }
						


		
?>