<?php
session_start ();


$con = mysql_connect ( 'localhost', 'webclient', '12345678' );

if (! $con) {
	die ( 'Failed to connect to MySQL: ' . mysql_error () );
	$message .= 'Database connection failed. Please try again';
}

$db_selected = mysql_select_db ( "bookstore" );

if (! $db_selected) {
	die ( 'Can\'t use the db :' . mysql_error () );
	$message .= 'Database connection failed. Please try again';
}
$numOfLines = $_GET ['numofLines'];
$unitsProcured = $_GET ['totalQty'];
$totalPrice = $_GET ['totalPrice'];

$storeID = $_GET ['storeId'];
$getStoreNameSQL = "select storeName from Stores where storeID = '" . $storeID . "'";
$storenameresult = mysql_query ( $getStoreNameSQL );
while ( $row = mysql_fetch_assoc ( $storenameresult ) ) {
	$storeName = $row ['storeName'];
}
$title ="";
$proItems = $_GET ['proitems'];
foreach ( $proItems as $items ) {
	$supplierstore = $items ['supplierstore'];
	$agentname = $items ['agentname'];
	$isbn = $items ['isbn'];
}

$getBookTitleSQL = "select title from books where isbn = '" . $isbn . "'";
$bookTitleResult = mysql_query ( $getBookTitleSQL );
while ( $row = mysql_fetch_assoc ( $bookTitleResult ) ) {
	$title = $row ['title'];
}
$message = '';
$insertProcuredItemSQL = "INSERT INTO `PROCURES`(`StoreName`, `SupplierName`, `NumberOfLines`, `TotalPrice`, `UnitsProcured`, `AgentName`, `Title`) VALUES
			('" . $storeName . "','" . $supplierstore . "','" . $numOfLines . "','" . $totalPrice . "','" . $unitsProcured . "','" . $agentname . "','" . $title . "')";

$insert = mysql_query ( $insertProcuredItemSQL );
if (! $insert) {
	$message .= 'Unable to procure please try again';
	error_log ( "Insert into procure Failed " );
} else {
	error_log ( "Insert into procure SUCCESSFULL" );
}

$getMaxPidSQL = "select max(PID) as PID from Procures;";
$maxPidResult = mysql_query ( $getMaxPidSQL );
while ( $row = mysql_fetch_assoc ( $maxPidResult ) ) {
	
	$PID = $row ['PID'];
}

$lineNumber = 0;
$eachTitle = "";
$pItems = $_GET ['proitems'];
foreach ( $pItems as $item ) {
	$lineNumber = $lineNumber + 1;
	$qty = $item ['qty'];
	$desc = $item ['desc'];
	$isbn = $item ['isbn'];
	$unitprice = $item ['unitprice'];
	
	$lineprice = $qty * $unitprice;
	
	$getEachBookTitleSQL = "select title from books where isbn = '" . $isbn . "'";
	$eachBookTitleResult = mysql_query ( $getEachBookTitleSQL );
	while ( $row = mysql_fetch_assoc ( $eachBookTitleResult ) ) {
		$eachTitle = $row ['title'];
	}
	
	$insertProcureLineItemsSQL = "INSERT INTO `ProcureLineItems`(`PID`, `LineNum`, `isbn`, `title`, `description`, `Quantity`, `price`) VALUES
			('" . $PID . "','" . $lineNumber . "','" . $isbn . "','" . $eachTitle . "','" . $desc . "','" . $qty . "','" . $lineprice . "')";
	$insertLineItem = mysql_query ( $insertProcureLineItemsSQL );
	if (! $insertLineItem) {
		$message .= '\n Unable to insert Procure Line Item for pid '.$PID.' and line number '.$lineNumber;
		error_log ( "Insert into procureLineItems Failed " );
	} else {
		error_log ( "Insert into procureLineItems SUCCESSFULL" );
	}
}

if ($message != "") {
	echo $message;
} 

?>