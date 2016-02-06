<?php
session_start();
if (isset($_POST['orgID'])) {


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

$myData = mysql_query("SELECT organID,name FROM `organizations` WHERE `organID`='".$_POST['orgID']."'");


 $row = mysql_fetch_array($myData);
 //echo $row;
echo "<pre>";
	//var_dump($row);
echo "</pre>";

$value9=$row['organID'];
$value10=$row['name'];

$value = $_POST['bname'];
$value2 = $_POST['cbname'];
$value3 = $_POST['phone'];
$value4 = $_POST['phone1'];
$value5 = $_POST['email'];
$value6 = $_POST['address'];
$value7 = $_POST['contact'];
$value8 = $_POST['ccontact'];

//echo "submit". $_POST['submit'];

if (isset($_POST['submit'])) {
$sql = "INSERT INTO branches (bname,cbname,organID,organName,telephoneNumber,otherPhone,emailAddress,address,contact,ccontact) VALUES ('$value','$value2','$value9','$value10','$value3',
'$value4','$value5','$value6','$value7','$value8') ";
}

/*echo "update". $_POST['update'];
if (isset($_POST['update'])) {
UPDATE branch
SET bname='bname',cbname='cbname' ,phone='phone',phone1='phone1',email='email',address='address',contact='contact',ccontact='ccontact'
WHERE bname='bname';
}*/
if(!mysql_query($sql)) {
    die('Error: ' . mysql_error());
}
else{
?>
    <html>
    <head>
        <script type="text/javascript">
            alert("Branch Created Successfully");
            window.location.href='get.php?oid=<?php echo $value9; ?>';
        </script>
    </head>
</html>
<?php
}
mysql_close();
}
?>



