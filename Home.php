<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>

<script>
function initialize()
{
	var myCenter=new google.maps.LatLng(36.066059,-79.806840);
	var mapProp = {
	  center:myCenter,
	  zoom:15,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
	  };
	  
	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
	var marker=new google.maps.Marker({position:myCenter,});
	
	marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script language="javascript" >
function changeColorBlack(o)
{
   if(o.value=="Enter Your Address Here")
   o.value="";
   o.className="searchbarBlack";
}
 
function changeColorGray(o)
{
   if(o.value=='')
   {
	  o.value="Enter Your Address Here";
	  o.className="searchbarGray";
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

<br/>

<form  name="form1" method="post" action="">
	<table width="98%" height="38"  border="1" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#09F" class="tableBorder_gray">
	<tr>
    <td>
    <label>Search: </label>
    <select name="criterion" class="searchbox" id="criterion">
      <option value="<?php echo "t.title";?>" selected="selected">Title</option>
      <option value="<?php echo "b.author";?>">Author</option>
      <option value="<?php echo "i.ISBN";?>">ISBN</option>
      <option value="<?php echo "p.catalog";?>">Catalog</option>
     </select>
     <input name="keyword" type="text" id="keyword" size="50">
     <label>Near </label>
     <input type="text" id="searchStr" value="Enter Your Address Here" style="border:1; width:365px; height:23px; line-height:22px; padding:0 5px 0 5px; color:#c4c4c4;font-family: Arial" onblur="changeColorGray(this)" onclick="changeColorBlack(this)"/>
     <input name="Submit" type="submit" class="btn_grey" value="Go!">
     
     <td align="right">
     <?php 
	  if(isset($_SESSION['custID'])) 
	  {
		  echo '<a class="Account-link" href="GoToMyAccount.php">My Account</a>';
		  echo ' | '; 
	  	  echo '<a class="Home-link" href="Home.php">Logout</a>'; 
	  }
	  else 
	  {
	  	  echo '<a class="Login-link" href="Login.php">Login</a>'; 
		  echo ' | '; 
	  	  echo '<a class="Signup-link" href="Signup.php">Sign Up</a>'; 
	  }
	 ?>
     </td>
     </td>
  </tr>
</table>
</form>


<div id="googleMap" style="width:500px;height:380px;"></div>

</body>
</html>