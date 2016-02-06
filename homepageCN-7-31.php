<?php
session_start ();
include 'NavigationBarCN.php';
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

	 bible=new Array("一般", "新舊約聖經", "英文聖經", "外文聖經", "中外文聖經", "註釋本聖經", "選摘本");
	 biblestudy=new Array("一般", "讀經法", "釋經法", "參考書工具書", "摩西五經", "聖經概論", "歷史書", "舊約註釋", "新約註釋", "智慧詩歌書", "大先知書", "小先知書", "四福音書", "使徒行傳", "保羅書信", "希伯來書", "普通書信", "啟示錄", "聖經史地", "聖經人物", "登山寶訓", "耶穌生平與教訓", "專題論述", "聖經文學");
	 theology=new Array("一般", "系統神學概論", "信徒神學", "神論", "基督論", "聖靈論", "救恩論", "救恩論", "人論", "末世論", "靈界", "教義", "護教學", "神學專題", "其它");
	 practice=new Array("一般", "教會", "講道", "管家職份", "宣教差傳", "崇拜、儀式", "靈恩", "教育", "社會參與", "文字工作", "輔導", "教牧", "醫治", "小組教會", "倫理學", "其它");
	 churchhistory=new Array("一般", "教會歷史概論", "中國教會歷史", "外國教會歷史", "派別", "異端", "文獻信條", "與其它宗教", "教會復興", "台灣教會歷史");
         life=new Array("不分類別", "初信造就", "禱告", "靈修", "培靈", "事奉", "講章", "其它");
         biography=new Array("不分類別", "福音見證", "生活見證", "傳記", "見證");
         gospel=new Array("不分類別", "佈道講章", "單張", "小冊", "佈道工作", "福音叢書", "文選");
         living=new Array("不分類別", "倫理", "交友", "婚姻", "家庭", "兒童", "青少年", "成人", "職業", "特殊問題", "生活教導");
         train=new Array("不分類別", "小組材料", "工作訓練", "研經", "兒童", "青少年", "幼稚", "成人", "主日學", "歸納法研經", "紙品");
         literature=new Array("不分類別", "小說故事", "詩、散文", "劇本", "兒童故事CD", "畫冊");
         hymn=new Array("不分類別", "音樂叢書", "詩歌本譜", "節慶樂譜");
         dvd=new Array("信息類", "節慶音樂", "英文詩歌演唱", "演奏", "中文演唱", "兒童故事類", "伴唱帶", "一般音樂類");
         software=new Array("不分類別", "錄影帶", "投影片", "電腦軟體", "VCD", "DVD", "MP3");
         

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
         
		
         if(cat=='聖經'){
             bible.forEach(function(t) { 
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }
         
         if(cat=='聖經論叢'){
             biblestudy.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }
     	
     	if(cat=='神學類'){
     		theology.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }
         
     	if(cat=='實踐神學'){
     		practice.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }
     	
     	
     	if(cat=='教會歷史'){
     		churchhistory.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }
     	
         if(cat=='生命造就'){
     		life.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }

         if(cat=='見證傳記'){
     		biography.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }

         if(cat=='福音佈道'){
     		gospel.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }

         if(cat=='生活教導'){
     		living.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }

         if(cat=='訓練材料'){
     		train.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }

         if(cat=='文藝類'){
     		literature.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }

         if(cat=='詩本樂譜'){
     		hymn.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }

         if(cat=='影音光碟'){
     		dvd.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }

     	if(cat=='影音軟體'){
     		software.forEach(function(t) {
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
   stateAbbr["AS"] = 'AS - American Samoa';
   stateAbbr["AZ"] = 'AZ - Arizona';
   stateAbbr["AR"] = 'AR - Arkansas';
   stateAbbr["CA"] = 'CA - California';
   stateAbbr["CO"] = 'CO - Colorado';
   stateAbbr["CT"] = 'CT - Connecticut';
   stateAbbr["DE"] = 'DE - Delaware';
   stateAbbr["DC"] = 'DC - District of Columbia';
   stateAbbr["FM"] = 'FM - Federated States of Micronesia';
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
   stateAbbr["MH"] = 'MH - Marshall Islands';
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
   stateAbbr["MP"] = 'MP - Northern Mariana Islands';
   stateAbbr["OH"] = 'OH - Ohio';
   stateAbbr["OK"] = 'OK - Oklahoma';
   stateAbbr["OR"] = 'OR - Oregon';
   stateAbbr["PW"] = 'PW - Palau';
   stateAbbr["PA"] = 'PA - Pennsylvania';
   stateAbbr["PR"] = 'PR - Puerto Rico';
   stateAbbr["RI"] = 'RI - Rhode Island';
   stateAbbr["SC"] = 'SC - South Carolina';
   stateAbbr["SD"] = 'SD - South Dakota';
   stateAbbr["TN"] = 'TN - Tennessee';
   stateAbbr["TX"] = 'TX - Texas';
   stateAbbr["UT"] = 'UT - Utah';
   stateAbbr["VT"] = 'VT - Vermont';
   stateAbbr["VI"] = 'VI - Virgin Islands';
   stateAbbr["VA"] = 'VA - Virginia';
   stateAbbr["WA"] = 'WA - Washington';
   stateAbbr["WV"] = 'WV - West Virginia';
   stateAbbr["WI"] = 'WI - Wisconsin';
   stateAbbr["WY"] = 'WY - Wyoming';

   $(document).ready(function() {

      $('#state').empty();
      $('#state').append(new Option('州', '', true, true)); 
      $('#city').empty();
      $('#city').append(new Option('城市', '', true, true));

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
			<h1>教會圖書館管理系統</h1>

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
								<td colspan=2><label>按</label></td>
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
								<td colspan=2><label>和</label></td>
								<td colspan=2><select style="margin: 10px 10px 10px 10px"
									name="optionSelected" id="optionSelected">
										<option value="">選項</option>    <!--    Fu 5-22 before is Select -->
										<option value="ISBN">ISBN</option>
										<option value="Author">作者</option>
										<option value="Title">書名</option>
										<option value="Call Number">找書號</option>
								</select></td>
								<td colspan=1><label> 選值</label></td>
								<td colspan=2><input style="margin: 10px 10px 10px 10px"
									type="text" name="callnum" id="callnum"
									style="border:1; width:365px; height:23px; line-height:22px; padding:0 5px 0 5px; color:#c4c4c4;font-family: Arial"
									onblur="changeColorGray4(this)"
									onclick="changeColorBlack4(this)" /></td>
							</tr>
							<tr>
								<td colspan=2><label>和</label></td>
								<td colspan=2><select style="margin: 10px 10px 10px 10px"
									name="bookcat" tabindex="60" id="bookcat">
										<option value="">主類</option>
										<option value="聖經">A. 聖經</option>
										<option value="聖經論叢">B. 聖經論叢</option>
										<option value="神學類">C. 神學類</option>
										<option value="實踐神學">D. 實踐神學</option>
										<option value="教會歷史">E. 教會歷史</option>
										<option value="生命造就">F. 生命造就</option>
                                                                                <option value="見證傳記">G. 見證傳記</option>
										<option value="福音佈道">H. 福音佈道</option>
										<option value="生活教導">I. 生活教導</option>
										<option value="訓練材料">J. 訓練材料</option>
										<option value="文藝類">K. 文藝類</option>
										<option value="詩本樂譜">L. 詩本樂譜</option>
                                                                                <option value="影音光碟">M. 影音光碟</option>
										<option value="影音軟體">N. 影音軟體</option>
                                                                                
								</select></td>
								<td colspan=2><select style="margin: 10px 10px 10px 10px"
									name="subcat" tabindex="60" id="subcat">
										<option value="">子類</option>
								</select></td>
							</tr>
							<tr>
								<input style="margin: 10px 10px 10px 10px" id="lat1"
									maxlength="100" name="lat" value="" type="hidden"> <input
									style="margin: 10px 10px 10px 10px" id="lng1" maxlength="100"
									name="lng" value="" type="hidden"></td>
							
							</tr>
							<tr>
								<td id='search' colspan=7><input value='查詢' name='Search'
									id="caSubmitBtn" type="submit" tabindex="10" name="CmdCreate"
									alt="Continue" class="large-secondary-action-button" /></td>
							</tr>
						</table>
					</form>
				</div>
			</div>

</body>
</html>