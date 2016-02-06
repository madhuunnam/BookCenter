<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>storeloginchecking</title>
</head>

<body>
<?php  
    ob_start();  
    $username = $_POST['username'];  
    $passwords = $_POST['password'];
	//$ans1 = $_POST['TxtAns1'];
	//$ans2 = $_POST['TxtAns2'];
    if($username==null||$passwords==null){
        header("location:StoreLogin.php");
        echo "Please fill name and password fields.";  
    }else {  
        $sql="select * from stores where storeID = '".$username."' and password = '".$passwords."'";
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
		$_SESSION['storeID']=$_POST['username'];
        $kiss=mysql_fetch_array(mysql_query($sql));  
        $sss=$kiss["username"];  
        $ss="location:localhost/Payment.php?kk=".$sss;
        //header($ss);
		header("location:StoreSecurityQuestions.php");
    }
	else
	{  
        header("location:StoreLogin.php");
    }  
?>
</body>
</html>