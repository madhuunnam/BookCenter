<?php

// array for JSON response
$response = array();


if(isset($_POST['callno'])&&isset($_POST['name'])&&isset($_POST['b1'])&&isset($_POST['b2'])&&isset($_POST['b3'])&&isset($_POST['b4'])){

    $callno = $_POST['callno'];
	$storename = $_POST['name'];
	$b1 = $_POST['b1'];
	$b2 = $_POST['b2'];
	$b3 = $_POST['b3'];
	$b4 = $_POST['b4'];

require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
	$query = "";
	$result = "";
	if( strcmp ("call number",$callno) == 0 ){
		$query = "SELECT title,books.isbn,category,subCat,salesPrice,rentPrice FROM stores,inventory,books WHERE stores.storeId=inventory.storeId and inventory.isbn=books.isbn and stores.storeName='$storename' and (callNum ='$b1' or callNum ='$b2' or callNum ='$b3' or callNum ='$b4' )";
		$result = mysql_query("SELECT title,books.isbn,category,subCat,salesPrice,rentPrice FROM stores,inventory,books WHERE stores.storeId=inventory.storeId and inventory.isbn=books.isbn and stores.storeName='$storename' and (callNum ='$b1' or callNum ='$b2' or callNum ='$b3' or callNum ='$b4' )");
	}else{
		$query = "SELECT title,books.isbn,category,subCat,salesPrice,rentPrice FROM stores,inventory,books WHERE stores.storeId=inventory.storeId and inventory.isbn=books.isbn and stores.storeName='$storename' and (ISBN ='$b1' or ISBN ='$b2' or ISBN ='$b3' or ISBN ='$b4' )";
	$result = mysql_query("SELECT title,books.isbn,category,subCat,salesPrice,rentPrice FROM stores,inventory,books WHERE stores.storeId=inventory.storeId and inventory.isbn=books.isbn and stores.storeName='$storename' and (inventory.isbn ='$b1' or inventory.isbn ='$b2' or inventory.isbn ='$b3' or inventory.isbn ='$b4' )");
	}

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
 
	$response["result"] = $query;
	$response["message"] = "Opps! An error occurred.";
	echo json_encode($response);
    }
}else{
	$response["result"] = $query;
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