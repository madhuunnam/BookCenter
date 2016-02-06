<?php
	session_start();

	if(!isset($_POST['payment']) && !isset($_POST['total']) && !isset($_POST['tid'])) {
		header("Location: storeOrderStatus.php");
		die();
	} else if(!isset($_POST['payment']) && !isset($_POST['total']) && isset($_POST['tid'])) {
		header("Location: storeCheckout.php?tid=".$_POST['tid']);
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

		//echo var_dump($_POST);

		$storeID=$_SESSION['storeID'];
		$custID=$_POST['custID'];
		$payment=isset($_POST['payment']) ? intval($_POST['payment']) : 0;
		$agentName=isset($_POST['agentName']) ? $_POST['agentName'] : '';
		$shippingFee=isset($_POST['shipping']) ? $_POST['shipping'] : 0;
	    $orderStatus = "Received";

		if ($shippingFee != 0) {
			$orderStatus = "Shipped";
		}

		$TID = $_POST['tid'];
		
		$updatActiveOrdersSQL = 'UPDATE activeorders SET orderStatus="'.$orderStatus.'" WHERE tid='.$TID;
		$transactionUpdated = true;
	   	$updateResult = mysql_query($updatActiveOrdersSQL);
	   	if (!$updateResult) {
	   		$transactionUpdated = false;
	   	}
		
		$message = '';
		$paymentSuccessful = true;

		if( $orderStatus != "Shipped") {
			$insertTransactionSQL = 'insert into transactions select * from activeorders where tid='.$TID;
			$insertResult = mysql_query($insertTransactionSQL);

			if (!$insertResult) {
				$transactionUpdated = false;
			} 
		}

		if (!$transactionUpdated) {
			$message .= 'Unable to create an transactions please try again';
		} else if ($_POST['total'] > 0) {
			$descs = '';
            $maxLedgerNumSQL = 'SELECT MAX(ledgerNum) AS maxLedgerNumber FROM ledgers WHERE custID='.$custID.' AND storeID='.$storeID;
            $maxLedgerNum = 1;
            $maxRowResult = mysql_query($maxLedgerNumSQL);

			while ( $maxRow = mysql_fetch_assoc($maxRowResult)) {
				$maxLedgerNum = $maxRow['maxLedgerNumber'] + 1;
			}

			$custPayBal = $_POST['total'] - $payment;
			$note = 'Paid in Full';
			if ($custPayBal > 0) {
				$note = 'Balance unpaid';
			}
			$insertLedgerSQL = ' INSERT INTO ledgers 
				SELECT custID, storeID, '.$maxLedgerNum.', '.$TID.', custFirstName, custLastName, storeName,"'.date('Y-m-d').'", 
				"'.$descs.'", '.$_POST['total'].', '.$payment.',  "Online", '.$custPayBal.', "'.$note.'" FROM activeorders WHERE tid='.$TID;
			$insertLedgerResult = mysql_query($insertLedgerSQL);
			//echo $insertLedgerSQL;
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

		if ($paymentSuccessful && $orderStatus != "Shipped") {
	   		
			$deleteActiveOrder = 'DELETE FROM activeorders WHERE tid='.$TID;
			$deleteResult = mysql_query($deleteActiveOrder);

			if (!$deleteResult) {
				$message = 'Unable to delete the active order';
			}
			
	   	}
		

		if ($message != "") {
			echo $message;
		} else {
			header("Location: homepage.php");
			die();
		}
	}
?> 
