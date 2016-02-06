<?php

// array for JSON response
$response = array();


// check for required fields
if(isset($_POST['libName']) && isset($_POST['libPin'])  && isset($_POST['custid'])&& isset($_POST['name']))
{
	$libName = $_POST['libName'];
	$libPin = $_POST['libPin'];
	$custid = $_POST['custid'];
	$name = $_POST['name'];
	// include db connect class
   	 require_once __DIR__ . '/db_connect.php';
 
   	 // connecting to db
   	 $db = new DB_CONNECT();
	 $storeID=0;
	$result2 = mysql_query("select storeID from stores where storeName='$libName'");	
	if (!empty($result2)) {
        // check for empty result
        if (mysql_num_rows($result2) > 0) {
			$row2 =  mysql_fetch_array($result2);
			$storeID = $row2["storeID"];

			
	
		}
			}

	 $result = mysql_query("INSERT INTO LibMembers(custID, storeName, pin, custFirstName,activate ,joinDate, storeID) VALUES('$custid', '$libName', '$libPin','$name',0 ,now(),'$storeID')");

if ($result) {
        // successfully inserted into database
        $response["result"] = 1;
        $response["message"] = "Customer message successfully inserted.";
	
	
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["result"] = 0;
        $response["message"] = "Oops! An error occurred.";
	
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

