<?php
session_start();

$sessionStoreID = "";
if (isset($_SESSION['storeID'])) {
	$sessionStoreID = $_SESSION['storeID'];
}

$sessionLibraryName = "";
if (isset($_SESSION['libraryName'])) {
	$sessionLibraryName = $_SESSION['libraryName'];
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search Results</title>
</head>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!-- include the jquery ui library -->
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">

	storeId = "<?php echo $sessionStoreID; ?>";
	storeName = "<?php echo $sessionLibraryName; ?>";
	$(document).ready(function () {
		$('#storeID').val(storeId);
		$('#libraryName').val(storeName);
	});
	sessionStoreID='<?php echo $sessionStoreID; ?>';
	removed = false;
	removedCartItems = new Array();
	cartItems = <?php 
		if (isset($_SESSION['cartItems'])) {
			echo $_SESSION['cartItems'];
			echo ";";
		?>
			$(document).ready(function() {
				$('#checkoutBtn').show();
				$('#showcartBtn').show();
			});
		<?php
		} else {
			echo "new Array();";
		}
	?>

	function showCategory(idValue) {
		$('#'+idValue+'Li').toggleClass('clicked');
		if ($('#'+idValue+'Link').html() == ' + ') {
			$('#'+idValue+'Link').html(' - ');
		} else {
			$('#'+idValue+'Link').html(' + ');
		}
	}

	function showDialog(idValue) {
		sid = $('#' + idValue + 'storeID').val();
		if (cartItems.length != 0 && storeId != "" && storeId != sid) {
			alert('You already have items in cart that belong to book store: ' + storeName + ". You cannot have items from a differnt store at the same time. Please checkout the existing cart in order to order books from a different store.")
			return;
		}

		$( "#"+idValue+"Div" ).dialog({
	      modal: true,
	      buttons: {
	      			"Buy": function() {
	      				updateCartAndShow(idValue, 'buy');
	      				$( this ).dialog( "close" );
	                },
	                "Borrow": function() {
	                	updateCartAndShow(idValue, 'borrow');
	                	$( this ).dialog( "close" );
	                },
	                "Rent": function() {
	                	updateCartAndShow(idValue, 'rent');
	                	$( this ).dialog( "close" );
	                },
	                Cancel: function() {
	                    $( this ).dialog( "close" );
	                }
	            }
	    });
	}

	function showBook(idValue) {
		$( "#"+idValue ).dialog({
	      modal: true,
	      width: 460,
	      buttons: {
	      			"back": function() {
	      				$( this ).dialog( "close" );
	                }
	            }
	    });
	}

	function updateCartAndShow(idValue, type) {
		if (storeId == "" || cartItems.length == 0) {
			storeId = $('#' + idValue + 'storeID').val();
			sessionStoreID = storeId;
			storeName = $('#' + idValue + 'storeName').val();

			$('#storeID').val(storeId);
			$('#libraryName').val(storeName);
		}

		if (sessionStoreID != $('#' + idValue + 'storeID').val()) {
			alert("Cart can only contain items from one store. Please checkout the existing items to get new items from this store or remove existing items and update cart.");
		} else {

			newItemJSON = {
				'item' : $( "#"+idValue+"Name" ).val(),
				'qty' : $( "#"+idValue+"Quantity" ).val(),
				'desc' : $( "#"+idValue+"Desc" ).val(),
				'isbn' : $( "#"+idValue+"ISBN" ).val(),
				'idx': $( "#"+idValue+"idx" ).val(),
				'saleprice': $( "#"+idValue+"SalePrice" ).val(),
				'rentprice' : $( "#"+idValue+"RentPrice" ).val(),
				'type' : type
			}

			cartItems.push(newItemJSON);
		}
		showcart();	
	}

	function removeCartEntry(i) {
		price = parseFloat($('#remove' + i + 'Price').html());
		tax = parseFloat($('#cartTax').val());
		total = parseFloat($('#cartTotal').val()) - price;
		$('#cartSubTotal').val(total);
		$('#cartTotal').val(total * (1 + tax));
		console.log(price);
		console.log(tax);
		console.log(total);

		$('#cartEntry' + i).remove();
		removedCartItems.push(i);
	}

	function showcart() {
		$('.cartItemEntries').remove();
		i = 0;
		totalPrice = 0;
		$('#cartTable').empty();
		$('#cartTable').html('<tr><td colspan=5 align="center" style="text-align:center"><h3 style="text-align:center"> Your Cart </h3></td>'+
		'</tr><tr>'+ 
		'<th style="width:150px" >Item</th>'+
		'<th style="width:50px">Quantity</th>'+
		'<th style="width:150px">Desc</th>'+
		'<th style="width:75px">price</th>'+
		'</tr>');
		for (itemNumber in cartItems) {
			itemJSON = cartItems[itemNumber];
			price = 0;
			if (itemJSON['type'] == 'buy') {
				price = itemJSON['qty'] * itemJSON['saleprice'];
			} else if (itemJSON['type'] == 'rent') {
				price =  itemJSON['qty'] * itemJSON['rentprice'];
			} 

			totalPrice = totalPrice + price;
			$('#cartTable tr:last').after('<tr id="cartEntry' + i + '" class="cartItemEntries">' + 
				'<td>' + itemJSON['item'] + '</td>' +
				'<td>' + itemJSON['qty'] + '</td>' +
				'<td>' + itemJSON['desc'] + '</td>' +
				'<td id="remove'+ i + 'Price">' + price + '</td>' +
				'<td><a href="#" onclick="removeCartEntry('+ i + ');">Del</a></td>' +
				'</tr>');
			i = i + 1;
		}

		while (i < 10) {
			$('#cartTable tr:last').after('<tr><td colspan=5></td></tr>');
			i = i + 1;
		}

		$('#cartSubTotal').val(totalPrice);
		$('#cartTax').val(0);
		$('#cartTotal').val(totalPrice);
		$('#cartDialog').dialog({
			width: 500,
			height: 600,
			modal: true,
			buttons: {
	      			"Checkout": function() {
	      				$( this ).dialog( "close" );
	      				checkout();
	                },
	                "Update Cart": function() {
	      				$( this ).dialog( "close" );
	      				updateCart();
	                }
	            }
		});

		$('#checkoutBtn').show();
	}

	function updateCart() {
		$('#redirectUrl').val(window.location.href);
		i = 0;
		newCartItems = new Array();
		for (itemNumber in cartItems) {
			addItem = true;
			for ( index in removedCartItems) {
				if(removedCartItems[index] == i) {
					addItem = false;
				}
			}
			
			if (addItem) {
				newCartItems.push(cartItems[itemNumber]);
			}

			i = i + 1;
		}
		$('#cartItems').val(JSON.stringify(newCartItems));
		$('#summaryCartForm').submit();
	}

	function checkout() {
		$('#redirectUrl').val('summaryCart.php');
		i = 0;
		newCartItems = new Array();
		for (itemNumber in cartItems) {
			addItem = true;
			for ( index in removedCartItems) {
				if(removedCartItems[index] == i) {
					addItem = false;
				}
			}
			
			if (addItem) {
				newCartItems.push(cartItems[itemNumber]);
			}

			i = i + 1;
		}
		$('#cartItems').val(JSON.stringify(newCartItems));
		$('#summaryCartForm').submit();
	}


	function buttononclickorder(obj) 
	{
		var storeID = obj.value;
		var isbn = obj.name;
		window.location.href="EditBook.php?store=" + storeID + "&isbn=" + isbn;
	}
</script>
<style type="text/css">

   body {
            text-align: center;
        }

        table.priceChart {
            margin: 0 auto; /* or margin: 0 auto 0 auto */
            text-align:left;
            margin-top:20px;
            margin-bottom:20px;
        }

        td {
            padding: 5px;
        }
        .priceChart {
            border:1px solid #ddd;
            border-radius: 5px;
            padding:10px;
            background-color: #ddd;
        }

        .priceChart th {
            border:1px solid #ddd;
            background-color: #ddd;
            color:#222;
            text-align: center;
            border-radius: 5px;
            padding:10px;
        }

        .priceChart td {
            border-left:1px solid #fff;
            border-right:1px solid #fff;
            background-color: #fff;
        }

        .last {
            background-color: #ddd;
        }

body {
	margin: 10px auto;
	margin-top: 0px;
	font: 75%/120% Verdana,Arial, Helvetica, sans-serif;
}
div#container {
	text-align: left;
	margin:50px;
}

td {
	font-size: 12px !important;
}
ul#Categories li {
	padding:5px;
}

ul#Categories li.clicked,
ul#SubSubCategories li.clicked {
	padding:5px;
	background-color: #eee;
	border-radius: 10px;
}

ul#Categories li:hover a, 
ul#Categories li.clicked a,
ul#SubCategories li.clicked a  {
	display:inline;
	padding:0px;
	padding-right:3px;
	border:1px solid #222;
	color:#222;
	background-color: #ddd;
	text-decoration: none;
	border-radius: 15px;
	font-weight: bold;
	text-align: center;
	vertical-align: middle;
	margin:4px;
}

li.clicked ul.SubCategories a {
	display:none !important;
}

li.clicked ul.SubCategories li:hover a {
	display:inline !important;
	padding:0px;
	padding-right:3px;
	border:1px solid #222;
	color:#222;
	background-color: #ddd;
	text-decoration: none;
	border-radius: 15px;
	font-weight: bold;
	text-align: center;
	vertical-align: middle;
	margin:4px;
}

ul.SubCategories li.clicked {
	padding:5px;
	background-color: #fff !important;
	border-radius: 10px;
}

ul.SubSubCategories li.clicked {
	padding:5px;
	background-color: #eee !important;
	border-radius: 10px;
}

ul#Categories li a, li.clicked .SubCategories a,
ul#SubCategories li.clicked .SubSubCategories a {
	display:none;
}

.SubCategories, .SubSubCategories, .books {
	display:none;
}

li.clicked .SubCategories,
ul.SubCategories li.clicked .SubSubCategories,
ul.SubSubCategories li.clicked .books  {
	display:inherit ;
	margin-left:50px;
}

.getItDialog, #cartDialog {
	display:none;
}

#cartTable th, .checkoutBtn, .showcartBtn {
	background-color: #ddd;
	border-radius: 15px;
	padding:10px;
	text-decoration: none;
	color:#222;
	
}

.checkoutBtn, .showcartBtn {
	display:none;
}

.ui-dialog-content table#cartTable, .ui-dialog-content table#cartTotalsTable,  {
	font-size:11px !important;
}

.ui-dialog-content table#cartTable td, .ui-dialog-content table#cartTotalsTable td,  {
	padding: 2px !important;
}

</style>
<?php include 'NavigationBar.php'; ?>
<body>
<div> 
<?php
	$cat="";
	$storename="";
	$title="";
	$author="";
	$isbn="";
	$callnum="";
	$option1="";
	$operation1="";
	$value1="";
	$option2="";
	$operation2="";
	$value2="";
	$address="";
	$lat=null;
	$lng=null;
	if(isset($_GET['address']))
		$address = $_GET['address'];
	if(isset($_GET['title']))
		$title = $_GET['title'];
	if(isset($_GET['author']))
		$author = $_GET['author'];
	if(isset($_GET['isbn']))
		$isbn = $_GET['isbn'];
	if(isset($_GET['callnum']))
		$callnum = $_GET['callnum'];
	if(isset($_GET['cat']))
	$cat = $_GET['cat'];
	if(isset($_GET['storename']))
	$storename = $_GET['storename'];
	
	if ($title == "" && $author == "" && $isbn == "" && $callnum == "" && $cat == '' && $storename == '') {
		?>
			<script type="text/javascript">
				$(document).ready(function() {
					window.location.href='storeList.php'
				});
			</script>
		<?php
		die();
	} 
	
	if(isset($_GET['lat']))
	$lat = $_GET['lat'];
	if(isset($_GET['lng']))
	$lng = $_GET['lng'];
	
	if(isset($_GET['option1']))
	$option1 = $_GET['option1'];
	if(isset($_GET['operation1']))
	$operation1 = $_GET['operation1'];
	if(isset($_GET['value1']))
	$value1 = $_GET['value1'];
	if(isset($_GET['option2']))
	$option2 = $_GET['option2'];
	if(isset($_GET['operation2']))
	$operation2 = $_GET['operation2'];
	if(isset($_GET['value2']))
	$value2 = $_GET['value2'];
	
	$perpage = "200";
	$orderby = "title";
	$pagenumber = "1";
	if(isset($_GET['perpage']))
	$perpage = $_GET['perpage'];
	if(isset($_GET['orderby']))
	$orderby = $_GET['orderby'];
	if(isset($_GET['pagenumber']))
	$pagenumber = $_GET['pagenumber'];


	$sql = 'select B.title as title, B.author as author, B.isbn as isbn, B.callNum as callNum, B.category as category, B.subCat as subCat, B.subSubCat as subSubCat, B.publisherName as publisherName, B.edtionNumber as editionNumber, B.amzonStar as star, B.pubDate as pubDate, B.pages as pages, ';
	$sql .= ' I.bookCondition as bookCondition, I.rentPrice as rentPrice, I.salesPrice as salePrice, I.quantity as availability, ';
	if ($lat != null && $lng != null) {
		$sql .= " ( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( S.latitude  ) ) * cos( radians( S.longtitude  ) - radians('".$lng."') ) + sin( radians('".$lat."') ) * sin( radians( S.latitude  ) ) ) ) AS distance, ";
	} else {
		$sql .= ' "" as distance, ';
	}
	$sql .= ' S.storeID as storeID, S.storeName as storeName, I.idx as idx, I.holderID as holderID, I.quantity as quantity from books B join inventory I on I.isbn = B.isbn join stores S on S.storeID = I.storeID where 1 ';

	if($cat!="") {
		$sql .= " and (B.category like '%" .$cat. "%' or B.subCat like '%" .$cat. "%' or B.subSubCat like '%" .$cat. "%')";
	}
	if($storename != "") {
		$sql  .= " and (S.storeName like '%" .$storename. "%' or S.city like '%" .$storename. "%' or S.state like '%" .$storename. "%' or S.zip = '" .$storename. "')";
	} 
	if($isbn!="")
	{
		$sql .=" and B.isbn='".$isbn."'";
	}
	if($author!="")
	{
		$sql .=" and B.author like '%".$author."%'";
	}
	if($title!="")
	{
		$sql .=" and B.title like '%".$title."%'";
	}
	if($callnum!="")
	{
		$sql .=" and B.callNum='".$callnum."'";
	}
	if($option1=="Price" &&$operation1!=""&&$value1!="")
	{
		$sql .=" and I.salePrice".$operation1."'".$value1."'";
	}
	if($option1=="Pub Year"&&$operation1!=""&&$value1!="")
	{
		$sql .=" and B.pubYear".$operation1."'".$value1."'";
	}
	if($option1=="Language"&&$operation1!=""&&$value1!="")
	{
		$sql .=" and B.language".$operation1."'".$value1."'";
	}
	if($option2!=""&&$option2=="Price"&&$operation2!=""&&$value2!="")
	{
		$sql2.=" and I.salePrice".$operation2."'".$value2."'";
	}
	if($option2!=""&&$option2=="Pub Year"&&$operation2!=""&&$value2!="")
	{
		$sql .=" and B.pubYear".$operation2."'".$value2."'";
	}
	if($option2!=""&&$option2=="Language"&&$operation2!=""&&$value2!="")
	{
		$sql .=" and B.language".$operation2."'".$value2."'";
	}
	
	$db = new DataBase();
	$db->conn();
	$k= $db->indb($sql );
?>

	</div>
	<table class="priceChart">
        <tr>
            <th> Title </th>
            <th> <table>
            		<tr>
            			<th colspan=2> Year </th>
            		</tr>
            		<tr>
            			<th>Star</th><th>Distance</th>
            		</tr>
            	 </table> 
            </th>
            <th> Store Name</th>
            <th> Book Condition </th>
            <th> Sale Price </th>
            <th> Rent Price </th>
            <th> Availability </th>
        </tr>
    <?php
    $count20 = 1;
    $count40 = 1;
    $count60 = 1;
    $count = 0;
	while($store=mysql_fetch_row($k))
		{
			$count = $count + 1;
			if ($count % 20 == 0)
				$count20 = $count20 + 1;

    		if ($count % 20 == 0)
				$count40 = $count40 + 1;

    		if ($count % 20 == 0)
				$count60 = $count60 + 1;

			$storeid=$store[17];
			$isbn=$store[2];
			$storename=$store[18];
			$booktitle = $store[0];
			$bookAuthor = $store[1];
			$bookyear=explode('-', $store[10])[0];
			$pages=$store[11];
			$booksale=$store[14];
			$bookrent=$store[13];
			$bookquantity=$store[15] == '0' || $store[15] == ''? 'Not Available' : $store[15].' Available';
			$bookcond=$store[12];
			$rating=$store[9];
			$distance=$store[16];
			$bookCat=$store[4];
			$bookCallNum=$store[3];
			$bookSubCat=$store[5];
			$bookSubSubCat=$store[6];
			$pudDate=$store[10];
			$publisherName=$store[7];
			$editionNumber=$store[8] == null || $store[8] == '' || $store[8] == '0' ? '' : 'Edition '.$store[8] ;
			$subLinkID='book' . $count;
			$bookDialogID = $subLinkID . 'Dialog';
			$idx=$store[19];
			$holderID=$store[20];
			$inventoryQuantity=intval($store[21]);
			echo "<tr class='".$count20."Class ".$count40."Class ".$count60."Class results'>
			
			<td>
				<a href='#' onclick='showBook(\"$bookDialogID\");'> $booktitle </a>
				<div id='$bookDialogID' style='display:none;'>
					<h4>Book Info</h4>
					<table >
						<tr>
							<td colspan=4><h3>$booktitle</h3><br>by <b>$bookAuthor</b></td>
						</tr>
						<tr>
							<td style='text-align:left;' colspan=2>$editionNumber</td>
						</tr>
						<tr>
							<td style='text-align:left;' colspan=2><b>ISBN:</b> $isbn</td>
							<td style='text-align:left;' colspan=2><b>Amazon Reviews:</b> $rating</td>
						</tr>
						<tr>
							<td style='text-align:left;' ><b>Publisher:</b></td>
							<td style='text-align:left;' colspan=2>$publisherName</td>
							<td style='text-align:left;'>$bookyear ($pages pages)</td>
						</tr>
						<tr>
							<td style='text-align:left;'><b>Category:</b></td>
							<td style='text-align:left;'>$bookCat</td>
							<td style='text-align:left;'><b>SubCategory:</b></td>
							<td style='text-align:left;'>$bookSubCat</td>
						</tr>
						<tr>
							<td style='text-align:left;'>&nbsp;</td>
							<td style='text-align:left;'>&nbsp;</td>
							<td style='text-align:left;'><b>SubSubCategory:</b></td>
							<td style='text-align:left;'>$bookSubSubCat</td>
						</tr>
						<tr>
							<td style='text-align:left;' colspan=2><b>Call Number:</b></td>
							<td style='text-align:left;'>$bookCallNum</td>
						</tr>
					</table>
				</div>
			</td>
			<td>
				<table>
					<tr>
						<td colspan=2 style='text-align:center;'>$bookyear</td>
					</tr>
					<tr>
						<td> $rating </td>
						<td> $distance </td>
					</tr>	
				</table>
			</td>
			<td><a href='storePage.php?name=$storename&storeId=$storeid' >$storename</a></td>
			<td>$bookcond</td>
			<td>$booksale</td>
			<td>$bookrent</td>
			<td>$bookquantity</td>";

			if ($inventoryQuantity == 0 || ($inventoryQuantity == 1 & $holderID != '')) {
				echo '<td> &nbsp; </td>';
			} else {
			?>
				<td> <a href="#" style="padding: 5px; font-size: 12px;" class='bookClass store<?php echo $storeid; ?>Class'  onclick="showDialog('<?php echo $subLinkID; ?>');"> Get It </a>
					<div id="<?php echo $subLinkID; ?>Div" class="getItDialog">
						<table style="text-align:left; font-size:12px;"> 
							<tr>
								<td colspan=4 style="text-align:left;"> 
									<h3><?php echo $booktitle; ?> </h3>
									<input type="hidden" id='<?php echo $subLinkID; ?>Name' value='<?php echo $booktitle; ?>'>
									<input type="hidden" id='<?php echo $subLinkID; ?>ISBN' value='<?php echo $isbn; ?>'>
									<input type="hidden" id='<?php echo $subLinkID; ?>SalePrice' value='<?php echo $booksale; ?>'>
									<input type="hidden" id='<?php echo $subLinkID; ?>RentPrice' value='<?php echo $bookrent; ?>'>
									<input type="hidden" id='<?php echo $subLinkID; ?>storeID' value='<?php echo $storeid; ?>'>
									<input type="hidden" id='<?php echo $subLinkID; ?>storeName' value='<?php echo $storename; ?>'>
									<input type="hidden" id='<?php echo $subLinkID; ?>idx' value='<?php echo $idx; ?>'>
								</td>
							</tr>
							<tr>
								<td colspan=3 style="text-align:left;"> Quantity </td> 
								<td colspan=1 style="text-align:right;"> 
									<input type="text" id='<?php echo $subLinkID; ?>Quantity' value='1' size=1>
								</td>
							</tr>
							<tr>
								<td style="text-align:left;"> Desc </td> 
								<td colspan=3 style="text-align:left;"> 
									<input type="text" id='<?php echo $subLinkID; ?>Desc' size=15 value=''>
								</td>
							</tr>
						</table>
					</div>
				</td>
			<?php
			}
			
			echo "</tr>";
			
		} 

		if ($count == 0) {
			echo "<tr><td colspan='7' style='text-align:center;'> Found no results for the search </td></tr>";
		}
		echo '</table>';
		echo '</td>';
	
	echo '</table>';
	
	class DataBase{  
        public $dbhost = "localhost";
        public $dbuser = "webclient";  
        public $dbpass = "12345678";  
        public $dbname = "bookstore";  
        function conn(){
            $dbconn = mysql_connect($this->dbhost,$this->dbuser,$this->dbpass) or die("database error!".mysql_error());  
            mysql_select_db($this->dbname) or die("can not connect database：".mysql_error());  
            return $dbconn;  
        }  
        function indb($in_sql){
            $result_indb = mysql_query($in_sql) or die("can not run the sql language:".mysql_error());  
            return $result_indb;  
        }  
    }
?>
<form method='post' action='addDataSession.php' id="summaryCartForm">
					<input type="hidden" id="storeID" name="storeID" value="">
					<input type="hidden" id="libraryName" name="libraryName" value="">
					<input type="hidden" id="cartItems" name="cartItems" value="">
					<input type="hidden" id="redirectUrl" name="redirectUrl" value="">
				</form>
<div id='cartDialog'> 
	<table id="cartTable">
		<tr> 
			<td colspan=5 align="center" style="text-align:center"><h3 style="text-align:center"> Your Cart </h3></td>
		</tr>
		<tr> 
			<th style="width:150px">Item</th>
			<th style="width:50px">Quantity</th>
			<th style="width:150px">Desc</th>
			<th style="width:75px">price</th>
		</tr>
	</table>
	<br>
	<br>
	<hr>
	<table id="cartTotalsTable">
		<tr> 
			<td  style="text-align:right">Subtotal</td>
			<td> <input type="text" id='cartSubTotal' size=5 value=''> </td>
		</tr>
		<tr> 
			<td  style="text-align:right">Tax</td>
			<td> <input type="text" id='cartTax' size=5 value=''> </td>
		</tr>
		<tr> 
			<td  style="text-align:right">Total</td>
			<td> <input type="text" id='cartTotal' size=5 value=''> </td>
		</tr>
	</table>
</div>
<div> <a id="showcartBtn" class="showcartBtn" href="#" onclick="showcart();">Show Cart</a> <a id="checkoutBtn" class="checkoutBtn" href="#" onclick="checkout();">Checkout</a> </div>
</body>
</html>