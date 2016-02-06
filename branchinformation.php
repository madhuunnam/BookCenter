<?php
session_start();
?>

            <html>
            <head>
			
			 <script type="text/javascript" src='jquery.js'></script>
	        <script type="text/javascript">
			
		    function validateAndSubmit() {
		var ret=true;
			if ($('#bname').val() == "") {
				alert("Please enter a branch name");
				ret= false;
			}
			
			else if ($('#keywords').val() == "") {
				alert("Please enter a keywords");
				ret= false;
			}
			
			else if ($('#addrL1').val() == "") {
				alert("Please enter address");
				ret= false;
			}
			
			else if ($('#city').val() == "") {
				alert("Please enter a city");
				ret= false;
			}
			else if ($('#state').val() == "") {
				alert("Please enter a state");
				ret= false;
			}
			else if ($('#zip').val() == "") {
				alert("Please enter a zipcode");
				ret= false;
			}
			else if ($('#phone').val() == "") {
				alert("Please enter a phone");
				ret=false
			}
			else if ($('#email').val() == "") {
				alert("Please enter a email");
				ret=false
			}
			else if ($('#username').val() == "") {
				alert("Please enter a username");
				ret=false
			}
			else if ($('#password').val() == "") {
				alert("Please enter a password");
				ret=false
			}	
            else{
			ret=true;}
			return ret;

		}
	</script>

	</head>
	<?php include 'NavigationBar.php'; ?>
            <body>
			<?php 
			if (isset($_GET['branchID'])) 
			{			
define('DB_NAME', 'bookstore');
define('DB_USER', 'webclient');
define('DB_PASSWORD', '12345678');
define('DB_HOST', 'localhost');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db(DB_NAME, $link);

if(!$db_selected) {
    die('Can\'t use ' . DB_NAME . ': ' . mysql_error());
}
$myData = mysql_query("SELECT * FROM `branch` WHERE `branchID`='".$_GET['branchID']."'");
 
    $row = mysql_fetch_array($myData);
echo "<pre>";
	//var_dump($row);
echo "</pre>";

$bname = $row['bname'];
$cbname = $row['cbname'];
$phone = $row['phone'];
$phone = $row['phone1'];
$email = $row['email'];
$address=$row['address'];
$contact=$row['contact'];
$ccontact = $row['ccontact'];
}?>

 
 
 <div align="center"><h1>Information of Branch of an Organisation </h1></div>
      
	    <form id='insertForm' method='post' action='branchupdate.php'  enctype="multipart/form-data">
 <table>
			
			
                <tr>
                    <th><div align ="right">Branch Name<sup>*</sup></div></th>
                    <td><input type="text" name="bname" id="bname"  value="<?php echo htmlentities($bname); ?>"/></td>
				  
				
                    <th><div align ="right">Optional Branch Name</div></th>
					<td><input type=text name="cbname" id="cbname" value="<?php echo htmlentities($cbname); ?>"/></td>
				</tr>
					
				<tr>	
                    <th><div align ="right">Phone</div></th>
                    <td><input type=text name="phone" id="phone" value="<?php echo htmlentities($phone); ?>"/></td>
					
					<th><div align ="right">Other Phone</div></th>
                    <td><input type=text name="phone1" id="phone1" value="<?php echo htmlentities($phone1); ?>" /></td>
                 </tr>
				
                  <tr>				
					<th><div align ="right">Email<sup>*<sup></div></th>
                    <td><input type=text name="email" id="email" value="<?php echo htmlentities($email); ?>"></td>
				</tr>
				
				<tr>
                <th><div align ="right">Address <sup>*</sup></div></th>
                <td colspan="2"><input type=text name="address" id="address" value="<?php echo htmlentities($address); ?>"/></td>
                </tr>
				
                <tr>
				<th><div align ="right">Contact</div></th>
                <td colspan="2"><input type=text name="contact" id="contact" value="<?php echo htmlentities($contact); ?>"/></td>
                
				<th><div align ="right">Optional Contact Name</div></th>
                <td><input type=text name="ccontact" id="ccontact" value="<?php echo htmlentities($ccontact); ?>"/></td>
                </tr>
				
				<input type='hidden' name="ID" value="<?php echo $row['branchID'] ?>" />
				<input type="submit" value="Update" name="submit" />			
				</form>
				
                </body>
                </html>