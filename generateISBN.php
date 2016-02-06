<?php
session_start ();

$responseJSON = array ();
$con = mysql_connect ( 'localhost', 'webclient', '12345678' );

if (! $con) {
	die ( 'Failed to connect to MySQL: ' . mysql_error () );
	error_log("generateISBN.php dbconn failed");
	$responseJSON = array('error' => 'Query failed');
}
$db_selected = mysql_select_db ( "bookstore" );

if (! $db_selected) {
	die ( 'Can\'t use the db :' . mysql_error () );
	error_log("generateISBN.php dbconn failed");
	$responseJSON = array('error' => 'Query failed');
}

$genIsbnSQL = "select isbnCnt from stores where storeID = " . $_SESSION ['storeID'];
$result = mysql_query ( $genIsbnSQL );
if (! $result) {
	error_log("generateISBN.php insert query failed");
	$responseJSON = array('error' => 'Query failed');
} 

while ( $row = mysql_fetch_assoc ( $result ) ) {
	$count = $row ['isbnCnt'];
	$isbnCntNew = $count + 1;
}

$generatedIsbn = $_SESSION ['storeID'] . "---" . $isbnCntNew;
$responseJSON = array (
		'newisbn' => $generatedIsbn 
);

$updateisbnCnt = 'UPDATE Stores SET isbnCnt =' . $isbnCntNew . '
									WHERE storeID = ' . $_SESSION ['storeID'];

$updateResult = mysql_query ( $updateisbnCnt );

if (! $updateResult) {
	error_log("generateISBN.php update query failed");
	$responseJSON = array('error' => 'Query failed');
}
error_log("END of GENERATEISBN.PHP");
echo json_encode ( $responseJSON );
?>