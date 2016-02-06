 <?php
session_start();
?>
            <html>
            <head>
			
			<!-- <script type="text/javascript" src='jquery-1.4.1.js'></script> -->
                         <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/ui-darkness/jquery-ui.min.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>


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

        function showBranch(idval) {
		$( "#"+idval ).dialog({
	      modal: true,
	      width: 470,
    	  position: { my: 'top', at: 'top+150' },
	      buttons: {
	      			"back": function() {
	      				$( this ).dialog( "close" );
	                }
	            }
	    });
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
//echo "<pre>";
	//var_dump($row);
//echo "</pre>";

$orgname = $row['name'];
$cname = $row['cname'];
$foundYear = $row['foundYear'];
$type = $row['type'];
$keywords=$row['keywords'];
//$logo=$row['logo'];
$phone = $row['telephoneNumber'];
$phone1 = $row['otherPhone'];
$email = $row['emailAddress'];
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

 }?>

 
 <br><br>
 <div align="center"><h1> <?php echo htmlentities($orgname); ?> </h1></div>
 <div align="center"><h2> <?php echo htmlentities($cname); ?> </h2></div>
 <br><br>

<h3 align = "left"> Basic Info </h3>
<hr>

<b>Address: </b><?php echo htmlentities($addrL1); ?> , <?php echo htmlentities($city); ?> ,
        <?php echo htmlentities($state); ?> ,<?php echo htmlentities($zip); ?> 
&nbsp;&nbsp;<b>Phone:</b> <?php echo htmlentities($phone); ?> , &nbsp;<b>Alternative phone: </b><?php echo htmlentities($phone1); ?> 
<br>
<b>Email: </b><?php echo htmlentities($email); ?> , &nbsp;&nbsp;
<b>Homepage:</b> <a href ="http://<?php echo htmlentities($website); ?>"> <?php echo htmlentities($website); ?> </a>, <?php echo htmlentities($type); ?>, founded in year <?php echo htmlentities($foundYear); ?>  
<br>
<b>Keywords: </b><?php echo htmlentities($keywords); ?>  &nbsp;&nbsp;
<br>
<b>Pastor: </b><?php echo htmlentities($pastor); ?> &nbsp;( <?php echo htmlentities($cpastor); ?>) , &nbsp;&nbsp;
<b>Contact: </b><?php echo htmlentities($contact); ?> &nbsp;( <?php echo htmlentities($ccontact); ?>) , &nbsp;&nbsp;
<b>Status: </b><?php echo htmlentities($status); ?> 
<br>
There are <?php echo htmlentities($numAdults); ?> adults and <?php echo htmlentities($numKids); ?> kids in a typical worship service.

<h3 align = "left"> Meeting Times </h3>
<hr>

<b>Worship Time: </b><?php echo htmlentities($worshipTime); ?> , &nbsp;&nbsp; <b>Sunday School: </b><?php echo htmlentities($sunSchoolTime); ?> 
<br>
<b>Bible Study Time: </b><?php echo htmlentities($bibleStudyTime); ?> , &nbsp;&nbsp; <b>Prayer Time: </b><?php echo htmlentities($prayerTime); ?> 
<br>
<b><?php echo htmlentities($meetingName); ?></b> &nbsp;&nbsp; <?php echo htmlentities($meetingTime); ?>
<br>
<b><?php echo htmlentities($meetingName1); ?></b> &nbsp;&nbsp; <?php echo htmlentities($meetingTime1); ?>
<br><br>

<h3 align = "left"> Fellowships/Branches </h3>
<hr>

<?php


   $query = "SELECT * FROM `branches` WHERE `organID`='".$_GET['oid']."'"; 
    //var_dump($query);

    $result=mysql_query($query);  
    //var_dump($result);	
    echo "<p align = 'center'>";
	echo "<table style='border: solid 1px black;'>";
    echo "<tr><th>BranchID</th> <th>Branch Name</th> <th>Alt Name</th> <th>Contact</th> <th>Phone</th> <th>Email</th> </tr>";
  	while($row1 = mysql_fetch_array($result)) {
	//var_dump($row);
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
	
        Echo "<tr><td><a href=# onclick='showBranch(" .$branchID .");'>" .$branchID. "</a></td>";   
        echo "<div id='$branchID' style='display: none;'> <h4>Branch Info</h4>
            Contact Other Name: $brccontact <br>
            Other Phone: $bro <br>
            Branch Description: $brdesc <br>
            Branch Address: $bra <br>
            Branch inserted on: $insD <br>
            $meN $meT $meD


        ";
	// echo "<td><a href=#  onclick=document.myform.formVar.value=$name; document.myform.submit(); return false>name</a></td>";
	echo "<td>&nbsp;&nbsp;$bname&nbsp;&nbsp;</td>";
        echo "<td>&nbsp;&nbsp;$cbname&nbsp;&nbsp;</td>";
	
	echo "<td>&nbsp;&nbsp;$brcontact&nbsp;&nbsp;</td>";
        echo "<td>&nbsp;&nbsp;$brphone&nbsp;&nbsp;</td>";
        echo "<td>&nbsp;&nbsp;$bremail&nbsp;&nbsp;</td></tr>";
	}
	echo "</table>";
	echo "</p>";


?>


<br><br><br>
<a class="showbranches" href="updateOrganForm.php?oid=<?php echo $row['organID'] ?>">Update 

</body>
</html>