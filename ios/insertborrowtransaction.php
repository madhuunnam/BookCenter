<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	$SignUpDetail=array();
  	
    $storeName = $_POST['storeName'];
	$custID = $_POST['custID'];
	//$title = $_POST['title'];
	$type=$_POST['type'];
	$b1=$_REQUEST["b1"];
	$b2=$_REQUEST["b2"];
	$b3=$_REQUEST["b3"];
	$b4=$_REQUEST["b4"];
	$b5=$_REQUEST["b5"];
	$b6=$_REQUEST["b6"];
	$b7=$_REQUEST["b7"];
	$b8=$_REQUEST["b8"];
	$b9=$_REQUEST["b9"];
	$b10=$_REQUEST["b10"];
	//$title = $_POST['title'];
	$b=array();
	if(!empty($_POST['b1']))
	{
	$b[]=$_POST['b1'];
	}
	if(!empty($_POST['b2']))
	{
	$b[]=$_POST['b2'];
	}
	if(!empty($_POST['b3']))
	{
	$b[]=$_POST['b3'];
	}
	if(!empty($_POST['b4']))
	{
	$b[]=$_POST['b4'];
	}
	if(!empty($_POST['b5']))
	{
	$b[]=$_POST['b5'];
	}
	if(!empty($_POST['b6']))
	{
	$b[]=$_POST['b6'];
	}
	if(!empty($_POST['b7']))
	{
	$b[]=$_POST['b7'];
	}
	if(!empty($_POST['b8']))
	{
	$b[]=$_POST['b8'];
	}
	if(!empty($_POST['b9']))
	{
	$b[]=$_POST['b9'];
	}
	if(!empty($_POST['b10']))
	{
	$b[]=$_POST['b10'];
	}
	
	$vals=array();
	$vals = array_count_values($b);
	$TransactionDetail=array(); 
	$dataObj = new UserClass();
	 $result5=0;    
		if($type=='isbn') 
		{
	 
          for($i=0;$i<=count($b)-1;$i++)
		{
		   $result1 = $dataObj->checkbookavailable($vals[$b[$i]],$b[$i],$storeName);
		   if(mysql_num_rows($result1)==0)
		    {
			echo json_encode(array("ResponseCode"=>"3","ResponseMsg"=> "$b[$i] books have not sufficient quantity","Result"=>"false"));
			exit;
			}
		   
		  }
		   $result = $dataObj-> getBookListBorrowDetail($type,$storeName,$b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8,$b9,$b10); 
		
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$TransactionDetail[]= $row;
					}
					
				
				}
				
			
		
		for($i=0;$i<=count($b)-1;$i++)
		{
		
		$result2=$dataObj->updateQuantitybyisbn($storeName,$b[$i]);
		 if($result2==true)
            {
			if(mysql_num_rows($result2)>0)
			{
			while( $row =  mysql_fetch_assoc($result2) )
			 {
			 $title=$row['title'];
			 $isbn=$row['isbn'];
			$result3 = $dataObj-> insertboorwtrans($storeName,$custID,$title);
			     if($result3)
				                {	
							         $result4 = $dataObj-> getlastinsertrecord();
			                           if($result4==true)
		                               {
                                            while( $row =  mysql_fetch_assoc($result4) )
			                                 {
				                                 $tid = $row["tid"];
                                                 $transTime = $row["transTime"];
 												 
							                    
                                     	        $result5 = $dataObj-> insertoutitemDetail($storeName,$custID,$isbn,$title,$tid,$transTime);
										        
						                     }
                 						 
				                 }
			                }
		   }
		  }
		
		}
		}
		if($result5==true)
		                                        
		                                        {	
											      $result6=$dataObj->updateitemDuedate($custID,$storeName,$isbn,$tid,$transTime);
                                                    if($result6==true)
		                                           {	
												   if(!empty($TransactionDetail))	
												   {									
                                                     ResponseClass::successResponseInArray("Alldetails",$TransactionDetail,"1","Successfully Response","True");											
						                           }
												   else
												   {
												    ResponseClass::ResponseMessage("1","Record Successfully Inserted","True");		
												   }
													   			
				                                 }
				                                 else
				                                 {
					                                     ResponseClass::ResponseMessage("2","Record Not Found","True");
				                                 }
												  
												} 
												else
												{
												ResponseClass::ResponseMessage("2","Something Missing","True");
												}
		}
		
		if($type=='privateCallNum') 
		{
		
		for($i=0;$i<=count($b)-1;$i++)
		{
		   $result1 = $dataObj->checkbookavailablebycallnum($vals[$b[$i]],$b[$i],$storeName);
		 if(mysql_num_rows($result1)==0)
		    {
			echo json_encode(array("ResponseCode"=>"3","ResponseMsg"=> "$b[$i] books have not sufficient quantity","Result"=>"false"));
			exit;
			}
		   
		  }
		  
		   $result = $dataObj-> getBookListBorrowDetail($type,$storeName,$b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8,$b9,$b10); 
		
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$TransactionDetail[]= $row;
					}
					
				
				}
				
		for($i=0;$i<=count($b)-1;$i++)
		{
		
		$result2=$dataObj->updateQuantitybycallnum($storeName,$b[$i]);
		 if($result2==true)
            {
			if(mysql_num_rows($result2)>0)
			{
			while( $row =  mysql_fetch_assoc($result2) )
			 {
			 $title=$row['title'];
			 $isbn=$row['isbn'];
			$result3 = $dataObj-> insertboorwtrans($storeName,$custID,$title);
			     if($result3)
				                {	
							         $result4 = $dataObj-> getlastinsertrecord();
			                           if($result4==true)
		                               {
                                            while( $row =  mysql_fetch_assoc($result4) )
			                                 {
				                                 $tid = $row["tid"];
                                                 $transTime = $row["transTime"];
 												 
							                    
                                     	        $result5 = $dataObj-> insertoutitemDetail($storeName,$custID,$isbn,$title,$tid,$transTime);
										      
						                     }
                 						 
				                 }
			                }
		   }
		  }
		
		}
		}
		  if($result5==true)
		                                        {	
											      $result6=$dataObj->updateitemDuedate($custID,$storeName,$isbn,$tid,$transTime);
                                                    if($result6==true)
		                                           {	
												   if(!empty($TransactionDetail))	
												   {									
                                                     ResponseClass::successResponseInArray("Alldetails",$TransactionDetail,"1","Successfully Response","True");											
						                           }
												   else
												   {
												    ResponseClass::ResponseMessage("1","Record Successfully Inserted","True");		
												   }
													   			
				                                 }
				                                 else
				                                 {
					                                     ResponseClass::ResponseMessage("2","Record Not Found","True");
				                                 }
												  
												} 
												else
												{
												ResponseClass::ResponseMessage("2","Something Missing","True");
												}
		}
		
	
                 
                      
		
?>