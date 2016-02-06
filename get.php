 <?php
session_start();
?>
            <html>
            <head>
			
			 <script type="text/javascript" src='jquery-1.4.1.js'></script>
	        <script type="text/javascript">
			
		    function validateAndSubmit() {
		var ret=true;
			if ($('#orgname').val() == "") {
				alert("Please enter a organisation name");
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
 </style>
			
            </head>
            <?php include 'NavigationBar.php'; ?>

            <body>
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

$orgname = $row['name'];
$cname = $row['cname'];
$foundYear = $row['foundYear'];
$type = $row['type'];
$keywords=$row['keywords'];
//$logo=$row['logo'];
$phone = $row['telephoneNumber'];
$phone1 = $row['otherPhone'];
$email = $row['emailAddress'];
$pastor = $row['pastor'];
$cpastor = $row['cpastor'];
$contact = $row['contact'];
$ccontact = $row['ccontact'];
$addrL1 = $row['addrStNum'];
$addrL2 = $row['addrL2'];
$city = $row['city'];
$state = $row['state'];
$country = $row['country'];
$zip = $row['zip'];
$status = $row['status'];
$numAdults = $row['numAdults'];
$numKids = $row['numKids'];
$workshipTime = $row['worshipTime'];
$prayerTime = $row['prayerTime'];
$bibleStudyTime = $row['bibleStudyTime'];

 }?>

 
 
 <div align="center"><h1>Information of Organisation Directory </h1></div>
 <div align="right"><a href="Lookupdirectory.php">Back</a></div>
 <div align="right"><a href="homepage.php">Home Page</a></div>
 
      
	    <form id='insertForm' method='post' action='orgupdate.php'  enctype="multipart/form-data">
 <table>
			
			
                <tr>
                    <th><div align ="right">Name<sup>*</sup></div></th>
                    <td><input type="text" name="orgname" id="orgname" value="<?php echo htmlentities($orgname); ?>"/></td>
				  
				
                    <th><div align ="right">Optional Name</div></th>
					<td><input type=text name="cname" id="cname" value="<?php echo htmlentities($cname); ?>"/></td>
					
					
                    <th><div align ="right">Found Year</div></th>
                    <td><input type=text name="foundYear" id="foundYear" value="<?php echo htmlentities($foundYear); ?>"/></td>
					
					<th><div align ="right">Type</div></th>
                    <td><input type=text name="type" id="type" value="<?php echo htmlentities($type); ?>" /></td>

					
					<th><div align ="right">Keywords<sup>*<sup></div></th>
                    <td><input type=text name="keywords" id="keywords" value="<?php echo htmlentities($keywords); ?>"></td>
				</tr>
				
				<tr>
				<th><div align ="right">Logo</div></th>
                <td> <img width="150" src="" />
			 <input type="file" name="logo" id="logo"></td>
			 <td><input type="button" value="Upload Image" name="uploadimage"></td>
                <!--<td> <input type="button" value="Upload" name="uploadBtn" id="uploadBtn" > </td>-->
                </tr>		
	             
				 
				<tr>
                <th><div align ="right">Address Line 1<sup>*</sup></div></th>
                <td colspan="2"><input type=text name="addrL1" id="addrL1" value="<?php echo htmlentities($addrL1); ?>"/></td>
                </tr>
				
                <tr>
				<th><div align ="right">Address Line 2</div></th>
                <td colspan="2"><input type=text name="addrL2" id="addrL2" value="<?php echo htmlentities($addrL2); ?>"/></td>
                </tr>
				
				
                <tr>
		        <th><div align ="right">City<sup>*</sup></div></th>
                <td > <input type=text name="city" id="city" value="<?php echo htmlentities($city); ?>"/> </td>
                    
			       <!-- <th colspan=2> <div align ="right">State<sup>*</sup></div></th>-->
				    <th><div align ="right">State<sup>*</sup></div></th>
                    <td><input type=text name="state" id="state" value="<?php echo htmlentities($state); ?>"></td>
                    
					
                    <th><div align ="right">Zip<sup>*</sup></div></th>
					<td><input type=text name="zip" id="zip" value="<?php echo htmlentities($zip); ?>"/></td>
                </tr>
				
				<tr>
                    <th> <div align ="right">Phone<sup>*</sup></div></th>
                    <td > <input type=text name="phone" id="phone" value="<?php echo htmlentities($phone); ?>"/> </td>
                    <th> <div align ="right">Other Phone </div></th>
                    <td> <input type=text name="phone1" id="phone1" value="<?php echo htmlentities($phone1); ?>"/> </td>
                </tr>
				
		        <tr>
                    <th><div align ="right">Email<sup>*</sup></div></th>
                    <td><input type=text name="email" id="email" value="<?php echo htmlentities($email); ?>"/></td>
					
                </tr>
                 
				 
				<tr>
                <th><div align ="right">Number of Adults</div></th>
                <td> <input type=text name="numAdults" id="numAdults" value="<?php echo htmlentities($numAdults); ?>"/></td>

                <th><div align ="right">Number of Kids</div></th>
                <td> <input type=text name="numKids" id="numKids" value="<?php echo htmlentities($numKids); ?>"/></td>

                <th><div align ="right">Pastor</div></th>
                <td> <input type=text name="pastor" id="pastor" value="<?php echo htmlentities($pastor); ?>"/></td>

                <th><div align ="right">Optional Pastor</div></th>
                <td><input type=text name="cpastor" id="cpastor" value="<?php echo htmlentities($cpastor); ?>"/></td>
                </tr>  

                <tr>
                <th><div align ="right">Contact Name</div></th>
                <td> <input type=text name="contact" id="contact" value="<?php echo htmlentities($contact); ?>"/></td>
                <th><div align ="right">Optional Contact Name</th></th>
                <td> <input type=text name="ccontact" id="ccontact" value="<?php echo htmlentities($ccontact); ?>"/></td>
                </tr>
				
				<tr>
                <th><div align ="right">Status</div></th>
                <td><input type=text name="status" id="status" value="<?php echo htmlentities($status); ?>"/></td>
                </tr>
				
                <tr>
                <th><div align ="right">Workship Time</div></th>
                <td><input type=text name="workshipTime" id="workshipTime" value="<?php echo htmlentities($workshipTime); ?>"/></td>
                </tr>

                <tr>
                <th><div align ="right">Prayer Time</div></th>
                <td><input type=text name="prayerTime" id="prayerTime" value="<?php echo htmlentities($prayerTime); ?>"/></td>

                <th><div align ="right">Bible Study Time</div></th>
                <td> <input type=text name="bibleStudyTime" id="bibleStudyTime" value="<?php echo htmlentities($bibleStudyTime); ?>"/></td>
                </tr>
				 
				 <?php 
				 Echo "<td><br><br><a href='branchnew.php?oid=".$row['organID']."'>Add branches</a></td>";?>
				 
				
				<!--<tr><th><td><h3><a href='http://localhost/branchnew.php'/>Add Branches</h3></td></th>-->
				
				<th><td><br><br><a class="showbranches" href="branchlist.php?orgid=<?php echo $row['organID'] ?>">Show Branches</a></td></th>
				
				<input type="hidden" name="ID" value="<?php echo $row['organID'] ?>" />
				<th><td><br><br><input type="button" name="update" id="update"  value="Update"></td></th>
				
                </table>
				
				
		<div class='updateConfirm'  style='display:none;'>
		<div class='update'>
    Are You sure you want to update this organization?
	
	<input type="submit" name="submit" value="Yes" />
	<input type="button" name="close" class="close" value="close" />
	</div></div>
	<div class='branchesCont'  style='display:none;'>
		<div class='branch' style='max-height:400px'>
   <iframe src="branchlist.php?orgid=<?php echo $row['organID'] ?>" width="380" height="240"  frameBorder="0" ></iframe>
	<input type="button" name="close" class="close" value="close" />
	</div></div>
	
				</form>
				
	<script>
	$(".showbranches").click(function(e){
		e.preventDefault();
		$('.branchesCont').show();
	});
	$("#update").click(function(e){
		e.preventDefault();
		if(validateAndSubmit())
			$('.updateConfirm').show();
	})
	$(".close").click(function(e){
		e.preventDefault();
		$('.updateConfirm').hide();
		$('.branchesCont').hide();
	})
	</script>
                </body>
                </html>