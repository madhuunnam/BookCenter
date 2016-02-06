<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>StoreSecurityQuestionchecking</title>
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
    $storeID = $_SESSION['storeID'];
	$ans1 = $_POST['TxtAns1'];
	$ans2 = $_POST['TxtAns2'];
    if($ans1==null||$ans2==null){
        header("location:StoreSecurityQuestion.php");
    }else {  
        $sql="select * from stores where storeID = '".$storeID."' and questans1 = '".$ans1."' and questans2 = '".$ans2."'";
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
    $db = new DataBase();  
    $db->conn();  
    $k= $db->indb($sql);  
      
    if(mysql_fetch_row($k))
	{
		header("location:MyStoreAccount.php");
    }
	else
	{  
		if(isset($_SESSION['storeID']))
		unset($_SESSION['storeID']);
        header("location:StoreLogin.php");
    }  
?>
</body>
</html>