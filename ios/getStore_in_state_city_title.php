<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$type=$_REQUEST["type"];
	$typeno=$_REQUEST["typeno"];
	$state=$_REQUEST["state"];
	$city=$_REQUEST["city"];
	
	$storelist = array();
    $storeinfo=array();
	
	$dataObj = new UserClass();
	
		$result = $dataObj-> getStateWiseStoreDetail($type,$typeno,$state,$city);
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
            


    
}else{
	  ResponseClass::ResponseMessage("2","Required field(s) is missing","False");
}
?>