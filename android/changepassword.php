<?php

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['user1']) && isset($_POST['opwd']) && isset($_POST['npwd']) && isset($_POST['repwd']))

{
 	$user1 = $_POST['user1'];
	$opwd = $_POST['opwd'];
	$npwd = $_POST['npwd'];
	$repwd = $_POST['repwd'];

	// include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();

	$result = mysql_query("UPDATE customers SET password = '$npwd' WHERE emailAddress = '$user1' and password = '$opwd'");
 
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