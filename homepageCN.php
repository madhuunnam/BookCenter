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

	 bible=new Array("a. 一般", "b. 新舊約聖經", "c. 英文聖經", "d. 外文聖經", "e. 中外文聖經", "f. 註釋本聖經", "g. 選摘本");
	 biblestudy=new Array("a. 一般", "b. 讀經法", "c. 釋經法", "d. 參考書工具書", "e. 摩西五經", "f. 聖經概論", "g. 歷史書", "h. 舊約註釋", "i. 新約註釋", "j. 智慧詩歌書", "k. 大先知書", "l. 小先知書", "m. 四福音書", "n. 使徒行傳", "o. 保羅書信", "p. 希伯來書", "q. 普通書信", "r. 啟示錄", "s. 聖經史地", "t. 聖經人物", "u. 登山寶訓", "v. 耶穌生平與教訓", "w. 專題論述", "x. 聖經文學");
	 theology=new Array("a. 一般", "b. 系統神學概論", "c. 信徒神學", "d. 神論", "e. 基督論", "f. 聖靈論", "g. 救恩論", "h. 人論", "i. 末世論", "j. 靈界", "k. 教義", "l. 護教學", "m. 神學專題", "o. 啟示論", "p. 教會論", "n. 其它");
	 practice=new Array("a. 一般", "b. 教會", "c. 講道", "d. 管家職份", "e. 宣教差傳", "f. 崇拜、儀式", "g. 靈恩", "h. 教育", "i. 社會參與", "j. 文字工作", "k. 輔導", "l. 教牧", "m. 醫治", "n. 小組教會", "o. 倫理學", "p. 其它");
	 churchhistory=new Array("a. 一般", "b. 教會歷史概論", "c. 中國教會歷史", "d. 外國教會歷史", "e. 派別", "f. 異端", "g. 文獻信條", "h. 與其它宗教", "i. 教會復興", "j. 台灣教會歷史");
         life=new Array("a. 不分類別", "b. 初信造就", "c. 禱告", "d. 靈修", "e. 培靈", "f. 事奉", "g. 講章", "h. 其它");
         biography=new Array("a. 不分類別", "b. 福音見證", "c. 生活見證", "d. 傳記", "e. 見證");
         gospel=new Array("a. 不分類別", "b. 佈道講章", "c. 單張", "d. 小冊", "e. 佈道工作", "f. 福音叢書", "g. 文選");
         living=new Array("a. 不分類別", "b. 倫理", "c. 交友", "d. 婚姻", "e. 家庭", "f. 兒童", "g. 青少年", "h. 成人", "i. 職業", "j. 特殊問題", "k. 生活教導");
         train=new Array("a. 不分類別", "b. 小組材料", "c. 工作訓練", "d. 研經", "e. 兒童", "f. 青少年", "g. 幼稚", "h. 成人", "i. 主日學", "j. 歸納法研經", "k. 紙品");
         literature=new Array("a. 不分類別", "b. 小說故事", "c. 詩、散文", "d. 劇本", "e. 兒童故事CD", "f. 畫冊");
         hymn=new Array("a. 不分類別", "b. 音樂叢書", "c. 詩歌本譜", "d. 節慶樂譜");
         dvd=new Array("a. 信息類", "b. 節慶音樂", "c. 英文詩歌演唱", "d. 演奏", "e. 中文演唱", "f. 兒童故事類", "g. 伴唱帶", "h. 一般音樂類");
         software=new Array("a. 不分類別", "b. 錄影帶", "c. 投影片", "d. 電腦軟體", "e. VCD", "f. DVD", "g. MP3");
         

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
         
		
         if(cat=='A. 聖經'){
             bible.forEach(function(t) { 
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }
         
         if(cat=='B. 聖經論叢'){
             biblestudy.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }
     	
     	if(cat=='C. 神學類'){
     		theology.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }
         
     	if(cat=='D. 實踐神學'){
     		practice.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }
     	
     	
     	if(cat=='E. 教會歷史'){
     		churchhistory.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }
     	
         if(cat=='F. 生命造就'){
     		life.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }

         if(cat=='G. 見證傳記'){
     		biography.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }

         if(cat=='H. 福音佈道'){
     		gospel.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }

         if(cat=='I. 生活教導'){
     		living.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }

         if(cat=='J. 訓練材料'){
     		train.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }

         if(cat=='K. 文藝類'){
     		literature.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }

         if(cat=='L. 詩本樂譜'){
     		hymn.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }

         if(cat=='M. 影音光碟'){
     		dvd.forEach(function(t) {
                 $('#subcat').append('<option>'+t+'</option>');
             });
         }

     	if(cat=='N. 影音軟體'){
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
   stateAbbr["VT"] = 'VT - Vermont';;
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
										<option value="A. 聖經">A. 聖經</option>
										<option value="B. 聖經論叢">B. 聖經論叢</option>
										<option value="C. 神學類">C. 神學類</option>
										<option value="D. 實踐神學">D. 實踐神學</option>
										<option value="E. 教會歷史">E. 教會歷史</option>
										<option value="F. 生命造就">F. 生命造就</option>
                                                                                <option value="G. 見證傳記">G. 見證傳記</option>
										<option value="H. 福音佈道">H. 福音佈道</option>
										<option value="I. 生活教導">I. 生活教導</option>
										<option value="J. 訓練材料">J. 訓練材料</option>
										<option value="K. 文藝類">K. 文藝類</option>
										<option value="L. 詩本樂譜">L. 詩本樂譜</option>
                                                                                <option value="M. 影音光碟">M. 影音光碟</option>
										<option value="N. 影音軟體">N. 影音軟體</option>
                                                                                
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