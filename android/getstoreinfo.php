<?php

// array for JSON response
$response = array();


if(isset($_POST['loc'])){

    $loc = $_POST['loc'];

require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
	
	$result = mysql_query("SELECT * FROM stores WHERE city = '$loc'");

if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {

 
            //$result = mysql_fetch_array($result);
			$city = "";
			while( $row =  mysql_fetch_array($result) ){

	   //$storeinfo = array();
         //   $storeinfo["city"] = $result["city"];
			$city = $city . $row["city"] . ":";

		//$response["success"] = 1;
 
            // user node
          //  $response["storeinfo"] = array();
 
            //array_push($response["storeinfo"], $storeinfo);
			}

			$storeinfo = array();
			$storeinfo["city"] = $city;
			$response["success"] = 1;
			$response["storeinfo"] = array();
			array_push($response["storeinfo"], $storeinfo);
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