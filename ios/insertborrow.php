<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
  	
    $tid = $_POST['tid'];
	
	
	
	$dataObj = new UserClass();
	
		    $result = $dataObj-> updateActiveOrder($tid);
			if($result==true)
		    {	
				 $result1=$dataObj->AddTranDetail($tid);
				 	
				if($result1==true)
				{	
                      $result2=$dataObj->getTransIdDetail($tid);
					
				 	  if($result2==true)
					  {
						   while($row =  mysql_fetch_assoc($result2) )
			               {
						     $tid = $row["tid"];
                            $transTime = $row["transTime"];
                            $storeName = $row["storeName"];
							$storeID = $row["storeID"];
							$custID = $row["custID"];
							$title = $row["title"];
							$type = $row["type"];
						     $result3=$dataObj->getisbn($title);
							 if($result3==true)
					         {
						      while($row1 =  mysql_fetch_assoc($result3) )
			                  {
							  $isbn=$row1["isbn"];
							  }
							  }
						  
							
						    $result4 = $dataObj-> insertoutitemDetail1($storeID,$storeName,$custID,$isbn,$title,$tid,$type,$transTime);
	                        if($result4==true)
		                    {	
						      ResponseClass::ResponseMessage("1","Record Successfully Inserted","True");				
				            }
				            else
				           {
					              ResponseClass::ResponseMessage("2","Record Not Inserted","True");
				           }
	                      // $result4=$dataObj->DeleteActiveorderID($tid);
						 }
					  }
				}
			}				


		
?>