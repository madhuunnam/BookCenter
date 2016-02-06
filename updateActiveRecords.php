<?php
	session_start();

	if((isset($_POST) && empty($_POST)) || !isset($_POST)) {
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
		
		$total=$_POST['total'];
		$shippingFee=$_POST['shippingFee'];
		$shippingMethod=$_POST['shippingMethod'];
		$carrierName=$_POST['carrierName'];
		$shippingAddress=$_POST['shippingAddress'] . ' ' . $_POST['shippingAddress2'] .", " . $_POST['city']. ', ' . $_POST['state']. ', ' . $_POST['zip'];
		$deliveryNotes=$_POST['deliveryNotes'];
		$receiverName=$_POST['receiverName'];
		$updateAddress=$_POST['updateAddress'];

		$TID = $_SESSION['TID'];

		$updateActiveRecordSQL = 'update activeorders set ';
		$updateActiveRecordSQL .= ' totPrice='.$_POST['total'];
		$updateActiveRecordSQL .= ', shipFee='.$_POST['shippingFee'];
		$updateActiveRecordSQL .= ', shippingAddr="'.$shippingAddress.'"';
		$updateActiveRecordSQL .= ', shipMethod="'.$_POST['shippingMethod'].'"';
		$updateActiveRecordSQL .= ', carrierName="'.$_POST['carrierName'].'"';
		$updateActiveRecordSQL .= ', deliveryNotes="'.$_POST['deliveryNotes'].'"';
		$updateActiveRecordSQL .= ', receiverName="'.$_POST['receiverName'].'"';
		$updateActiveRecordSQL .= ' where tid='.$TID;

		$updateARResult = mysql_query($updateActiveRecordSQL);
		if (!$updateARResult) {
			echo "Unable to confirm shipping info. Please try again.";
			die();
		} else {
			if ($updateAddress == 'Y') {
				$updateCustAddrSQL = 'update customers set ';
				$updateCustAddrSQL .= ' addrStNum="'.$_POST['shippingAddress'].'"';
				$updateCustAddrSQL .= ', addrL2="'.$_POST['shippingAddress2'].'"';
				$updateCustAddrSQL .= ', city="'.$_POST['city'].'"';
				$updateCustAddrSQL .= ', state="'.$_POST['state'].'"';
				$updateCustAddrSQL .= ', zip="'.$_POST['zip'].'"';
				$updateCustAddrSQL .= ' where custID='.$_SESSION['custID'];

				$updateCustAddrResult = mysql_query($updateCustAddrSQL);
				if (!$updateCustAddrResult) {
					echo $updateCustAddrSQL;
					echo 'Unable to update customer address';
					die();
				}
			}

			$customerSQL = 'select * from customers where custID=' . $_SESSION['custID'];
		    $result = mysql_query($customerSQL);
		    $row = mysql_fetch_assoc($result);
		    if ($row['cardNumber'] != null &&
		        $row['cardType'] != null &&
		        $row['cardName'] != null &&
		        $row['cardExp'] != null &&
		        $row['cardCode'] != null &&
		        $row['billingAddr'] != null) {
		        $hasCardInfo = true;
		    }

		    if ($hasCardInfo) {
		    	header("Location: CustomerActiveOrders.php");
				die();
		    } else {
		    	header("Location: Payments.php");
				die();
		    }

		}
	}
?> 
