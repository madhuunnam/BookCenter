<?php

// array for JSON response
$response = array();

if(isset($_POST['username']) && isset($_POST['password']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];

	// include db connect class
   	 require_once __DIR__ . '/db_connect.php';
 
   	 // connecting to db
   	 $db = new DB_CONNECT();

	$result = mysql_query("SELECT * FROM customers WHERE emailAddress = '$username' and password='$password'");

	if (mysql_num_rows($result) == 1) {
		while($row =  mysql_fetch_array($result)){
		$response["name"] = $row["firstName"]." ".$row["lastName"];
		$response["custID"] = $row["custID"];
        $response["result"] = 1;
        $response["message"] = "Customer have been successfully login.";
		}
	
	 echo json_encode($response);
    } else {
	
	$response["result"] = 0;
        $response["message"] = "Wrong Password";
	//$response["query"]=mysql_num_rows($result);
	
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










