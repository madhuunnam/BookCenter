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

table {
    border-spacing: 1em;
}
 </style>
			
            </head>
            <?php include 'NavigationBar.php'; ?>

            <body>
<?php 
if (isset($_GET['oid']))  {			
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
$username = $row['username'];
$password = $row['password'];
$website = $row['website'];
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
$worshipTime = $row['worshipTime'];
$prayerTime = $row['prayerTime'];
$bibleStudyTime = $row['bibleStudyTime'];
$sunSchoolTime = $row['sunSchoolTime'];
$meetingName = $row['meetingName'];
$meetingTime = $row['meetingTime'];
$meetingName1 = $row['meetingName1'];
$meetingTime1 = $row['meetingTime1'];

 }

?>

 
 <br><br>
 <div align="center"><h1>Update Church/Organisation Info </h1></div>
 <br><br>
<form id='insertForm' method='post' action='updateOrgan.php'  enctype="multipart/form-data">
 <table>		
        <tr>
            <th><div align ="right">Name<sup>*</sup></div></th>
            <td><input type="text" name="orgname" id="orgname" value="<?php echo htmlentities($orgname); ?>"/></td>


            <th><div align ="right">Optional Name</div></th>
                                <td><input type=text name="cname" id="cname" value="<?php echo htmlentities($cname); ?>"/></td>


            <th><div align ="right">Found Year</div></th>
            <td><input type=text name="foundYear" id="foundYear" value="<?php echo htmlentities($foundYear); ?>"/></td>
            </tr><tr>

            
            <th><div align ="right" >Type</div></th>
                    <td><select name="type" value="<?php echo htmlentities($type); ?>">
                        <option ><?php echo htmlentities($type); ?></option>
                        <option value="Church">Church</option>
                        <option value="Organization">Organization</option>
                    </select></td>

            <th><div align ="right">Keywords<sup>*<sup></div></th>
            <td><input type=text name="keywords" id="keywords" value="<?php echo htmlentities($keywords); ?>"></td>
            <th><div align ="right">Status</div></th>
            <td><input type=text name="status" id="status" value="<?php echo htmlentities($status); ?>"/></td>
        </tr><tr>


            <th><div align ="right">Logo</div></th>
            <td> <img width="150" src="" /> <input type="file" name="logo" id="logo"></td>
            <td><input type="button" value="Upload Image" name="uploadimage"></td>
        <!--<td> <input type="button" value="Upload" name="uploadBtn" id="uploadBtn" > </td>-->
        </tr><tr>


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

                       <!-- <th colspan=2> <div align ="right">State<sup>*</sup></div></th>
                            <th><div align ="right">State<sup>*</sup></div></th>
            <td><input type=text name="state" id="state" value="<?php echo htmlentities($state); ?>"></td> -->
            
            <th><div align ="right">State<sup>*</sup></div></th>
                           <td> <select id="state" name="state" tabindex="30" >
                            <option ><?php echo htmlentities($state); ?></option>
                            <option value="AL">AL - Alabama</option>
                            <option value="AK">AK - Alaska</option>
                            <option value="AZ">AZ - Arizona</option>
                            <option value="AR">AR - Arkansas</option>
                            <option value="CA">CA - California</option>
                            <option value="CO">CO - Colorado</option>
                            <option value="CT">CT - Connecticut</option>
                            <option value="DE">DE - Delaware</option>
                            <option value="DC">DC - District of Columbia</option>
                            <option value="FL">FL - Florida</option>
                            <option value="GA">GA - Georgia</option>
                            <option value="GU">GU - Guam</option>
                            <option value="HI">HI - Hawaii</option>
                            <option value="ID">ID - Idaho</option>
                            <option value="IL">IL - Illinois</option>
                            <option value="IN">IN - Indiana</option>
                            <option value="IA">IA - Iowa</option>
                            <option value="KS">KS - Kansas</option>
                            <option value="KY">KY - Kentucky</option>
                            <option value="LA">LA - Louisiana</option>
                            <option value="ME">ME - Maine</option>
                            <option value="MD">MD - Maryland</option>
                            <option value="MA">MA - Massachusetts</option>
                            <option value="MI">MI - Michigan</option>
                            <option value="MN">MN - Minnesota</option>
                            <option value="MS">MS - Mississippi</option>
                            <option value="MO">MO - Missouri</option>
                            <option value="MT">MT - Montana</option>
                            <option value="NE">NE - Nebraska</option>
                            <option value="NV">NV - Nevada</option>
                            <option value="NH">NH - New Hampshire</option>
                            <option value="NJ">NJ - New Jersey</option>
                            <option value="NM">NM - New Mexico</option>
                            <option value="NY">NY - New York</option>
                            <option value="NC">NC - North Carolina</option>
                            <option value="ND">ND - North Dakota</option>
                            <option value="OH">OH - Ohio</option>
                            <option value="OK">OK - Oklahoma</option>
                            <option value="OR">OR - Oregon</option>
                            <option value="PA">PA - Pennsylvania</option>
                            <option value="PR">PR - Puerto Rico</option>
                            <option value="RI">RI - Rhode Island</option>
                            <option value="SC">SC - South Carolina</option>
                            <option value="SD">SD - South Dakota</option>
                            <option value="TN">TN - Tennessee</option>
                            <option value="TX">TX - Texas</option>
                            <option value="UT">UT - Utah</option>
                            <option value="VT">VT - Vermont</option>
                            <option value="VA">VA - Virginia</option>
                            <option value="WA">WA - Washington</option>
                            <option value="WV">WV - West Virginia</option>
                            <option value="WI">WI - Wisconsin</option>
                            <option value="WY">WY - Wyoming</option>
                        </select></td>


            <th><div align ="right">Zip<sup>*</sup></div></th>
                                <td><input type=text name="zip" id="zip" value="<?php echo htmlentities($zip); ?>"/></td>
        </tr>

        <tr>
            <th> <div align ="right">Phone<sup>*</sup></div></th>
            <td > <input type=text name="phone" id="phone" value="<?php echo htmlentities($phone); ?>"/> </td>
            <th> <div align ="right">Other Phone </div></th>
            <td> <input type=text name="phone1" id="phone1" value="<?php echo htmlentities($phone1); ?>"/> </td>
            <th> <div align ="right">Web Site  </div></th>
            <td> <input type=text name="website" id="website" value="<?php echo htmlentities($website); ?>"/> </td>
        </tr>

        <tr>
            <th><div align ="right">Email<sup>*</sup></div></th>
            <td><input type=text name="email" id="email" value="<?php echo htmlentities($email); ?>"/></td>
            <th> <div align ="right">Username  </div></th>
            <td> <input type=text name="username" id="username" value="<?php echo htmlentities($username); ?>"/> </td>
            <th> <div align ="right">Password  </div></th>
            <td> <input type=text name="password" id="password" value="<?php echo htmlentities($password); ?>"/> </td>

        </tr><tr>
        <th><div align ="right">Number of Adults</div></th>
        <td> <input type=text name="numAdults" id="numAdults" value="<?php echo htmlentities($numAdults); ?>"/></td>

        <th><div align ="right">Number of Kids</div></th>
        <td> <input type=text name="numKids" id="numKids" value="<?php echo htmlentities($numKids); ?>"/></td>

        <th><div align ="right">Pastor</div></th>
        <td> <input type=text name="pastor" id="pastor" value="<?php echo htmlentities($pastor); ?>"/></td>

        
        </tr> <tr>
        <th><div align ="right">Contact Name</div></th>
        <td> <input type=text name="contact" id="contact" value="<?php echo htmlentities($contact); ?>"/></td>
        <th><div align ="right">Optional Contact Name</th></th>
        <td> <input type=text name="ccontact" id="ccontact" value="<?php echo htmlentities($ccontact); ?>"/></td>
        <th><div align ="right">Optional Pastor</div></th>
        <td><input type=text name="cpastor" id="cpastor" value="<?php echo htmlentities($cpastor); ?>"/></td>
        </tr>
        
        
        <tr>
        <th><div align ="right">Worship Time</div></th>
        <td><input type=text name="worshipTime" id="worshipTime" value="<?php echo htmlentities($worshipTime); ?>"/></td>
        <th><div align ="right">Prayer Time</div></th>
        <td><input type=text name="prayerTime" id="prayerTime" value="<?php echo htmlentities($prayerTime); ?>"/></td>

        <th><div align ="right">Bible Study Time</div></th>
        <td> <input type=text name="bibleStudyTime" id="bibleStudyTime" value="<?php echo htmlentities($bibleStudyTime); ?>"/></td>
        </tr><tr>


        <th><div align ="right">Sunday School Time</div></th>
        <td> <input type=text name="sunSchoolTime" id="sunSchoolTime" value="<?php echo htmlentities($sunSchoolTime); ?>"/></td>
        <th><div align ="right">Meeting Name </div></th>
        <td> <input type=text name="meetingName" id="meetingName" value="<?php echo htmlentities($meetingName); ?>"/></td>
        <th><div align ="right">Meeting Time</div></th>
        <td> <input type=text name="meetingTime" id="meetingTime" value="<?php echo htmlentities($meetingTime); ?>"/></td>
        </tr> <tr>

        <th><div align ="right">Another Meeting Name</div></th>
        <td> <input type=text name="meetingName1" id="meetingName1" value="<?php echo htmlentities($meetingName1); ?>"/></td>
        <th><div align ="right">Meeting Time</div></th>
        <td> <input type=text name="meetingTime1" id="meetingTime1" value="<?php echo htmlentities($meetingTime1); ?>"/></td>
        </tr><tr> 

        <?php echo " <td><br><br><a href='insertBranchForm.php?oid=".$row['organID']."'>Add Fellowships or Branches</a></td>&nbsp;&nbsp;&nbsp;&nbsp;";?>
        
        <?php echo "<td><br><br><a href='showBranches.php?oid=".$row['organID']."'>Update or Delete Fellowships or Branches</a></td>";?>

       <input type="hidden" name="ID" value="<?php echo $row['organID'] ?>" />
       <th><td><br><br><input type="button" name="update" id="update"  value="Update"></td></th>
       </tr>

        </table>


        <div class='updateConfirm'  style='display:none;'>
        <div class='update'> Are You sure you want to update this organization?
	<br><br>
	<input type="submit" name="submit" value="Yes" /> <br><br><br>
	<input type="button" name="close" class="close" value="close" />
	</div></div>

				
	<script>
	$("#update").click(function(e){
		e.preventDefault();
		if(validateAndSubmit())
			$('.updateConfirm').show();
	})
	$(".close").click(function(e){
		e.preventDefault();
		$('.updateConfirm').hide();
	})
	</script>
</body>
</html>