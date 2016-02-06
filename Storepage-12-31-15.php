<?php
session_start ();
// /*added for NEWUI of Storepage*/

// $_SESSION['name'] = $name;
// $_SESSION['storeIdTemp'] = $storeId;
// /*end of changes */

$storeID = - 1;
if (isset ( $_GET ['storeId'] ))
	$storeID = $_GET ['storeId'];

$storename = "";
if (isset ( $_GET ['name'] ))
	$storename = $_GET ['name'];

$sessionStoreID = "";
if (isset ( $_SESSION ['storeID'] )) {
	$sessionStoreID = $_SESSION ['storeID'];
}

$sessionLibraryName = "";
if (isset ( $_SESSION ['libraryName'] )) {
	$sessionLibraryName = $_SESSION ['libraryName'];
}

$customerId = "";
if (isset ( $_SESSION ['custID'] )) {
	$customerId = $_SESSION ['custID'];
}

$categoryID = 01;
if (isset ( $_GET ['categoryId'] )) {
	$categoryID = $_GET ['categoryId'];
	error_log ( "Category ID **" . $categoryID );
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="lightbox.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Store Page</title>
</head>
<link rel="stylesheet"
	href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css">
	
	


		<script type="text/javascript">

	firstBook =true;
    currentStoreID='<?php echo $storeID; ?>';
    currentStorename ='<?php echo $storename; ?>';
    currentCustId = '<?php echo $customerId; ?>';
    sessionStoreID='<?php echo $sessionStoreID; ?>';
	removed = false;
	removedCartItems = new Array();
	cartItems = <?php
	if (isset ( $_SESSION ['cartItems'] )) {
		echo $_SESSION ['cartItems'];
		echo ";";
		?>
			$(document).ready(function() {
				$('#storeID').val(storeId);
				$('#libraryName').val(storeName);
				$('#checkoutBtn').show();
				$('#showcartBtn').show();
				
    	//	});
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

	function showBook(idValue) {
		$( "#"+idValue ).dialog({
		      modal: true,
		      width: 650,
		      buttons: {
		      			"back": function() {
		      				$( this ).dialog( "close" );
		                }
		            }
		    });
	}
	
	function showDialog(idValue) {
		
		sid = $('#' + idValue + 'storeID').val();
           
                if ( firstBook ) { 
                    storeId = sid; storeName = $('#' + idValue + 'storeName').val(); firstBook = false;
                } // added 8-16 ***

		if (cartItems.length != 0 && storeId != "" && storeId != sid) {
			alert('You already have items in cart that belong to book store: ' + storeName + 
                            ". You cannot have items from a different store at the same time. Please checkout the existing cart in order to order books from a different store.")
			return;
		}

		$( "#"+idValue ).dialog({
	      modal: true,
	      buttons: {

	                "Borrow": function() {
	                	updateCartAndShow(idValue, 'borrow');
	                	$( this ).dialog( "close" );
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

 	function addMembership(){
 	 	
  	 	data = {
                'storename' : currentStorename,
                'custId' : currentCustId
            }
 	 	$.ajax({
            method: "POST",
            url: "addMembership.php",
            data: data
          }).done(function( response ) {
              responseJSON = JSON.parse(response);
              if (responseJSON['error'] != undefined) {
                  alert(responseJSON['error']);
              }
              else {
                  alert(responseJSON['success']);
              }
          });
 	}

 	function listStore(){

 	 	 	data = {
                'storeID' : currentStoreID,
                'storeName' : currentStorename,
                'childStoreID' : sessionStoreID,
           	}
 	 	if(currentStoreID != sessionStoreID){
        $.ajax({
            method: "POST",
            url: "addStoreassociation.php",
            data: data
          }).done(function( response ) {
              responseJSON = JSON.parse(response);
              if (responseJSON['error'] != undefined) {
                  alert(responseJSON['error']);
              }
              else {
                 
                  //alert(responseJSON['storeId']);
                 $.each(responseJSON, function (k,v){
                 $("#assiciationId").html(responseJSON['storeId']);
                 });
              }
          });
 	 	}else{
 	 	 	alert("Your Store cannot be associated with itself");
 	 	}
 	}

 	$(function() {
 	    $( "#tabs" ).tabs();
 	  });
 	
</script>
		<script type="text/javascript"
			src="https://uncgshoppingcart.googlecode.com/svn-history/r3/trunk/mycart.js"></script>
		<!-- <script type="text/javascript" src="jquery-1.4.1.js"></script> -->
		<style type="text/css">
body {
	margin: 10px auto;
	margin-top: 0px;
	font: 75%/120% Verdana, Arial, Helvetica, sans-serif;
}

p {
	padding: 0 0 1em;
}

.msg_list {
	margin: 0px auto;
	padding: 0px;
	width: 383px;
	height: 311px;
}

.msg_head {
	padding: 5px 10px;
	cursor: pointer;
	position: relative;
	background-color: #6699FF;
	margin: 1px;
}

.msg_body {
	padding: 5px 10px 15px;
	background-color: #6699FF;
}

.cartHeaders div {
	display: inline-block;
	margin: 18px;
}

.itemContainer div {
	display: inline-block;
	margin: 10px;
}

.storeInfo td {
	padding: 5px;
}

div#container {
	text-align: left;
	margin: 50px;
}

td {
	padding: 5px;
}

.SubCategories, .SubSubCategories, .books {
	display: none;
}

.books {
	display: inherit;
	margin-left: 50px;
}

.getItDialog, #cartDialog {
	display: none;
}

#cartTable th, .checkoutBtn, .showcartBtn {
	background-color: #ddd;
	border-radius: 15px;
	padding: 10px;
	text-decoration: none;
	color: #222;
}

th {
	vertical-align: top !important;
}

.checkoutBtn, .showcartBtn {
	display: none;
}

.ui-dialog-content

























 

























table


















































#cartTable
,
.ui-dialog-content

























 

























table


















































#cartTotalsTable
,
{
font-size


















































:


















































11
px

























 

























!
important


















































;
}
.ui-dialog-content

























 

























table


















































#cartTable

























 

























td
,
.ui-dialog-content

























 

























table


















































#cartTotalsTable

























 

























td
,
{
padding


















































:

























 

























2
px

























 

























!
important


















































;
}
.SubCategories, .SubSubCategories, .books {
	padding-top: 0px !important;
	padding-bottom: 0px !important;
}

.SubCategories p, .SubSubCategories p {
	display: none;
}

.SubCategories h4, .SubSubCategories h4, .SubCategories div,
	.SubSubCategories div {
	border: 0px !important;
}

.SubSubCategories  ul {
	padding-left: 20px;
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
	padding: 10px;
	margin: 10px;
}

.block {
	width: 260px;
	margin-bottom: 10px;
	padding-bottom: 5px;
	padding-left: 0;
	background-color: #E8E8E8;
}

.block1 {
	width: 260px;
	margin-bottom: 10px;
	padding-bottom: 5px;
	padding-left: 0;
	background-color: #E8E8E8;
}

a.tryitbtn, a.tryitbtn:link, a.tryitbtn:visited, a.showbtn, a.showbtn:link,
	a.showbtn:visited {
	font-family: Verdana, Geneva, Tahoma, Arial, Helvetica, sans-serif;
	display: inline-block;
	color: #FFFFFF;
	background-color: #A8A8A8;
	width: 210px;
	font-size: 15px;
	text-align: left;
	padding: 5px 16px;
	text-decoration: none;
	margin-left: 0;
	margin-top: 0px;
	margin-bottom: 5px;
	border: 1px solid #400000;
	white-space: nowrap;
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
}

a.tryitbtn:hover, a.tryitbtn:active, a.showbtn:hover, a.showbtn:active {
	background-color: #ffffff;
	color: #282828;
}

.master-wrapper-leftside {
	float: left;
	width: 250px;
	margin: 0 0 0 0px;
	font-family: arial, helvetica, sans-serif;
	display: inline;
	padding: 10px 10px 10px 10px;
}

.master-wrapper-rightside {
	float: right;
	width: 250px;
	margin: 0 0 0 0px;
	font-family: arial, helvetica, sans-serif;
	display: inline;
	padding: 0px 10px 10px 0px;
}

.master-wrapper-center {
	float: left;
	width: 700px;
	color: #000;
	min-height: 600px;
	padding: 10px 10px 10px 10px;
}

.master-wrapper-page {
	margin: 10px;
	width: 1250px;
	vertical-align: top;
}
</style>

<?php include 'NavigationBar.php'; ?>
<body>

<?php

$sql = "select * from stores where storeName='" . $storename . "'";
if ($storeID != - 1) {
	$sql = "select * from stores where storeID='" . $storeID . "'";
}
$db = new DataBase ();
$db->conn ();
$k = $db->indb ( $sql );

$store = mysql_fetch_row ( $k );
$storeID = $store [0];
$altStoreName = $store [3]; // added Fu 5-19-15
$officephone = $store [11];
$storeaddress = $store [4] . " " . $store [6] . " " . $store [7] . " " . $store [8];
$webtag = $store [16]; // fu added 5/9
$weblink = "http://" . $webtag;
$selfChkout = $store[34];


$sql1 = "select count(*) from storereviews where storeID=" . $storeID;
$k1 = $db->indb ( $sql1 );
$totalreview = 0;
while ( $review = mysql_fetch_row ( $k1 ) ) {
	$totalreview = $review [0];
}

$sql2 = "select distinct * from storeassociations where motherID=" . $storeID;
$k2 = $db->indb ( $sql2 );
$association = "";
?>	
	<table class="storeInfo" align="center"
				style="margin: 30px 10px 20px 330px">
				<tr>
					<td rowspan=2>
						<div style="float: left" class="coverphoto">
							<a href="storelogos/<?php echo $storeID; ?>" data-lightbox="storelogos/<?php echo $storeID; ?>">
							<img src="storelogos/<?php echo $storeID; ?>"
								class="listResultImage" alt="storelogo"
								style="width: 100px; height: 70px;" /></a>
						</div>
					</td>
					<td colspan=3 class="author">
						<h1><?php echo $storename; ?></h1>
						<h2> <?php echo $altStoreName; ?></h2> <!-- added Fu 5-19-15 -->
						<form method='post' action='addDataSession.php'
							id="summaryCartForm">
							<input type="hidden" id="storeID" name="storeID"
								value="<?php echo $storeID; ?>"> <input type="hidden"
								id="libraryName" name="libraryName"
								value="<?php echo $storename; ?>"> <input type="hidden"
									id="cartItems" name="cartItems" value=""> <input type="hidden"
										id="redirectUrl" name="redirectUrl" value="">
						
						</form>
					</td>
					<td>
						<!-- fu added review link 5-19 --> <label style="font-size: 12px"><?php echo $totalreview; ?> 
                                <a
							href="storereview.php?name=<?php echo $storename; ?>&storeID=<?php echo $storeID; ?>">
								Reviews </a> </label>
					</td>
				</tr>
				<tr>
					<td><label style="font-size: 12px">Phone: <?php echo $officephone; ?></label>
					</td>
					<td><label style="font-size: 12px">Address: <?php echo $storeaddress; ?></label>
					</td>
				</tr>
				<tr>
					<td><label style="font-size: 12px">Website: <a
							href=<?php echo $weblink; ?>> <?php echo $webtag; ?> </a>
					</label> <!-- Fu-5-19 --></td>
					<td><label style="font-size: 12px">Librarian: <?php echo $store[19]; ?></label>
					</td>
					<td><label style="font-size: 12px">Open Hours: <?php echo $store[24]; ?></label>
					</td>
					
				</tr>

				<tr>
					<td><label style="font-size: 12px">Duration: <?php echo $store[27]; ?></label>
					</td>
					<td><label style="font-size: 12px">Borrow limit one time: <?php echo $store[28]; ?></label>
					</td>
					<td><label style="font-size: 12px">Max renew times: <?php echo $store[33]; ?></label>
					</td>
				</tr>




			</table>
<?php
$first = true;
$flag = false;
while ( $review1 = mysql_fetch_row ( $k2 ) ) {
	if ($first) {
		$first = false;
		$flag = true;
		?>
				<div align="center" class="associations">
				<label style="font-size: 12px">Associated Libraries:</label>
			</div>
			<div id="assiciationId" align="center" class="associations">
				<?php
	}
	echo "<a href=\"Storepage.php?name=$review1[1]&storeId=$review1[0]\">$review1[1]</a>";
}

if (! $first) {
	echo "</div>";
}
?>
<br>
	<?php
	if (isset ( $_SESSION ['type'] ) && $_SESSION ['type'] == 'Store' && ($flag == true)) {
		?>
	<div align="center" class="associations">
						<td><input type="button" name="ListMystore" id="listStore"
							onclick="listStore()" value="List My Store Here, too"> </input> <input
							type="hidden" id="liststorebtnid" name="liststorebtnid"
							value="<?php echo $storeID; ?>"> <input type="hidden"
								id="liststorebtnname" name="liststorebtnname"
								value="<?php echo $storename; ?>"></td>
					</div>
	<?php
	} else if (isset ( $_SESSION ['type'] ) && $_SESSION ['type'] == 'Customer' && ($flag == true)) {
		?>		
				
			
			<div align="center" class="associations">
						<td><input type="button" name="addMembership" id="addMembership"
							onclick="addMembership()" value="Apply Membership"> </input></td>
					</div>
			
			<?php
	}
	?>
			<br>
						<hr>
							<br>
			
			</div>
			<!--  Store Page Design ****** START ***** -Unnam  -->

			<div class="master-wrapper-page">
				<div class="master-wrapper-leftside">
					<div class="block" id="leftNav">
						<table id="Category" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td style="width: 250px; height: 45px;" />
								<strong><i>BOOK CATEGORIES</i></strong>
								</td>
							</tr>
							<tr>
								<td style="width: 200px; height: 45px; border: none;" />
								<a class=tryitbtn
									href="Storepage.php?name=<?php echo $storename ?>&storeId=<?php echo $storeID;?>&categoryId=01">
									BIBLE</a>
								</td>
							</tr>
							<tr>
								<td style="width: 200px; height: 45px; border: none;" />
								<a class=tryitbtn
									href="Storepage.php?name=<?php echo $storename ?>&storeId=<?php echo $storeID;?>&categoryId=02">
									THEOLOGY</a>
								</td>
							</tr>
							<tr>
								<td style="width: 200px; height: 45px; border: none;" />
								<a class=tryitbtn
									href="Storepage.php?name=<?php echo $storename ?>&storeId=<?php echo $storeID;?>&categoryId=03">
									CHRISTIAN LIFE</a>
								</td>
							</tr>
							<tr>
								<td style="width: 200px; height: 45px; border: none;" />
								<a class=tryitbtn
									href="Storepage.php?name=<?php echo $storename ?>&storeId=<?php echo $storeID;?>&categoryId=04">
									CHRISTIAN MINISTRY</a>
								</td>
							</tr>
							<tr>
								<td style="width: 200px; height: 45px; border: none;" />
								<a class=tryitbtn
									href="Storepage.php?name=<?php echo $storename ?>&storeId=<?php echo $storeID;?>&categoryId=05">
									CHURCH & CHURCH HISTORY</a>
								</td>
							</tr>
							<tr>
								<td style="width: 200px; height: 45px; border: none;" />
								<a class=tryitbtn
									href="Storepage.php?name=<?php echo $storename ?>&storeId=<?php echo $storeID;?>&categoryId=06">
									CD/DVD/OTHER</a>
								</td>
							</tr>
						</table>
					</div>
				</div>


				<div class="master-wrapper-center">


					<div id="tabs">
					
										<?php
										$cat = - 1;
										if ($categoryID == 01) {
											$cat = 'A. Bible';
										} else if ($categoryID == 02) {
											$cat = 'B. Theology';
										} else if ($categoryID == 03) {
											$cat = 'C. Christian Life';
										} else if ($categoryID == 04) {
											$cat = 'D. Christian Ministry';
										} else if ($categoryID == 05) {
											$cat = 'E. Church and Church History';
										} else if ($categoryID == 06) {
											$cat = 'F. CD/DVD/Other';
										}
										// if($cateogryID != -1)
										{
											$getsubCat = "select B.subCat, count(*) as NumOfBooks from Inventory I, Books B, Stores S where B.isbn = I.isbn and S.storeID = I.storeID and S.storeID = '" . $storeID . "' and B.category = '" . $cat . "'" . "group by B.subCat";
											$db = new DataBase ();
											$db->conn ();
											$k = $db->indb ( $getsubCat );
											$count = 0;
											
											// add the li items for each tab --START
											echo "<ul>";
											while ( $subcattabs = mysql_fetch_row ( $k ) ) {
												
												$count = $count + 1;
												$tab = $subcattabs [0];
												$bookcount = $subcattabs [1];
												$tabId = "tab" . $count;
												$tabname = $tab . "(" . $bookcount . ")";
												echo "<li><a href='#" . $tabId . "'><span>" . $tabname . "</span></a></li>";
											}
											echo "</ul>";
											// add the li items for each tab --FINISH
											
											// Again Loop through all the Sub Categories Add the Tab Content for Each Sub Cat - START
											$getsubCat = "select B.subCat, count(*) as NumOfBooks from Inventory I, Books B where B.isbn = I.isbn and B.category = '" . $cat . "'" . "group by B.subCat";
											$db = new DataBase ();
											$db->conn ();
											$subCatsSQLResults = $db->indb ( $getsubCat );
											$tempCount = 0;
											while ( $subcattabs = mysql_fetch_row ( $subCatsSQLResults ) ) {
												
												$tempCount = $tempCount + 1;
												$tab = $subcattabs [0];
												$bookcount = $subcattabs [1];
												$tabId = "tab" . $tempCount;
												$tabname = $tab . "(" . $bookcount . ")";
												error_log ( "TABNAME*** -- " . $tabname . "--TABID --" . $tabId );
												
												// Add the DIV for each Tab Content
												echo "<div id='" . $tabId . "'>";
												
												// For every Sub Category , Fetch the books for it - START
												$getbooksForSubCat = "select B.title,B.author,I.quantity,B.isbn,I.privateCallNum,B.translator,B.editionType,
		                										B.editionNumber,B.amazonStar,B.amazonReviews,B.category,B.subcat,B.publisherName,B.amazonRevLink,
		                										S.storeID, S.storeName,I.idx,B.pubDate,B.pages,I.bookCondition,I.holderID,B.altTitle,B.subTitle, 
		                										B.language,B.audience,B.productFormatDetail,B.fromBackCover,B.contents,B.subSubCat,B.keywords,B.productDimensions,B.shippingWeight
		                										from Inventory I, Books B, Stores S where B.isbn = I.isbn and S.storeID = I.storeID and S.storeID = '" . $storeID . "'
		                										and B.category = '" . $cat . "'" . " and B.subCat = '" . $tab . "'";
												// error_log($getbooksForSubCat);
												$db = new DataBase ();
												$db->conn ();
												$booksForSubCatSQLResults = $db->indb ( $getbooksForSubCat );
												echo "<table  border=0>";
												$cnt = 0;
												// loop through all the books in each sub category and populate a table
												while ( $bookRow = mysql_fetch_row ( $booksForSubCatSQLResults ) ) {
													
													$cnt = $cnt + 1;
													$subLinkID = 'book' . $cnt;
													$title = $bookRow [0];
													$author = $bookRow [1];
													$quantity = $bookRow [2] == '0' || $bookRow [2] == '' ? 'Checked out' : $bookRow [2] . ' Available';
													$isbn = $bookRow [3];
													$privateCallNum = $bookRow [4];
													$translator = $bookRow [5];
													$editionType = $bookRow [6];
													$editionNumber = $bookRow [7] == null || $bookRow [7] == '' || $bookRow [7] == '0' ? '' : 'Edition ' . $bookRow [7];
													$amazonStar = $bookRow [8];
													$amazonReviews = $bookRow [9];
													$category = $bookRow [10];
													$subcategory = $bookRow [11];
													$publisher = $bookRow [12];
													$amazonLink = $bookRow [13];
													$storeid = $bookRow [14];
													$storeName = $bookRow [15];
													$idx = $bookRow [16];
													$bookyear = explode ( '-', $bookRow [17] )[0];
													$pages = $bookRow[18];
													$bookcond = $bookRow[19];
													$pubDate = $bookRow[17];
													$holderID = $bookRow[20];
													$inventoryQuantity = intval ( $bookRow[2] );
													
													//new ones
													$altTitle = $bookRow[21];
													$subTitle = $bookRow[22];
													$language = $bookRow[23];
													$audience = $bookRow[24];
													$productFormatDetail = $bookRow[25];
													$fromBackCover = $bookRow[26];
													$contents = $bookRow[27];
													$subSubCat = $bookRow[28];
													$keywords = $bookRow[29];
													$productDimensions = $bookRow[30];
													$shippingWeight = $bookRow[31];
													
													echo "<tr>";
													echo "<td>";
													echo "<a href='coverimages/".$isbn."' data-lightbox='coverimages/".$isbn."'><img src ='coverimages/" . $isbn . "' class='listResultImage'  alt='coverimg' style='width:90px;height:120px;' /></a>"; 
													echo "</td>";
													echo "<td>";
													echo "<table  border =0>";
													echo "<tr><td>Title: </td><td><a href = '#'; onclick='showBook(\"$isbn\");'>$title</a>";
													
													echo "<div id = \"$isbn\" style='display:none;'>
													 	<table >
															<tr>
																<td colspan=4><h3>$title</h3><br>by <b>$author</b></td>
															</tr>
															<tr>
																<td style='text-align:left;' colspan=2><b> Alternate Title: </b> $altTitle</td>
									                            <td style='text-align:left;' colspan=2><b> Sub Title: </b> $subTitle</td>
															</tr>
															<tr>
																<td style='text-align:left;' colspan=2><b> Edition: </b> $editionNumber</td>
									                            <td style='text-align:left;' colspan=2><b> Edition Type: </b> $editionType</td>
															</tr>
															<tr>
																<td style='text-align:left;' colspan=2><b>ISBN:</b> $isbn</td>
																<td style='text-align:left;' colspan=2><b>Amazon Rating:</b> $amazonStar</td>
															</tr>
									                                                <tr>
																<td style='text-align:left;' colspan=2><b>Amazon </b> $amazonReviews</td>
									                                                        
																<td style='text-align:left;' colspan=2><b>Amazon Link:</b> <a href = $amazonLink>$amazonLink</a></td>
															</tr>
															<tr>
																<td style='text-align:left;' ><b>Publisher:</b></td>
																<td style='text-align:left;' colspan=2>$publisher</td>
																<td style='text-align:left;'>$bookyear ($pages pages)</td>
															</tr>
															<tr>
																<td style='text-align:left;'><b>Category:</b></td>
																<td style='text-align:left;'>$category</td>
																<td style='text-align:left;'><b>SubCategory:</b></td>
																<td style='text-align:left;'>$subcategory</td>
															</tr>
															<tr>
																<td style='text-align:left;'><b>SubSubCategory:</b></td>
																<td style='text-align:left;'>$subSubCat</td>
																
															</tr>
															<tr>
																<td style='text-align:left;' ><b>Call Number:</b></td>
																<td style='text-align:left;'>$privateCallNum</td>
									                            <td style='text-align:left;' ><b>Translator:</b></td>
																<td style='text-align:left;'>$translator</td>
															</tr>
															<tr>
																<td style='text-align:left;' ><b>Language:</b></td>
																<td style='text-align:left;'>$language</td>
									                            <td style='text-align:left;' ><b>Audience:</b></td>
																<td style='text-align:left;'>$audience</td>
															</tr>
															<tr>
																<td style='text-align:left;' colspan=2><b> Product Format Details: </b> $productFormatDetail</td>
									                            <td style='text-align:left;' colspan=2><b> From BackCover: </b> $fromBackCover</td>
															</tr>
															<tr>
																<td style='text-align:left;' colspan=2><b> Contents: </b> $contents</td>
									                            <td style='text-align:left;' colspan=2><b> Keywords: </b> $keywords</td>
															</tr>
															<tr>
																<td style='text-align:left;' colspan=2><b> Product Dimensions: </b> $productDimensions</td>
									                            <td style='text-align:left;' colspan=2><b> Shipping Weight: </b> $shippingWeight</td>
															</tr>
														</table>
				
													</div> ";
													echo "</td></tr>";
													
													echo "<tr><td>Author: </td><td>" . $author . "</td></tr>";
													echo "<tr><td>Quantity: </td><td>" . $quantity . "</td></tr>";
													
													if ($inventoryQuantity == 0 || ($inventoryQuantity == 1 & $holderID != '')) {
														// If books are not available we show Hold It button
														echo "<td><input type='button' style='color:#fff;width:100%;background-color:#585858;border-color:#C8C8C8' name='holdit' value='Hold It' /></td></tr>";
														
													} else {
													//If books are available we show Get It button
																	echo "<tr><td><input type='button' style='color:#fff;width:100%;background-color:#585858 ;border-color:#C8C8C8' name='getit'  onclick='showDialog(\"$subLinkID\");' value='Get It' />";
																					
																					echo "<div id=\"$subLinkID\" style='display:none;' >";
																					?>
																					<table style="text-align: left; font-size: 12px;">
							<tr>
								<td colspan=4 style="text-align: left;">
									<h3><?php echo $title; ?> </h3> <input type="hidden"
									id='<?php echo $subLinkID; ?>Name'
									value='<?php echo $title; ?>'> <input type="hidden"
										id='<?php echo $subLinkID; ?>ISBN'
										value='<?php echo $isbn; ?>'><input type="hidden"
											id='<?php echo $subLinkID; ?>storeID'
											value='<?php echo $storeid; ?>'> <input type="hidden"
												id='<?php echo $subLinkID; ?>storeName'
												value='<?php echo $storeName; ?>'> <input type="hidden"
													id='<?php echo $subLinkID; ?>idx'
													value='<?php echo $idx; ?>'>
								
								</td>
							</tr>
							<tr>
								<td colspan=3 style="text-align: left;">Quantity</td>
								<td colspan=1 style="text-align: right;"><input type="text"
									id='<?php echo $subLinkID; ?>Quantity' value='1' size=1></td>
							</tr>
							<tr>
								<td style="text-align: left;">Desc</td>
								<td colspan=3 style="text-align: left;"><input type="text"
									id='<?php echo $subLinkID; ?>Desc' size=15 value=''></td>
							</tr>
						</table>
					</div>
					</td>
													<?php
													}
												//	echo "<td><input type='button' style='color:#fff;width:100%;background-color:#585858;border-color:#C8C8C8' name='holdit' value='Hold It' /></td></tr>";
													echo "</table>";
													echo "</td>";
													echo "</tr>";
												}
												echo "</table>";
												echo "</div>";
												// For every Sub Category , ie Tab ID , Fetch the books for it - START
											}
											// Again Loop through all the Sub Categories Add the Tab Content for Each Sub Cat - FINISH
											$empty = "There are no Subcategories";
											if (mysql_num_rows ( $k ) == 0) {
												echo "<p>There Are No SubCategories</p>";
											}
										}
										?>
										</div>

			</div>

			<div class="master-wrapper-rightside">
				<div class="block1" id="rightNav">
					<table id="Category" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td style="width: 250px; height: 45px;" />
							<strong><i>ADDS</i></strong>
							</td>
						</tr>
						<tr>
							<td style="width: 200px; height: 45px; border: none;" />
							<a href="http://www.w3schools.com/html/"><i><strong>Did you know
										that..?</strong></i></a>
							</td>
						</tr>
						<tr>
							<td style="width: 200px; height: 45px; border: none;" />
							</td>
						</tr>
						<tr>
							<td style="width: 200px; height: 45px; border: none;" />
							</td>
						</tr>
						<tr>
							<td style="width: 200px; height: 45px; border: none;" />
							</td>
						</tr>
						<tr>
							<td style="width: 200px; height: 45px; border: none;" />
							</td>
						</tr>
						<tr>
							<td style="width: 200px; height: 45px; border: none;" />
							</td>
						</tr>
					</table>
				</div>
			</div>
			</div>

			<!--  Store Page Design **** END **** -Unnam  -->
	
	<?php
	class DataBase {
		public $dbhost = "localhost";
		public $dbuser = "webclient";
		public $dbpass = "12345678";
		public $dbname = "bookstore";
		function conn() {
			$dbconn = mysql_connect ( $this->dbhost, $this->dbuser, $this->dbpass ) or die ( "database error!" . mysql_error () );
			mysql_select_db ( $this->dbname ) or die ( "can not connect database：" . mysql_error () );
			return $dbconn;
		}
		function indb($in_sql) {
			$result_indb = mysql_query ( $in_sql ) or die ( "can not run the sql language:" . mysql_error () );
			return $result_indb;
		}
	}
	?>

	<div id='cartDialog'>
				<table id="cartTable">
					<tr>
						<td colspan=5 align="center" style="text-align: center"><h3
								style="text-align: center">Your Cart</h3></td>
					</tr>
					<tr>
						<th style="width: 150px">Item</th>
						<th style="width: 50px">Quantity</th>
						<th style="width: 150px">Desc</th>
						<th style="width: 75px">price</th>
					</tr>
				</table>
				<br> <br>
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
					<div style="text-align: center">
						<a id="showcartBtn" class="showcartBtn" href="#"
							onclick="showcart();">Show Cart</a> <a id="checkoutBtn"
							class="checkoutBtn" href="#" onclick="checkout();">Checkout</a>
					</div>
		<script src="lightbox.js"></script>
		</body>
</html>