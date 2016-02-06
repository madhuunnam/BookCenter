<?php

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['tempemail']) && isset($_POST['temppwd']))

{
 	$tempemail = $_POST['tempemail'];
	$temppwd = $_POST['temppwd'];
	

	// include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();

	$result = mysql_query("UPDATE customers SET password = '$temppwd' WHERE emailAddress = '$tempemail'");
 
if ($result) {
        // successfully updated
        $response["result"] = 1;
        $response["message"] = "Password successfully updated.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
 
	$response["result"] = 0;
	$response["message"] = "Opps! An error occurred.";
	echo json_encode($response);
    }
} else {
    // required field is missing
    $response["result"] = 0;
    $response["message"] = "Required field(s) is missing";
    $response["sql"] = "UPDATE customers SET password = '$npwd' WHERE emailAddress = '$user1' AND password = '$opwd'";
 
    // echoing JSON response
    echo json_encode($response);
}
?>