<?php
session_start();
?>
<?php
	$con = mysql_connect('localhost', 'webclient', '12345678');

	if (!$con) {
		die("Failed to conect to MySQL: " . mysqli_error());
	}

	$db_selected = mysql_select_db("bookstore");

	if (!$db_selected) {
		die('Can\'t use the db :' . mysql_error());
	}

	$isbn = $_POST['isbn'];
	if ($isbn == "" || $isbn == null) {
		echo '<script type="text/javascript"> window.location.href = "StoreShelfing.php" </script>';
	} else {
		$count = mysql_query("select count(isbn) as bookCount from books where isbn = '$isbn'");
		while ( $row = mysql_fetch_assoc($count)) {
			if (0 == $row['bookCount']) {
				echo '<script type="text/javascript"> window.location.href = "InsertBook.php" </script>';
			}
		}
	}

	$storeID = $_SESSION['storeID'];
	if ($storeID == null) {
		?>
		<html>
    		<head>
		        <script type="text/javascript">
		            alert("Please log into store first");
		            window.location.href='Login.php';
		        </script>
		    </head>
		</html>
		<?php
	}

	$storeName = $_SESSION['name'];
	
	/* code for populating privateCallNum by normal processing */
	$cat = mysql_query("select LEFT(category,1) as cat, LEFT(subcat,1) as subcat from books where isbn = '$isbn' ");
	$catRow = mysql_fetch_assoc($cat);
	$category = $catRow['cat'];
	$subcat = $catRow['subcat'];
	$value = $category.$subcat;
	
	$count = mysql_query("select count(*) as callcount from inventory where privateCallNum LIKE '$value%' ");
	$countRow = mysql_fetch_assoc($count);
	$countVal = $countRow['callcount'];
	$privateCallCount = $countVal + 1;
	
	$privateCallNumber = $category.$subcat.$privateCallCount ;
	
	
	$myfile = fopen("newLabels.txt", "a") or die("Unable to open file!");
	fwrite($myfile, "\t".$privateCallNumber);
	fclose($myfile);
	
	/*end of changes*/
	
	$update = false;
	$idx = $_POST['idx'];
	echo $idx;
	if ($idx == null || $idx == "") {
		$maxIdx = mysql_query("select max(idx) as idx from inventory where storeID = '$storeID' and isbn = '$_POST[isbn]'");
		while ( $row = mysql_fetch_assoc($maxIdx)) {
			$idx = $row['idx'] + 1;
		}

		if ($idx == null || $idx == "") {
			$idx = 0;
		}
	} else {
		$update = true;
	}

	if ($update) {
		$count = mysql_query("select count(idx) as idxCount from inventory where storeID = '$storeID' and isbn = '$isbn' and idx='$idx'");
		while ( $row = mysql_fetch_assoc($count)) {
			if (0 == $row['idxCount']) {
				$update = false;
				echo "this is false";
			}
		}
	}
	
	if ($update) {
		$sql = "UPDATE inventory SET privateCallNum = '$privateCallNumber', " .
				"bookCondition = '$_POST[condition]', quantity = '$_POST[quantity]', " .
				"salesPrice = '$_POST[salePrice]', rentPrice = '$_POST[rentPrice]', " .
				"rentDuration = '$_POST[duration]', status = '$_POST[status]' " .
				"where storeID = '$storeID' and isbn = '$isbn' and idx = '$idx'";
		$result = mysql_query($sql);

		if (!$result) {
			die('lid query:' . mysql_error());
		} else {
			echo '<script type="text/javascript"> alert("Successfully updated to Inventory") </script>';
			echo($privateCallNumber);
			echo '<script type="text/javascript"> window.location.href = "homepage.php" </script>';		
		}

	} else {
		$sql = "INSERT INTO inventory (storeID, storeName, isbn, idx, privateCallNum, bookCondition, condDesc, quantity, salesPrice, rentPrice, rentDuration, status) " .
		" VALUES('$storeID', '$storeName', '$isbn', '$idx', '$privateCallNumber', '$_POST[condition]', '$_POST[conditionDesc]', '$_POST[quantity]', '$_POST[salePrice]', '$_POST[rentPrice]', '$_POST[duration]', '$_POST[status]')";
		
		$result = mysql_query($sql);

		if (!$result) {
			die('lid query:' . mysql_error());
		} else {
			echo '<script type="text/javascript"> alert("Successfully added to Inventory") </script>';
			echo '<script type="text/javascript"> window.location.href = "homepage.php" </script>';		
		}
	}
	mysql_close($con);
?>
