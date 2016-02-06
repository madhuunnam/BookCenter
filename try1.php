<?php
session_start();
?>

            <html>
            <head>
            <script type="text/javascript" src='jquery-1.4.1.js'></script>
	        <script type="text/javascript">
			
			    function validateAndSubmit() {
			
					if ($('#orgname').val() == "") {
						alert("Please enter a organisation name");
						return
					}
					
					if ($('#keywords').val() == "") {
						alert("Please enter a keywords");
						return
					}
					
					if ($('#addrL1').val() == "") {
						alert("Please enter address");
						return
					}
					
					if ($('#city').val() == "") {
						alert("Please enter a city");
						return
					}
					if ($('#state').val() == "") {
						alert("Please enter a state");
						return
					}
					if ($('#zip').val() == "") {
						alert("Please enter a zipcode");
						return
					}
					if ($('#phone').val() == "") {
						alert("Please enter a phone");
						return
					}
					if ($('#email').val() == "") {
						alert("Please enter a email");
						return
					}
					if ($('#username').val() == "") {
						alert("Please enter a username");
						return
					}
					if ($('#password').val() == "") {
						alert("Please enter a password");
						return
					}
					
					
		            $('#insertForm').submit();

				}
			</script>
 <style>
 .branchcont{
 position:fixed;
 top:0;
 left:0;
 width:100%;
 height:100%;
 background:rgba(0,0,0,0.5)
 }
 .branches{
 background:#fff;
 box-shadow:0 0 5px 0 #ddd;
 position:relative;
 top:150px;
 min-height:200px;
 padding:20px;
 width:300px;
margin:0 auto;
 }
 </style>
</head>
<?php include 'NavigationBar.php'; ?>
            <body><?php 
					
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
if (isset($_GET['oid'])) 
			{	
$myData = mysql_query("SELECT * FROM `organisation` WHERE `ID`='".$_GET['oid']."'");
 
    $row = mysql_fetch_array($myData);
echo "<pre>";
//	var_dump($row);
echo "</pre>";

 $orgname = $row['orgname'];
}


if (isset($_GET['delid']))
{
$query1 = mysql_query("Delete from `branch` where `branchID`='".$_GET['delid']."'");
}
?>  
<br><br>
<div align="center"><h1>Insert Organization to Directory </h1></div>
<div align="right"><a href="homepage.php">Back</a></div>
<br><br>




      
	    <form id='insertForm' method='post' action='demo.php'  enctype="multipart/form-data">
        
            
            <table>
			
			    <tr>
                    <th><div align ="right">Name<sup>*</sup></div></th>
                    <td><input type=text name="orgname" id="orgname" /></td>
				  
					
                    <th><div align ="right">Optional Name</th></th>
					<td><input type=text id="cname" name="cname"/></td>
					
                    <th><div align ="right">Found Year</div></th>
                    <td><input type=text id="foundYear" name="foundYear"/></td>
					
					<th><div align ="right">Type</div></th>
                    <td><select name="type">
                    <option value="">Select...</option>
                    <option value="Church">Church</option>
                    <option value="Organisation">Organisation</option>
                    </select></td>
					</tr>
					
					<tr>
					<th><div align ="right">Keywords<sup>*<sup></div></th>
                    <td><input type="int" name="keywords"></td>
				
				
				
				<th><div align ="right">Logo</div></th>
               
               <td> <input type="file" name="logo" id="logo"></td>
			   <td></td>
               <td><input type="button" value="Upload Image" name="uploadimage"></td>
                </tr>		
	             
				 
				<tr>
                <th><div align ="right">Address Line 1<sup>*</sup></div></th>
                <td colspan="2"><input type=text id="addrL1" name="addrL1" size=30/></td>
                </tr>
				
                <tr>
				<th><div align ="right">Address Line 2</div></th>
                <td colspan="2"><input type=text id="addrL2" name="addrL2" size=30/></td>
                </tr>
				
				
                <tr>
		        <th><div align ="right">City<sup>*</sup></div></th>
                <td > <input type=text id="city" name="city" /> </td>
                    
			    <!--<th colspan=2><div align ="right">State<sup>*</sup></div>-->
				<th><div align ="right">State<sup>*</sup></div></th>
                           <td> <select id="state" name="state" tabindex="30" >
                            <option value="">Select</option>
                            <option value="AL">AL - Alabama</option>
                            <option value="AK">AK - Alaska</option>
                            <option value="AS">AS - American Samoa</option>
                            <option value="AZ">AZ - Arizona</option>
                            <option value="AR">AR - Arkansas</option>
                            <option value="CA">CA - California</option>
                            <option value="CO">CO - Colorado</option>
                            <option value="CT">CT - Connecticut</option>
                            <option value="DE">DE - Delaware</option>
                            <option value="DC">DC - District of Columbia</option>
                            <option value="FM">FM - Federated States of Micronesia</option>
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
                            <option value="MH">MH - Marshall Islands</option>
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
                            <option value="MP">MP - Northern Mariana Islands</option>
                            <option value="OH">OH - Ohio</option>
                            <option value="OK">OK - Oklahoma</option>
                            <option value="OR">OR - Oregon</option>
                            <option value="PW">PW - Palau</option>
                            <option value="PA">PA - Pennsylvania</option>
                            <option value="PR">PR - Puerto Rico</option>
                            <option value="RI">RI - Rhode Island</option>
                            <option value="SC">SC - South Carolina</option>
                            <option value="SD">SD - South Dakota</option>
                            <option value="TN">TN - Tennessee</option>
                            <option value="TX">TX - Texas</option>
                            <option value="UT">UT - Utah</option>
                            <option value="VT">VT - Vermont</option>
                            <option value="VI">VI - Virgin Islands</option>
                            <option value="VA">VA - Virginia</option>
                            <option value="WA">WA - Washington</option>
                            <option value="WV">WV - West Virginia</option>
                            <option value="WI">WI - Wisconsin</option>
                            <option value="WY">WY - Wyoming</option>
                        </select></td>
                    
					
                    <th><div align ="right">Zip<sup>*</sup></div></th>
					<td><input type=text id="zip" name="zip" size=5/></td>
                </tr>
				
				<tr>
                    <th><div align ="right"> Phone<sup>*</sup></div></th>
                    <td > <input type=text id="phone" name="phone" /> </td>
                    <th><div align ="right"> Other Phone</div> </th>
                    <td> <input type=text id="phone1" name="phone1"/> </td>
                </tr>
				
		        <tr>
                    <th><div align ="right">Email<sup>*</sup></div></th>
                    <td><input type=text id="email" name="email"/></td>
					<th><div align ="right">Username<sup>*</sup></div></th>
                    <td><input type=text id="username" name="username"/></td>
					<th><div align ="right">Password<sup>*</sup></div></th>
                    <td> <input type=password id="passwd" name="passwd"/> </td>
                </tr>
                 
				 
				<tr>
                <th><div align ="right">Number of Adults</div></th>
                <td> <input type="int" id="numAdults" name="numAdults"/></td>

                <th><div align ="right">Number of Kids</div></th>
                <td> <input type="int" id="numKids" name="numKids"/></td>

                <th><div align ="right">Pastor</div></th>
                <td> <input type="text" id="pastor" name="pastor"/></td>

                <th><div align ="right">Optional Pastor</div></th>
                <td><input type="text" id="cpastor" name="cpastor"/></td>
                </tr>  

                <tr>
                <th><div align ="right">Contact Name</div></th>
                <td> <input type="text" id="contact" name="contact"/></td>
                <th><div align ="right">Optional Contact Name</div></th>
                <td> <input type="text" id="ccontact" name="ccontact"/></td>
                </tr>
				
				<tr>
                <th><div align ="right">Status</div></th>
                <td><input type="text" id="status" name="status"/></td>
                </tr>
				
                <tr>
                <th><div align ="right">Workship Time</div></th>
                <td><input type="time" id="workshipTime" name="workshipTime"/></td>
                </tr>

                <tr>
                <th><div align ="right">Prayer Time</div></th>
                <td><input type="time" id="prayerTime" name="prayerTime"/></td>

                <th><div align ="right">Bible Study Time</div></th>
                <td> <input type="time" id="bibleStudyTime" name="bibleStudyTime"/></td>
                </tr>
				<tr>
			<th> </th>
			<td></td>
			<td> <br><br><br><input type="button" name="signUp" id="signUp" onclick="javascript:validateAndSubmit();" value="Insert" /></td>
			<!--<td> <br><br><input type="button" name="update" id="update" value="Update"/></td>-->
			<!--<td> <br><br><input type="button" name="update" id="update" onclick="javascript:validateAndSubmit();" value="Update"></td> -->
			<td></td>
			<td> <br><br><br><input type="reset" name="done" id="done" value="Done"></td>
			
			
			
			</tr>
			
			<!--<form method='post' action='branchnew.php' onclick="#enctype="multipart/form-data">-->
			<!--<td><input type="button" name="addBranches" id="addBranches" value="Add Branches"/></td>-->
			<!--<td><a href='http://localhost/branchnew.php'/>Add Branches</td>-->
            </form>
			
			
		  <!--  <td><input type="button" name="showBranches" id="showBranches" value="Show Branches"></td></tr>-->
			
			
		</tr>
				
            </table>
           
        
		<div class='branchcont'  style='display:none;'>
		<div class='branches'>
       <?php

$query1 = "SELECT branchID,bname FROM branch";
    //echo $query1;
    $result=mysql_query($query1); 
 while($row = mysql_fetch_array($result))	{   
    $bname = $row['bname'];
	
	
	echo $bname." <a href='?delid=".$row['branchID']."'>delete</a><br>";
	}	   ?>
	<input type="button" name="close" id="close" value="close"></div></div>
	<script type="text/javascript">
	
		$(document).ready(function() {
			$("#showBranches").click( function(e){
				e.preventDefault();
				$('.branchcont').show();
			});

			$("#close").click(function(e){
				e.preventDefault();
				$('.branchcont').hide();
			});
		
			url = window.location.href;
			if (url.indexOf["?"]) {
				if(url.split("?")[1].indexOf("delid") > -1)
				$('.branchcont').show();
			}
			
	
		});
		
	</script>
    </body>
	</form>
	
</html>