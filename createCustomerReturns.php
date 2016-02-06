<?php
	session_start();

	if (!isset($_SESSION) || !isset($_SESSION['custID']) || !isset($_SESSION['type']) || $_SESSION['type'] != 'Customer') {
		header("Location: homepage.php");
		die();	
	} else if(isset($_POST) && !empty($_POST) && !isset($_POST['returnItems'])) {
		header("Location: homepage.php");
		die();
	} else if(isset($_POST['returnItems'])) {
		$con = mysql_connect('localhost', 'webclient', '12345678');                   
		if (!$con) {
		    die('Failed to conect to MySQL: ' . mysql_error());
		}
		$db_selected = mysql_select_db("bookstore");
		if (!$db_selected) {
		    die('Can\'t use the db :' . mysql_error());
		}
		
		$success = true;
				
		$returnItemsJSON = json_decode($_POST['returnItems'], true);
		foreach($returnItemsJSON as $storeID => $returnItems) {
			$maxTIDSQL = 'SELECT MAX(trans.maxTid) AS maxTID FROM (SELECT MAX(tid) AS maxTid FROM activeorders UNION ALL SELECT MAX(tid) AS maxTid FROM transactions) AS trans';
			$maxResult = mysql_query($maxTIDSQL);
		    $TID = 1;
			while ( $maxRow = mysql_fetch_assoc($maxResult)) {
				$TID = $maxRow['maxTID'] + 1;
			}

			$count = count($returnItems);
			$insertTransactionSQL = 'insert into activeorders (tid, storeID, storeName, custID, custFirstName, custLastName, numberOfLines, orderStatus, title, type,  unitsOrdered, transTime)';
			$insertTransactionSQL .= ' SELECT '.$TID.', S.storeID, S.storeName, C.custID, C.firstName, C.lastName, '.$count.', "Ordered", "Online Return", "Return", '.$count.', NOW() 
  										FROM stores S, customers C 
									   WHERE S.storeID = '.$storeID.' 
										 AND C.custID = '.$_SESSION['custID'];
			$insertResult = mysql_query($insertTransactionSQL);

			if (!$insertResult) {
				echo 'Unable to return books '. $insertTransactionSQL. '   ;';
			} else {
				$custID = $_SESSION['custID'];
				$itemCount = 0;
				foreach($returnItems as $returnItem) {
					$itemCount = $itemCount + 1;
					$updateOutItems = 'UPDATE outitems SET tid='.$TID.', type="'.$returnItem['type'].'Return" WHERE tid='.$returnItem['tid'].' AND isbn="'.$returnItem['isbn'].'"';
					$updateOIResult = mysql_query($updateOutItems);

					if (!$updateOIResult) {
						$success = false;
					} else {
						$insertLineItem = 'INSERT INTO lineitems (tid, lineNumber, isbn, title, orderQuantity, type, dueDate)';
						$insertLineItem .= ' SELECT tid, '.$itemCount.', isbn, title, quantity, type, dueDate FROM outitems ';
						$insertLineItem .= ' WHERE tid='.$TID.' and isbn="'.$returnItem['isbn'].'"';

						$InsertLIResult = mysql_query($insertLineItem);
						if (!$InsertLIResult) {
							$success = false;
						}
					}
				}
			}
		}
		if($success) {
			echo 'Success';
		} else {
			$data = array('type' => 'error', 'message' => 'some message');
        	header('HTTP/1.1 400 Bad Request');
        	header('Content-Type: application/json; charset=UTF-8');
        	echo json_encode($data);
		}	
	}
?> 
