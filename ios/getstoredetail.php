<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$storeName=$_REQUEST["storeName"];
	
	
	$storelist = array();
    $storeinfo = array();
	
	
	$dataObj = new UserClass();
	

  $result = $dataObj-> getStoreDetail($storeName);
   if (!empty($result)) {
     
       		
			while( $row =  mysql_fetch_assoc($result) )
			{
				   
				   $storeinfo = $row;
				   
			      $storeid = $row["storeID"];
			      

			              $result1 = $dataObj->getRating($storeid);
						 if(mysql_num_rows($result1)>0)
						 {
							 while( $row1 =  mysql_fetch_assoc($result1))
						  {
						       $storeinfo["overallStars"] = round($row1["rating"], 1);
							  
                          }
						 }
						 else{
							  $storeinfo["rating"] = 'null';
						 }
						   
					array_push($storelist, $storeinfo); 
					
			}
			ResponseClass::successResponseInArray("Alldetails",$storelist,"1","Successfully Response","True");
			//print_r ($storelist);
			//print_r(array_values($storelist));
			 //$storeid = $row["storeID"];


    
}else{
	  ResponseClass::ResponseMessage("2","Required field(s) is missing","False");
}
?>