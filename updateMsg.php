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

if( isset($_POST['Update'])) {

    $status = ($_POST['status'] == "None") ? "Read" : $_POST['status'];
    $sql="UPDATE messages SET status= '". $status . 
        "', replyTime = now(),  replyText = '". $_POST['replyText'] . "', replied = '1'  WHERE msgID='" .$_POST['msgID'] ."';";
}

else if ( isset($_POST['Delete'])) {

    $sql="DELETE FROM messages WHERE msgID='" .$_POST['msgID'] . "';";
    
}

//echo $sql;
if(!mysql_query($sql)) {
        die('Error: ' . mysql_error());
    }
    else { 
        
        echo "<html>  <head> 
        <script type='text/javascript'>
            //alert('Message is Updated Successfully');
            window.location.href='searchMessage.php';
        </script>
        </head> </html> ";
                            
    }

mysql_close();

?>