 <?php
session_start();
?>
<html>
<head>

<!-- <script type="text/javascript" src='jquery-1.4.1.js'></script> -->
 <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/ui-darkness/jquery-ui.min.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>


	
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
if (isset($_GET['mid'])) 
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
        $myData = mysql_query("SELECT * FROM `messages` WHERE `msgID`='".$_GET['mid']."'");
        $row = mysql_fetch_array($myData);

        $msgID = $row['msgID'];
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $msgTime = $row['msgTime']; 
        $subject = $row['subject']; 
        $msgText = $row['msgText']; 
        $replyTime = $row['replyTime'];
        $replyText = $row['replyText']; 
        $replied = $row['replied'];
        $status = $row['status'];

 }?>

 
 <br><br>
 <div align="center"><h1> Subject: <?php echo htmlentities($subject); ?> </h1></div>
 <br><br>

<hr>
<div style = "text-align:left; line-height: 200%">
<b>msgID: </b><?php echo htmlentities($msgID); ?> <br>
<b>name: </b><?php echo htmlentities($name); ?> <br>
<b>email: </b><?php echo htmlentities($email); ?> <br>
<b>phone: </b><?php echo htmlentities($phone); ?> <br>
<b>msgTime: </b><?php echo htmlentities($msgTime); ?> <br>
<b>msgText: </b><?php echo htmlentities($msgText); ?> <br>
<b>replyTime: </b><?php echo htmlentities($replyTime); ?> <br>
<b>replyText: </b><?php echo htmlentities($replyText); ?> <br>
<b>replied: </b><?php echo htmlentities($replied); ?> <br>
<b>status: </b><?php echo htmlentities($status); ?> <br>
</div>

<hr> 
<br>

<form id='updateMsg' method='post' action="updateMsg.php"  enctype="multipart/form-data">
        
        <h2> Reply Message: </h2><br>
        <textarea name="replyText" rows="10" cols="60" > <?php echo htmlentities($replyText); ?> </textarea><br>

        <br>
        Change Message Status:
        <select name='status'>
                <option value='None'>Select...</option>
                <option value='Unread'>Unread</option>
                <option value='Read'>Read</option>
                <option value='Del'>Del</option>
                <option value='Ok'>Ok</option>
        </select>

        <input type='hidden' name='msgID' value="<?php echo htmlentities($msgID); ?>"/>
        <input type='hidden' name='email' value="<?php echo htmlentities($email); ?>"/>


        <br><br><input type="submit" name="Update"  value="Update"/></td>
        <br><br><br><input type="submit" name="Delete"  value="Delete"/>
</form>



</body>
</html>