<?php
session_start ();

$sessionStoreID = "";
if (isset ( $_SESSION ['storeID'] )) {
	$sessionStoreID = $_SESSION ['storeID'];
}

$sessionLibraryName = "";
if (isset ( $_SESSION ['libraryName'] )) {
	$sessionLibraryName = $_SESSION ['libraryName'];
}
?>
<html>
<head>
<style>
body {
	text-align: center;
}

table {
	margin: 0 auto; /* or margin: 0 auto 0 auto */
	text-align: left;
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
	padding: 5px;
	font-size: 0.95em;
	border-radius: 5px;
}

input[type=radio] {
	margin-right: 10px;
	margin-top: 10px;
}

.anchorButton {
	padding: 10px;
	border: 1px solid #aaa;
	background-color: #ddd;
	color: #222;
	font-weight: bold;
	cursor: pointer;
	text-decoration: none;
}
</style>
<script type="text/javascript" src='jquery-1.4.1.js'></script>
<script type="text/javascript">
	
	sessionStoreId ='<?php echo $sessionStoreID; ?>';

	procureItems = new Array();
	test = new Array();
	
			
	function takeToHomePage() {
			window.location = 'homepage.php';
	}

	var numOfLines = 0;
	var totalQty = 0;
	var totalPrice = 0;
	
	function updateCartAndShow() {
		if($( "#storename" ).val() !="" && $( "#Agent" ).val() !="" && $( "#quantity" ).val() !="" && $( "#Description" ).val() !="" &&
				$( "#isbn" ).val() !="" && $( "#Price" ).val() !=""){
		newItemJSON = {
				'supplierstore' : $( "#storename" ).val(),
				'agentname' : $( "#Agent" ).val(),
				'qty' : $( "#quantity" ).val(),
				'desc' : $( "#Description" ).val(),
				'isbn' : $( "#isbn" ).val(),
				'unitprice': $( "#Price" ).val(),
			}
		procureItems.push(newItemJSON);
		
		numOfLines = numOfLines +1;
		var qty = $( "#quantity" ).val();
		totalQty = Number(totalQty) + Number(qty);
		var price = $( "#quantity" ).val() * $( "#Price" ).val();
		totalPrice = totalPrice + price;
		$( "#quantity" ).val("1");
		$( "#isbn" ).val("");
		$( "#Price" ).val("");
		
		alert("Cart Updated successfully! Try to add another item to cart or click Procure button!");
		}
		else {
			alert("Please enter all the fields");
			}
}
	
	function doProcure() {
		if (procureItems.length == 0) {
			alert("There are no books in the Cart! Please add books to cart and then click Procure button!");
		}else{
			$.ajax({
		          url: 'insertProcure.php',
		          data: {
			          'proitems' :procureItems,
			          'storeId': sessionStoreId,
			          'numofLines' : numOfLines,
			          'totalQty' : totalQty,
			          'totalPrice' : totalPrice,
			      },
		          success: function (response) {
					alert("Books procured successfully!");
					window.location = 'ProcureForm.php';
		          },
		          error: function () {
		             alert("Error occured while procuring. Please try again");
		          }
			 });
		}
	}		
	
	</script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
	<h2>Procure Books</h2>
	<form method=post action="ProcureBooks.php">
	
		<input type="hidden" id="subhashStore" value="" />
		<table>
			<tr>
				<th>Books are all procured/purchased from Store</th>
				<td><input type="text" name="storename" id="storename"
					placeholder="Store Name"></td>
			</tr>
			<tr>
				<th>Agent Name</th>
				<td><input type="text" name="Agent" id="Agent"
					placeholder="Agent Name"></td>
			</tr>
			<tr>
				<th>ISBN *</th>
				<td><input type="text" name="isbn" id="isbn"></td>
			</tr>
			<tr>
				<th>Qunatity</th>
				<td><input type="text" name="quantity" id="quantity" value="1"></td>
			</tr>
			<tr>
				<th>Unit Price</th>
				<td><input type="text" name="Price" id="Price" placeholder="Price">
				</td>
			</tr>

			<tr>
				<th>Description</th>
				<td><input type="text" name="Description" id="Description"
					placeholder="Description"></td>
			</tr>
			<tr>
				<td><input type="button" name="Add to Cart" value="Add to Cart"
					id="addToCart" onclick="javascript:updateCartAndShow();"></td>
				<td><input type="button" name="Cancel" value="Cancel" id="cancel"
					onclick="javascript:takeToHomePage();"></td>
				<td><input type="button" name="procure" id="procure" value="Procure"
					onclick="javascript:doProcure();"></td>
			</tr>

		</table>
	</form>
</body>
</html>