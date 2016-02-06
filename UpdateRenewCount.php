<?php
$responseJSON = array ();
$renewCnt = $_GET ['renewCount'];
$storeID = $_GET ['storeIDForRenew'];
$custID = $_GET ['customerIDForRenew'];
$isbn = $_GET ['isbnForRenew'];
$newDueDate = $_GET ['dueDate'];
error_log("InUPDATERENEWCOUNT" .$newDueDate);
$con = mysql_connect ( 'localhost', 'webclient', '12345678' );
if (! $con) {
	die ( 'Failed to conect to MySQL: ' . mysql_error () );
}
$db_selected = mysql_select_db ( "bookstore" );
if (! $db_selected) {
	die ( 'Can\'t use the db :' . mysql_error () );
}
$sql = "UPDATE OutItems SET renewCount = $renewCnt, dueDate = STR_TO_DATE('$newDueDate','%Y-%m-%d')  where storeID = '".$storeID."' and custID = '".$custID. "' and isbn = '" .$isbn. "';";
error_log($sql);
mysql_query ( $sql );
$responseJSON = array (
		'success' => 'Updated the Renew Count Successfully' 
);

echo json_encode ( $responseJSON );

?>	