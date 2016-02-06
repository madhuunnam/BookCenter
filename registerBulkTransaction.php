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
	if ($key == "callnumber") {
        $key = 'privateCallNum';
    }

	$errored = [];
	$failedDeletes = []; 
	$success = True;

	$max = mysql_query("select max(tid) as tid from transactions");
	$tid = 1;
	while ( $row = mysql_fetch_assoc($max)) {
		if ($row['tid'] != null) {
			$tid = $row['tid'] + 1;
		}
	}
	$insertTransaction = "INSERT INTO transactions (tid, storeID, orderStatus, type) values ('$tid', '$storeID', 'Received', 'BorrowReturn')";
	
	$transactionInsertResult = mysql_query($insertTransaction);

	if (!$transactionInsertResult) {
		$returnJSON['status'] = 'error';
		$returnJSON['error'] = 'FailedTransaction';
		echo json_encode($returnJSON);
		return;
	} else if ($key == 'isbn') {
	
		for ($i = 0, $l = count($_POST['shelvedItems']); $i < $l; $i++) {
			if($_POST['shelvedItems'][$i] != "") {
    			$value = $_POST['shelvedItems'][$i];

    			$lineNumber = $i + 1;
    			$lineInsertSql = "INSERT INTO lineitems (tid, lineNumber, isbn)  VALUES('$tid', '$lineNumber', '$value')";
	
				$result = mysql_query($lineInsertSql);

				if (!$result) {
					$success = False;
					$errored[] = $value;
				}

				$deleteFromSql = "DELETE FROM outitems where storeID='$storeID' and ".$key."='$value'";

				$deleteResult = mysql_query($deleteFromSql);

				if (!$result) {
					$success = False;
					$failedDeletes[] = $value;
				}
    		}
		}
	} 

	if ($success) {
		$returnJSON['status'] = 'Success';
	} else {
		$returnJSON['status'] = 'Failure';
		$returnJSON["failedDeletes"] = $failedDeletes;
		$returnJSON['missedValues'] = $errored;		
	}

	echo json_encode($returnJSON);	
	mysql_close($con);
?>