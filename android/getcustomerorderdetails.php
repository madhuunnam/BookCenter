<?php

// array for JSON response
$response = array();


if(isset($_POST['tid'])){

    $tid = $_POST['tid'];
	
	
require_once __DIR__ . '/db_connect.php';
	$query = "";
    // connecting to db
    $db = new DB_CONNECT();
	
		$query = "select * from activeorders where tid = $tid";
	

	


	$result = mysql_query($query);
	//	$result = mysql_query("SELECT * FROM organizations WHERE '$cname' = '$cnamevalue'");
			$storeinfo = array();		
if (!empty($result)) {
        // check for empty result
		
        if (mysql_num_rows($result) > 0) {

	
        	$city = "";
			while( $row =  mysql_fetch_array($result) ){

			$store = array();
			$store["tid"] = $row["tid"];
			$store["title"] = $row["title"];
			$store["type"] = $row["type"];
			$store["transTime"] = $row["transTime"];
			$store["storeName"] = $row["storeName"];
			$store["orderStatus"] = $row["orderStatus"];
			$store["msgToCust"] = $row["msgToCust"];
			$store["msgToStore"] = $row["msgToStore"];
			

		
            array_push($storeinfo, $store);
			}

			//$storeinfo = array();

			$response["success"] = 1;
			$response["storeinfo"] = array();
			array_push($response["storeinfo"], $storeinfo);
            // echoing JSON response
            echo json_encode($response);


    } else {
	$response["success"] = 0;
	$response["result"] = 0;
	$response["message"] = "Opps! An error occurred.";
	echo json_encode($response);
    }
}else{
		$response["success"] = $query;
	$response["result"] = "1";
	$response["message"] = "Opps! An error occurred.";
	echo json_encode($response);
}

}else{
		$response["success"] = 0;
	$response["result"] = 2;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>