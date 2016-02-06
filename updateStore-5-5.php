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
	$storeID = $_SESSION['storeID'];
	$allowSelfCheckout = false;
	if (isset($_POST['allowSelfCheckout'])) {
		$allowSelfCheckout = true;
	}
    $result = mysql_query("UPDATE stores SET storeName='$_POST[storeName]', addrStNum='$_POST[storeAddr1]', addrLine2='$_POST[storeAddr2]', city='$_POST[city]', state='$_POST[state]', zip='$_POST[zip]', phone='$_POST[phone]', phone1='$_POST[phone1]', email='$_POST[email]', mgrPasswd='$_POST[managerPassword]', staffPasswd='$_POST[staffPassword]', question='$_POST[securityQuestion]', answer='$_POST[securityQuestionAnswer]', storeType='$_POST[storeType]', services='$_POST[serviceAvailable]', keywords='$_POST[keywords]', website='$_POST[website]', openHour='$_POST[openHours]', mgrName='$_POST[managerName]', mgrPhone='$_POST[managerPhone]', mgrEmail='$_POST[managerEmail]', dueRent='$_POST[durationRent]', dueLent='$_POST[durationLend]', dueHold='$_POST[durationHold]', graceRent='$_POST[gracePeriod]', fineRateRent='$_POST[fineRate]', maxFine='$_POST[maxFine]', maxRenew='$_POST[renewTimes]', lentLimit='$_POST[lendLimit]', selfCheckout='".$allowSelfCheckout."' where  storeID='$storeID'");

	if (!$result) {
		echo 'alert("Unable to update store profile.);';
		echo 'window.history.back();';
	} else {
		echo 'alert("Updated store profile successfully.");';
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