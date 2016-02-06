<html>
<script type="text/javascript">
<?php
	session_start();

	$con = mysql_connect('localhost', 'webclient', '12345678');

	if (!$con) {
		die("Failed to conect to MySQL: " . mysqli_error());
	}

	$db_selected = mysql_select_db("bookstore");

	if (!$db_selected) {
		die('Can\'t use the db :' . mysql_error());
	}

	//$img = file_get_contents($_FILES['fileToUpload]['tmp_name']);
	$max = mysql_query("select max(storeID) as storeID from stores");
	$storeID = 1;
	while ( $row = mysql_fetch_assoc($max)) {
		$storeID = $row['storeID'] + 1;
	}

	$allowSelfCheckout = false;
	if (isset($_POST['allowSelfCheckout'])) {
		$allowSelfCheckout = true;
	}
    $result = mysql_query("INSERT INTO stores (storeID, storeName, addrStNum, addrLine2, city, state, zip, phone, phone1, email, mgrPasswd, staffPasswd, question, answer, storeType, services, keywords, website, openHour, mgrName, mgrPhone, mgrEmail, dueRent, dueLent, dueHold, graceRent, fineRateRent, maxFine, maxRenew, lentLimit, selfCheckout) " .
	" VALUES('$storeID', '$_POST[storeName]', '$_POST[storeAddr1]', '$_POST[storeAddr2]', '$_POST[city]', '$_POST[state]', '$_POST[zip]', '$_POST[phone]', '$_POST[phone1]', '$_POST[email]', '$_POST[managerPassword]', '$_POST[staffPassword]', '$_POST[securityQuestion]', '$_POST[securityQuestionAnswer]', '$_POST[storeType]', '$_POST[serviceAvailable]', '$_POST[keywords]', '$_POST[website]', '$_POST[openHours]', '$_POST[managerName]', '$_POST[managerPhone]', '$_POST[managerEmail]', '$_POST[durationRent]', '$_POST[durationLend]', '$_POST[durationHold]', '$_POST[gracePeriod]', '$_POST[fineRate]', '$_POST[maxFine]', '$_POST[renewTimes]', '$_POST[lendLimit]', '". $allowSelfCheckout ."')");

	if (!$result) {
		echo 'alert("Sign-up unsuccessfull. Please check your input and try again.);';
		echo 'window.history.back();';
	} else {
		if ( isset($_POST['motherStoreValue']) && $_POST['motherStoreValue'] != "") {
			list($motherStoreID, $motherStoreName) = explode(",", $_POST['motherStoreValue']);
			$motherStoreResult = mysql_query("INSERT INTO storeAssociations (storeID, storeName, motherID, motherStore) values ('$storeID', '$_POST[storeName]', '$motherStoreID', '$motherStoreName')");
			if (!$motherStoreResult) {
				echo 'alert("Successfully created a store with name ' . $_POST['storeName'] .', but unable to associate the store to mother store");';
			} else {
				echo 'alert("Successfully created a store with name ' . $_POST['storeName'] . '. This store is associated to ' . $motherStoreName . '");';
			}
		} else {
			echo 'alert("Successfully created a store with name ' . $_POST['storeName'] . '");';		
		}
		$_SESSION['name'] = $_POST['storeName'];
		$_SESSION['type'] = 'Store';
		$_SESSION['loggedIn'] = true;
		$_SESSION['storeID'] = $storeID;
		$_SESSION['attempts'] = null;
		echo 'window.location.href = "homepage.php";';
	}

	mysql_close($con);
?>

</script>
</html>
