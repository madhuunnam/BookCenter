<?php

// array for JSON response
$response = array();


// check for required fields
if(isset($_POST['CardNo']) && isset($_POST['ExpDate'])  && isset($_POST['CvvDate']) && isset($_POST['CardName']) && isset($_POST['BillAddr']) && isset($_POST['cardSelected'])&& isset($_POST['details'])&& isset($_POST['custid']))
{
	
	$CardNo = $_POST['CardNo'];
	$ExpDate = $_POST['ExpDate'];
	$CvvDate = $_POST['CvvDate'];
	$CardName = $_POST['CardName'];
	$BillAddr = $_POST['BillAddr'];
	$cardSelected = $_POST['cardSelected'];
	$details = $_POST['details'];
	$custid = $_POST['custid'];
	
	$detailss = split("::" , $details);
	// include db connect class
   	 require_once __DIR__ . '/db_connect.php';
	  $db = new DB_CONNECT();
	 $result = mysql_query("update customers set cardNumber='$CardNo', cardExp = '$ExpDate', cardCode='$CvvDate', cardName='$CardName', billingAddr='$BillAddr', cardType='$cardSelected' where custID='$custid'");
	 
	for ($i = 0; $i < count($detailss); $i++) {
		if(strlen($detailss[$i]) > 0){
         $detailseach = $detailss[$i];
		 $detailseachs = split(":",$detailseach);
		  
		$title = $detailseachs[0];
		//$response["result1"] = $title;	
		$quantity = $detailseachs[1];
		$store = $detailseachs[2];
		$type = $detailseachs[3];
		$tot = $detailseachs[4];
   	 // connecting to db
   	
	$storeID=0;
	$result2 = mysql_query("select storeID from stores where storeName='$store'");	
	if (!empty($result2)) {
        // check for empty result
        if (mysql_num_rows($result2) > 0) {
			$row2 =  mysql_fetch_array($result2);
			$storeID = $row2["storeID"];

			
	
		}
			}

	$isbn=0;
	$result1 = mysql_query("select isbn from books where title='$title'");	
	if (!empty($result1)) {
        // check for empty result
        if (mysql_num_rows($result1) > 0) {
			$row1 =  mysql_fetch_array($result1);
			$isbn = $row1["isbn"];

			
	
		}
			}

			$firstname = "";
			$lastname ="";

				$result3 = mysql_query("select firstName,lastName from customers where custID='$custid'");	
	if (!empty($result3)) {
        // check for empty result
        if (mysql_num_rows($result3) > 0) {
			$row3 =  mysql_fetch_array($result3);
			$firstname = $row3["firstName"];
			$lastname = $row3["lastName"];

			
	
		}
			}
		
	// mysql inserting a new row
   	 $result = mysql_query("insert into activeorders (storeName,custID,title,unitsOrdered,type,totPrice,transTime) values('$store','$custid','$title','$quantity','$type','$tot', now())");
		$tid = mysql_insert_id();
		//if($tot > 0 ){

		//}else{
			if( $type== "rent"){
			$result = mysql_query("insert into outitmes (storeName,custID,title,quantity,type,outDate,storeID,isbn,custFirstName,custLastName,tid) values('$store','$custid','$title','$quantity','$type', now(),'$storeID','$isbn','$firstname','$lastname','$tid')");
			}
		//}

		}
	}
	
	
	 $result1 = mysql_query("select quantity  FROM stores,inventory,books WHERE stores.storeId=inventory.storeId and inventory.isbn=books.isbn  and books.title='$title'");

			if (!empty($result1)) {
        // check for empty result
        if (mysql_num_rows($result1) > 0) {
			$storelist = array();
 
            //$result = mysql_fetch_array($result);
			$city = "";
			$row1 =  mysql_fetch_array($result1);
			$qua = $row1["quantity"];

			$newqua = $qua - $quantity;
			mysql_query("update inventory,books,stores set quantity='$newqua'  WHERE stores.storeId=inventory.storeId and inventory.isbn=books.isbn  and books.title='$title'");
	
		}
			}

	// check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["result"] = 1;
        $response["message"] = "Customer information successfully inserted.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["result"] = 0;
        $response["message"] = "Oops! An error occurred.";
	//$response["sql"]="INSERT INTO customers(firstName, lastName, emailAddress,password) VALUES('$fname', '$lname', '$email', '$pwd')"; 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["result"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>

	
