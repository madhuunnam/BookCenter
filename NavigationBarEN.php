<html>
<head>
<meta charset="UTF-8" />
	<style>
	*{
			margin:0;
			padding:0;
		}
		h2, body {
			text-align: center;
			color:#555;
		}
		h2 {
			padding:20px;
		}
		/*table td {
			padding:10px;
			font-size: 1.2em;
		}*/
		.clear:after {
			clear: both;
			content: ".";
			display: block;
			height: 0;
			visibility: hidden;
		}

		nav{
			display:inline-block;
			border:1px solid #505255;
			border-bottom: 1px solid #282C2F;
		}

		.grayNavBar {
			background-color: #444;
		}
		a.topNav {
			border: 1px solid;
			border-radius: 10px;
			padding:5px 5px;
			padding-right: 10px;
			padding-left: 10px;
			background-color: #f5f5f5;
			text-align: center;
			text-decoration: none;
			font-size: 13px;
			color:#555;
		}
		a.topNav:hover {
			background-color: #555;
			color:#f5f5f5;
		}
		.first{
			list-style:none;
			float:left;
			border: 0px;
			border-right: 1px solid #aaa;
			border-left: 1px solid #aaa;
			position: relative;
		}
.second{
	list-style:none;
	float:left;
	border-right: 1px solid #2E3235;
	position: relative;
	/*background: -moz-linear-gradient(top, #fff, #555D5F 2% ,#555D5F  50%,#3E4245 100%);
	background: -webkit-gradient(linear, 0 0, 0 100%, from(#fff), color-stop(2%, #555D5F), color-stop(50%, #555D5F),to(#3E4245));*/
	background:#555D5F;
}
.first:hover{
	/*background: -moz-linear-gradient(top, #fff, #3E4245 2% ,#555D5F  80%,#555D5F 100%);
	background: -webkit-gradient(linear, 0 0, 0 100%, from(#fff), color-stop(2%, #3E4245), color-stop(80%, #3E4245),to(#555D5F));*/
	background:#3E4245;
	-moz-transition: background 1s ease-out;
	-webkit-transition: background 1s ease-out;
}
.second:hover{
	/*background: -moz-linear-gradient(top, #fff, #3E4245 2% ,#555D5F  80%,#555D5F 100%);
	background: -webkit-gradient(linear, 0 0, 0 100%, from(#fff), color-stop(2%, #3E4245), color-stop(80%, #3E4245),to(#555D5F));*/
	background:#3E4245;
	-moz-transition: background 1s ease-out;
	-webkit-transition: background 1s ease-out;
}
.first a{
	display:block;
	height:40px;
	line-height:40px;
	padding:0 30px;
	font-size:small;
	color:#fff;
	text-shadow: 0px -1px 0px #000;
	text-decoration:none;
	white-space:nowrap;
	width:100px;	
	z-index:100;
	border:1px solid #aaa;
}

li > a{
	position:relative;
}

li.last{
	border-right: 0 none;
}

li:hover dl{
	top:50px;
	display:block;
	width:145px;
	padding:10px;
}
.popmenu a{
	background:transparent;
	border:0 none;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-transition: background 0.5s ease-out;
	-webkit-transition: background 0.5s ease-out;
	
	z-index:50;
}


li:hover dd{
	margin-top:0;
	opacity:1;
}
li dd:nth-child(1){
	-webkit-transition-duration: 0.1s;
	-moz-transition-duration: 0.1s;
}
li dd:nth-child(2){
	-webkit-transition-duration: 0.2s;
	-moz-transition-duration: 0.2s;
}
li dd:nth-child(3){
	-webkit-transition-duration: 0.3s;
	-moz-transition-duration: 0.3s;
}
li dd:nth-child(4){
	-webkit-transition-duration: 0.4s;
	-moz-transition-duration: 0.4s;
}
dt{
	display:none;
	margin-top:-25px;
	padding-top:15px;
	height:10px;
}
li:hover dt{
	display:block;
}
.Darrow{
	float:right;
	margin:18px 10px 0 0;
	border-width:5px;
	border-color:#FFF transparent transparent transparent;
	border-style:solid;
	width:0;
	height:0;
	line-height:0;
	overflow:hidden;
	
	cursor:pointer;
	
	text-shadow: 0px -1px 0px #000;
	
	-webkit-box-shadow:0px -1px 0px #000;
	-moz-box-shadow:0px -1px 0px #000;
}
.arrow{
	margin:0 auto;
	margin-top:-5px;
	display:block;
	width:10px;
	height:10px;
	background:#222222;
	-webkit-transform: rotate(45deg);
	-moz-transform: rotate(45deg);
}
</style>
</head>
<body>
<div align="center" style='margin:20px;'>
	<a class="menulink topNav roundedLeftBottom" href="try1.php" >Add to Directory</a>
		<a class="menulink topNav" href="LookupDirectory.php">Lookup Directory</a>
		<?php
		if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != True) {
			?>
			<a class="menulink topNav" href="login.php" >Login</a>
			<a class="menulink topNav roundedRightbottom" href="signUp.php">Signup</a>
			<?php
		} else {
			?>
			<a class="menulink topNav  roundedRightbottom" href="login.php?action=logout" >Logout</a>
			<?php
		}
		?>

		</div>
<div align="center" class='grayNavBar' style="margin-top:10px;">
	<nav>
		<ul class="clear">
			<li class="first"><a class="menulink" href="homepage.php">Home</a></li>
		<?php
			if (isset($_SESSION['type']) && $_SESSION['type']=='Customer') {
		?>
					
			<li class="first"><a class="menulink" href="CustomerOutitems_Return.php">Return</a></li>
			<li class="first"><a class="menulink" href="customerProfile.php">Profile</a></li>
			<li class="first"><a class="menulink" href="Borrow.php">Borrow</a></li>
			<li class="first"><a class="menulink" href="CustomerActiveOrders.php">Orders</a></li>
			<li class="first"><a class="menulink" href="CustomerAccount.php">Account</a></li>
			<li class="first"><a class="menulink" href="CustomerMembership.php">Lib Membership</a></li>
			<li class="first"><a class="menulink" href="CustomerOrderHistory.php">History</a></li>
							
		<?php
			} else if (isset($_SESSION['type']) && $_SESSION['type']=='Store') {
		?>
			
			<li class="first"><a class="menulink" href="storeOnsiteCheckin.php">Onsite Checkin</a></li>
			<li class="first"><a class="menulink" href="storeOnsitePayment.php">Onsite Checkout</a></li>
			<li class="first"><a class="menulink" href="storeOrderStatus.php">Order Status</a></li>
			<li class="first"><a class="menulink" href="storeCheckout.php">Online Checkout</a></li>
			<li class="first"><a class="menulink" href="BulkShelfing.php">Lib Return</a></li>
			<li class="first"><a class="menulink" href="StoreShelfing.php">Shelfing</a></li><br>
			<li class="first"><a class="menulink" href="">Procure</a></li>
			<li class="first"><a class="menulink" href="InsertBook.php">Insert Books</a></li>
			<li class="first"><a class="menulink" href="storeAccount.php">Account</a></li>
			<li class="first"><a class="menulink" href="StoreProfile.php">Profile</a></li>
			<li class="first"><a class="menulink" href="">Statistics</a></li>
			<li class="first"><a class="menulink" href="StoreMembership.php">Lib Members</a></li>
			<li class="first"><a class="menulink" href="storeReturns.php">Out Items</a></li>
		<?php
			} else if (isset($_SESSION['type']) && $_SESSION['type']=='Admin') {
		?>
					
			<!--<li><a class="menulink" href="StoreViewOpenOrders.php">Open Orders</a></li>-->
			<li class="first"><a class="menulink" href="adminProfile.php">Profile</a></li>
			<li class="first"><a class="menulink" href="adminLookup.php">Lookup</a></li>
			<li class="first"><a class="menulink" href="">Statistics</a></li>
			<li class="first"><a class="menulink" href="">Messages</a></li>
							
		<?php
			} else {
		?>
			<li class="first"><a class="menulink" href=""> ?????</a></li>?<!-- Fu -->
			<!--Fu <li class="first"><a class="menulink" href="">Android App</a></li> -->
		<?php
			}

			if  (!isset($_SESSION['type']) || (isset($_SESSION['type']) && $_SESSION['type'] !=='Store' && $_SESSION['type'] !=='Customer')) {
		?>

			<!--Fu <li class="first"><a class="menulink" href="">Partner</a></li> -->
			<li class="first"><a class="menulink" href="About.php">About</a></li>
			<li class="first"><a class="menulink" href="Contact.php">Contact</a></li>
		<?php
			}
		?>
		</ul>
	</nav>
</div>
	
</body>
</html>