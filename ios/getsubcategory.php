<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$category=$_REQUEST["category"];	
	
	$storelist = array();
    $storeinfo=array();
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> getSubCategoryDetail($category);
		 if (!empty($result)) {
     
       			
			while( $row =  mysql_fetch_assoc($result) )
			{
				   $storeinfo = $row;
				   
			       $subCat = $row["subCat"];
				   $category = $row["category"];
			      

			              $result1 = $dataObj->getSubCategoryDetail1($category,$subCat);
						while($row1 =  mysql_fetch_assoc($result1))
						  {
						       $storeinfo["no_of_store"] = $row1["no_of_store"];
							 
							  
                          }

						   array_push($storelist, $storeinfo); 
			}
			ResponseClass::successResponseInArray("Alldetails",$storelist,"1","Successfully Response","True");
            


    
}else{
	  ResponseClass::ResponseMessage("2","Required field(s) is missing","False");
}
?>