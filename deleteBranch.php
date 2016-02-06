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


$sql="DELETE FROM branches WHERE branchID='".$_GET['brid']."'";
$brid = $_GET['brid'];
//echo $sql;

    if(!mysql_query($sql)) {
        die('Error: ' . mysql_error());
    }
    else { 
        
        echo "<html>  <head> 
        <script type='text/javascript'>
            alert('Branch is Deleted Successfully');
            window.location.href='showBranches.php?oid=" .$_GET['oid'] . "'; </script>   </head> </html> ";
                            
    }
    mysql_close($link);
}
?>



