<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search Books</title>




</script>

<script language="javascript" >
function changeColorBlack(o)
{
   if(o.value=="Enter Book Name Here")
   o.value="";
   o.className="searchbarBlack";
}
 
function changeColorGray(o)
{
   if(o.value=='')
   {
	  o.value="Enter Book Name Here";
	  o.className="searchbarGray";
   }
   else
   {
		getlatlng(o);
	}
}
</script>

<style>

  .searchbarGray{
        border:1; width:365px; height:23px; line-height:22px; padding:0 5px 0 5px; color:#c4c4c4;font-family: Arial
   }
   .searchbarBlack{
        border:1; width:365px; height:23px; line-height:22px; padding:0 5px 0 5px; color:black;font-family: Arial
   }
   .button1{
        border:1;width:76px; height:29px;color:white; font-family: Tahoma;text-align:left;cursor:hand
   } 
</style>


</head>
<?php include 'NavigationBar.php'; ?>
<body>

<div align="center">
<form  name="form1" method="post" action="">
	<table align="center" width="500" height="38"  border="1" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#09F" class="tableBorder_gray">
	<tr>
    <td>
    <label>Search Books: </label>
     <input type="text" id="searchStr" name="bookname" value="Enter Book Name Here" style="border:1; width:350px; height:23px; line-height:22px; padding:0 5px 0 5px; color:#c4c4c4;font-family: Arial" onblur="changeColorGray(this)" onclick="changeColorBlack(this)"/>
     <input name="Submit" type="submit" class="btn_grey" value="Go!">
     </td>
  </tr>
</table>
<p>
<input id="lat" maxlength="100" name="lat" value="" type="hidden">
<input id="lng" maxlength="100" name="lng" value="" type="hidden">
</p>
</form>


<?php
	ob_start();
	if(isset($_POST['bookname']))
	{
		$bookname=$_POST['bookname'];
		
		$sql = "select * from books AS B, stores AS S where B.title like '%".$bookname."%' and B.storeID=S.storeID";
		
		$db = new DataBase();
		$db->conn();
		$k= $db->indb($sql);
		
		echo '<table align="center">';
		while($book=mysql_fetch_row($k))
		{
			$title=$book[0];
			$price=$book[5];
			$storename=$book[12];

			echo "<tr bgcolor=\"#6699FF\">
			<td>
				<div style=\"float:left\" class=\"coverphoto\">
				<img src=\"/images/bookcover.jpg\" class=\"listResultImage\" alt=\"Cover Image\"/>
				</div>
			</td>
			<td>
				<div class=\"title\">
				<label style=\"font-size:14px\">Title: $title</label>
				</div>
			</td>
			<td>
				<div class=\"storename\">
				<label style=\"font-size:14px\">Store: $storename</label>
				</div>
			</td>
			<td>
				<div class=\"price\">
				<label style=\"font-size:14px\">Price: \$$price</label>
				</div>
			</td>
			</tr>";
		}
		echo '</table>';
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




</div>


</body>
</html>