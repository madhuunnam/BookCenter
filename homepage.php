<?php
session_start ();
include 'NavigationBar.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Page</title>
<style type="text/css">
#content {
	width: 50%;
	border: 3px solid;
	border-radius: 14px;
	border-color: #f5f5f5;
	margin: 0 auto;
	padding: 20px;
	left: 50%;
	top: 50%;
	margin-top: 1%;
	text-align: center;
}

td {
	padding-top: 3px !important;
	padding-bottom: 2px !important;
	text-align: right;
}

table, #emailInputHolder, #emailInput {
	margin: 0 auto; /* or margin: 0 auto 0 auto */
}

#emailInputHolder {
	text-align: center;
}

input {
	text-align: left;
}

td#search, #browseBtn {
	text-align: center
}

td#search input, td#browseBtn input {
	border: 1px solid;
	border-radius: 10px;
	padding: 5px 5px;
	padding-right: 10px;
	padding-left: 10px;
	background-color: #f5f5f5;
	text-align: center;
}
</style>
<script type="text/javascript" src='jquery-1.4.1.js'></script>
<script language="javascript">

	 bible=new Array("", "A. General", "B. Bibles", "C. Biblical Studies", "D. Biblical Reference", "E. Old Testament", "F. Moses's Books", "G. History Books", "H. Wisdom Literature", "I. Prophecy Books", "J. New Testament", "K. Jesus, Gospel, Acts", "L. Paul's Letters", "M. Common Letters", "N. Revelation", "O. Apocrypha");
	 theology=new Array("", "A. General", "B. Angelology and Demonology", "C. Anthropology", "D. Apologetics", "E. Christology", "F. Doctrinal", "G. Ecclesiology", "H. Eschatology", "I. Ethics", "J. History Theology", "K. Liberation Theology", "L. Mariology", "M. Pneumatology", "N. Process Theology", "O. Soteriology", "P. Systematic", "Q. Theological Thoughts");
	 christianlife=new Array("", "A. General", "B. Devotional", "C. Family", "D. Health and Emotion", "E. Inspirational", "F. Love and Marriage", "G. Men's Issues", "H. Parenting", "I. Personal Growth", "J. Prayer", "K. Professional Growth", "L. Relationships", "M. Servicing", "N. Social and Political Issues", "O. Spiritual Gifts", "P. Spiritual Growth", "Q. Spiritual Warfare", "R. Stewardship and Giving", "S. Trials and Suffering", "T. Understanding God's Will", "U. Women's Issues ");
	 christianministry=new Array("", "A. General", "B. Adult", "C. Care", "D. Children", "E. Counseling and Recovery", "F. Discipleship", "G. Education", "H. Evangelism", "I.  Leadership", "J. Missions", "K. Pastoral Resources", "L. Preaching", "M. Rituals and Practices", "N. Youth");
	 churchandchurchhistory=new Array("", "A. General", "B. Administration", "C. Biography", "D. Cannon", "E. Denominations", "F. Church Growth", "G. Church History", "H. The Apostolic Period 35-120", "I.  The Apologists 120-220", "J. The 3rd Century 220-305", "K. Imperial Church 305-476", "L. Early Middle Ages 476-999", "M. High Middle Ages 1000-1299", "N. Renaissance 1399-1499", "O. Reformation 16th 1500-1599", "P. Puritans 17th 1600-1699", "Q. Great Awakening 18th 1700-1799", "R. Second Awakening 19th 1800-1899", "S. Modern 20th 1900- present");
         cddvdother=new Array("", "A. General", "B. Audio Tapes", "C. Video Tapes", "D. Bible on CD", "E. Children's Tapes, CDs, DVDs", "F. Christian Literature and Fiction", "G. Computer Software and other media", "H. Family", "I.  Holidays Music", "J. Hymnal", "K. Hymns Video/ Karaoke, Songs", "L. Playings/Instruments", "M. Sermons", "N. Testimonials");
	 category = new Array("SubCategory");
	 
      populateSelect();

     $(function() {

           $('#bookcat').change(function(){
             populateSelect();
         });
         
     });


     function populateSelect(){
         cat=$('#bookcat').val();
         $('#subcat').html('');
         
		
         if(cat=='A. Bible'){
             bible.forEach(function(t) { 
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }
         
         if(cat=='B. Theology'){
             theology.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }
     	
     	if(cat=='C. Christian Life'){
     		christianlife.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }
         
     	if(cat=='D. Christian Ministry'){
     		christianministry.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }
     	
     	
     	if(cat=='E. Church and Church History'){
     		churchandchurchhistory.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }
     	
     	if(cat=='F. CD/DVD/Other'){
     		cddvdother.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }
     }
     

    function addOption(selectbox,text,value )
    {
      var optn = document.createElement("OPTION");
      optn.text = text;
      optn.value = value;
      selectbox.options.add(optn);
    }

    function onchange1(o){
      var value = document.getElementById('state').value;
      if(value=="NC") {
        addOption_list1();
      }
      if(value=="FL") {
        addOption_list2();
      }
    }
    function getlatlng(o)
    {
     var address = o.value;
     var geocoder = new google.maps.Geocoder();
     
     geocoder.geocode( { 'address': address}, function(results, status) 
     {
      if (status == google.maps.GeocoderStatus.OK) 
      {
        document.getElementById('lat1').value=results[0].geometry.location.lat();
        document.getElementById('lng1').value=results[0].geometry.location.lng();
        document.getElementById('lat2').value=results[0].geometry.location.lat();
        document.getElementById('lng2').value=results[0].geometry.location.lng();
  	  //alert("latitude: " + results[0].geometry.location.lat() + ", longtitude" + results[0].geometry.location.lng());
    } 
    else 
    {
        //alert('Geocode was not successful for the following reason: ' + status);
      }
    });
   }
    function fillHomeLib(){
		
		<?php 
			if($_SESSION['type']=='Store'){
			$sql1 = "select * from stores where storeID='" . $_SESSION ['storeID'] . "'";
			
			$dbconn = mysql_connect ( "localhost", "webclient", "12345678" ) or die ( "database error!" . mysql_error () );
			mysql_select_db ( "bookstore" ) or die ( "can not connect database：" . mysql_error () );
			$results1 = mysql_query ( $sql1 );
			while ( $row1 = mysql_fetch_assoc ( $results1 ) ) {
				$libraryName = $row1['storeName'];
			}
		 }
		else if($_SESSION['type']=='Customer'){
			$sql2 = "select * from Customers where custID='" . $_SESSION ['custID'] . "'";
			$dbconn = mysql_connect ( "localhost", "webclient", "12345678" ) or die ( "database error!" . mysql_error () );
			mysql_select_db ( "bookstore" ) or die ( "can not connect database：" . mysql_error () );
			$results2 = mysql_query ( $sql2 );
			while ( $row2 = mysql_fetch_assoc ( $results2 ) ) {
				$libraryName = $row2['homeLib'];
			}
		}
		?>
		document.getElementById('libName').value = '<?php echo $libraryName; ?>';
    }
    


    cityJSON = <?php
				$sql = 'select distinct s.state, s.city from stores s order by s.state, s.city';
				$dbconn = mysql_connect ( "localhost", "webclient", "12345678" ) or die ( "database error!" . mysql_error () );
				mysql_select_db ( "bookstore" ) or die ( "can not connect database：" . mysql_error () );
				$results = mysql_query ( $sql );
				
				$citiesJSON = array ();
				$cityArray = null;
				$state = '';
				while ( $row = mysql_fetch_assoc ( $results ) ) {
					if ($state != $row ['state']) {
						if ($cityArray != null) {
							$citiesJSON [$state] = $cityArray;
						}
						$state = $row ['state'];
						$cityArray = array ();
					}
					
					$cityArray [] = $row ['city'];
				}
				
				if ($cityArray != null) {
					$citiesJSON [$state] = $cityArray;
				}
				
				echo json_encode ( $citiesJSON );
				?>;

   storeTypes = <?php
			$sql = 'select distinct s.storeType from stores s order by s.storeType';
			$dbconn = mysql_connect ( "localhost", "webclient", "12345678" ) or die ( "database error!" . mysql_error () );
			mysql_select_db ( "bookstore" ) or die ( "can not connect database：" . mysql_error () );
			$results = mysql_query ( $sql );
			
			$storeTypes = array ();
			while ( $row = mysql_fetch_assoc ( $results ) ) {
				$storeTypes [] = $row ['storeType'];
			}
			
			echo json_encode ( $storeTypes );
			?>;
   stateAbbr = {};
   stateAbbr["AL"] = 'AL - Alabama';
   stateAbbr["AK"] = 'AK - Alaska';
   stateAbbr["AZ"] = 'AZ - Arizona';
   stateAbbr["AR"] = 'AR - Arkansas';
   stateAbbr["CA"] = 'CA - California';
   stateAbbr["CO"] = 'CO - Colorado';
   stateAbbr["CT"] = 'CT - Connecticut';
   stateAbbr["DE"] = 'DE - Delaware';
   stateAbbr["DC"] = 'DC - District of Columbia';
   stateAbbr["FL"] = 'FL - Florida';
   stateAbbr["GA"] = 'GA - Georgia';
   stateAbbr["GU"] = 'GU - Guam';
   stateAbbr["HI"] = 'HI - Hawaii';
   stateAbbr["ID"] = 'ID - Idaho';
   stateAbbr["IL"] = 'IL - Illinois';
   stateAbbr["IN"] = 'IN - Indiana';
   stateAbbr["IA"] = 'IA - Iowa';
   stateAbbr["KS"] = 'KS - Kansas';
   stateAbbr["KY"] = 'KY - Kentucky';
   stateAbbr["LA"] = 'LA - Louisiana';
   stateAbbr["ME"] = 'ME - Maine';
   stateAbbr["MD"] = 'MD - Maryland';
   stateAbbr["MA"] = 'MA - Massachusetts';
   stateAbbr["MI"] = 'MI - Michigan';
   stateAbbr["MN"] = 'MN - Minnesota';
   stateAbbr["MS"] = 'MS - Mississippi';
   stateAbbr["MO"] = 'MO - Missouri';
   stateAbbr["MT"] = 'MT - Montana';
   stateAbbr["NE"] = 'NE - Nebraska';
   stateAbbr["NV"] = 'NV - Nevada';
   stateAbbr["NH"] = 'NH - New Hampshire';
   stateAbbr["NJ"] = 'NJ - New Jersey';
   stateAbbr["NM"] = 'NM - New Mexico';
   stateAbbr["NY"] = 'NY - New York';
   stateAbbr["NC"] = 'NC - North Carolina';
   stateAbbr["ND"] = 'ND - North Dakota';
   stateAbbr["OH"] = 'OH - Ohio';
   stateAbbr["OK"] = 'OK - Oklahoma';
   stateAbbr["OR"] = 'OR - Oregon';
   stateAbbr["PA"] = 'PA - Pennsylvania';
   stateAbbr["PR"] = 'PR - Puerto Rico';
   stateAbbr["RI"] = 'RI - Rhode Island';
   stateAbbr["SC"] = 'SC - South Carolina';
   stateAbbr["SD"] = 'SD - South Dakota';
   stateAbbr["TN"] = 'TN - Tennessee';
   stateAbbr["TX"] = 'TX - Texas';
   stateAbbr["UT"] = 'UT - Utah';
   stateAbbr["VT"] = 'VT - Vermont';
   stateAbbr["VA"] = 'VA - Virginia';
   stateAbbr["WA"] = 'WA - Washington';
   stateAbbr["WV"] = 'WV - West Virginia';
   stateAbbr["WI"] = 'WI - Wisconsin';
   stateAbbr["WY"] = 'WY - Wyoming';

   $(document).ready(function() {

      $('#state').empty();
      $('#state').append(new Option('State', '', true, true)); 
      $('#city').empty();
      $('#city').append(new Option('City', '', true, true));

      $.each(cityJSON, function(k, v) {
          stateName = stateAbbr[k] == undefined ? k : stateAbbr[k];
          $('#state').append(new Option(stateName, k, false, false)); 
      });

      $('#state').change(function() {
          $('#city').empty();
          $('#city').append(new Option('City', '', true, true));
          $.each(cityJSON[$('#state').val()], function(k, v) {
              $('#city').append(new Option(v, v, false, false));
          });
      });  

      $('#type').empty();
      $('#type').append(new Option('Store Type', '', true, true)); 
      $.each(storeTypes, function(k, v) {
          $('#type').append(new Option(v, v, false, false)); 
      });

   });


 
</script>

<style>
.action-box-rounded {
	border: 1px solid;
	border-color: #09F;
	width: 400px;
	margin: 10px;
	margin-left: 20px
}
</style>

</head>
<body>
	<br><br>
			<h1>Church Library Management System</h1>

  <?php
		if (isset ( $_SESSION ['loggedIn'] ) && $_SESSION ['loggedIn']) {
			if (! isset ( $_SESSION ['welcomed'] ) || ! $_SESSION ['welcomed']) {
				$_SESSION ['welcomed'] = true;
				echo "<H2> Welcome " . $_SESSION ['name'] . "</H2>";
			} else {
				echo "<H2> " . $_SESSION ['name'] . "</H2>";
			}
		}
		?>
  <div align="center" id="content">
				<div align="left">
					<form id="basic_information_form" name="basic_information_form"
						action="searchresult.php" method="GET">
						<table>
							<tr>
								<td colspan=2><label>Search By</label></td>
								<td colspan=2><select style="margin: 10px 10px 10px 10px"
									name="state" tabindex="60" id="state" class="state-required"
									rel="addressResult" onChange="onchange1(this)">

										<option value="">Select</option>

								</select><sup>*</sup></td>
								<td colspan=2><select style="margin: 10px 10px 10px 10px"
									name="city" tabindex="60" id="city" class="state-required"
									rel="addressResult">
										<option value="">City</option>
								</select></td>
							</tr>
							<tr>
								<td colspan=2><label>And</label></td>
								<td colspan=2><select style="margin: 10px 10px 10px 10px"
									name="optionSelected" id="optionSelected">
										<option value="">Select</option>
										<option value="ISBN">ISBN</option>
										<option value="Author">Author</option>
										<option value="Title">Title</option>
										<option value="Call Number">Call Number</option>
								</select></td>
								<td colspan=1><label> Enter Text</label></td>
								<td colspan=2><input style="margin: 10px 10px 10px 10px"
									type="text" name="callnum" id="callnum"
									style="border:1; width:365px; height:23px; line-height:22px; padding:0 5px 0 5px; color:#c4c4c4;font-family: Arial"
									onblur="changeColorGray4(this)"
									onclick="changeColorBlack4(this)" /></td>
							</tr>
							<tr>
								<td colspan=2><label>And</label></td>
								<td colspan=2><select style="margin: 10px 10px 10px 10px"
									name="bookcat" tabindex="60" id="bookcat">
										<option value="">Category</option>
										<option value="A. Bible">A. Bible</option>
										<option value="B. Theology">B. Theology</option>
										<option value="C. Christian Life">C. Christian Life</option>
										<option value="D. Christian Ministry">D. Christian Ministry</option>
										<option value="E. Church and Church History">E. Church and Church History</option>
										<option value="F. CD/DVD/Other">F. CD/DVD/Other</option>
								</select></td>
								<td colspan=2><select style="margin: 10px 10px 10px 10px"
									name="subcat" tabindex="60" id="subcat">
										<option value="">SubCategory</option>
								</select></td>
							</tr>
							<tr>
								<input style="margin: 10px 10px 10px 10px" id="lat1"
									maxlength="100" name="lat" value="" type="hidden"> <input
									style="margin: 10px 10px 10px 10px" id="lng1" maxlength="100"
									name="lng" value="" type="hidden"></td>
							
							</tr>
							<tr>
								<td colspan=2><label>And</label></td>
								<td colspan=2><input style="margin: 10px 10px 10px 10px"
									type="text" name="libName" id="libName" placeholder = "Library Name"
									style="border:1; width:365px; height:23px; line-height:22px; padding:0 5px 0 5px; color:#c4c4c4;font-family: Arial"
									onblur="changeColorGray4(this)"
									oncli	ck="changeColorBlack4(this)" /></td>
								<td><a href ="#" onclick="fillHomeLib();">Fill HomeLib</a></td>
							</tr>
							<tr>
								<td id='search' colspan=7><input value='Search' name='Search'
									id="caSubmitBtn" type="submit" tabindex="10" name="CmdCreate"
									alt="Continue" class="large-secondary-action-button" /></td>
							</tr>
						</table>
					</form>
				</div>
			</div>

</body>
</html>