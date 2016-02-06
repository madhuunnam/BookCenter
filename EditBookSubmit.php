<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UpdateBook</title>
</head>

<body>

<?php 
if(!isset($_SESSION['storeID']))
{
	header("location:StoreLogin.php");
}
?>

<?php  
    ob_start(); 
	
	$storeID = $_SESSION['storeID'];
	$title = "";
	$author = "";
	$category = "";
	$isbn = "";
	$publisher = "";
	$year = "";
	$number = "";
	$price = "";
	$status = "";
	$coverphoto = "";
	
	$messages = "";
	
	if(isset($_POST['title']))
	{
		$title = $_POST['title'];
	}
	if(isset($_POST['author']))
	{
		$author = $_POST['author'];
	}
	if(isset($_POST['category']))
	{
		$category = $_POST['category'];
	}
	if(isset($_POST['isbn']))
	{
		$isbn = $_POST['isbn'];
	}
	if(isset($_POST['publisher']))
	{
		$publisher = $_POST['publisher'];
	}
	if(isset($_POST['year']))
	{
		$year = $_POST['year'];
	}
	if(isset($_POST['number']))
	{
		$number = $_POST['number'];
	}
	if(isset($_POST['status']))
	{
		$status = $_POST['status'];
	}
	if(isset($_POST['coverphoto']))
	{
		$coverphoto = $_POST['coverphoto'];
	}
	if(isset($_POST['price']))
	{
		$price = $_POST['price'];
	}
	
	if($storeID==null||$isbn==null)
	{
        header("location:storelogin.php");
    }
	else 
	{  
		$checkingduplicate = "select * from books where storeID='".$storeID."' and isbn='".$isbn."'";
		$sql="UPDATE `books` SET `title`='".$title."',`author`='".$author."',`category`='".$category."',`price`='".$price."',`publisher`='".$publisher."',`year`='".$year."',`booknumber`='".$number."',`status`='".$status."',`logo`='".$coverphoto."' WHERE storeID='".$storeID."' and isbn='".$isbn."'";
		
		$db = new DataBase();
		$db->conn();
		$k= $db->indb($checkingduplicate);
		  
		if(mysql_fetch_row($k))
		{
			$db->indb($sql);
			$messages = "Update book successfully.";
			header("location:StoreViewAllBooks.php");
		}
		else
		{  
			$messages = "Book not found.";
			header("location:StoreViewAllBooks.php");
		}  
	}
	 
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

</body>
</html>