<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AllBooks</title>


<script language="javascript" type="text/javascript">

function buttononclick(obj) 
{
	var storeID = obj.value;
	var isbn = obj.name;
	window.location.href="EditBook.php?store=" + storeID + "&isbn=" + isbn;
}

function buttononclickdelete(obj) 
{
	var storeID = obj.value;
	var isbn = obj.name;
	window.location.href="DeleteBook.php?store=" + storeID + "&isbn=" + isbn;
}


</script>



</head>


<?php 
if(!isset($_SESSION['storeID']))
{
	header("location:StoreLogin.php");
}
?>

<?php include 'NavigationBar.php'; ?>


<body>
<div align="center">
<?php  
    ob_start(); 
	
	$storeID = $_SESSION['storeID'];
	
	$allbooks = "select * from books where storeID='".$storeID."'";
	
	$db = new DataBase();
	$db->conn();
	$k= $db->indb($allbooks);
	
	
	
	echo '<table align="center">';
	while($book=mysql_fetch_row($k))
	{
		$title=$book[0];
		$author = $book[3];
		$publisher = $book[6];
		$year = $book[7];
		$status = $book[9];
		$isbn = $book[1];
		
		echo "<tr bgcolor=\"#6699FF\">
		<td>
			<div style=\"float:left\" class=\"coverphoto\">
			<img src=\"/images/bookcover.jpg\" class=\"listResultImage\" alt=\"Cover Image\"/>
			</div>
		</td>
		<td>
			<table>
			<tr valign=\"top\">
			<p>
			<div>
			<div class=\"title\">
			<label style=\"font-size:14px\">$title</label>
			</div>
			<div class=\"author\">
			<label style=\"font-size:12px\">by $author, Published $year</label>
			</div>
			</div>
			</p>
			</tr>
			
			<tr valign=\"bottom\">
			<p>
			<div>
			<div class=\"title\">
			<label style=\"font-size:14px\">$publisher</label>
			</div>
			<div class=\"author\">
			<label style=\"font-size:12px\">$status</label>
			</div>
			</div>
			</p>
			</tr>
			</table>
		</td>
		<td>
			<table>
			<tr valign=\"top\">
			<div class=\"addtocart\">
			<button type=\"button\" value=\"$storeID\" name=\"$isbn\" onclick=\"buttononclick(this)\">Edit Book</button>
			</div>
			</tr>
			
			<tr valign=\"bottom\">
			<div class=\"addtocart\">
			<button type=\"button\" value=\"$storeID\" name=\"$isbn\" onclick=\"buttononclickdelete(this)\">Delete Book</button>
			</div>
			</tr>
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