<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$category=$_REQUEST["category"];
	$subCat=$_REQUEST["subCat"];
	
    $storelist = array();
    $storeinfo=array();
	
	$dataObj = new UserClass();
	
             $result = $dataObj-> getCat_SubcatDetail($category,$subCat);	
		
           if (!empty($result)) {
     
       			
			while( $row =  mysql_fetch_assoc($result) )
			{
			
			      
			       $storeinfo["storeName"] = $row["storeName"];
			       $storeinfo["storeServices"] = $row["services"];
		           $storeinfo["latitude"] = $row["latitude"];
			       $storeinfo["longitude"] = $row["longtitude"];
			       $storeinfo["comment"] = $row["No_of_review"];
			       $storeinfo["city"]=$row["city"];
			       $storeid = $row["storeID"];
			      
			
			              $result1 = $dataObj-> getRating($storeid);
			              while( $row1 =  mysql_fetch_assoc($result1))
						  {
						       $storeinfo["rating"] = $row1["overallStars"];
							  // $storeinfo["comment"] = $row["No_of_review"];
                          }
	                       
						   //$storeinfo[]=$row;
						   array_push($storelist, $storeinfo); 
			}
			ResponseClass::successResponseInArray("Alldetails",$storelist,"1","Successfully Response","True");
            


    
}else{
	  ResponseClass::ResponseMessage("2","Required field(s) is missing","False");
}
?>