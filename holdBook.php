<?php


session_start ();

$responseJSON = array ();
$holderId = $_POST ['holderId'];
$holdDate = $_POST ['holdDate'];
$storeID = $_POST ['sID'];
$isbn = $_POST ['isbn'];
$storeName = $_POST['storeName'];

if (! isset ( $_SESSION ['type'] ) || $_SESSION ['type'] != 'Customer') {
	$_SESSION ['redirectUrl'] = 'Storepage.php?name='.$storeName.'&storeId='.$storeID;
	error_log("**In Hold Book Php If condition to prompt login" );

	$responseJSON = array('loginNeeded' => 'true');
}
else{

	$con = mysql_connect ( 'localhost', 'webclient', '12345678' );
	if (! $con) {
		die ( 'Failed to conect to MySQL: ' . mysql_error () );
	}
	$db_selected = mysql_select_db ( "bookstore" );
	if (! $db_selected) {
		die ( 'Can\'t use the db :' . mysql_error () );
	}
	
	$sql = "UPDATE Inventory SET holderID = $holderId, holdDate = STR_TO_DATE('$holdDate','%Y-%m-%d')  where storeID = '".$storeID."'  and isbn = '" .$isbn. "';";
	
	error_log($sql);
	$updateResult = mysql_query($sql);
	if (! $updateResult) {
		error_log("SQL error while updating holderID and holdDate in Inventory Table");
		$responseJSON = array('error' => 'There is a problem placing hold for this book! Please try again!');
	}
	else {
		$responseJSON = array('success' => 'Book placed under hold successfully');
	}
	error_log(json_encode ( $responseJSON ));
}
echo json_encode ( $responseJSON );
?>