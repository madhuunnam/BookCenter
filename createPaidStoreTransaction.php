<?php
	session_start();

	if(!isset($_SESSION['cartItems'])) {
		header("Location: storeOnsiteCheckIn.php");
		die();
	} else if (isset($_SESSION['cartItems']) && empty($_SESSION['cartItems'])) {
		unset($_SESSION['cartItems']);
		unset($_SESSION['reportItems']);
		unset($_SESSION['redirectURL']);
		unset($_SESSION['custID']);
		unset($_SESSION['custFirstName']);
		unset($_SESSION['custLastName']);
		unset($_SESSION['total']);
		unset($_SESSION['subtotal']);
		unset($_SESSION['orderType']);
		unset($_SESSION['tax']);
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
		$orderType=$_SESSION['orderType'];
		$custFirstName=$_SESSION['custFirstName'];
		$custLastName=$_SESSION['custLastName'];
		$payment=isset($_POST['payment']) ? intval($_POST['payment']) : 0;
		$paymentType=isset($_POST['paymentType']) ? $_POST['paymentType'] : '';
		$agentName=isset($_POST['agentName']) ? $_POST['agentName'] : '';
	    
	    $cartItemsJSON = json_decode($_SESSION['cartItems'], true);
		$title=$cartItemsJSON[0]['item'];
		$orderStatus = "Received";
		// if ($orderType == 'rent' || $orderType == 'buy') {
		// 	$orderStatus = "Ordered";
		// }
		//echo var_dump($_SESSION);
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

		$insertTransactionSQL = 'insert into transactions (tid, storeID, storeName, custID, custFirstName, custLastName, numberOfLines, subTot, taxRatePercent, taxAmount, totPrice, orderStatus, title, unitsOrdered, transTime, agentName, type)';
		$insertTransactionSQL .= ' values ('.$TID.', '.$storeID.', "'.$storeName.'", '.$custID.', "'.$custFirstName.'", "'.$custLastName.'", '.$count.', 0, 0, 0, 0, "'.$orderStatus.'", "'.$title.'", '.$unitsOrdered.', CURRENT_DATE, "'.$agentName.'", "'.$orderType.'")';
		$insertResult = mysql_query($insertTransactionSQL);

		$message = '';

		$paymentSuccessful = true;

		if (!$insertResult) {
			//echo $insertTransactionSQL;
			$message .= 'Unable to create an transactions please try again';
		} else if ($_SESSION['total'] > 0) {
			$reportItems = json_decode($_SESSION['reportItems'], true);
            $descs = '';

            foreach($reportItems as $key) {
                if ($key['damageCheck'] && $key['damageDesc'] != '') {
                	$desc = str_replace('"', "'", $key['damageDesc']);
                    $descs = $descs == '' ? $desc : $descs . ", " . $desc;
                }
            }
            $maxLedgerNumSQL = 'SELECT MAX(ledgerNum) AS maxLedgerNumber FROM ledgers WHERE custID='.$custID.' AND storeID='.$storeID;
            $maxLedgerNum = 1;
            $maxRowResult = mysql_query($maxLedgerNumSQL);

			while ( $maxRow = mysql_fetch_assoc($maxRowResult)) {
				$maxLedgerNum = $maxRow['maxLedgerNumber'] + 1;
			}

			$custPayBal = $_SESSION['total'] - $payment;
			$note = 'Paid in Full';
			if ($custPayBal > 0) {
				$note = 'Balance unpaid';
			}
			$insertLedgerSQL = ' INSERT INTO ledgers 
				SELECT custID, storeID, '.$maxLedgerNum.', '.$TID.', custFirstName, custLastName, storeName,"'.date('Y-m-d').'", 
				"'.$descs.'", '.$_SESSION['total'].', '.$payment.',  "'.$paymentType.'", '.$custPayBal.', "'.$note.'" FROM transactions WHERE tid='.$TID;
			$insertLedgerResult = mysql_query($insertLedgerSQL);
			echo $insertLedgerSQL;
			if (!$insertLedgerResult) {
				$paymentSuccessful = false;
				$message = ' Unable to register payment information ';

				$deleteTIDSQL = 'DELETE FROM transactions WHERE tid='.$TID;
				$deleteTIDResult = mysql_query($deleteTIDSQL);

				if (!$deleteTIDResult) {
					$message .= 'but, registered a transaction as received';
				} else {
					$message .= 'so, transaction was cancelled and removed';
				}
			} else {
				$accountSQL = 'SELECT accNum FROM accounts WHERE storeID='.$storeID.' AND custID='.$custID;
				$accountResult = mysql_query($accountSQL);

				$accountNum = 0;
				$hasAccount = true;
				if (!$accountResult || mysql_num_rows($accountResult) == 0) {
					$getMaxAccountNumSQL = 'SELECT max(accNum) as maxAccNum from accounts';
					$getMaxAccNumResult = mysql_query($getMaxAccountNumSQL);
					$accountNum = 1;
					while($row = mysql_fetch_assoc($getMaxAccNumResult)) {
						$accountNum = $row['maxAccNum'] + 1;
					}

					$insertAccount = 'INSERT INTO accounts VALUES ('.$accountNum.', '.$storeID.', '.$custID.', 0)';
					$insertAccResult = mysql_query($insertAccount);

					if (!$insertAccResult) {
						$hasAccount = false;
					}
				} else {
					while($row = mysql_fetch_assoc($accountResult)) {
						$accountNum = $row['accNum'] + 1;
					}				
				}

				if ($hasAccount) {
					$udpadeAccSQL = 'UPDATE accounts A 
						JOIN (SELECT custID, storeID, SUM(bal) AS bal FROM ledgers WHERE 
							custID='.$custID.' AND storeID='.$storeID.' GROUP BY custID, storeID
						      ) AS L ON L.custID = A.custID AND L.storeID = A.storeID
						SET A.bal = L.bal
						WHERE A.accNum='.$accountNum;
					$updateAccResult = mysql_query($udpadeAccSQL);
					if (!$updateAccResult) {
						$paymentSuccessful = false;
						$message = 'Unable to update user account with balance';
					}

				} else {
					$paymentSuccessful = false;
					$message = 'Unable to create account for User';
				}


			}
		}

		if ($paymentSuccessful ) {
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
					if ($orderType == 'rent' || $orderType == 'buy' || $orderType == 'borrow') {

						$updateInventory = true;
						if ($orderType != 'buy') {
							$outItemQuery = 'INSERT INTO outitems 
								SELECT S.storeID, S.storeName, C.custID, C.firstName, C.lastName, I.isbn, T.title, T.tid, '.$qty.', "'.$item["type"].'",
								       CURRENT_DATE, 
								       CASE 
									    WHEN S.lentLimit IS NOT NULL THEN DATE_ADD(CURRENT_DATE, INTERVAL S.lentLimit DAY) 
									    WHEN S.lentLimit IS NULL THEN  DATE_ADD(CURRENT_DATE, INTERVAL 14 DAY) 
								       END, S.maxRenew
								  FROM stores AS S 
								  JOIN inventory AS I ON I.storeID = S.storeID AND I.idx = '.$item["idx"].' AND I.isbn = "'.$item["isbn"].'"
								  JOIN transactions AS T ON S.storeID = T.storeID AND T.tid='.$TID.'
								  JOIN customers AS C ON C.custID = T.custID';
							$outItemResult = mysql_query($outItemQuery);

							if (!$outItemResult) {
								$updateInventory = false;
								$message .= '<BR> Unable to insert Out Item for tid '.$TID;
							} 
						}
						if ($updateInventory) {

							$reduceInventoryQuantity = 'UPDATE inventory SET quantity = quantity - 1 
							WHERE storeID = '.$storeID.' AND idx='.$item["idx"].' AND isbn="'.$item["isbn"].'"';

							$reduceQuantityResult = mysql_query($reduceInventoryQuantity);

							if (!$reduceQuantityResult) {
								//$message .= $reduceInventoryQuantity;
								$message .= '<BR> Unable to reduce quantity in inventory for isbn: '.$item["isbn"].', idx:'.$item["idx"].' and storeID:'.$storeID;
							}
						}
					} else {
						foreach($cartItemsJSON as $item) {
							$deleteSQL = 'DELETE FROM outitems WHERE custID='.$custID.
							' AND storeID='.$storeID.' AND isbn="'.$item['isbn'].'"';

							$result = mysql_query($deleteSQL);
							if (!$result) {
								$message .= 'Unable to delete outitem with isbn: '.$item['isbn'].' for the customer selected';
							}
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
			unset($_SESSION['reportItems']);
			unset($_SESSION['total']);
			unset($_SESSION['subtotal']);
			unset($_SESSION['tax']);
			unset($_SESSION['orderType']);
			header("Location: homepage.php");
			die();
		}
	}
?> 
