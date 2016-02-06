<?php

// array for JSON response
$response = array();


if(isset($_POST['customerid'])){

    $customerid = $_POST['customerid'];
	
	
require_once __DIR__ . '/db_connect.php';
	$query = "";
    // connecting to db
    $db = new DB_CONNECT();
	
		$query = "select * from libmembers where custID = $customerid";
	

	


	$result = mysql_query($query);
	//	$result = mysql_query("SELECT * FROM organizations WHERE '$cname' = '$cnamevalue'");
			$storeinfo = array();		
if (!empty($result)) {
        // check for empty result
		
        if (mysql_num_rows($result) > 0) {

	
        	$city = "";
			while( $row =  mysql_fetch_array($result) ){

			$store = array();
			$store["custID"] = $row["custID"];
			$store["custFirstName"] = $row["custFirstName"];
			$store["custLastName"] = $row["custLastName"];
			$store["storeName"] = $row["storeName"];
			$store["joinDate"] = $row["joinDate"];
			$store["pin"] = $row["pin"];
			$store["activate"] = $row["activate"];

		
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