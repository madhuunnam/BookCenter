<?php

// array for JSON response
$response = array();


// check for required fields
if(isset($_POST['fname']) && isset($_POST['lname'])  && isset($_POST['email']) && isset($_POST['pwd']) )
{
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	//$add1 = $_POST['add1'];
	//$city = $_POST['city'];
	//$state = $_POST['state'];
	//$zip = $_POST['zip'];

	$email = $_POST['email'];
	$pwd = $_POST['pwd'];

	//$phno1 = $_POST['phno1'];
	//$phno2 = $_POST['phno2'];

	// include db connect class
   	 require_once __DIR__ . '/db_connect.php';
 
   	 // connecting to db
   	 $db = new DB_CONNECT();
	 $checkemail = mysql_query("select * from customers where emailAddress='$email'");
		//$response["resul1t"] = "select * customers where emailAddress='$email'";
	 if(mysql_fetch_array($checkemail) ){

		$response["result"] = 0;
        $response["message"] = "Email already present";
		echo json_encode($response);
	 }else{
	// mysql inserting a new row
   	 $result = mysql_query("INSERT INTO customers(firstName, lastName, emailAddress, password) VALUES('$fname', '$lname', '$email', '$pwd')");

	// check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["result"] = 1;
        $response["message"] = "Customer information successfully inserted.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["result"] = 0;
        $response["message"] = "Oops! An error occurred.";
	$response["sql"]="INSERT INTO customers(firstName, lastName, emailAddress,password) VALUES('$fname', '$lname', '$email', '$pwd')"; 
        // echoing JSON response
        echo json_encode($response);
    }

}
} else {
    // required field is missing
    $response["result"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>
	
