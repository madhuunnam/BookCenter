<?php
session_start();
?>
<html>
<head>
<title>loginchecking</title>
<script type="text/javascript" src='jquery-1.4.1.js'></script>
<script type="text/javascript">
    
        <?php  
            ob_start();  
            $username = $_POST['username'];  
            $passwords = $_POST['password'];  
            if($username==null||$passwords==null){
                header("location:Login.php");
                echo "Please fill name and password fields.";  
            }else {  
                $sql="select * from customers where custID = '".$username."' and password = '".$passwords."'";
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
                $_SESSION['custID']=$_POST['username'];
                $kiss=mysql_fetch_array(mysql_query($sql));  
                $sss=$kiss["username"];  
                $ss="Location:localhost/Payment.php?kk=".$sss;
                //header($ss);
                header("Location:MyAccount.php");
                echo "alert('Login Successful');";
                echo 'window.location.href = "MyAccount.php";';
                // exit;
            }
            else
            {  
                header("Location:Login.php");
                echo "alert('Please Login');";
                echo 'window.location.href = "login.php";';
                
                // exit;
            }  
        ?>
    
</script>
</head>


<body>
</body>
</html>