<?php

// array for JSON response
$response = array();


if(isset($_POST['storename'])){

    $loc = $_POST['storename'];

require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
	
	$result = mysql_query("SELECT title,books.isbn,category,subCat FROM stores,inventory,books WHERE stores.storeID=inventory.storeID and inventory.isbn=books.isbn and stores.storeName='$loc'");

if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
			$storelist = array();
 
            //$result = mysql_fetch_array($result);
			$city = "";
			while( $row =  mysql_fetch_array($result) ){
				$storeinfo=array();
			$storeinfo["title"] = $row["title"];
			$storeinfo["isbn"] = $row["isbn"];
			$storeinfo["category"] = $row["category"];
			$storeinfo["subCat"] = $row["subCat"];
			
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

}else if(isset($_POST['getall'])){

 //   $loc = $_POST['storename'];

require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
	
	$result = mysql_query("SELECT title,books.isbn,category,subCat FROM stores,inventory,books WHERE stores.storeId=inventory.storeId and inventory.isbn=books.isbn");

if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
			$storelist = array();
 
            //$result = mysql_fetch_array($result);
			$city = "";
			while( $row =  mysql_fetch_array($result) ){
				$storeinfo=array();
			$storeinfo["title"] = $row["title"];
			$storeinfo["isbn"] = $row["isbn"];
			$storeinfo["category"] = $row["category"];
			$storeinfo["subCat"] = $row["subCat"];
			
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

}else{
	require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
	
	$result = mysql_query("SELECT distinct category  FROM stores,inventory,books WHERE stores.storeID=inventory.storeID and inventory.isbn=books.isbn");

if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
			$storelist = array();
 
            //$result = mysql_fetch_array($result);
			$city = "";
			while( $row =  mysql_fetch_array($result) ){
				$storeinfo=array();
			$storeinfo["category"] = $row["category"];

			
			array_push($storelist, $storeinfo);
			}

			$response["success"] = 1;
			$response["storeinfo"] = array();
			array_push($response["storeinfo"], $storelist);
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


}
?>