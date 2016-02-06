<?php

// array for JSON response
$response = array();

// check for required fields
if(isset($_POST['cusmsgname']) && isset($_POST['cusmsgemail']) && isset($_POST['cusmsgph']) && isset($_POST['cusmsgsub']) && isset($_POST['cusmsg']))
{
	$cusmsgname = $_POST['cusmsgname'];
	$cusmsgemail = $_POST['cusmsgemail'];
	$cusmsgph = $_POST['cusmsgph'];
	$cusmsgsub = $_POST['cusmsgsub'];
	$cusmsg = $_POST['cusmsg'];

	
	// include db connect class
   	 require_once __DIR__ . '/db_connect.php';
 
   	 // connecting to db
   	 $db = new DB_CONNECT();

	// mysql inserting a new row
   	 $result = mysql_query("INSERT INTO messages(name, email, phone, subject, msgText) VALUES('$cusmsgname', '$cusmsgemail', '$cusmsgph', '$cusmsgsub', '$cusmsg')");

	// check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["result"] = 1;
        $response["message"] = "Customer message successfully inserted.";
	
	
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["result"] = 0;
        $response["message"] = "Oops! An error occurred.";
	
	// echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["result"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>




	