<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$storeName=$_REQUEST["storeName"];
    $category=$_REQUEST["category"];
	
	$storelist = array();
    $storeinfo=array();
	
	$dataObj = new UserClass(); 
	

		    $result = $dataObj-> getNumberOfBookBySubCategoryDetail($storeName,$category);
	if (!empty($result)) {
     
       			
			while( $row =  mysql_fetch_assoc($result) )
			{
				   $storeinfo = $row;
				   
			       $category = $row["category"];
				   $storeName = $row["storeName"];
				   $SubCategory = $row["SubCategory"];
			      

			            $result1 = $dataObj-> getNumberOfBookBySubCategoryDetail_1($storeName,$category,$SubCategory);
						while($row1 =  mysql_fetch_assoc($result1))
						  {
						       $storeinfo["No_of_books"] = $row1["No_of_books"];
							 
							  
                          }

						   array_push($storelist, $storeinfo); 
			}
			ResponseClass::successResponseInArray("Alldetails",$storelist,"1","Successfully Response","True");
            


    
}else{
	  ResponseClass::ResponseMessage("2","Required field(s) is missing","False");
}
?>