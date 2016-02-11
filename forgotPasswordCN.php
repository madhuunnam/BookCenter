<?php
session_start();
include 'NavigationBar.php'; 
?>

<html> 
<head>
	<script type="text/javascript" src='jquery-1.4.1.js'></script>
	<script type="text/javascript">
		function requestPassword() {
			$.post("requestPassword.php",
			{
				email: $('#email').val(),
				type: <?php echo "'". (isset($_GET['type'])?$_GET['type']:"")."'"; ?>
			},
			function(data, status){
				alert(data);
			});
		}


		<?php


				$con = mysql_connect('localhost', 'webclient', '12345678');

				$DB_CONNECTED = false;

				if (!$con) {
					$DB_CONNECTED = false;
				} else {
					$db_selected = mysql_select_db("bookstore");

					if (!$db_selected) {
						$DB_CONNECTED = false;
					} else {
						$DB_CONNECTED = true;
					}
				}				
				$type = isset($_GET['type'])?$_GET['type']:"";
				if (($type == null || $type == "")) {
					$type = isset($_POST['type'])?$_POST['type']:"";
				}

				if (($type == null || $type == "")) {
					echo "$(document).ready(function() {\n"; 
					echo "alert('Please select a user type at login');\n";
					echo 'window.location.href = "login.php";';
					echo "});\n";
				} 

		$reset = "";
		if($type == null || $type == "") {
			$type = isset($_POST['type'])?$_POST['type']:"";
			$reset = isset($_POST['reset'])?$_POST['reset']:"";
		} else {
			$reset = "reset";
		}

		if (($reset == null || $reset == "") && ($type == null || $type == "")) {


		} else if ($DB_CONNECTED) {  
			$email = isset($_POST['email'])?$_POST['email']:"";


			if ($reset == 'reset' && isset($_POST['submitted']) && $_POST['submitted']=='submitted') {
				$oldPassword = $_POST['oldPassword'];
				$newPassword = $_POST['newPassword'];
				$confirmPassword = $_POST['confirmPassword'];
				if ($oldPassword == null || $oldPassword == "") {
					echo "$(document).ready(function() {\n"; 
					echo "alert('Please enter old password');\n";
					echo "$('.reset').attr('style', 'display:none;');";
					echo "$('input:radio[name=\"type\"]').filter('[value=\"" . $type . "\"]').attr('checked', true);";
					echo "$('#reset').val('reset');";
					echo "});\n";
				} elseif ($email == null || $email == "") {
					echo "$(document).ready(function() {\n"; 
					echo "alert('Please enter email');\n";
					echo "$('.reset').attr('style', 'display:none;');";
					echo "$('input:radio[name=\"type\"]').filter('[value=\"" . $type . "\"]').attr('checked', true);";
					echo "$('#reset').val('reset');";
					echo "});\n";
				} elseif ($newPassword == null || $newPassword == "") {
					echo "$(document).ready(function() {\n"; 
					echo "alert('Please enter new password');\n";
					echo "$('.reset').attr('style', 'display:none;');";
					echo "$('input:radio[name=\"type\"]').filter('[value=\"" . $type . "\"]').attr('checked', true);";
					echo "$('#reset').val('reset');";
					echo "});\n";
				} elseif ($confirmPassword == null || $confirmPassword == "") {
					echo "$(document).ready(function() {\n"; 
					echo "alert('Please enter confirm password');\n";
					echo "$('.reset').attr('style', 'display:none;');";
					echo "$('input:radio[name=\"type\"]').filter('[value=\"" . $type . "\"]').attr('checked', true);";
					echo "$('#reset').val('reset');";
					echo "});\n";
				} elseif ($confirmPassword != $newPassword) {
					echo "$(document).ready(function() {\n"; 
					echo "alert('Passwords do not match');\n";
					echo "$('.reset').attr('style', 'display:none;');";
					echo "$('input:radio[name=\"type\"]').filter('[value=\"" . $type . "\"]').attr('checked', true);";
					echo "$('#reset').val('reset');";
					echo "});\n";
				} else {
					$sql = "";
					if ($type == 'Customer') {
						$sql="UPDATE customers SET password='$newPassword' WHERE emailAddress='$email' and password='$oldPassword'";
					} else if ($type == 'Admin') {
						$sql="UPDATE admins SET password='$newPassword' WHERE emailAddress='$email' and password='$oldPassword'";
					} else {
						$sql="UPDATE stores SET password='$newPassword' WHERE username='$email' and password='$oldPassword'";
					}

					$update = mysql_query($sql);
					$printSQL = $sql;

					$sql = "";
					if ($type == 'Customer') {
						$sql="SELECT custID FROM customers WHERE password='$newPassword' and emailAddress='$email'";
					} else if ($type == 'Admin') {
						$sql="SELECT adminID FROM admins WHERE password='$newPassword' and emailAddress='$email'";
					} else {
						$sql="SELECT storeID FROM stores WHERE password='$newPassword' and username='$email'";
					}

                    $update = mysql_query($sql);
                    $printSQL = $printSQL + "; " + $sql + ";";
                    $isChanged = false;
					
					try {
							while ($row = mysql_fetch_assoc($update)) {
								echo "$(document).ready(function() {\n";
								echo "alert('Successfully changed the password. Please login with new password.');\n";
								//echo 'alert("'.$printSQL.' ")';
								echo 'window.location.href = "login.php";';
								echo "});\n";
								$isChanged = true;
							}
						} catch (Exception $e) {
							$isChanged = false;
						}	
					

					if (!$isChanged) {
						if(!isset($_SESSION['attempts']) || $_SESSION['attempts'] == null) {
							$_SESSION['attempts'] = 0;
						}

						$_SESSION['attempts'] = $_SESSION['attempts'] + 1;

                        echo "$(document).ready(function() {\n";
						if(isset($_SESSION['attempts']) && $_SESSION['attempts'] > 3 ) {
							echo "alert('Please Click on request password and get temporary password from email.' );\n";
						} else {
							echo "alert('Unable to reset the password. Please try again. ');\n";
						}
						echo "$('.reset').attr('style', 'display:none;');";
						echo "$('input:radio[name=\"type\"]').filter('[value=\"" . $type . "\"]').attr('checked', true);";
						echo "$('#reset').val('reset');";
						echo "});\n";
					}  

				}
			}

		} else if (!$DB_CONNECTED) {
			echo "$(document).ready(function() {\n"; 
				echo "alert('We are unable to reset the password, Please try again');\n";
				echo "});\n";
		}
?>
</script>
<style type="text/css">
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

	input[type=submit], input[type=button] {
		-webkit-appearance: none;
		height: 2em;
		width: 12em;
		font-size: 1em;
		border-radius: 5px;
	}

	input[type=radio] {
		margin-right: 10px;
		margin-top: 10px;
	}

	#loginTable {
		width: 100%;
		border: 3px solid;
		border-radius: 14px;
		border-color: #f5f5f5;
		margin: 35px;
		padding: 20px;
		left: 50%;
		top: 50%;
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

	td {
		width: 200px;
	}

	#loginBtn, #requestBtn {
		border: 2px solid;
		border-radius: 14px;
		padding:5px 5px;
		font-size: 15px;
		background-color: #f5f5f5;
		width: 200px;
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

	.request {
		font-size: 1em !important;
	}

	.request input {
        background-color: #fff;
        border: 0px;
        font-size: 0.9em !important;
        padding-bottom: 10px !important;
        padding-top: 3px !important;
	}

	table {
		vertical-align: top;
	}

    table th {
        text-align: right;
    }
</style>
</head>
<body>
	<div id='tableContainer' style="width:800px; margin:0 auto; margin-top:	3%;">
		<h2> 恢复或改变密码 </h2>
		<form method=post action="forgotPassword.php" id="forgotPassword">
			<table  id='loginTable' style="width:100%; margin:35px;" > 
				<tr>
					<th> 电邮 </th>
					<td> 
						<input type="text" class='inputBox' name="email" id="email"> 
						<input type="hidden" class='inputBox' name="type" id="type" value="<?php echo $type; ?>">
						<input type="hidden" class='inputBox' name="submitted" id="submitted" value="submitted">
						<input type="hidden" name="reset" id="reset" value="reset"> 
					</td>
				</tr>
				<tr class="change">
					<th> 旧密码 </th>
					<td> <input class='inputBox' type="password" name="oldPassword" id="oldPassword"> </td>
					<td class="request" style="width:90px; text-align:right;"> 忘了? </td>
					<td class="request" style="width:200px;">
						<input id='requestBtn' onclick="requestPassword()" type="button" value="申请临时密码" name="resetPassword" id="resetPassword"> 
					</td>
				</tr>
				<tr class="change">
					<th> 新密码 </th>
					<td> <input class='inputBox' type="password" name="newPassword" id="newPassword"> </td>
				</tr>
				<tr class="change">
					<th> 重新输入 </th>
					<td> <input class='inputBox' type="password" name="confirmPassword" id="confirmPassword"> </td>
				</tr>
				<tr class="change">
					<td>&nbsp;</td>
					<td> <input id='loginBtn' type="submit" name="submitPassword" id="submitPassword"> </td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>