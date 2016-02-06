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
				alert("Please enter a Branch name");
				ret=false;
			}
			
			else if ($('#contact').val() == "") {
				alert("Please enter a Contact Details");
				ret=false;
			}
		
			else if ($('#phone').val() == "") {
				alert("Please enter a phone");
				ret=false;
			}
			
			else if ($('#email').val() == "") {
				alert("Please enter a email");
				ret=false;
			}
			
			return ret;
			

		}
	</script>
 
</head>
<?php include 'NavigationBar.php'; ?>


<?php 
if (isset($_GET['oid'])) 
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
$myData = mysql_query("SELECT * FROM `organizations` WHERE `organID`='".$_GET['oid']."'");
 
    $row = mysql_fetch_array($myData);
echo "<pre>";
	//var_dump($row);
echo "</pre>";
}?>
            <body>
			<br></br>
                 <div align="center"><h1>Create Branch </h1>
				 
				 <div align="right"><a href="homepage.php">Home Page</a></div>
				 
				  
      
	    <form id='branchnew' method='post' action='branch.php'  enctype="multipart/form-data">
        
            
           <table>
			<br></br>
                <tr>
				<div align text="left">
                    <th>Branch Name<sup>*</sup></th></div>
                    <td><input type=text id="bname" name="bname" /></td>
					
					
                    <th><div align="right">Optional Branch Name</div></th>
					<td><input type=text id="cbname" name="cbname"/></td>
				</tr>
				
				
				<tr>
				
                    <th><div align ="right"> Phone<sup>*</sup></div></th>
                    <td > <input type=text id="phone" name="phone" /> </td>
					
                    <th><div align="right">Other Phone </div></th>
                    <td> <input type=text id="phone1" name="phone1"/> </td>
                </tr>
				
				
				<tr>
				<th><div align="right">Email<sup>*</sup></div></th>
                <td><input type="text" id="email" name="email"/></td>
				</tr>
                   
				<tr>
				<th>Address Line </th>
                <td colspan="2"><input type="text" id="address" name="address" size=40/></td>
                </tr>
				
									
	             
				<tr>
                <th>Contact Name<sup>*</sup></th>
                <td> <input type="text" id="contact" name="contact" size=40/></td>
				
                <th><div align="right">Optional Contact Name</div></th>
                <td> <input type="text" id="ccontact" name="ccontact"/></td>
                </tr>
				
				<th> </th>
				</div>
			<tr>
			<input type='hidden' name='orgID' value="<?php echo $row['organID']; ?>"/>
			
			<td><br><br><input type="submit" name="submit" onclick="javascript:return validateAndSubmit();" value="Create"/></td>
			<!--<td><br><br><input type="button" name="submit" onclick="javascript:validateAndSubmit();" value="Create"/></td>-->
			
	
           <?php //Echo "<td><a href='branch.php?oid=".$row['ID']."'>Create</a></td>"; ?>
		   
		   <td></td>
			<td> <!-- <br><br><input type="submit" name="update" id="update" onclick="javascript:validateAndSubmit();" value="Update"> --> </td>
		
			<td></td>
			
			<td><br><br><input type="reset" name="done" id="done" value="Done"/></td>
			
			</tr>
			
			
				
            </table>
           
       <!-- </form>-->
       
    </body>
	</form>
</html>