<?php 
	session_start();
?>
<html>
<head>
	<title>
		Store Editor
	</title>
	<style>
		body {
			text-align: center;
		}

		table {
    		margin: 0 auto; /* or margin: 0 auto 0 auto */
    		text-align:left; 		
    	}

    	td {
    		padding: 10px;
    	}

    	.submitBtnTd {
    		text-align: center;
    		vertical-align: center;
    	}

    	input {
    		height: 2em;
    	}

    	input[type=submit] {
    		-webkit-appearance: none;
  			height: 2em;
  			width: 12em;
  			font-size: 1em;
  			border-radius: 5px;
		}

		input[type=button] {
    		-webkit-appearance: none;
  			padding:5px;
  			font-size: 0.95em;
  			border-radius: 5px;
		}

		input[type=radio] {
			margin-right: 10px;
			margin-top: 10px;
		}

		.anchorButton {
			padding:10px;
			border:1px solid #aaa;
			background-color: #ddd;
			color: #222;
			font-weight: bold;
			cursor: pointer;
			text-decoration: none;
		}
	</style>
	<script type="text/javascript" src='jquery-1.4.1.js'></script>
	<script type="text/javascript">
		function setUpdate() {
			$('#idx').val(0);
		}

		function incrementidx() {
			$('#idx').val(parseInt($('#idx').val()) + 1);
		}

		function clearidx() {
			$('#idx').val("");
		}

		function validateAndSubmit() {
			if ($('#isbn').val() != undefined && $('#isbn').val() != "") {
				$('#putOnShelf').submit();
			} else {
				alert("Please enter an ISBN number");
			}
		}

		function validateAndUpdate() {
			$('#update').val("true");
			if ($('#idx').val() == undefined || $('#idx').val() == "") {
				$('#idx').val(0);
			} 
			validateAndSubmit();
		}

		function clearValidateAndSubmit() {
			clearidx();
			validateAndSubmit();
		}

		function takeToHomePage() {
			window.location = 'homepage.php';
		}

		function checkIsbnInShelf() {
			var idx = $('#idx').val();
			var isbn = $('#isbn').val();
			clearInput();
			if ((isbn.length == 10 || isbn.length == 13)) {
				$.post('checkIsbnInShelf.php', { isbn: isbn, idx: idx }, function(data) {
    				$('#privateCallNum').val(data.privateCallNum);
					$('#condition').val(data.bookCondition);
					$('#conditionDesc').val(data.condDesc);
					$('#quantity').val(data.quantity);
					$('#salePrice').val(data.salesPrice);
					$('#rentPrice').val(data.rentPrice);
					$('#duration').val(data.rentDuration);
					$('#status').val(data.status);
    			}, 'json');
    		}
			
		}

		function clearInput() {
			$('#privateCallNum').val("");
			$('#condition').val("");
			$('#conditionDesc').val("");
			$('#quantity').val("1");
			$('#salePrice').val("");
			$('#rentPrice').val("");
			$('#duration').val("");
			$('#status').val("");
		}
	</script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>

	<h2> 
	<?php
		$con = mysql_connect('localhost', 'webclient', '12345678');

		if (!$con) {
			echo '<script type="text/javascript"> alert("Connection Failed") </script>';
			die("Failed to conect to MySQL: " . mysqli_error());
		}

		$db_selected = mysql_select_db("bookstore");

		if (!$db_selected) {
			echo '<script type="text/javascript"> alert("DB could not be selected") </script>';
			die('Can\'t use the db :' . mysql_error());
		} 

		$storeID = isset($_SESSION['storeID']) ? $_SESSION['storeID'] : null;
		if ($storeID == null) {
	?>
				<script type="text/javascript">
					alert("Please Sign-In");
					window.location.href = 'Login.php';
				</script>

	<?php
		}

		$sql = "SELECT storeName from stores where storeID = '$storeID'";
	
		$result = mysql_query($sql);
		$storeName = "";
		while ( $row = mysql_fetch_assoc($result)) {
			$storeName = $row['storeName'];
		}
		
		echo ucwords($storeName);
	?> Shelfing </h2>
	<form method=post action="putToShelf.php" id="putOnShelf">
	<table> 
		<tr>
			<th colspan=2> Shelfing Sell/Rent items: </th>
			<th> <a href="BulkShelfing.php" class="anchorButton">Shelf Lend Items </a> </th>
		</tr>
		<tr>
			<th> <input type="radio" name="shelfTask" value="put" onchange="javascript:clearidx();"> Put on Shelf </th>
			<th> <input type="radio" name="shelfTask" value="update" onchange="javascript:setUpdate();"> Update Shelf </th>
		</tr>
		<tr>
			<th> ISBN * </th>
			<td> <input type="text" name="isbn" id="isbn" onmouseup="javascript:checkIsbnInShelf()" onkeyup="javascript:checkIsbnInShelf()"> </td>
			<td> Idx: <input type="text" name="idx" style="width:30px;"value="" id="idx"> <input type="button" value="Update Another" name="updateAnother" id="updateAnother" onclick="javascript:incrementidx();"> </td>
		</tr>
		<tr>
			<th> Private CallNum </th>
			<td> <input type="text" name="privateCallNum" id="privateCallNum"> </td>
		</tr>
		<tr>
			<th> Condition </th>
			<td > 
				<select name="condition" id="condition"> 
					<option value=""/>
					<option value="new">New </option>
					<option value="excellent">Excellent </option>
					<option value="good">Good</option>
					<option value="fair">Fair</option>
					<option value="poor">Poor</option>
				</select> 
			</td>
		</tr>
		<tr>
			<th> Condition Description</th>
			<td> <input type="text" name="conditionDesc" id="conditionDesc"> </td>
			<td class="exampleValue"> e.g. back cover missing </td>
		</tr>
		<tr>
			<th> Quantity</th>
			<td> <input type="text" name="quantity" id="quantity" value="1"> </td>
		</tr>
<!--
		<tr>
			<th> Sale Price </th>
			<td> <input type="text" name="salePrice" id="salePrice"> </td>
		</tr>
		<tr>
			<th> Rent Price </th>
			<td> <input type="text" name="rentPrice" id="rentPrice"> </td>
		</tr>
-->
		<tr>
			<th> Duration<br>(# days) </th>
			<td> <input type="text" name="duration" id="duration"> </td>
		</tr>
		<tr>
			<th> Note </th>
			<td> <input type="text" disabled="disabled" name="note" id="note"> </td>
		</tr>
		<tr>
			<th> Status </th>
			<td> <input type="text" name="status" id="status"> </td>
			<td class="exampleValue"> e.g. lost </td>
		</tr>
		<tr>
			<td> <input type="button" name="putOnShelf" id="putOnShelf" value="Put on Shelf" onclick="javascript:clearValidateAndSubmit();"> </td>
			<td> <input type="button" name="updateBtn" id="updateBtn" value="Update" onclick="javascript:validateAndUpdate();">
				 <input type="hidden" name="update" id="update" value="false"> </td>
			<td> <input type="button" name="done" id="done" value="Done" onclick="javascript:takeToHomePage();"> </td>
		</tr>
	</table>
	</form>
</body>
</html>
