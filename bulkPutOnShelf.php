<?php
	session_start();
	$con = mysql_connect('localhost', 'webclient', '12345678');
	$returnJSON = array();
	if (!$con) {
		$returnJSON['status'] = 'error';
		$returnJSON['error'] = "Failed to conect to MySQL: " . mysqli_error();
		echo json_encode($returnJSON);
		return;
	}

	$db_selected = mysql_select_db("bookstore");

	if (!$db_selected) {
		$returnJSON['status'] = 'error';
		$returnJSON['error'] = 'Can\'t use the db :' . mysql_error();
		echo json_encode($returnJSON);
		return;
	} 

	$storeID = isset($_SESSION['storeID']) ? $_SESSION['storeID'] : null;
	if ($storeID == null) {
		$returnJSON['status'] = 'error';
		$returnJSON['error'] = 'LoginERROR';
		echo json_encode($returnJSON);
		return;
	}

	$key = $_POST['key'];


	$count=0;
	for ($j=0; $j < count($_POST['bookRef']); $j++) {
		if($_POST['bookRef'][$j] != "")
			$count++;
	}

	if (!in_array($key, ['isbn', 'privateCallNum'])) {
		$returnJSON['status'] = 'error';
		$returnJSON['error'] = 'only ISBN and privateCallNum are supported at this moment';
		echo json_encode($returnJSON);
		return;
	}

	$storeName = $_SESSION['name'];
	$TID = isset($_POST['tid']) ? $_POST['tid'] : "";
	$insertTransactionSQL = 'UPDATE transactions SET numberOfLines = numberOfLines + count WHERE tid='.$TID;

	if ($TID == '') {
		$maxTIDSQL = 'SELECT MAX(trans.maxTid) AS maxTID FROM (SELECT MAX(tid) AS maxTid FROM activeorders UNION ALL SELECT MAX(tid) AS maxTid FROM transactions) AS trans';
		$maxResult = mysql_query($maxTIDSQL);
	    $TID = 1;
		while ( $maxRow = mysql_fetch_assoc($maxResult)) {
			$TID = $maxRow['maxTID'] + 1;
		}

		$insertTransactionSQL = 'insert into transactions (tid, storeID, storeName, numberOfLines, orderStatus, type, transTime)';
		$insertTransactionSQL .= ' values ('.$TID.', '.$storeID.', "'.$storeName.'", '.$count.', "Received", "BorrowReturn", CURRENT_DATE)';
	}
	$insertResult = mysql_query($insertTransactionSQL);

	$message = '';
	if (!$insertResult) {
		$returnJSON['status'] = 'error';
		$returnJSON['error'] = 'Unable to create an transactions please try again';
		echo json_encode($returnJSON);
		return;
	} else {
		$errored = [];
		$succeeded = []; 
		$success = True;
		    		
		for ($lineNumber = 1; $lineNumber <= $count; $lineNumber++) {

			while($_POST['bookRef'][$lineNumber-1] == "") {
				$lineNumber++;
			}

		    $value = $_POST['bookRef'][$lineNumber-1];
			$lineItemQuery = 'INSERT INTO lineitems (tid, lineNumber, isbn, orderQuantity, type)';
			$lineItemQuery .= ' SELECT distinct '.$TID.', '.$lineNumber.', isbn, 1, "BorrowReturn" FROM inventory where storeID='.$storeID.' and '.$key.'="'.$value.'"';
			
			$lineQueryResult = mysql_query($lineItemQuery);

			if (!$lineQueryResult) {
				$success = False;
				$errored[] = $value;
			} else {
				$max = mysql_query("select max(idx) as idx from inventory where storeID='$storeID' and ".$key."='$value'");
				$idx = 0;
				while ( $row = mysql_fetch_assoc($max)) {
					if ($row['idx'] != null) {
						$idx = $row['idx'];
					}
				}

	    		$sql = "UPDATE inventory set quantity=quantity+1 where storeID='$storeID' and ".$key."='$value' and idx=".$idx;
		
				$result = mysql_query($sql);

				if (!$result) {
					$success = False;
					$errored[] = $value;
				} else {
					$outitemDeleteSQL = "DELETE FROM outitems WHERE storeID='$storeID' AND isbn IN (SELECT DISTINCT isbn FROM inventory WHERE ".$key."='$value' AND storeID='$storeID')";
					$outitemsDeleteResult = mysql_query($outitemDeleteSQL);

					if (!$outitemsDeleteResult) {
						$success = False;
						$errored[] = $value;
					} else {
						$succeeded[] = $value;
					}
				}
			}
		}
		if ($success) {
			$returnJSON['status'] = 'Success';
			$returnJSON["succeeded"] = $succeeded;
		} else {
			$returnJSON['status'] = 'Failure';
			$returnJSON["succeeded"] = $succeeded;
			$returnJSON['missedValues'] = $errored;		
		}
	}

	echo json_encode($returnJSON);	
	mysql_close($con);
?>