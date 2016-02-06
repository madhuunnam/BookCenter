<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nearby Book Store</title>


<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

<script>
var markers=[];
function createMarker(strs) {
  //var html = "<b>" + name + "</b> <br/>";
  markers=[];
  var myCenter=new google.maps.LatLng(strs[0].lat,strs[0].lng);
  
  var mapProp = {
	  center:myCenter,
	  zoom:15,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
	  };
	  
	  
	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
	
	for (var i = 0; i < strs.length; i++) 
	  {
		  var positions=new google.maps.LatLng(strs[i].lat,strs[i].lng);
		var marker=new google.maps.Marker({position:positions, map:map,});
		markers.push(marker);
		//marker.setMap(map);
	  }
	  var bound = new google.maps.LatLngBounds();
	  for (var i = 0; i < markers.length; i++) 
	  {
		markers[i].setMap(map);
		bound.extend(markers[i].getPosition());
	  }
	map.fitBounds(bound);
  //google.maps.event.addListener(marker, 'click', function() {
    //infoWindow.setContent(html);
    //infoWindow.open(map, marker);
  //});
}

function getlatlng(o)
{
	var address = o.value;
	var geocoder = new google.maps.Geocoder();
	
  geocoder.geocode( { 'address': address}, function(results, status) 
  {
    if (status == google.maps.GeocoderStatus.OK) 
	{
		document.getElementById('lat').value=results[0].geometry.location.lat();
		document.getElementById('lng').value=results[0].geometry.location.lng();
	  //alert("latitude: " + results[0].geometry.location.lat() + ", longtitude" + results[0].geometry.location.lng());
    } 
	else 
	{
      //alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

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
	markers.push(marker)
	
	for (var i = 0; i < markers.length; i++) 
	  {
		markers[i].setMap(map);
	  }
}

//google.maps.event.addDomListener(window, 'load', initialize);
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
    <label>Search Stores Near: </label>
     <input type="text" id="searchStr" name="address" value="Enter Your Address Here" style="border:1; width:365px; height:23px; line-height:22px; padding:0 5px 0 5px; color:#c4c4c4;font-family: Arial" onblur="changeColorGray(this)" onclick="changeColorBlack(this)"/>
     <input name="Submit" type="submit" class="btn_grey" value="Go!">
     </td>
  </tr>
</table>
<p>
<input id="lat" maxlength="100" name="lat" value="" type="hidden">
<input id="lng" maxlength="100" name="lng" value="" type="hidden">
</p>
</form>
<div align="center">
<div id="googleMap" align="center" style="width:500px;height:380px;"></div>
</div>
<div style="display:inline" class="coverphoto">

<?php
    ob_start();
	
	$lat = "";
	$lng = "";
	
	if(isset($_POST['lat'])&&isset($_POST['lng']))
	{
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		$latlngarray=array();
		$items=array();
		//$items['lat']=$lat;
		//$items['lng']=$lng;
		//$latlngarray[]=$items;
		
		$sql = "select *, ( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$lng."') ) + sin( radians('".$lat."') ) * sin( radians( lat ) ) ) ) AS distance from stores HAVING distance < 25 ORDER BY distance";
	
		$db = new DataBase();
		$db->conn();
		$k= $db->indb($sql);
		
		echo '<table align="center">';
		while($store=mysql_fetch_row($k))
		{
			$name=$store[1];
			$storeaddress = $store[3].",".$store[5].",".$store[6]." ".$store[7];
			$officephone = $store[8];
			$type = $store[15];
			$templat=$store[26];
			$templng=$store[27];
			$items['lat']=$templat;
			$items['lng']=$templng;
			$latlngarray[]=$items;
			echo "<script language=javascript>alert($storeaddress);</script>";
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
				<label style=\"font-size:14px\">Name: $name</label>
				</div>
				<div class=\"author\">
				<label style=\"font-size:12px\">Address: $storeaddress</label>
				</div>
				</div>
				</p>
				</tr>
				
				<tr valign=\"bottom\">
				<p>
				<div>
				<div class=\"title\">
				<label style=\"font-size:14px\">Phone: $officephone</label>
				</div>
				<div class=\"author\">
				<label style=\"font-size:12px\">$type</label>
				</div>
				</div>
				</p>
				</tr>
				</table>
			</td>
			</tr>";
		}
		echo '</table>';
		$strdata=json_encode($latlngarray);
		echo "<script 'text/javascript'>createMarker($strdata);</script>";
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
</div>

</body>
</html>