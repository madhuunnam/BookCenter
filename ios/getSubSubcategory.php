<?php	
session_start();
	include('classes/mainclass.php');
	header('Content-type: application/json; charset=utf-8');
	$CustomHeaders = apache_request_headers();
	
	$category=$_REQUEST["category"];
	$subCat=$_REQUEST["subCat"];
	
	$cat_SubSubCatDetail=array();
	
	$dataObj = new UserClass();
	

		    $result = $dataObj-> getCat_SubSubcatDetail($category,$subCat);
				if($result == true)
				{		
					while($row = mysql_fetch_assoc($result))
					{
						$cat_SubSubCatDetail[]= $row;
					}
					ResponseClass::successResponseInArray("Alldetails",$cat_SubSubCatDetail,"1","Successfully Response","True");
				
				}
				else
				{
					$_SESSION['fail'] = "There's something going wrong, Try Later";
					ResponseClass::ResponseMessage("2","There is no data","False");
				}
		
?>