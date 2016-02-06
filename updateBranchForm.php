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
    div,iframe{
    padding:0;
    margin:0;
    }
    .updateConfirm, .branchesCont {
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5)
    }
    .update, .branch{
    background:#fff;
    box-shadow:0 0 5px 0 #ddd;
    position:relative;
    top:150px;
    min-height:200px;
    padding:20px;
    width:400px;
    margin:0 auto;
    }

   table {
       border-spacing: 1em;
   }
</style>
			
</head>
<?php include 'NavigationBar.php'; ?>

<body>

<?php 
if (isset($_GET['brid']))  {			
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

   $query = "SELECT * FROM `branches` WHERE `branchID`='".$_GET['brid']."'"; 
    //var_dump($query);

    $result=mysql_query($query); 
  	
    while($row1 = mysql_fetch_array($result)) {
	//var_dump($row);
        $orgID = $row1['organID'];
        $orgName = $row1['organName'];
        $bname = $row1['bname'];
        $cbname = $row1['cbname'];
        $branchID = $row1['branchID'];
        $brcontact = $row1['contact'];
	$brphone = $row1['telephoneNumber'];
	$bremail=$row1['emailAddress'];
        $brccontact = $row1['ccontact'];
        $brdesc = $row1['description'];
        $bro = $row1['otherPhone'];
        $bra = $row1['address'];
        $meN = $row1['meetingName'];
        $meT = $row1['meetingTime'];
        $meD = $row1['meetingDesc'];
        $insD = $row1['insertDate'];
 }
}

?>

 
 <br><br>
 <div align="center"> <h1>Update <?php echo htmlentities($bname); ?> </h1> </div>
 <br><br>


<form id='updateBranch' method='post' action="updateBranch.php?brid=<?php echo $branchID; ?> "  enctype="multipart/form-data">
        
            
    <table>
                 <br></br>
         <tr>
             <th><div align="right">Branch Name<sup>*</sup></th></div>
             <td><input type=text id="bname" name="bname" value="<?php echo htmlentities($bname); ?>"/></td>


             <th><div align="right">Optional Branch Name</div></th>
             <td><input type=text id="cbname" name="cbname" value="<?php echo htmlentities($cbname); ?>"/></td>
         </tr><tr>

             <th><div align ="right"> Phone<sup>*</sup></div></th>
             <td > <input type=text id="phone" name="phone"  value="<?php echo htmlentities($brphone); ?>"/> </td>

             <th><div align="right">Other Phone </div></th>
             <td> <input type=text id="phone1" name="phone1" value="<?php echo htmlentities($bro); ?>"/> </td>
         </tr>


         <tr>
             <th><div align="right">Email<sup>*</sup></div></th>
             <td><input type="text" id="email" name="email" value="<?php echo htmlentities($bremail); ?>"/></td>
             <th><div align="right">Description</div></th>
             <td><input type="text" id="description" name="description" value="<?php echo htmlentities($brdesc); ?>"/></td>
         </tr>

        <tr>
        <th>Address Line </th>
         <td colspan="4"><input type="text" id="address" name="address" size=80 value="<?php echo htmlentities($bra); ?>"/></td>
         </tr>						

         <tr>
         <th>Contact Name<sup>*</sup></th>
         <td> <input type="text" id="contact" name="contact"  value="<?php echo htmlentities($brcontact); ?>"/></td>

         <th><div align="right">Optional Contact Name</div></th>
         <td> <input type="text" id="ccontact" name="ccontact" value="<?php echo htmlentities($brccontact); ?>"/></td>
         </tr> <tr>

             <th><div align="right">Meeting Name</div></th>
             <td> <input type="text" id="meetingName" name="meetingName" value="<?php echo htmlentities($meN); ?>"/></td>
             <th><div align="right">Meeting Time</div></th>
             <td> <input type="text" id="meetingTime" name="meetingTime" value="<?php echo htmlentities($meT); ?>"/></td>

         </tr> <tr>
             <th><div align="right">Meeting Description</div></th>
             <td colspan="4"> <input type="text" id="meetingDesc" name="meetingDesc" size=80 value="<?php echo htmlentities($meD); ?>"/></td>

         </tr>


         <tr>
                 <input type='hidden' name='orgID' value="<?php echo htmlentities($orgID); ?>"/>
                 <input type='hidden' name='orgName' value="<?php echo htmlentities($orgName); ?>"/>

                 <td></td>
                 <td><br><br><input type="submit" name="submit" onclick="javascript:return validateAndSubmit();" value="Update"/></td>

         </tr>
     </table>
           
</form>

</body>
</html>