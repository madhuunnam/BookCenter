<?php

// array for JSON response
$response = array();


if(isset($_POST['subcat'])){

    $subcat = $_POST['subcat'];

require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
	$query = "SELECT stores.storeName FROM stores,inventory,books WHERE stores.storeID=inventory.storeID and inventory.isbn=books.isbn and subCat like '%$subcat%'";
	$result = mysql_query("SELECT * FROM stores,inventory,books WHERE stores.storeID=inventory.storeID and inventory.isbn=books.isbn and (subCat = '$subcat' or subSubCat = '$subcat') group by stores.storeName");
//$result = mysql_query("SELECT * FROM stores  WHERE  subCat = '$subcat' or subSubCat = '$subcat'");

if (!empty($result)) {
        // check for empty result
		
        if (mysql_num_rows($result) > 0) {
			$storelist = array();
			$size = 0;
            //$result = mysql_fetch_array($result);
			$city = "";
			while( $row =  mysql_fetch_array($result) ){
				$storeinfo=array();
			$storeinfo["storename"] = $row["storeName"];
			$storeinfo["subsubCat"] = $row["subSubCat"];
			$size = $size +1;
			array_push($storelist, $storeinfo);
			}

			$response["success"] = 1;
			$response["size"] = $size;
			$response["storecomplete"] = array();
			array_push($response["storecomplete"], $storelist);
             // echoing JSON response
            echo json_encode($response);


    } else {
 
	$response["result"] = $query;
	$response["message"] = "Opps! An error occurred.";
	echo json_encode($response);
    }
}else{
	$response["result"] = 1;
	$response["message"] = "Opps! An error occurred.";
	echo json_encode($response);
}

}else{
	$response["result"] = 2;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>