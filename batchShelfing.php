
<?php

	$responseJSON = array();
	
	$con = mysql_connect ( 'localhost', 'webclient', '12345678' );
	
	if (! $con) {
		die ( 'Failed to connect to MySQL: ' . mysql_error () );
		$responseJSON = array('error' => 'Query failed');
	}
	
	$db_selected = mysql_select_db ( "bookstore" );

	if (! $db_selected) {
		die ( 'Can\'t use the db :' . mysql_error () );
		$responseJSON = array('error' => 'Query failed');
	}
	
	$s = $_POST['SID'];
	
	$books = "SELECT LEFT(B.category,1) as cat,  LEFT(B.subcat,1) as subcat, YEAR(B.pubdate) as Year, I.isbn as isbn, I.idx as idx, I.storeID as store FROM  Books B, Inventory I where B.isbn = I.isbn  and I.storeID = '$s' order by Year" ;

	$orderedbooks = mysql_query ( $books );

	if(!$orderedbooks){
		die('lid query:' . mysql_error());
		$responseJSON = array('error' => 'Query failed');
	}
	else{
		$responseJSON = array('success' => 'PrivateCallNum allocated successfully');
	}
	while ( $row = mysql_fetch_assoc ( $orderedbooks ) ) {
		
		$catrow = $row['cat'];
		$subcatrow = $row['subcat'];
		$idxrow = $row['idx'];
		
		$privateCallNum = $catrow.$subcatrow.$idxrow;
		
		$stId = $row['store'];
		$isbn = $row['isbn'];
		$idx = $row['idx'];
		
		$sql = "UPDATE inventory SET privateCallNum = '$privateCallNum' " .
		"where storeID = '$stId' and isbn = '$isbn' and idx = '$idx' ";
		$result = mysql_query($sql);
		if (!$result) {
			die('lid query:' . mysql_error());
			$responseJSON = array('error' => 'Query failed');
		}
		else{
			$responseJSON = array('success' => 'PrivateCallNum allocated successfully');
		}
	}
	
	echo json_encode($responseJSON);
	
?>