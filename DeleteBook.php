<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete Book</title>
</head>

<?php 
if(!isset($_SESSION['storeID']))
{
	header("location:StoreLogin.php");
}
?>


<body>

<?php

	ob_start(); 
		
	if(!isset($_SESSION['storeID']))
	{
		header("location:StoreLogin.php");
	}

	$storeID=$_GET['store'];
	$isbn=$_GET['isbn'];

	$sql="DELETE FROM `books` WHERE storeID='".$storeID."' and isbn='".$isbn."'";

	$db = new DataBase();
	$db->conn();
	$k= $db->indb($sql);

	header("location:StoreViewAllBooks.php");
	 
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