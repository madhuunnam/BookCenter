<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GooglemapGeo</title>

<style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
      #panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
    </style>


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>



<script>
var geocoder;
var map;
function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var mapOptions = {
    zoom: 8,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}

function codeAddress() 
{
  var address = document.getElementById('address').value;
  geocoder.geocode( { 'address': address}, function(results, status) 
  {
    if (status == google.maps.GeocoderStatus.OK) 
	{
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
	  //alert("latitude: " + results[0].geometry.location.lat() + ", longtitude" + results[0].geometry.location.lng());
    } 
	else 
	{
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

function createMarker(address) 
{
	alert(address);
  geocoder.geocode( { 'address': address}, function(results, status) 
  {
    if (status == google.maps.GeocoderStatus.OK) 
	{
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
	  alert("good");
    } 
	else 
	{
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>

<?php
		$address="1105 Walnut St, Cary, NC 27511";
		//$latlng = Get_LatLng_From_Google_Maps($address);
		$name="Cary Towne Center";
		echo "<script>createMarker('$address');</script>";
		
?>

</head>



<body>
	<div id="panel">
      <input id="address" type="textbox" value="Sydney, NSW">
      <input type="button" value="Geocode" onclick="codeAddress()">
    </div>
    <div id="map-canvas"></div>
    
    
    
    
</body>
</html>