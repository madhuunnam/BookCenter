<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$storeName=$_REQUEST["storeName"];	
	
	$storelist = array();
    $storeinfo=array();
	
	$dataObj = new UserClass(); 
	

		    $result = $dataObj-> getNumberOfBookByCategoryDetail($storeName);
				 if (!empty($result)) {
     
       			
			while( $row =  mysql_fetch_assoc($result) )
			{
				   $storeinfo = $row;
				   
			       $category = $row["Category"];
				   $storeName = $row["storeName"];
			      

			            $result1 = $dataObj->getNumberOfBookByCategoryDetail_1($storeName,$category);
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