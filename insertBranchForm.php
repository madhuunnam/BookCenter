<?php
session_start();
?>
            <html>
			
            <head>
            <script type="text/javascript" src='jquery-1.4.1.js'></script>
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
 
<style>
    table {
    border-spacing: 1em;
}
</style>

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

    <form id='branchnew' method='post' action='insertBranch.php'  enctype="multipart/form-data">
        
            
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
                    <th><div align="right">Description</div></th>
                    <td><input type="text" id="description" name="description"/></td>
                </tr>
                   
				<tr>
				<th>Address Line </th>
                <td colspan="4"><input type="text" id="address" name="address" size=80/></td>
                </tr>						
	             
				<tr>
                <th>Contact Name<sup>*</sup></th>
                <td> <input type="text" id="contact" name="contact" /></td>
				
                <th><div align="right">Optional Contact Name</div></th>
                <td> <input type="text" id="ccontact" name="ccontact"/></td>
                </tr> <tr>

                    <th><div align="right">Meeting Name</div></th>
                    <td> <input type="text" id="meetingName" name="meetingName"/></td>
                    <th><div align="right">Meeting Time</div></th>
                    <td> <input type="text" id="meetingTime" name="meetingTime"/></td>

                </tr> <tr>
                    <th><div align="right">Meeting Description</div></th>
                    <td colspan="4"> <input type="text" id="meetingDesc" name="meetingDesc" size=80/></td>
                

                </tr>
                
				
				<th> </th>
		</div>
                <tr>
			<input type='hidden' name='orgID' value="<?php echo $row['organID']; ?>"/>
                        <input type='hidden' name='orgName' value="<?php echo $row['name']; ?>"/>
			
                        <td></td>
			<td><br><br><input type="submit" name="submit" onclick="javascript:return validateAndSubmit();" value="Create"/></td>
				
                        <td></td>
			<td><br><br><input type="reset" name="done" id="done" value="Clear"/></td>
			
		</tr>
            </table>
           
       </form>
       
    </body>
	
</html>