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
            $meN $meT $meD";

	echo "<td>&nbsp;&nbsp;$bname&nbsp;&nbsp;</td>";
        echo "<td>&nbsp;&nbsp;$cbname&nbsp;&nbsp;</td>";
	
	echo "<td>&nbsp;&nbsp;$brcontact&nbsp;&nbsp;</td>";
        echo "<td>&nbsp;&nbsp;$brphone&nbsp;&nbsp;</td>";
        echo "<td>&nbsp;&nbsp;$bremail&nbsp;&nbsp;</td>";
        echo "<td>&nbsp;&nbsp;<a href='updateBranchForm.php?brid=" .$branchID. "'>Update</a></td>"; 
        echo "<td>&nbsp;&nbsp;<a href='deleteBranch.php?brid=" .$branchID. "&oid=" .$_GET['oid']. "'>Delete</a></td></tr>"; 
	}
	
        echo "</table>";
	echo "</p>";
        echo "<br><br><a href = 'updateOrganForm.php?oid=" .$_GET['oid']. "'>Back</a>"; 
} 
?>

</body>
</html>