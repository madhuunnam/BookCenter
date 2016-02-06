<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Security Questions</title>

<style>

   .column-middle{
        border:1px solid;border-color:#09F;width:400px
   }
   
</style>

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
    
    if($storeID==null){
        header("location:StoreLogin.php");
    }else {  
        $sql="select * from stores where storeID = '".$storeID."'";
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
      
    if($store=mysql_fetch_row($k))
	{
		$question1 = $store[22];
		$question2 = $store[24];
    }
	else
	{  
        header("location:StoreLogin.php");
    }  
?>

<div class="column-middle" style="margin:auto" align="center">
<form action="StoreSecurityQuestionchecking.php" id="login-form" method="POST" name="login_form">
    <p>
        <div>
            <label>Security Question 1: </label>
            </div>
            </p>
            <p>
            <div>
            <select id="sq-type1" name="type1">
                <option value="1" <?php if($question1==1) echo("selected");?>>What is the color of your eyes?</option>
                <option value="2" <?php if($question1==2) echo("selected");?>>What is your favorite sport?</option>
                <option value="3" <?php if($question1==3) echo("selected");?>>What is your mother's middle name?</option>
                <option value="4" <?php if($question1==4) echo("selected");?>>What was your maternal grandfather's first name?</option>
                <option value="5" <?php if($question1==5) echo("selected");?>>What is the country of your ultimate dream vacation?</option>
            </select>
        </div>
        </p>
        <p>
        <div>
              <label><span class="required">*</span>Answer: </label>
              <input id="TxtAns1" maxlength="50" name="TxtAns1" value="" type="text" onblur="checkans1()">
              <div id="divAns1" style="display:inline"></div>
              <input name="_D:TxtAns1" value=" " type="hidden">
        </div>
      </p>
      
      <p>
        <div>
            <label><span class="required">*</span>Security Question 2: </label>
            </div>
            </p>
            <p>
            <div>
            <select id="sq-type2" name="type2">
                <option value="1" <?php if($question2==1) echo("selected");?>>What is the first name of the person you first kissed?</option>
                <option value="2" <?php if($question2==2) echo("selected");?>>What is the name of the first beach you visited?</option>
                <option value="3" <?php if($question2==3) echo("selected");?>>What was the make and model of your first car?</option>
                <option value="4" <?php if($question2==4) echo("selected");?>>What was the name of your elementary school?</option>
                <option value="5" <?php if($question2==5) echo("selected");?>>What is your pet's name?</option>
            </select>
        </div>
        </p>
        <p>
        <div>
              <label>Answer: </label>
              <input id="TxtAns2" maxlength="50" name="TxtAns2" value="" type="text" onblur="checkans2()">
              <div id="divAns2" style="display:inline"></div>
              <input name="_D:TxtAns2" value=" " type="hidden">
        </div>
      </p>
      
      <p  style="margin:auto">
	<button name="store_submit" type="submit" value="Log In" class="ybtn ybtn-small"><span>Submit</span></button>
	</p>
</form>
</div>
</body>

</html>