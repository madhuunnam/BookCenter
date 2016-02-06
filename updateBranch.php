<?php
session_start();
if (isset($_GET['brid'])) {

//echo "started---------------<br> use _GET instead of _POST";
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

$value9=$_POST['orgID'];
$value10=$_POST['orgName'];
$value11=$_POST['description'];
$value12=$_POST['meetingName'];
$value13=$_POST['meetingTime'];
$value14=$_POST['meetingDesc'];

$value = $_POST['bname'];
$value2 = $_POST['cbname'];
$value3 = $_POST['phone'];
$value4 = $_POST['phone1'];
$value5 = $_POST['email'];
$value6 = $_POST['address'];
$value7 = $_POST['contact'];
$value8 = $_POST['ccontact'];


$sql="UPDATE branches
SET bname='$value',cbname='$value2' ,description='$value11',telephoneNumber='$value3',otherPhone='$value4',
emailAddress='$value5',contact='$value7',ccontact='$value8', address='$value6',
meetingName = '$value12', meetingTime='$value13', meetingDesc = '$value14'
WHERE branchID='".$_GET['brid']."'";
//echo $sql;

    if(!mysql_query($sql)) {
        die('Error: ' . mysql_error());
    }
    else { 
        
        echo "<html>  <head> 
        <script type='text/javascript'>
            alert('Branch Updated Successfully');
            window.location.href='showBranches.php?oid=$value9';
        </script>
        </head> </html> ";
                            
    }
    mysql_close();
}
?>



