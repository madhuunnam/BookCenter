<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>List of Store</title>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<style type="text/css">
	table td {
		font-size: 1em;
	}
</style>
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



</head>
<?php include 'NavigationBar.php'; ?>
<body>
<div align="right" style=" border: 1px solid #222S; float: right;">
<div id="googleMap" align="center" style="width:500px;height:380px;"></div>
</div>
<div style=" border: 1px solid #fff; float: left;" class="coverphoto" >
<?php
	$cat=isset($_GET['bookcat']) ? $_GET['bookcat'] : null;
	$subCat=isset($_GET['subcat']) ? $_GET['subcat'] : null;
	$subSubCat=isset($_GET['subsubcat']) ? $_GET['subsubcat'] : null;
	$state=isset($_GET['state']) ? $_GET['state'] : null;
	$city=isset($_GET['city']) ? $_GET['city'] : null;
	$zip=isset($_GET['zip']) ? $_GET['zip'] : null;
	$storename=isset($_GET['storename']) ? $_GET['storename'] : null;
	$lat = isset($_GET['lat']) ? $_GET['lat'] : null;
   	$lng = isset($_GET['lng']) ? $_GET['lng'] : null;
   	$sql = "";
   	$latlngarray=array();
	$items=array();
	$selectedDistance = "";
	$havingDistanceClause = "";
	if ($lat != null && $lng != null) {
		$selectedDistance = ", ( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( latitude  ) ) * cos( radians( longtitude  ) - radians('".$lng."') ) + sin( radians('".$lat."') ) * sin( radians( latitude  ) ) ) ) AS distance ";
		$havingDistanceClause = "HAVING distance < 25 ORDER BY distance";
	}
   
   	if ($storename != null) {
   		if($cat != null) {
	   		$sql = "select * from stores AS S where S.StoreName like '%".$storename."%' and S.storeID in (select distinct storeID from inventory AS Inv, books as B where B.category = '".$cat."' and B.isbn = Inv.isbn ) ".$havingDistanceClause;
	   	} else {
			$sql = "select * ".$selectedDistance." from stores AS S where S.StoreName like '%".$storename."%' and S.storeID in (select distinct storeID from inventory AS Inv, books as B where B.isbn = Inv.isbn ) ".$havingDistanceClause;
		}
   	} else if($cat != null) {
		   
		   	$sql = "select * ".$selectedDistance." from stores AS S where S.storeID in (select distinct storeID from inventory AS Inv, books as B where B.category = '".$cat."'";
		    if ($subCat != null) {
		    	$sql .= 'and b.subCat="'.$subCat.'" ';
		    }
		    if ($subSubCat != null) {
		    	$sql .= 'and b.subSubCat="'.$subSubCat.'" ';
		    }

		   	$sql .= " and B.isbn = Inv.isbn ) ";
			if($state != null) {
				$sql .= " and S.state = '".$state."' ";
			}
			if ($city != null) {
				$sql .= ' and S.city="'.$city.'" ';
			}
			if ($zip != null) {
				$sql .= ' and S.zip="'.$zip.'" ';
			}	
		    if (isset($_GET['type']) && $_GET['type'] != '') {
				$sql .= ' and S.storeType="'.$_GET['type'].'" ' ;
			}
			$sql .= ' '.$havingDistanceClause;
	} else if($state != null) {
		$sql = "select * ".$selectedDistance." from stores AS S where S.state = '".$state."' ";
		if ($city != null) {
			$sql .= ' and S.city="'.$city.'" ';
		}
		if ($zip != null) {
			$sql .= ' and S.zip="'.$zip.'" ';
		}	
	    if (isset($_GET['type']) && $_GET['type'] != '') {
			$sql .= ' and S.storeType="'.$_GET['type'].'" ' ;
		}
		$sql .= " and S.storeID in (select distinct storeID from inventory AS Inv, books as B where B.isbn = Inv.isbn ) ".$havingDistanceClause;
	} else {
		$sql = "select *".$selectedDistance." from stores ".$havingDistanceClause;
	}
	
	$db = new DataBase();
	$db->conn();
	$k= $db->indb($sql);

	
?>
	<table align="left" style="margin:30px;">
<?php
	while($store=mysql_fetch_row($k))
	{
		$storeId = $store[0];
		$name=$store[2];
		$storeaddress = $store[3]." ".$store[5]." ".$store[6]." ".$store[7];
		$officephone = $store[11];
		$type = $store[22];
		$service = $store[25];
		$templat=$store[8];
		$templng=$store[9];
		$distance = '';
		if ($lat != null && $lng != null)
			$distance = number_format($store[35], 2, '.', ' ');
		$items['lat']=$templat;
		$items['lng']=$templng;
		$latlngarray[]=$items;
?>
		<tr>
			<td bgcolor="#6699FF">
				<div style="float:left" class="coverphoto">
					<img src="/images/bookcover.jpg" class="listResultImage" alt=""/>
				</div>
			</td>
			<td  bgcolor="#ddd">
				<table>
					<tr valign="top">
						<td>
							<span style="font-size:15px;"> Name: </span><a class="menulink" href="Storepage.php?name=<?php echo $name; ?>&storeId=<?php echo $storeId; ?>" style="font-size:15px"><?php echo $name; ?></a>
						</td>
						<td class="author">
							<label style="font-size:15px">Address: <?php echo $storeaddress; ?></label>
						</td>
					</tr>
					<tr valign="bottom" align="left">
						<td class="title">
							<label style="font-size:15px">Phone: <?php echo $officephone; ?></label>
						</td>
						<td class="author">
							<label style="font-size:15px">Type: <?php echo $type; ?></label>
						</td>
						<td class="author">
							<label style="font-size:15px">Service: <?php echo $service; ?></label>
						</td>
						<td class="author">
							<label style="font-size:15px">Distance: <?php echo $distance; ?></label>
						</td>
					</tr>
				</table>
			</td>
		</tr>
<?php
	}
	$strdata=json_encode($latlngarray);
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
	</table>
	<script 'text/javascript'>createMarker(<?php echo $strdata; ?>);</script>

</div>
</div>
</body>
</html>