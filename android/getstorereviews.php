<?php

// array for JSON response
$response = array();


if(isset($_POST['store'])){

    $store = $_POST['store'];

require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
	
	$result = mysql_query("SELECT firstName,lastName,reviewTime,comment FROM storereviews,stores,customers where storereviews.storeID = stores.storeID and customers.custID = storereviews.custID and storeName='$store'");
$storelist = array();
if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
			//$response["vganji"] = 1;
            //$result = mysql_fetch_array($result);
			
			while( $row =  mysql_fetch_array($result) ){
			
			$storeinfo=array();
			$storeinfo["name"] = $row["firstName"]." ".$row["lastName"];
			$storeinfo["reviewTime"] = $row["reviewTime"];
			$storeinfo["comment"] = $row["comment"];
			
			array_push($storelist, $storeinfo);
			}

			$response["success"] = 1;
			$response["storereview"] = array();
			array_push($response["storereview"], $storelist);
            // echoing JSON response
            echo json_encode($response);


    } else {
 
	$response["result"] = 0;
	$response["message1"] = "Opps! An error occurred.";
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