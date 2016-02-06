<?php ob_start(); 

require_once 'C://wamp//www//PHPWord-develop//src//PhpWord//Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();

	$responseJSON = array();
	
	$con = mysql_connect ( 'localhost', 'webclient', '12345678' );
	
	if (! $con) {
		die ( 'Failed to conect to MySQL: ' . mysql_error () );
		$responseJSON = array('error' => 'Query failed');
	}
	
	$db_selected = mysql_select_db ( "bookstore" );

	if (! $db_selected) {
		die ( 'Can\'t use the db :' . mysql_error () );
		$responseJSON = array('error' => 'Query failed');
	}
	
	$s = $_POST['SID'];
	
	$labelquery = "select privateCallNum, isbn, idx  from inventory  where storeID = '$s'";
	$label = mysql_query ( $labelquery );
	if (! $label) {
		die('lid query:' . mysql_error());
		$responseJSON = array('error' => 'Query failed');
	}
	$labelString="";
	while ( $row = mysql_fetch_assoc ( $label ) ) {
		
		$printLabel = $row['privateCallNum'] ;
		$labelString = $labelString."  ".$printLabel;
	}
	// Creating the new document...
	$phpWord = new \PhpOffice\PhpWord\PhpWord();
	
	/* Note: any element you append to a document must reside inside of a Section. */
	
	// Adding an empty Section to the document...
	$section = $phpWord->addSection();
	// Adding Text element to the Section having font styled by default...
	
	$section->addText(
			
			htmlspecialchars($labelString)
	);
	// Saving the document as OOXML file...
	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
	$objWriter->save('BatchLabel.docx');
	$responseJSON = array('url' => 'BatchLabel.docx');

	
	ob_end_flush();
	
	echo json_encode($responseJSON);
	
?>