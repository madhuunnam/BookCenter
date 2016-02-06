<?php
	session_start();

	if(!isset($_SESSION['cartItems']) || (isset($_POST) && empty($_POST)) || !isset($_POST)) {
		header("Location: homepage.php");
		die();
	} else if(isset($_SESSION['cartItems']) && empty($_SESSION['cartItems'])) {
		$redirectURL = isset($_POST['redirectURL']) ? $_POST['redirectURL'] : 'homepage.php';
		header("Location: " . $redirectURL);
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
		$total=$_POST['total'];
		$subtotal=$_POST['subtotal'];
		$tax=$_POST['tax'];
		$taxAmount = (float)$tax * (float)$subtotal;
		$redirectURL=$_POST['redirectURL'];
		$storeID=$_SESSION['storeID'];
		$storeName=$_SESSION['libraryName'];
		$custID=$_SESSION['custID'];
		$customerSQL = 'select * from customers where custID=' . $_SESSION['custID'];
		$result = mysql_query($customerSQL);
	    $row = mysql_fetch_assoc($result);
		$custFirstName=$row['firstName'];
		$custLastName=$row['lastName'];
	    
		$cartItemsJSON = json_decode($_SESSION['cartItems'], true);
		$title=$cartItemsJSON[0]['item'];
		$orderType=$cartItemsJSON[0]['type'];
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

		$insertActiveRecordSQL = 'insert into activeorders (type, transTime, tid, storeID, storeName, custID, custFirstName, custLastName, numberOfLines, subTot, taxRatePercent, taxAmount, totPrice, orderStatus, title, unitsOrdered)';
		$insertActiveRecordSQL .= ' values ("'.$orderType.'",now(), '.$TID.', '.$storeID.', "'.$storeName.'", '.$custID.', "'.$custFirstName.'", "'.$custLastName.'", '.$count.', '.$subtotal.', '.$tax.', '.$taxAmount.', '.$total.', "ordered", "'.$title.'", '.$unitsOrdered.')';
		$insertResult = mysql_query($insertActiveRecordSQL);

		$message = '';
		if (!$insertResult) {
			echo $insertActiveRecordSQL;
			$message .= 'Unable to create an active order please try again';
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

				echo $lineItemQuery;
				if (!$lineQueryResult) {
					$message .= '\n Unable to insert Line Item for tid '.$TID.' and line number '.$lineNumber;
				}
			}
		}

		if ($message != "") {
			echo $message;
		} else {
			unset($_SESSION['cartItems']);
			header("Location: ". $redirectURL);
			die();
		}
	}
?> 
