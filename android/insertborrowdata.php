<?php

// array for JSON response
$response = array();


// check for required fields
if(isset($_POST['storeName'])&& isset($_POST['title'])&& isset($_POST['totPrice'])&& isset($_POST['custID'])&& isset($_POST['quantity']))
{
	
	$custID = $_POST['custID'];
	$storeName = $_POST['storeName'];
	$title = $_POST['title'];
	$totPrice = $_POST['totPrice'];
	$quantity = $_POST['quantity'];
	// include db connect class
   	 require_once __DIR__ . '/db_connect.php';
	  $db = new DB_CONNECT();
	 

   	 // connecting to db
   	$storeID=0;
	$result2 = mysql_query("select storeID from stores where storeName='$storeName'");	
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
			$firstname = "";
			$lastname ="";

				$result3 = mysql_query("select firstName,lastName from customers where custID='$custID'");	
	if (!empty($result3)) {
        // check for empty result
        if (mysql_num_rows($result3) > 0) {
			$row3 =  mysql_fetch_array($result3);
			$firstname = $row3["firstName"];
			$lastname = $row3["lastName"];

			
	
		}
			}
	// mysql inserting a new row
   	 $result = mysql_query("insert into activeorders (storeName,custID,title,totPrice, unitsOrdered,transTime,storeID) values('$storeName','$custID','$title','$totPrice','$quantity',now(),'$storeID')");
	$tid = mysql_insert_id();

	$result = mysql_query("insert into outitmes (storeName,custID,title,quantity,type,outDate,storeID,isbn,custFirstName,custLastName,tid) values('$storeName','$custID','$title','$quantity','borrow', now(),'$storeID','$isbn','$firstname','$lastname','$tid')");	
	
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

	
