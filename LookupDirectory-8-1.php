<?php
session_start();
?>
<html>
<body>

<form action='LookupDirectory.php'  method='post'>



<?php

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


function query(){
    $myData = mysql_query("select organID, name from organizations");
    while($record = mysql_fetch_array($myData))
    {
    echo '<option value="' . $record['organID'] . '">' . $record['name'] . '</option>';
    }

}

function queryst(){
    $myDatast=mysql_query("select distinct state from organizations");

    while($recordst = mysql_fetch_array($myDatast))
    {
        echo '<option value="' . $recordst['state'] . '">' . $recordst['state'] . '</option>';
    }
}


function queryty(){
$myDataty=mysql_query("select distinct type from organizations");

while($recordty = mysql_fetch_array($myDataty))
{
echo '<option value="' . $recordty['type'] . '">' . $recordty['type'] . '</option>';
}
}
?>

<html>
<head>
<title>Look Up Organizations</title>
</head>
<?php include 'NavigationBar.php'; ?>
<br><br>

<div align="center">

<a href="try1.php">Add New Organizations to Directory</a>
<br> <br>
<h1>Lookup for  Directory</h1>

<!--<th>Search By</th>
<select name ="name">
<?php// query() ?>
</select>-->

<br><br>
<th>Search By</th>
<select name="searchtype">
    <option>Organizations Name</option>
    <option>Optional Organizations Name</option>
    <option>Pastor Name</option>
    <option>Optional Pastor Name</option>
</select>


<input type="text" name="oid" value="">
<br><br>
<th>Limit to State</th>
<select name ="state">
<?php queryst() ?>
</select>

<th>And City</th>
<input type="text" name="city" value="">
<br><br>
<th>Type</th>
<select name ="type">
<?php queryty() ?>
</select>
<br><br>

<input type="submit" name="Go"  value="Search"></div>
<br>
<hr></hr>
<?php
if (isset($_POST['Go'])) 
{ 
    
    $searchtype = $_POST['searchtype'];
	$search=$_POST['oid'];
	$state = $_POST['state'];
	$city=$_POST['city'];
	$type=$_POST['type'];
	
		if ($searchtype=="Organizations Name")
		{
			$query1 = "SELECT * FROM organizations WHERE name like '%".$search."%' and state='".$state."' and city like '%".$city."%' and type='".$type."'";
		}
		else if($searchtype=="Optional Organizations Name")
		{
			$query1 = "SELECT * FROM organizations WHERE cname='".$search."'";
		}
		else if($searchtype=="Pastor Name")
		{
			$query1 = "SELECT * FROM organizations WHERE pastor='".$search."'";
		}
		else if($searchtype=="Optional Pastor Name")
		{
			$query1 = "SELECT * FROM organizations WHERE cpastor='".$search."'";
		}

    //First query
    //$query1 = "SELECT * FROM `organizations` WHERE `name`='".$name."' or `state`='".$state."' or `city`='".$city."' or `type`='".$type."'";
	//var_dump($query1);

    $result=mysql_query($query1);  
    //var_dump($result);	
    echo "<p align = 'center'>";
	echo "<table style='border: solid 1px black;'>";
    echo "<tr><th>name</th><th>Phone</th><th>Pastor</th><th>Address</th></tr>";
  	while($row = mysql_fetch_array($result)) {
	//var_dump($row);
    $name = $row['name'];
	$phone = $row['telephoneNumber'];
	$pastor=$row['pastor'];
	$addrL1=$row['addrStNum'];
	
    Echo "<td><a href='get.php?oid=".$row['organID']."'>$name</a></td>";   
	// echo "<td><a href=#  onclick=document.myform.formVar.value=$name; document.myform.submit(); return false>name</a></td>";
	
	echo "<td>$phone</td>";
	echo "<td>$pastor</td>";
	echo "<td>$addrL1</td></tr>";
	}
	echo "</table>";
	echo "</p>";
}
?>

<!--<form method=post name='LookupDirectory.php' action='demo-formchanged.php'>

	<input type="hidden" name="formVar" value="">
	<input type="submit" value="Send form!">
</form>-->

</body>
</html>
</form>
