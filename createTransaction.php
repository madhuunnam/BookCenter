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
                $type=$cartItemsJSON[0]['type'];  // added 8-15-15 Fu ***
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
                
                // added type below 8-15 Fu ***
		$insertTransactionSQL = 'insert into transactions (tid, storeID, storeName, custID, custFirstName, custLastName, numberOfLines, subTot, taxRatePercent, taxAmount, totPrice, orderStatus, title, type, unitsOrdered, transTime)';
		$insertTransactionSQL .= ' values ('.$TID.', '.$storeID.', "'.$storeName.'", '.$custID.', "'.$custFirstName.'", "'.$custLastName.'", '.$count.', '.$subtotal.', '.$tax.', '.$taxAmount.', '.$total.', "Received", "'.$title.'", "'.$type.'", '.$unitsOrdered.', CURRENT_DATE)';
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
                        
                        
                        // changed below by Fu on 8-15-15 only one join now and use S.dueLent --- ALL LIBRARIES'S DEFAULT DUELENT IS 14 DAYS HERE *** 
                        $outItemQuery = 'INSERT INTO outitems (storeID, storeName, custID, custFirstName, custLastName, isbn, 
                                        title, tid, quantity, type, outDate, dueDate, renewCount)
                                SELECT T.storeID, T.storeName, T.custID, T.custFirstName, T.custLastName, "'.$item["isbn"]
                                        .'", "'.$item["item"] .'", T.tid, '.$qty.', "'  .$item["type"].'",
                                       CURRENT_DATE, 
                                       CASE 
                                            WHEN S.dueLent IS NOT NULL THEN DATE_ADD(CURRENT_DATE, INTERVAL S.dueLent DAY) 
                                            WHEN S.dueLent IS NULL THEN  DATE_ADD(CURRENT_DATE, INTERVAL 14 DAY) 
                                       END, S.maxRenew
                                  FROM stores AS S  JOIN transactions AS T ON S.storeID = T.storeID AND T.tid="' .$TID .'";';
                        echo $outItemQuery;
                        // error_log ($outItemQuery);
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
			unset($_SESSION['cartItems']);
			header("Location: ". $redirectURL);
			die();
		}
	}
?> 
