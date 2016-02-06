<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Payment</title>



<script language="javascript" type="text/javascript">

function buttononclick(obj) 
{
	var custID = obj.value;
	var cardnumber = obj.name;
	window.location.href="EditCard.php?customer=" + custID + "&cardnumber=" + cardnumber;
}

function buttononclickdelete(obj) 
{
	var custID = obj.value;
	var cardnumber = obj.name;
	window.location.href="DeleteCard.php?customer=" + custID + "&cardnumber=" + cardnumber;
}


</script>



</head>



<?php 
if(!isset($_SESSION['custID']))
{
	header("location:Login.php");
}
?>

<?php include 'NavigationBar.php'; ?>


<body>
<div align="center">
<?php  
    ob_start(); 
	
	$custID = $_SESSION['custID'];
	
	$allcards = "select * from creditcards where custID='".$custID."'";
	
	$db = new DataBase();
	$db->conn();
	$k= $db->indb($allcards);
	
	
	
	echo '<table align="center">';
	while($book=mysql_fetch_row($k))
	{
		$cardnumber=$book[1];
		$name = $book[2];

		
		echo "<tr bgcolor=\"#6699FF\">
		<td width=\"150px\">
			<div align=\"center\" class=\"coverphoto\">
			<label style=\"font-size:14px;text-align:center\">$cardnumber</label>
			</div>
		</td>
		<td width=\"150px\">
			<div align=\"center\" class=\"coverphoto\">
			<label style=\"font-size:14px;text-align:center\">$name</label>
			</div>
		</td>
		<td>
			<table>
			<td>
			<div class=\"addtocart\">
			<button type=\"button\" value=\"$custID\" name=\"$cardnumber\" onclick=\"buttononclick(this)\">Edit Card</button>
			</div>
			</td>
			
			<td>
			<div class=\"addtocart\">
			<button type=\"button\" value=\"$custID\" name=\"$cardnumber\" onclick=\"buttononclickdelete(this)\">Delete Card</button>
			</div>
			</td>
			</table>
		</td>
		</tr>";
	}
	echo '</table>';
	
	
	
	
	class DataBase{  
        public $dbhost = "localhost";
        public $dbuser = "webclient";  
        public $dbpass = "12345678";  
        public $dbname = "bookstore";  
        function conn(){
            $dbconn = mysql_connect($this->dbhost,$this->dbuser,$this->dbpass) or die("database error!".mysql_error());  
            mysql_select_db($this->dbname) or die("can not connect database：".mysql_error());  
            return $dbconn;  
        }  
        function indb($in_sql){
            $result_indb = mysql_query($in_sql) or die("can not run the sql language:".mysql_error());  
            return $result_indb;  
        }  
    }  
	
	
	
?>



</div>
</body>
</html>