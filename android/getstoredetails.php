<?php

// array for JSON response
$response = array();


if(isset($_POST['storename'])){

    $loc = $_POST['storename'];

require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
	
	$result = mysql_query("SELECT * FROM stores WHERE storeName = '$loc'");

if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
			$storelist = array();
 
            //$result = mysql_fetch_array($result);
			$city = "";
			while( $row =  mysql_fetch_array($result) ){
				$storeinfo=array();
			$storeinfo["storeName"] = $row["storeName"];
			$storeinfo["address"] = $row["addrStNum"].", ".$row["city"].", ".$row["state"].", ".$row["zip"];
			$storeinfo["phone"] = $row["phone"];
			$storeinfo["website"] = $row["website"];
			$storeinfo["type"] = $row["storeType"].", ".$row["services"].", ".$row["keywords"];
			$storeid = $row["storeID"];
			$result1 = mysql_query("SELECT overallStars FROM storereviews WHERE storeID = '$storeid'");
			if (!empty($result1)) {
				if (mysql_num_rows($result1) > 0) {
					$storeinfo["reviews"] = sizeOf($result1);
				}else{
					$storeinfo["reviews"] ="0";
				}
			}else{
				$storeinfo["reviews"] ="0";
			}
			
			$result2 = mysql_query("SELECT storeName FROM storeassociations WHERE motherStore = '$loc'");
			$assStore="";
			if (!empty($result2)) {
				if (mysql_num_rows($result2) > 0) {
					while( $row =  mysql_fetch_array($result2) ){
						$assStore = $assStore.$row["storeName"].":";
					}
					$storeinfo["assStore"] = $assStore;
				}else{
					$storeinfo["assStore"] ="";
				}
			}else{
				$storeinfo["assStore"] ="";
			}
			
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
	$response["result"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>