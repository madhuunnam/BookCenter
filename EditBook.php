<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Book</title>
</head>

<?php 
if(!isset($_SESSION['storeID']))
{
	header("location:StoreLogin.php");
}
?>

<?php include 'NavigationBar.php'; ?>



<body>

<?php

	ob_start(); 
		
	if(!isset($_SESSION['storeID']))
	{
		header("location:StoreLogin.php");
	}

	$storeID=$_GET['store'];
	$isbn=$_GET['isbn'];

	$sql="SELECT * FROM `books` WHERE storeID='".$storeID."' and isbn='".$isbn."'";

	$db = new DataBase();
	$db->conn();
	$k= $db->indb($sql);
	  
	if($book=mysql_fetch_row($k))
	{
		$title = $book[0];
		$author = $book[3];
		$category = $book[4];
		$isbn = $book[1];
		$publisher = $book[6];
		$year = $book[7];
		$number = $book[8];
		$price = $book[5];
		$status = $book[9];
		$coverphoto = $book[10];
	}
	else
	{  
		header("location:StoreViewAllBooks.php");
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




<div class="container" id="insertbook" style="margin:auto;border:1px solid;border-color:#09F;width:400px" align="center">

<form id="edit_book_form" name="edit_book_form" action="EditBookSubmit.php" method="POST">

<p>
  <div>
      <label>Title: </label>
      <input id="cc-title" name="title" type="text" maxlength="50" autocomplete="off" value="<?php echo $title;?>" />
  </div>
</p>

<p>
  <div>
      <label>Author: </label>
      <input id="cc-author" name="author" type="text" maxlength="50" autocomplete="off" value="<?php echo $author;?>" />
  </div>
</p>

<p>
  <div>
      <label>Category: </label>
      <select id="cc-category" name="category">
          <option value="Biology">Biology</option>
          <option value="Computer">Computer</option>
          <option value="Mathematics">Mathematics</option>
      </select>
  </div>
</p>

<p>
  <div>
      <label>ISBN: </label>
      <input id="cc-isbn" name="isbn" type="text" readonly="true" maxlength="50" autocomplete="off" value="<?php echo $isbn;?>" />
  </div>
</p>

<p>
  <div>
      <label>Publisher: </label>
      <input id="cc-publisher" name="publisher" type="text" maxlength="50" autocomplete="off" value="<?php echo $publisher;?>" />
  </div>
</p>

<p>
  <div>
      <label>Publish Year: </label>
      <input id="cc-year" name="year" type="text" maxlength="50" autocomplete="off" value="<?php echo $year;?>" />
  </div>
</p>

<p>
  <div>
      <label>Price: </label>
      <input id="cc-price" name="price" type="text" maxlength="50" autocomplete="off" value="<?php echo $price;?>" />
  </div>
</p>

<p>
  <div>
      <label>Book Number: </label>
      <input id="cc-number" name="number" type="text" maxlength="50" autocomplete="off" value="<?php echo $number;?>" />
  </div>
</p>

<p>
  <div>
      <label>Status: </label>
      <select id="cc-status" name="status">
          <option value="Available">Available</option>
          <option value="Bought">Bought</option>
          <option value="Sold">Sold</option>
          <option value="Rent">Rent</option>
          <option value="Lent">Lent</option>
          <option value="Unavailable">Unavailable</option>
      </select>
  </div>
</p>

<p>
	<div>
    <label>Cover Photo: </label>
    <input type="file" id="cc-photo" name="coverphoto" input enctype="multipart/form-data" maxlength="50" value="<?php echo $coverphoto;?>"/>
    </div>
</p>

<p style="margin:auto">
    <button name="store_submit" type="submit" value="Update" class="ybtn ybtn-small"><span>Update</span></button>
</p>
</form>
</div>


</body>
</html>