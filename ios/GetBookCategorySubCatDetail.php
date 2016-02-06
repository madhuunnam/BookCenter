<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$storeName=$_REQUEST["storeName"];
    $category=$_REQUEST["category"];	
    $subCat=$_REQUEST["subCat"];	
	
	$getBookCat_SubCategoeyDetail=array();
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> getBookByCat_SubCategoryDetail($storeName,$category,$subCat);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$getBookCat_SubCategoeyDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$getBookCat_SubCategoeyDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
		
?>