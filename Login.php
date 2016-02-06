<?php
session_start();
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
	$_SESSION['name'] = '';
	$_SESSION['type'] = '';
	$_SESSION['loggedIn'] = false;
	$_SESSION['welcomed'] = false;
	$_SESSION['userID'] = '';
	$_SESSION['storeID'] = '';
	$_SESSION['adminID'] = '';
	session_unset();
}

include 'NavigationBar.php'; 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login</title>
	<script type="text/javascript" src='jquery-1.4.1.js'></script>
	<script type="text/javascript">
		function sendToForgotPassword() {
			window.location.href = 'forgotPassword.php?type=' + $('#loginType:checked').val();
		}

		$(document).ready(function() {
			<?php
			$_SESSION['attempts'] = null;
			if (isset($_POST['submitted']) && $_POST['submitted'] == 'Y') {
				if ($_POST['loginType'] == '') {
					echo 'alert("Please select a login type");';
				} else if ($_POST['username'] == '' && $_POST['password'] == '') {
					echo 'alert("Please enter username and password");';
				} else if ($_POST['username'] == '') {
					echo 'alert("Please enter username");';
				} else if ($_POST['password'] == '') {
					echo 'alert("Please enter password");';
				} else {
					$con = mysql_connect('localhost', 'webclient', '12345678');
					
					if (!$con) {
						echo 'alert("Unable to login. Please try again");';
						echo '$("#username").val("' . $_POST['username'] . '");';
						echo '$("#password").val("' . $_POST['password'] . '");';
						echo '$("#loginType").val("' . $_POST['loginType'] . '").attr("checked", "checked");';
						die('Failed to conect to MySQL: ' . mysql_error());
					}

					$db_selected = mysql_select_db("bookstore");

					if (!$db_selected) {
						echo 'alert("Unable to login. Please try again");';
						echo '$("#username").val("' . $_POST['username'] . '");';
						echo '$("#password").val("' . $_POST['password'] . '");';
						echo '$("#loginType").val("' . $_POST['loginType'] . '").attr("checked", "checked");';
						die('Can\'t use the db :' . mysql_error());
					}

					if ($_POST['loginType'] == "Customer") {
						$checkLogin = "select COUNT(*) AS hasUser, custID, emailAddress, firstName, middleName, lastName from customers where emailAddress='". $_POST['username']  ."' and password='". $_POST['password'] ."'" ;
						$emailExists= mysql_query($checkLogin);
						$loggedIn = false;
						while ( $row = mysql_fetch_assoc($emailExists)) {
							if ($row['hasUser'] != 0) {
								$loggedIn = true;
								$_SESSION['name'] = $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'];
								$_SESSION['type'] = 'Customer';
								$_SESSION['loggedIn'] = $loggedIn;
								$_SESSION['welcomed'] = false;
								$_SESSION['custID'] = $row['custID'];
							}
						}

						if($loggedIn) {
							if (isset($_SESSION['redirectUrl'])) {
								echo 'window.location.href = "'.$_SESSION['redirectUrl'].'";';
								$_SESSION['redirectUrl'] = null;
							} else {
								echo 'window.location.href = "homepage.php";';
							}
						} else {
							echo 'alert("No customer matched the email provided");';
						}
					} else if ($_POST['loginType'] == 'Admin') {
						$checkLogin = "select COUNT(*) AS hasUser, adminID, email, `name` from admins where email='". $_POST['username']  ."' and password='". $_POST['password'] ."'" ;
						$emailExists= mysql_query($checkLogin);
						$loggedIn = false;
						
						while ( $row = mysql_fetch_assoc($emailExists)) {
							if ($row['hasUser'] != 0) {
								$_SESSION['name'] = $row['name'];
								$_SESSION['type'] = 'Admin';
								$_SESSION['loggedIn'] = true;
								$_SESSION['welcomed'] = false;
								$_SESSION['adminID'] = $row['adminID'];
								$loggedIn = true;
							}
						}

						if($loggedIn) {
							if (isset($_SESSION['redirectUrl'])) {
								echo 'window.location.href = "'.$_SESSION['redirectUrl'].'";';
								$_SESSION['redirectUrl'] = null;
							} else {
								echo 'window.location.href = "homepage.php";';
							}
						} else {
							echo 'alert("No admin matched the email provided");';
						}
					} else {
						$checkLogin = "select COUNT(*) AS hasUser, storeID, storeName from stores where email='". $_POST['username']  ."' and (mgrPasswd='". $_POST['password'] ."' or staffPasswd='". $_POST['password'] ."')" ;
						$emailExists= mysql_query($checkLogin);
						$loggedIn = false;
						
						while ( $row = mysql_fetch_assoc($emailExists)) {
							if ($row['hasUser'] != 0) {
								$_SESSION['name'] = $row['storeName'];
								$_SESSION['type'] = 'Store';
								$_SESSION['loggedIn'] = true;
								$_SESSION['welcomed'] = false;
								$_SESSION['storeID'] = $row['storeID'];
								$_SESSION['attempts'] = null;
								$loggedIn = true;
							}
						}
						if($loggedIn) {
							if (isset($_SESSION['redirectUrl'])) {
								echo 'window.location.href = "'.$_SESSION['redirectUrl'].'";';
								$_SESSION['redirectUrl'] = null;
							} else {
								echo 'window.location.href = "homepage.php";';
							}
						} else {
							echo 'alert("No record matched the credentials provided ");';

						}
					}
				}

				echo '$("#username").val("' . $_POST['username'] . '");';
				echo '$("#password").val("' . $_POST['password'] . '");';
				echo '$("#loginType").val("' . $_POST['loginType'] . '").attr("checked", "checked");';

			}

			?>
		});
</script>


<style>

	<style type="text/css">

		#loginTable {
			width: 100%;
			height: 400px;
			border: 3px solid;
			border-radius: 14px;
			border-color: #f5f5f5;
			margin: 35px;
			padding: 20px;
			left: 50%;
			top: 30%;
			text-align: center;

			
		}

		#left {
			text-align: right;
		}

		#right {
			text-align:left;
		}
		#loginTable td {
			padding:10px;
			font-size: 1.2em;

		}

		h2, body, td {
			text-align: center;
			color:#555;
		}

		h2 {
			padding:20px;
		}

		#loginBtn {
			border: 2px solid;
			border-radius: 14px;
			padding:5px 5px;
			font-size: 15px;
			background-color: #f5f5f5;
			width: 100px;
		}

		.inputBox {
			width: 250px;
			height:25px;
		}

		.inputBox, hr {
			text-decoration: none;
			color:#aaa;
		}

		.inputBox :hover {
			text-decoration: none;
			color:#555;
		}

        .anchor {
            color: blue;
            font-size: 0.9em;
            text-decoration: underline;
        }

        .smallFont {
            font-size: 0.9em;
        }
		
	</style>

</head>

<body>
	<div id='tableContainer' style="width:800px; margin:0 auto; margin-top:	3%;">
		<h2>Login</h2>
		<form method='post' action='Login.php'>
			<table id='loginTable' style="width:100%; margin:35px;" >
				<tr >
					<th  id='left'>
						<input type="radio" id="loginType" checked name="loginType" value="Customer"> Customer
					</th>
					<th>
						<input type="radio" id="loginType" name="loginType" value="Store"> Store/Library
					</th>
					<th  id='right'>
						<input type="radio" id="loginType" name="loginType" value="Admin"> Admin
					</th>
				</tr>
				<tr>
					<td id='left'>
						<label> Email Address</label>
						<input type="hidden" name="submitted" value="Y">
					</td>
					<td>
						<input class='inputBox' type="text" maxlength="64" size="20" class="form200" name="username" id="username" value="">
					</td>
					<td id='right' class="smallFont">
						First time user? <a class="anchor" href="Signup.php" id="sign-up" class="ybtn ybtn-primary">Sign Up</a>
					</td>
				</tr>
				
				<tr>
					<td id='left'>
						<label> Password</label>
					</td>
					<td >
						<input  class='inputBox' autocomplete="off" type="password" size="20" class="form200" id="password" name="password">
					</td>
					<td id='right'>
						<a class="anchor" href="#" onclick="sendToForgotPassword()">Forgot/Change password?</a>
					</td>
				</tr>
				<tr >
					<td>
					</td>
					<td>
						<input type="submit" value="Submit" id='loginBtn' class="ybtn ybtn-small">
					</td>
					<td>
					</td>
				</tr>
			</table>
			
		</form>
	</div>
</body>
</html>