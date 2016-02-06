<?php

// array for JSON response
$response = array();




//    $state = $_POST['state'];

require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
	
	$result = mysql_query("SELECT state  FROM stores,inventory,books WHERE stores.storeID=inventory.storeID and inventory.isbn=books.isbn group by stores.storeName");

if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
			$storelist = array();
 
            //$result = mysql_fetch_array($result);
			while( $row =  mysql_fetch_array($result) ){
				$storeinfo=array();
			$storeinfo["state"] = $row["state"];
			
			
			array_push($storelist, $storeinfo);
			}

			$response["success"] = 1;
			$response["storecomplete"] = array();
			array_push($response["storecomplete"], $storelist);
             // echoing JSON response
            echo json_encode($response);


    } else {
 
	$response["result"] = 0;
	$response["message"] = "Opps! An error occurred.";
	echo json_encode($response);
    }
}else{
	$response["result"] = 0;
	$response["message"] = "Opps! An error occurred.";
	echo json_encode($response);
}


?>