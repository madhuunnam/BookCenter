<?php

// array for JSON response
$response = array();


if(isset($_POST['latitude'])&&isset($_POST['longitude'])){

    $lat1 = $_POST['latitude'];
	$lon1 = $_POST['longitude'];
require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
	//$query = "SELECT * FROM FROM stores,inventory,books WHERE stores.storeID=inventory.storeID and inventory.isbn=books.isbn and books.subCat like '%$subcat%'";
	$result = mysql_query("SELECT * FROM  stores");
$storelist = array();
if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
			//$response["vganji"] = 1;
            //$result = mysql_fetch_array($result);
			
			while( $row =  mysql_fetch_array($result) ){
			$lon2 = $row["longtitude"];
			$lat2 = $row["latitude"];
			$theta = $lon1 - $lon2;
			 $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			 $dist = acos($dist);
			 $dist = rad2deg($dist);
			$miles = $dist * 60 * 1.1515;
			if($miles < 25 ){
				$storeinfo=array();
				$storeinfo["storeName"] = $row["storeName"];
				$storeinfo["storeServices"] = $row["services"];
				$storeinfo["distance"] = $miles;
				$storeinfo["latitude"] = $row["latitude"];
				$storeinfo["longitude"] = $row["longtitude"];
				$storeinfo["storeID"] = $row["storeID"];
				$storeid = $row["storeID"];
				$result1 = mysql_query("SELECT overallStars FROM storereviews WHERE storeID = '$storeid'");
				if (!empty($result)) {
					if (mysql_num_rows($result1) > 0) {
						while( $row1 =  mysql_fetch_array($result1) ){
							$storeinfo["rating"] = $row1["overallStars"];
						}
					}else{
						$storeinfo["rating"] ="1";
					}
				}else{
					$storeinfo["rating"] ="1";
				}
				array_push($storelist, $storeinfo);
			}
			}

			$response["success"] = 1;
			$response["storecomplete"] = array();
			array_push($response["storecomplete"], $storelist);
            // echoing JSON response
            echo json_encode($response);


    } else {
 
	$response["result1"] = 0;
	$response["message1"] = "Opps! An error occurred.";
	echo json_encode($response);
    }
}else{
	$response["result"] = $query;
	$response["message"] = "Opps! An error occurred.";
	echo json_encode($response);
}

}else{
	$response["result"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>