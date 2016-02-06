<?php

// array for JSON response
$response = array();


// check for required fields
if(isset($_POST['firstName']) && isset($_POST['middleName'])  && isset($_POST['lastName']) && isset($_POST['addrStNum']) && isset($_POST['city']) && isset($_POST['state'])  && isset($_POST['zip']) && isset($_POST['emailAddress']) && isset($_POST['telephoneNumber']) && isset($_POST['otherPhone'])  && isset($_POST['cardNumber'])&& isset($_POST['cardType']) && isset($_POST['cardExp']) && isset($_POST['cardCode']) && isset($_POST['cardName'])  && isset($_POST['billingAddr']) && isset($_POST['custID']))
{
	
	$firstName = $_POST['firstName'];
	$middleName = $_POST['middleName'];
	$lastName = $_POST['lastName'];
	$addrStNum = $_POST['addrStNum'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$emailAddress = $_POST['emailAddress'];
	$telephoneNumber = $_POST['telephoneNumber'];
	$otherPhone = $_POST['otherPhone'];
	$cardNumber = $_POST['cardNumber'];
	$cardExp = $_POST['cardExp'];
	$cardCode = $_POST['cardCode'];
	$cardName = $_POST['cardName'];
	$cardType = $_POST['cardType'];
	$billingAddr = $_POST['billingAddr'];
	$custID = $_POST['custID'];

	// include db connect class
   	 require_once __DIR__ . '/db_connect.php';
 
   	 // connecting to db
   	 $db = new DB_CONNECT();

	// mysql inserting a new row
   	 $result = mysql_query("UPDATE customers SET firstName = '$firstName', middleName = '$middleName', lastName = '$lastName', addrStNum = '$addrStNum', city = '$city', state = '$state', zip = '$zip', emailAddress = '$emailAddress', telephoneNumber = '$telephoneNumber', otherPhone = '$otherPhone',  cardType= '$cardType',cardNumber = '$cardNumber', cardExp = '$cardExp', cardCode = '$cardCode', cardName = '$cardName', billingAddr = '$billingAddr' WHERE custID = '$custID'");

	
	// check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["result"] = "1";
        $response["message"] = "Customer information successfully updated.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["result"] = 0;
        $response["message"] = "Oops! An error occurred.";
	//$response["sql"]="INSERT INTO customers(firstName, lastName, emailAddress,password) VALUES('$fname', '$lname', '$email', '$pwd')"; 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["result"] = isset($_POST['firstName']);
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>
	
	