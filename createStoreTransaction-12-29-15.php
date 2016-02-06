<?php
	session_start();

	if(!isset($_SESSION['cartItems'])) {
		header("Location: storeOnsiteCheckIn.php");
		die();
	} else if (isset($_SESSION['cartItems']) && empty($_SESSION['cartItems'])) {
		unset($_SESSION['cartItems']);
		unset($_SESSION['redirectURL']);
		unset($_SESSION['custID']);
		unset($_SESSION['custFirstName']);
		unset($_SESSION['custLastName']);
		unset($_SESSION['total']);
		unset($_SESSION['subtotal']);
		unset($_SESSION['tax']);
		unset($_SESSION['orderType']);
		header("Location: homepage.php");
		die();
	} else {
		$con = mysql_connect('localhost', 'webclient', '12345678');                   
		if (!$con) {
		    die('Failed to conect to MySQL: ' . mysql_error());
		}
		$db_selected = mysql_select_db("bookstore");
		if (!$db_selected) {
		    die('Can\'t use the db :' . mysql_error());
		}
		$storeID=$_SESSION['storeID'];
		$storeName=$_SESSION['name'];
		$custID=$_SESSION['custID'];
		$custFirstName=$_SESSION['custFirstName'];
		$custLastName=$_SESSION['custLastName'];
	    
	    $cartItemsJSON = json_decode($_SESSION['cartItems'], true);
		$title=$cartItemsJSON[0]['item'];
		$unitsOrdered = 0;
		foreach($cartItemsJSON as $item) {
			$unitsOrdered = $unitsOrdered + intval($item['qty']);
		}
		$count = count($cartItemsJSON);
		$maxTIDSQL = 'SELECT MAX(trans.maxTid) AS maxTID FROM (SELECT MAX(tid) AS maxTid FROM activeorders UNION ALL SELECT MAX(tid) AS maxTid FROM transactions) AS trans';
		$maxResult = mysql_query($maxTIDSQL);
	    $TID = 1;
		while ( $maxRow = mysql_fetch_assoc($maxResult)) {
			$TID = $maxRow['maxTID'] + 1;
		}

		$insertTransactionSQL = 'insert into transactions (tid, storeID, storeName, custID, custFirstName, custLastName, numberOfLines, subTot, taxRatePercent, taxAmount, totPrice, orderStatus, title, unitsOrdered, transTime, type)';
		$insertTransactionSQL .= ' values ('.$TID.', '.$storeID.', "'.$storeName.'", '.$custID.', "'.$custFirstName.'", "'.$custLastName.'", '.$count.', 0, 0, 0, 0, "Received", "'.$title.'", '.$unitsOrdered.', CURRENT_DATE, "borrow")';
		$insertResult = mysql_query($insertTransactionSQL);

		$message = '';
		if (!$insertResult) {
			echo $insertTransactionSQL;
			$message .= 'Unable to create an transactions please try again';
		} else {
			$_SESSION['TID'] = $TID;
			$lineNumber = 0;
			foreach($cartItemsJSON as $item) {
				$lineNumber = $lineNumber + 1;
				$price=0;
				$qty = intval($item['qty']);
				if ($item['type'] == 'rent') {
					$price = $qty * (float)$item['rentprice'];
				} else if ($item['type'] == 'buy') {
					$price = $qty * (float)$item['saleprice'];
				}
				$lineItemQuery = 'INSERT INTO lineitems (tid, lineNumber, isbn, title, orderQuantity, priceAmount, type, description)';
				$lineItemQuery .= ' VALUES ('.$TID.', '.$lineNumber.', "'.$item["isbn"].'", "'.$item["item"].'", '.$qty.', '.$price.', "'.$item["type"].'", "'.$item["desc"].'" )';
				
				$lineQueryResult = mysql_query($lineItemQuery);

				if (!$lineQueryResult) {
					$message .= '<BR> Unable to insert Line Item for tid '.$TID.' and line number '.$lineNumber;
				} else {

					$outItemQuery = 'INSERT INTO outitems 
						SELECT S.storeID, S.storeName, C.custID, C.firstName, C.lastName, I.isbn, T.title, T.tid, '.$qty.', "'.$item["type"].'",
						       CURRENT_DATE, 
						       CASE 
							    WHEN S.lentLimit IS NOT NULL THEN DATE_ADD(CURRENT_DATE, INTERVAL S.lentLimit DAY) 
							    WHEN S.lentLimit IS NULL THEN  DATE_ADD(CURRENT_DATE, INTERVAL 14 DAY) 
						       END
						  FROM stores AS S 
						  JOIN inventory AS I ON I.storeID = S.storeID AND I.idx = '.$item["idx"].' AND I.isbn = "'.$item["isbn"].'"
						  JOIN transactions AS T ON S.storeID = T.storeID AND T.tid='.$TID.'
						  JOIN customers AS C ON C.custID = T.custID';
					$outItemResult = mysql_query($outItemQuery);

					if (!$outItemResult) {
						//$message .= $outItemQuery;
						$message .= '<BR> Unable to insert Out Item for tid '.$TID;
					} else {

						$reduceInventoryQuantity = 'UPDATE inventory SET quantity = quantity - 1 
						WHERE storeID = '.$storeID.' AND idx='.$item["idx"].' AND isbn="'.$item["isbn"].'"';

						$reduceQuantityResult = mysql_query($reduceInventoryQuantity);

						if (!$reduceQuantityResult) {
							//$message .= $reduceInventoryQuantity;
							$message .= '<BR> Unable to reduce quantity in inventory for isbn: '.$item["isbn"].', idx:'.$item["idx"].' and storeID:'.$storeID;
						}
					}
				}
			}
		}

		if ($message != "") {
			echo $message;
		} else {
			unset($_SESSION['redirectURL']);
			unset($_SESSION['custID']);
			unset($_SESSION['custFirstName']);
			unset($_SESSION['custLastName']);
			unset($_SESSION['cartItems']);
			unset($_SESSION['total']);
			unset($_SESSION['subtotal']);
			unset($_SESSION['tax']);
			unset($_SESSION['orderType']);
			header("Location: homepage.php");
			die();
		}
	}
?> 
