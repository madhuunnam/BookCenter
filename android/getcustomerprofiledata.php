<?php

// array for JSON response
$response = array();

if(isset($_POST['customerid'])){

    $customerid = $_POST['customerid'];


require_once __DIR__ . '/db_connect.php';
	$query = "";
    // connecting to db
    $db = new DB_CONNECT();
		
		$query = "select * from customers where custID = $customerid";

		
			$result = mysql_query($query);
			
			$profileinfo = array();

if (!empty($result)) {
        // check for empty result
		
        if (mysql_num_rows($result) > 0) {

		while( $row =  mysql_fetch_array($result) ){

			$profile = array();
			$profile["custID"] = $row["custID"];
			$profile["firstName"] = $row["firstName"];
			$profile["middleName"] = $row["middleName"];
			$profile["lastName"] = $row["lastName"];
			$profile["addrStNum"] = $row["addrStNum"];
			$profile["city"] = $row["city"];
			$profile["state"] = $row["state"];
			$profile["zip"] = $row["zip"];
			$profile["emailAddress"] = $row["emailAddress"];
			$profile["telephoneNumber"] = $row["telephoneNumber"];
			$profile["otherPhone"] = $row["otherPhone"];
			$profile["cardNumber"] = $row["cardNumber"];
			$profile["cardType"] = $row["cardType"];
			$profile["cardExp"] = $row["cardExp"];
			$profile["cardCode"] = $row["cardCode"];
			$profile["cardName"] = $row["cardName"];
			$profile["billingAddr"] = $row["billingAddr"];

		array_push($profileinfo, $profile);
			}

		$response["success"] = 1;
			$response["profileinfo"] = array();
			array_push($response["profileinfo"], $profileinfo);
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





	