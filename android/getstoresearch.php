<?php

// array for JSON response
$response =	array();



	$price = isset($_POST['price'])?$_POST['price']:'';
	$pricevalue	= isset($_POST['pricevalue'])?$_POST['pricevalue']:'';
	$title = isset($_POST['title'])?$_POST['title']:'';
	$titlevalue	= isset($_POST['titlevalue'])?$_POST['titlevalue']:'';
	#$start = isset($_POST['start'])?$_POST['start']:'';
	#$end = isset($_POST['end'])?$_POST['end']:'';
	$equal = isset($_POST['equal'])?$_POST['equal']:'';
require_once __DIR__ . '/db_connect.php';
 
	// connecting to db
	$db	= new DB_CONNECT();
	$query = "";
	if(	strcmp($title, "Title" ) == 0  && strlen($titlevalue) > 0){

		$query = "SELECT title,books.isbn,category,subCat,salesPrice,rentPrice,condDesc,stores.storeName,pubDate,holderID,quantity,rentDuration FROM stores,inventory,books where title='$titlevalue' and stores.storeId=inventory.storeId and inventory.isbn=books.isbn";
	}else if( strcmp($title, "Author" ) == 0 && strlen($titlevalue) > 0){
		$query = "SELECT title,books.isbn,category,subCat,salesPrice,rentPrice,condDesc,stores.storeName,pubDate,holderID,quantity,rentDuration FROM stores,inventory,books where author='$titlevalue' and stores.storeId=inventory.storeId and inventory.isbn=books.isbn";
	}else if( strcmp($title, "ISBN"	) == 0 && strlen($titlevalue) > 0){
		$query = "SELECT title,books.isbn,category,subCat,salesPrice,rentPrice,condDesc,stores.storeName,pubDate,holderID,quantity,rentDuration FROM stores,inventory,books where books.isbn='$titlevalue' and stores.storeId=inventory.storeId and inventory.isbn=books.isbn";
	}else if( strcmp($title, "Call No" ) == 0 && strlen($titlevalue) > 0){
		$query = "SELECT title,books.isbn,category,subCat,salesPrice,rentPrice,condDesc,stores.storeName,pubDate,holderID,quantity,rentDuration FROM stores,inventory,books where callNum='$titlevalue' and stores.storeId=inventory.storeId and inventory.isbn=books.isbn";
	}else if(	strcmp($price, "Price" ) == 0 && strlen($pricevalue) > 0){

		$query = "SELECT title,books.isbn,category,subCat,salesPrice,rentPrice,condDesc,stores.storeName,pubDate,holderID,quantity,rentDuration FROM stores,inventory,books where (salesPrice$equal'$pricevalue' or rentPrice$equal'$pricevalue')and stores.storeId=inventory.storeId and inventory.isbn=books.isbn";
	}else if( strcmp($price, "Language" ) == 0 && strlen($pricevalue) > 0){
		$query = "SELECT title,books.isbn,category,subCat,salesPrice,rentPrice,condDesc,stores.storeName,pubDate,holderID,quantity,rentDuration FROM stores,inventory,books where language$equal'$pricevalue' and stores.storeId=inventory.storeId and inventory.isbn=books.isbn";
	}else if( strcmp($price, "Store Type"	) == 0 && strlen($pricevalue) > 0){
		$query = "SELECT title,books.isbn,category,subCat,salesPrice,rentPrice,condDesc,stores.storeName,pubDate,holderID,quantity,rentDuration FROM stores,inventory,books where storeType$equal'$pricevalue' and stores.storeId=inventory.storeId and inventory.isbn=books.isbn";
	}else if( strcmp($price, "Published Year" ) == 0 && strlen($pricevalue) > 0){
		$query = "SELECT title,books.isbn,category,subCat,salesPrice,rentPrice,condDesc,stores.storeName,pubDate,holderID,quantity,rentDuration FROM stores,inventory,books where pubDate$equal'$pricevalue' and stores.storeId=inventory.storeId and inventory.isbn=books.isbn";
	}
	$result	= mysql_query($query);

if (!empty($result)) {
		// check for empty result
		if (mysql_num_rows($result)	> 0) {
			$storelist = array();
 
			while( $row	=  mysql_fetch_array($result) ){
				$storeinfo=array();
			$storeinfo["title"]	= $row["title"];
			$storeinfo["isbn"] = $row["isbn"];
			$storeinfo["condDesc"] = $row["condDesc"];
			$storeinfo["storeName"] = $row["storeName"];
			$storeinfo["quantity"] = $row["quantity"];
			$storeinfo["rentDuration"] = $row["rentDuration"];
			$storeinfo["pubDate"] = $row["pubDate"];
			if($row["salesPrice"] != null)
				$storeinfo["salesPrice"] = $row["salesPrice"];
			else
				$storeinfo["salesPrice"] = "N/A";
			if($row["rentPrice"] !=	null)
				$storeinfo["rentPrice"]	= $row["rentPrice"];
			else
				$storeinfo["rentPrice"]	= "N/A";
			
			if($row["holderID"] !=	null)
				$storeinfo["holderID"]	= $row["holderID"];
			else
				$storeinfo["holderID"]	= "N/A";
			
			array_push($storelist, $storeinfo);
			}

			$response["success"] = 1;
			$response["storecomplete"] = array();
			array_push($response["storecomplete"], $storelist);
			 //	echoing	JSON response
			echo json_encode($response);


	} else {
 
	$response["result"]	= $query;
	$response["message"] = "Opps! An error occurred.";
	echo json_encode($response);
	}
}else{
	$response["result"]	= $query;
	$response["message"] = "Opps! An error occurred.";
	echo json_encode($response);
}


?>