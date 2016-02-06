<?php
session_start();

$storeID=-1;
if(isset($_GET['storeId']))
   $storeID = $_GET['storeId'];

$storename = "";
if(isset($_GET['name']))
   $storename = $_GET['name'];

$sessionStoreID = "";
if (isset($_SESSION['storeID'])) {
	$sessionStoreID = $_SESSION['storeID'];
}

$sessionLibraryName = "";
if (isset($_SESSION['libraryName'])) {
	$sessionStoreID = $_SESSION['libraryName'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Store Page</title>
</head>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
<!-- include the jquery ui library -->
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
    currentStoreID='<?php echo $storeID; ?>';
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

	$(document).ready(function() {
	    $( ".accordion" ).accordion({
	      heightStyle: "content",
	      widthStyle: "content",
	      collapsible: true,
	      active: false
	    });
	});

	function showCategory(idValue) {
		$('#'+idValue+'Li').toggleClass('clicked');
		if ($('#'+idValue+'Link').html() == ' + ') {
			$('#'+idValue+'Link').html(' - ');
		} else {
			$('#'+idValue+'Link').html(' + ');
		}
	}

	function showBook(idValue) {
		$( "#"+idValue ).dialog({
	      modal: true,
	      width: 470,
    	  position: { my: 'top', at: 'top+150' },
	      buttons: {
	      			"back": function() {
	      				$( this ).dialog( "close" );
	                }
	            }
	    });
	}

	function showDialog(idValue) {
		$( "#"+idValue+"Div" ).dialog({
	      modal: true,
	      buttons: {
	      			
	                "Borrow": function() {
	                	$( this ).dialog( "close" );
	      				updateCartAndShow(idValue, 'borrow');
	                },
	                Cancel: function() {
	                    $( this ).dialog( "close" );
	                }
	            }
	    });
	}

	function updateCartAndShow(idValue, type) {
		if (cartItems.length == 0) {
			sessionStoreID = currentStoreID;
		}
		if (sessionStoreID != currentStoreID) {
			alert("Cart can only contain items from one store. Please checkout the existing items to get new items from this store or remove existing items and update cart.");
		} else {
			newItemJSON = {
				'item' : $( "#"+idValue+"Name" ).val(),
				'qty' : $( "#"+idValue+"Quantity" ).val(),
				'desc' : $( "#"+idValue+"Desc" ).val(),
				'isbn' : $( "#"+idValue+"ISBN" ).val(),
				'idx' : $( "#"+idValue+"idx" ).val(),
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
		'</tr>');
		for (itemNumber in cartItems) {
			itemJSON = cartItems[itemNumber];
			price = 0;
			if (itemJSON['type'] == 'buy') {
				price = itemJSON['qty'] * itemJSON['saleprice'];
			} else if (itemJSON['type'] == 'rent') {
				price =  itemJSON['qty'] * itemJSON['rentprice'];
			} 

			justContinue = false;
			for ( index in removedCartItems) {
				if(removedCartItems[index] == i) {
					justContinue = true;
				}
			}

			if (justContinue) {
				i = i + 1;
				continue;
			}

			totalPrice = totalPrice + price;
			$('#cartTable tr:last').after('<tr id="cartEntry' + i + '" class="cartItemEntries">' + 
				'<td>' + itemJSON['item'] + '</td>' +
				'<td>' + itemJSON['qty'] + '</td>' +
				'<td>' + itemJSON['desc'] + '</td>' +
				
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
		$('#redirectUrl').val('Storepage.php?name=<?php echo $storename; ?>&storeId=<?php echo $storeID; ?>');
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
</script>
<script type="text/javascript" src="https://uncgshoppingcart.googlecode.com/svn-history/r3/trunk/mycart.js"></script>
<!-- <script type="text/javascript" src="jquery-1.4.1.js"></script> -->
<style type="text/css">
body {
	margin: 10px auto;
	margin-top: 0px;
	font: 75%/120% Verdana,Arial, Helvetica, sans-serif;
}
p {
	padding: 0 0 1em;
}
.msg_list {
	margin: 0px auto;
	padding: 0px;
	width: 383px;
	height:311px;
}
.msg_head {
	padding: 5px 10px;
	cursor: pointer;
	position: relative;
	background-color:#6699FF;
	margin:1px;
}
.msg_body {
	padding: 5px 10px 15px;
	background-color:#6699FF;
}
.cartHeaders div{
	display:inline-block;
	margin:18px;
}

.itemContainer div{
	display:inline-block;
	margin:10px;
}

.storeInfo td {
	padding : 5px;
}

div#container {
	text-align: left;
	margin:50px;
}

td { padding : 5px;}


.SubCategories, .SubSubCategories, .books {
	display:none;
}

.books  {
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

th {
	vertical-align: top !important;
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


.SubCategories, .SubSubCategories, .books {
    padding-top: 0px !important;
    padding-bottom: 0px !important;
}

.SubCategories p, .SubSubCategories p {
	display:none;
}

.SubCategories h4, .SubSubCategories h4, .SubCategories div, .SubSubCategories div {
	border:0px !important; 
}

.SubSubCategories  ul
{
	padding-left:20px;
}

.SubSubCategories li {
	list-style: none;
}

p.ui-accordion-header {
	display: none !important;
}

th span {
	font-weight: initial;
}

.associations a {
	padding :10px;
	margin : 10px;
}
</style>
<?php include 'NavigationBar.php'; ?>
<body>

<?php
	
	$sql = "select * from stores where storeName='".$storename."'";
	if ($storeID != -1) {
		$sql = "select * from stores where storeID='".$storeID."'";
	}
	$db = new DataBase();
	$db->conn();
	$k= $db->indb($sql);
	
	$store=mysql_fetch_row($k);
	$storeID = $store[0];
        $altStoreName = $store[3]; // added Fu 5-19-15
	$officephone = $store[11];
	$storeaddress = $store[4]." ".$store[6]." ".$store[7]." ".$store[8];
        $webtag = $store[16]; //fu added 5/9
        $weblink = "http://".$webtag;
	
	$sql1 = "select count(*) from storereviews where storeID=".$storeID;
	$k1= $db->indb($sql1);
	$totalreview = 0;
	while($review=mysql_fetch_row($k1))
	{
		$totalreview = $review[0];
	}
	
	$sql2 = "select distinct * from storeassociations where motherID=".$storeID;
	$k2= $db->indb($sql2);
	$association = "";
?>	
	<table class="storeInfo" align="center" style="margin:30px 10px 20px 330px">
		<tr>
			<td rowspan=2>
				<div style="float:left" class="coverphoto">
				<img src="/images/bookcover.jpg" class="listResultImage" alt=""/>
				</div>
			</td>
			<td colspan=3 class="author">
				<h1><?php echo $storename; ?></h1>
                                <h2> <?php echo $altStoreName; ?></h2>  <!-- added Fu 5-19-15 -->
				<form method='post' action='addDataSession.php' id="summaryCartForm">
					<input type="hidden" id="storeID" name="storeID" value="<?php echo $storeID; ?>">
					<input type="hidden" id="libraryName" name="libraryName" value="<?php echo $storename; ?>">
					<input type="hidden" id="cartItems" name="cartItems" value="">
					<input type="hidden" id="redirectUrl" name="redirectUrl" value="">
				</form>
			</td>
			<td> <!-- fu added review link 5-19 -->
				<label style="font-size:12px"><?php echo $totalreview; ?> 
                                <a href="storereview.php?name=<?php echo $storename; ?>&storeID=<?php echo $storeID; ?>" > Reviews </a> </label>
			</td>
		</tr>
		<tr>
			<td>
				<label style="font-size:12px">Phone: <?php echo $officephone; ?></label>
			</td>
			<td>
				<label style="font-size:12px">Address: <?php echo $storeaddress; ?></label>
			</td>
		</tr>
                <tr>
                        <td> 
                                <label style="font-size:12px">Website: <a href = <?php echo $weblink; ?> > <?php echo $webtag; ?> </a> </label> <!-- Fu-5-19 -->
                        </td>
                        <td>
                                <label style="font-size:12px">Librarian: <?php echo $store[19]; ?></label>
                        </td>
                        <td>
                                <label style="font-size:12px">Open Hours: <?php echo $store[24]; ?></label>
                        </td>
                </tr>

                <tr>
                        <td> 
                                <label style="font-size:12px">Duration: <?php echo $store[27]; ?></label>
                        </td>
                        <td>
                                <label style="font-size:12px">Borrow limit one time: <?php echo $store[28]; ?></label>
                        </td>
                        <td>
                                <label style="font-size:12px">Max renew times: <?php echo $store[33]; ?></label>
                        </td>
                </tr>

                     


	</table>
<?php
		$first = true;
		while($review1=mysql_fetch_row($k2)) {
			if ($first) {
				$first = false;
				?>
				<div align="center" class="associations">
					<label style="font-size:12px">Associated Libraries:</label>
				</div>
				<div align="center" class="associations">
				<?php
			}
			echo "<a href=\"Storepage.php?name=$review1[1]&storeId=$review1[0]\">$review1[1]</a>";
		} 

		if (!$first) {
			echo "</div>";
		}
?>
	<br>
	<hr>
	<br>
  <div id="container">
	<div class="accordion" style="width: 50%;margin: auto; min-width: 640px;">

<?php
	$allBooks = "select * from books AS B, inventory AS I where I.isbn = B.isbn and I.storeID='".$storeID."' order by B.category, B.subCat, B.subSubCat";
	$bookResults= $db->indb($allBooks);
	$category = null;
	$categoryCount = 0;
	$subCategory = null;
	$subCategoryCount = 0;
	$subSubCategory = null;
	$subSubCategoryCount = 0; /* http://localhost/bookcenter/Storepage.php?name=vid%20library&storeId=26 Fu 5-19 */
	$bookCount = 0;
	
	while($book=mysql_fetch_row($bookResults))
	{
		$isbn = $book[0];
		$title = $book[4];
		$callnum = $book[3];
		$author = $book[7];
		$saleprice = $book[40];
		$rentprice = $book[41];
		$bookCategory = $book[16];
		$bookSubCategory = $book[17];
		$bookSubSubCategory = $book[18];
		$productFormatDetail = $book[28];
		$reviews = $book[14] != null ? ' ('.$book[14].")" : "";
		$bookyear=explode('-', $book[23])[0];

		if ($bookyear == '0000') {
			$bookyear = '';
		}
		$pages=$book[31];
		$bookquantity=intval($book[39]);
		$bookcond=$book[37];
		$pudDate=$book[23];
		$publisherName=$book[22];
		$editionNumber=$store[12] == null || $store[12] == '' || $store[12] == '0' ? '' : 'Edition '.$store[12] ;
		$rating = $book[13];
		$idx = intval($book[35]);
		$holderID = $book[43];
		$categoryChanged = false;
		$subCategoryChanged = false;
		$subSubCategoryChanged = false;
		if($category != $bookCategory)  {
			$categoryCount += 1;
			if ($category != null) {
				#close Books
				echo '</ul></p></div></div></p></div></div></p></div>';
			}

			$categoryChanged = true;
			$subCategoryChanged = true;
			$subSubCategoryChanged = true;

			$subCategoryCount = 0;
			$subSubCategoryCount = 0;
			$subCategory = $bookSubCategory;
			$SubSubCategory = $bookSubSubCategory;
			$text = $bookSubSubCategory != null ? $bookSubSubCategory : 'General';
			$linkID = $categoryCount . "-" . $subCategoryCount;
			$subLinkID = $categoryCount . "-" . $subCategoryCount . "-" . $subSubCategoryCount ;
			$category = $bookCategory;
			echo '<h4 id="' . $categoryCount . 'Li">'. $category . "</h4>";
			echo "<div class='SubCategories'><p><div class='accordion'>";
			echo '<h4 id="' . $linkID . 'Li" >'. $subCategory . "</h4>";
			echo "<div class='SubSubCategories'><p><div class='accordion'>";
			echo '<h4 id="' . $subLinkID . 'Li">'. $text . "</h4>";
			echo "<div class='books'><p><ul>";

			$bookCount = 0;
		} else if($subCategory != $bookSubCategory)  {
			$subCategoryCount += 1;
			if ($subCategory != null) {
				echo '</ul></p></div></div></p></div>';
			}

			$subCategoryChanged = true;
			$subSubCategoryChanged = true;

			$subSubCategoryCount = 0;
			$SubSubCategory = null;

			$subCategory = $bookSubCategory;
			$linkID = $categoryCount . "-" . $subCategoryCount;
			echo '<h4 id="' . $linkID . 'Li" >'. $subCategory . "</h4>";
			echo "<div class='SubSubCategories'><p><div class='accordion'>";
			
			$subSubCategory = $bookSubSubCategory;
			$text = $bookSubSubCategory != null ? $bookSubSubCategory : 'General';
			$subLinkID = $categoryCount . "-" . $subCategoryCount . "-" . $subSubCategoryCount ;
			echo '<h4 id="' . $subLinkID . 'Li">'. $text . "</h4>";
			echo "<div class='books'><p><ul>";

			$bookCount = 0;
		} else if($subSubCategory != $bookSubSubCategory )  {
			$subSubCategoryCount += 1;
			if ($subSubCategory != null) {
				if ($subSubCategory != "") {
					echo '</ul></p></div>';
				}
			}
			
			$subSubCategory = $bookSubSubCategory;
			$text = $bookSubSubCategory != null ? $bookSubSubCategory : 'General';
			$subLinkID = $categoryCount . "-" . $subCategoryCount . "-" . $subSubCategoryCount ;
			echo '<h4 id="' . $subLinkID . 'Li">'; echo $text . "</h4>";
			echo "<div class='books'><p><ul>";

			$bookCount = 0;
		}

		$category = $bookCategory;
		$subCategory = $bookSubCategory;
		$subSubCategory = $bookSubSubCategory;
		$bookCount = $bookCount+1;
		$bookLink = $subLinkID.'-'.$bookCount;
		$bookDialogID = 'Book'.$bookLink;

			
		?>
		<li>
			<table>
				<tr>
					<th colspan=3 style='vertical-align:middle !important;'> <a href='#' onclick='showBook("<?php echo $bookDialogID; ?>");'><?php echo $title .'</a> <span>' . $bookquantity . '</span>'; ?> 
						<div id='<?php echo $bookDialogID; ?>' style='display:none;'>
								<h4>Book Info</h4>
								<table >
									<tr>
										<td colspan=4><h3><?php echo $title; ?></h3><br>by <b><?php echo $author; ?></b></td>
									</tr>
									<tr>
										<td style='text-align:left;  vertical-align:top;' colspan=2><?php echo $editionNumber; ?></td>
									</tr>
									<tr>
										<td style='text-align:left;  vertical-align:top;' colspan=2><b>ISBN:</b> <?php echo $isbn; ?></td>
										<td style='text-align:left;  vertical-align:top;' colspan=2><b>Amazon Reviews:</b> <?php echo $rating; ?></td>
									</tr>
									<tr>
										<td style='text-align:left;  vertical-align:top;' ><b>Publisher:</b></td>
										<td style='text-align:left;  vertical-align:top;' colspan=2><?php echo $publisherName; ?></td>
										<td style='text-align:left;  vertical-align:top;'><?php echo $bookyear; ?> (<?php echo $pages; ?> pages)</td>
									</tr>
									<tr>
										<td style='text-align:left; vertical-align:top; '><b>Category:</b></td>
										<td style='text-align:left;  vertical-align:top; '><?php echo $bookCategory; ?></td>
										<td style='text-align:left;  vertical-align:top;'><b>SubCategory:</b></td>
										<td style='text-align:left;  vertical-align:top;'><?php echo $bookSubCategory; ?></td>
									</tr>
									<tr>
										<td style='text-align:left;  vertical-align:top;'>&nbsp;</td>
										<td style='text-align:left;  vertical-align:top;'>&nbsp;</td>
										<td style='text-align:left;  vertical-align:top;'><b>SubSubCategory:</b></td>
										<td style='text-align:left;  vertical-align:top;'><?php echo $bookSubSubCategory; ?></td>
									</tr>
									<tr>
										<td style='text-align:left;  vertical-align:top;' colspan=2><b>Call Number:</b></td>
										<td style='text-align:left;  vertical-align:top;'><?php echo $callnum; ?></td>
									</tr>
								</table>
							</div>
					</th>
					<!-- <td> Sale: $<?php echo $saleprice; ?></td>
					<td> Rent: $<?php echo $rentprice; ?></td> -->
					<td> 
					<?php
						if ($bookquantity == 0 || ($bookquantity == 1 & $holderID != '')) {
							echo '&nbsp;';
						} else {
					?>
					<button href="#" 
							style="font-size:10px; padding: 2px;border: 1px solid #AAA !important;border-radius: 5px;" 
							onclick="showDialog('<?php echo $bookLink; ?>');"> Get It </button>
					<div id="<?php echo $bookLink; ?>Div" class="getItDialog">
						<table style="text-align:left; font-size:12px;"> 
							<tr>
								<td colspan=4 style="text-align:left;"> 
									<h3><?php echo $title; ?> </h3>
									<input type="hidden" id='<?php echo $bookLink; ?>Name' value='<?php echo $title; ?>'>
									<input type="hidden" id='<?php echo $bookLink; ?>ISBN' value='<?php echo $isbn; ?>'>
									<input type="hidden" id='<?php echo $bookLink; ?>SalePrice' value='<?php echo $saleprice; ?>'>
									<input type="hidden" id='<?php echo $bookLink; ?>RentPrice' value='<?php echo $rentprice; ?>'>		
									<input type="hidden" id='<?php echo $bookLink; ?>idx' value='<?php echo $idx; ?>'>
								</td>
							</tr>
							<tr>
								<td colspan=3 style="text-align:left;"> Quantity </td> 
								<td colspan=1 style="text-align:right;"> 
									<input type="text" id='<?php echo $bookLink; ?>Quantity' value='1' size=1>
								</td>
							</tr>
							<tr>
								<td style="text-align:left;"> Desc </td> 
								<td colspan=3 style="text-align:left;"> 
									<input type="text" id='<?php echo $bookLink; ?>Desc' size=15 value=''>
								</td>
							</tr>
						</table>
					</div>
					<?php
						}
					?>
					</td>
				</tr>
				<tr>
					<td> &nbsp; </td>
					<td> <?php echo $productFormatDetail; ?></td>
					<td> </td>
					<td> <?php echo $rating; ?></td>
			</table>
		</li>
		<?php
	}

	if ($subSubCategoryCount > 0) {
		echo "</ul></p></div>";
	}

	if ($subCategoryCount > 0) {
		echo "</div></p></div>";
	}

	if ($categoryCount > 0) {
		echo "</div></p></div>";
	}

	echo "</div>";
	// echo '<div style="border:1px solid;border-color:#09F">';
	// echo "<div class="simpleCart_items" ></div>
	// 	<div style="clear:left"></div>

	// 	SubTotal: <span class="simpleCart_total"></span> <br />
	// 	Tax: <span class="simpleCart_taxCost"></span><br />

	// 	<br />
	// 	Final Total: <span class="simpleCart_finalTotal"></span><br />
	// 	<a href="#" class="simpleCart_checkout">checkout</a>";
	// echo '</div>';
	
	
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


</div>

<div id='cartDialog'> 
	<table id="cartTable">
		<tr> 
			<td colspan=5 align="center" style="text-align:center"><h3 style="text-align:center"> Your Cart </h3></td>
		</tr>
		<tr> 
			<th style="width:150px" >Item</th>
			<th style="width:50px">Quantity</th>
			<th style="width:150px">Desc</th>
			<th style="width:75px">price</th>
		</tr>
	</table>
	<br>
	<br>
	<hr>
        <!--
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
        -->
</div>

<br> <br> 
<div style="text-align:center"> <a id="showcartBtn" class="showcartBtn" href="#" onclick="showcart();">Show Cart</a> 
<a id="checkoutBtn" class="checkoutBtn" href="#" onclick="checkout();">Checkout</a> </div>
</body>
</html>