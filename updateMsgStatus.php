<?php

$ID = $_POST['messageID'];
$status = $_POST['chosenStatus'];
//echo "- - ID = " . $ID . " - status = " .$status;
if (  isset($_POST['messageID']) && isset($_POST['chosenStatus']) ) {
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

$sql="UPDATE messages SET status= '". $_POST['chosenStatus'] . "' WHERE msgID='" .$_POST['messageID'] . "';";

echo $sql;

    if(!mysql_query($sql)) {
        die('Error: ' . mysql_error());
    }
    else { 
        
        echo "<html>  <head> 
        <script type='text/javascript'>
            alert('Message status is Updated Successfully');
            window.location.href='message.php';
        </script>
        </head> </html> ";
                            
    }
    mysql_close();
}
?>