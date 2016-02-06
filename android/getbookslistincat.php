<?php

// array for JSON response
$response = array();


if(isset($_POST['storename'])){

    $loc = $_POST['storename'];
	$subcat = $_POST['subcat'];

require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
	
	$result = mysql_query("SELECT title,books.isbn,category,subCat,salesPrice,rentPrice,holderID,quantity,rentDuration FROM stores,inventory,books WHERE stores.storeId=inventory.storeId and inventory.isbn=books.isbn and stores.storeName='$loc' and books.subcat='$subcat'");

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
			$storeinfo["quantity"] = $row["quantity"];
			$storeinfo["rentDuration"] = $row["rentDuration"];
			if($row["holderID"] !=	null)
				$storeinfo["holderID"]	= $row["holderID"];
			else
				$storeinfo["holderID"]	= "N/A";
			if($row["salesPrice"] != null)
				$storeinfo["salesPrice"] = $row["salesPrice"];
			else
				$storeinfo["salesPrice"] = "N/A";
			if($row["rentPrice"] != null)
				$storeinfo["rentPrice"] = $row["rentPrice"];
			else
				$storeinfo["rentPrice"] = "N/A";
			
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
			$subcat = $_POST['subcat'];

require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
	
	$result = mysql_query("SELECT title,books.isbn,category,subCat,salesPrice,rentPrice,holderID,quantity,rentDuration FROM stores,inventory,books WHERE stores.storeId=inventory.storeId and inventory.isbn=books.isbn  and books.subcat='$subcat'");

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
			$storeinfo["rentDuration"] = $row["rentDuration"];
			$storeinfo["quantity"] = $row["quantity"];
			if($row["holderID"] !=	null)
				$storeinfo["holderID"]	= $row["holderID"];
			else
				$storeinfo["holderID"]	= "N/A";
			if($row["salesPrice"] != null)
				$storeinfo["salesPrice"] = $row["salesPrice"];
			else
				$storeinfo["salesPrice"] = "N/A";
			if($row["rentPrice"] != null)
				$storeinfo["rentPrice"] = $row["rentPrice"];
			else
				$storeinfo["rentPrice"] = "N/A";
			
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

}
?>