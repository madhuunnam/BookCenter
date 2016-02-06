<?php
session_start ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Insert Book</title>
<style type="text/css">
div.container {
	margin-top: 20px !important;
	padding: 10px !important;
	border: 1px solid #eee;
	border-radius: 10px;
	width: 50%;
	margin: auto;
}

input, button {
	margin: 10px;
}

a {
	font-size: 0.8em;
}

button {
	padding: 5px;
	border-radius: 4px;
}

div#loading {
	display: none;
	position: fixed;
	z-index: 1000;
	top: 0;
	left: 0;
	height: 100%;
	width: 100%;
	background: rgba(0, 0, 0, 0.8)
		url('coverimages/ajax_loader_gray_350.gif') 50% 50% no-repeat;
}
</style>


<script type="text/javascript" src='js/jquery-2.1.1.min.js'></script>
<script type="text/javascript" src='js/categories.js'></script>
<script type="text/javascript">


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


MosesBooks=new Array("a. Genesis", "b. Exodus", "c. Leviticus", "d. Numbers", "e. Deuteronomy", "f. General");
HistoryBooks=new Array("a. Joshua", "b. Judges", "c. Ruth", "d. Samuel 1,2", "e. Kings 1,2", "f. Chronicles 1,2", "g. Ezra", "h. Nehemiah", "i. Esther", "j. General");
WisdomLiterature=new Array("a. Job", "b. Psalms", "c. Proverbs", "d. Ecclesiastes", "e. Song of Solomon", "f. General");
ProphecyBooks=new Array("a. Isaiah", "b. Jeremiah", "c. Lamentations", "d. Ezekiel", "e. Daniel", "f. General");
JesusGospelActs=new Array("a. Matthew", "b. Mark", "c. Luke", "d. John", "e. General");
PaulsLetters=new Array("a. Romans", "b. Corinthians 1,2", "c. Galatians", "d. Philippians", "e. Ephesians", "f. Colossians", "g. Thessalonians 1,2", "h. Timothy 1, 2", "i. Titus", "j. Philemon", "k. General");
CommonLetters=new Array("a. General", "b. James", "c. Peter 1,2", "d. John 1, 2, 3", "e. Jude");


populateSelect();
populateSelectSubcat();

$(function() {

      $('#bookCategory').change(function(){
        populateSelect();
        populateSelectSubcat();
    });
    
});

$(function() {

    $('#bookSubCategory').change(function(){
      populateSelectSubcat();
  });
  
});

function populateSelectSubcat(){

		subcat= $('#bookSubCategory').val();
	    $('#bookSubSubCategory').html('');

		if(subcat == "e. 摩西五經"){
			MosesBooks.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == 'g. 歷史書'){
			HistoryBooks.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == 'j. 智慧詩歌書'){
			WisdomLiterature.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == 'k. 大先知書'){
			ProphecyBooks.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == 'm. 四福音書'){
			JesusGospelActs.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == "o. 保羅書信"){
			PaulsLetters.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == 'q. 普通書信'){
			CommonLetters.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		
}

function populateSelect(){
         cat=$('#bookCategory').val();
         $('#bookSubCategory').html('');
         
		
         if(cat=='A. 聖經'){
             bible.forEach(function(t) { 
                 $('#bookSubCategory').append('<option>'+t+'</option>');
             });
         }
         
         if(cat=='B. 聖經論叢'){
             biblestudy.forEach(function(t) {
                 $('#bookSubCategory').append('<option>'+t+'</option>');
             });
         }
     	
     	if(cat=='C. 神學類'){
     		theology.forEach(function(t) {
                 $('#bookSubCategory').append('<option>'+t+'</option>');
             });
         }
         
     	if(cat=='D. 實踐神學'){
     		practice.forEach(function(t) {
                 $('#bookSubCategory').append('<option>'+t+'</option>');
             });
         }
     	
     	
     	if(cat=='E. 教會歷史'){
     		churchhistory.forEach(function(t) {
                 $('#bookSubCategory').append('<option>'+t+'</option>');
             });
         }
     	
         if(cat=='F. 生命造就'){
     		life.forEach(function(t) {
                 $('#bookSubCategory').append('<option>'+t+'</option>');
             });
         }

         if(cat=='G. 見證傳記'){
     		biography.forEach(function(t) {
                 $('#bookSubCategory').append('<option>'+t+'</option>');
             });
         }

         if(cat=='H. 福音佈道'){
     		gospel.forEach(function(t) {
                 $('#bookSubCategory').append('<option>'+t+'</option>');
             });
         }

         if(cat=='I. 生活教導'){
     		living.forEach(function(t) {
                 $('#bookSubCategory').append('<option>'+t+'</option>');
             });
         }

         if(cat=='J. 訓練材料'){
     		train.forEach(function(t) {
                 $('#bookSubCategory').append('<option>'+t+'</option>');
             });
         }

         if(cat=='K. 文藝類'){
     		literature.forEach(function(t) {
                 $('#bookSubCategory').append('<option>'+t+'</option>');
             });
         }

         if(cat=='L. 詩本樂譜'){
     		hymn.forEach(function(t) {
                 $('#bookSubCategory').append('<option>'+t+'</option>');
             });
         }

         if(cat=='M. 影音光碟'){
     		dvd.forEach(function(t) {
                 $('#bookSubCategory').append('<option>'+t+'</option>');
             });
         }

     	if(cat=='N. 影音軟體'){
     		software.forEach(function(t) {
                 $('#bookSubCategory').append('<option>'+t+'</option>');
             });
         }
     }


    function validateAndSubmit() {
        if ($('#bookCategory').val() == "") {
            alert("Please select a Category");
        } else if ($('#bookSubCategory').val() == "") {
            alert("Please select a Subcategory");
        } else if ($('#title').val() == "") {
        	alert("Please enter a Title");
        } else if ($('#author').val() == "") {
        	alert("Please enter Authors");
        } 
        
        $('#updateBookForm').submit(); // added 8-11-15
    }
</script>
</head>

<body>
<?php

        $title = "";  $author = "";
        $publisherName = "";
        $pubDate = "";
        $productFormatDetail = "";
        $pages = "";
        $language = "";
        $isbn = "";
        $isbn10 = "";
        $productDimensions = "";
        $shippingWeight = "";
        $amazonStar = "";
        $amazonReviews = "";
        $fromBackCover = "";
        $description = "";
        $amazonRevLink = "";
        $altTitle = "";
        $subTitle = "";
        $editionNumber = ""; 
        $editionType = ""; 
        $callNum = "";
        $audience = "";
        $contents = "";
        $category = "";
        $subCat = "";
        $subSubCat = "";
        $keywords = ""; 

    if (! isset ( $_SESSION ['type'] ) || $_SESSION ['type'] != 'Store' ) {
            echo " window.location.href='homepage.php';";
    }
    else if ( isset($_POST['autofill']) ) {

    
        define('DB_NAME', 'bookstore');
        define('DB_USER', 'webclient');
        define('DB_PASSWORD', '12345678');
        define('DB_HOST', 'localhost');

        $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

        if (!$link) {
            die('Could not connect: ' . mysql_error());
        }

        $db_selected = mysql_select_db(DB_NAME, $link);

        if(!$db_selected) {
            die('Can\'t use ' . DB_NAME . ': ' . mysql_error());
        }

        $checkingExist = "select * from books where isbn='" . $_POST['isbn'] . "' or isbn10='" . $_POST['isbn'] . "';";
        echo $checkingExist;
        $result_indb = mysql_query ( $checkingExist ) or die ( "can not run the sql language:" . mysql_error () );
        $row = mysql_fetch_array( $result_indb );
        //echo $row;
        //var_dump($row);
         if ( !$row ) {
            echo "This book is not in the database yet to update.";
        }

        //ob_start ();
        $title = $row ['title']; 
        $author = $row ['author'];
        $publisherName = $row ['publisherName'];
        $pubDate = $row ['pubDate'];
        $productFormatDetail = $row ['productFormatDetail'];
        $pages = $row ['pages'];
        $language = $row ['language'];
        $isbn = $row ['isbn'];
        $isbn10 = $row ['isbn10'];
        $productDimensions = $row ['productDimensions'];
        $shippingWeight = $row ['shippingWeight'];
        $amazonStar = $row ['amazonStar'];
        $amazonReviews = $row ['amazonReviews'];
        $fromBackCover = $row['fromBackCover'];
        $description = $row ['description'];
        $amazonRevLink = $row ['amazonRevLink'];

        $altTitle = $row ['altTitle'] ;
        $subTitle = $row ['subTitle'];
        $editionNumber = $row ['editionNumber']; 
        $editionType = $row ['editionType']; 
        $callNum = $row ['callNum'];
        $audience = $row ['audience'];
        $contents = $row ['contents'];
        $category = $row ['category'];
        $subCat = $row ['subCat'];
        $subSubCat = $row ['subSubCat'];
        $keywords = $row ['keywords'];

        mysql_close($link);
}

?>


<?php include 'NavigationBar.php'; ?>


	<h2>Update Book Information</h2>

        <form name = "isbnForm" action = "updateBookFormCN.php" method ="POST">
             ISBN-13 or ISBN-10 <sup>*</sup>
             <input id="isbn" name="isbn" type=text />
             <button  type = "submit" name="autofill" >Auto Fill</button>
        </form>

        <form id="updateBookFormCN" name="update_book_form" action="updateBook.php" method="POST">
                <table id="resultTable">
                        
                        <input type="hidden" name="isbn" id="isbn" value="<?php echo htmlentities($isbn); ?>"/>
                        <input type="hidden" name="isbn10" id="isbn10" value="<?php echo htmlentities($isbn10); ?>"/>
                        
                        <tr>
                                <th>Title<sup>*</sup>
                                </th>
                                <td><input type=text id="title" name="title" value="<?php echo htmlentities($title); ?>"/></td>
                                <th>Alt Title</th>
                                <td><input type=text name="altTitle" id="bookAltTitle" value="<?php echo htmlentities($altTitle); ?>"/></td>
                        </tr>
                        <tr>
                                <th>Sub-Title</th>
                                <td><input id="bookSubTitle" name="subTitle" type=text value="<?php echo htmlentities($subTitle); ?>"/></td>
                                <th>Language</th>
                                <td><input id="bookLanguage" name="language" type=text value="<?php echo htmlentities($language); ?>"/></td>
                        </tr>
                        <tr>
                                <th>Authors<sup>*</sup></th>
                                <td><input type=text id="author" name="author" value="<?php echo htmlentities($author); ?>"/></td>
                        </tr>
                        <tr>
                                <th>Edition Number</th>
                                <td><input type=text name="edition" id="bookEdition" value="<?php echo htmlentities($editionNumber); ?>"/></td>
                                <th>Edition Type</th>
                                <td><input type=text name="editionType" id="bookEditionType" value="<?php echo htmlentities($editionType); ?>"/></td>
                        </tr>
                        <tr>
                                <th>Amazon Star <input type=text name="rating" id="bookAmazonStar" value="<?php echo htmlentities($amazonStar); ?>"/></th>
                                <th>Amazon Reviews <input type=text name="reviews"
                                        id="bookAmazonReview" value="<?php echo htmlentities($amazonReviews); ?>"/></th>
                                <th colspan=2>Amazon URL <input type=text size=50 name="url"
                                        id="bookAmazonURL" value="<?php echo htmlentities($amazonRevLink); ?>"/></th>
                        </tr>
                        <tr>
                                <th>Call Number</th>
                                <td><input type=text name="callNum" id="bookCallNumber" value="<?php echo htmlentities($callNum); ?>"/></td>
                                <th>Audience</th>
                                <td><input type=text name="audience" id="audience" value="<?php echo htmlentities($audience); ?>"/></td>
                        </tr>
                        <tr>
                                <th>Publisher</th>
                                <td><input type=text id="publisher" name="publisher" value="<?php echo htmlentities($publisherName); ?>"/></td>
                                <th>Published Date</th>
                                <td><input type=text name="publishedDate" id="bookPublishedYear" value="<?php echo htmlentities($pubDate); ?>"/></td>
                        </tr>
                        <tr>
                                <th>Product format Details</th>
                                <td><input type=text name="productFormat"
                                        id="bookProductFormatDetails" value="<?php echo htmlentities($productFormatDetail); ?>"/></td>
                                <th>Pages</th>
                                <td><input type=text name="pages" id="bookPages" value="<?php echo htmlentities($pages); ?>"/></td>
                        </tr>
                        <tr>
                                <th>From Back Cover</th>
                                <td><input type=text name="description" id="bookFromBackCover" value="<?php echo htmlentities($fromBackCover); ?>"/></td>
                        </tr>
                        <tr>
                                <th>Content</th>
                                <td><input type=text name="content" id="bookContent" value="<?php echo htmlentities($contents); ?>"/></td>
                        </tr>
                        <tr>
                                <th>Category<sup>*</sup>
                                </th>
                                <td><select id="bookCategory" name="category" >
                                                <option value="<?php echo htmlentities($category); ?>"><?php echo htmlentities($category); ?></option>
                                                
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
                                <th>SubCategory<sup>*</sup>
                                </th>
                                <td><select id="bookSubCategory" name="subCategory" >
                                                <option value="<?php echo htmlentities($subCat); ?>"> <?php echo htmlentities($subCat); ?> </option>
                                </select></td>
                        </tr>
                        <tr>
                                <th>SubSubCategory</th>
                                <td><select id="bookSubSubCategory" name="subSubCategory" >
                                                <option value="<?php echo htmlentities($subSubCat); ?>"> <?php echo htmlentities($subSubCat); ?></option>
                                </select></td>
                                <th>Keywords</th>
                                <td><input type=text name="keywords" id="bookKeywords" value="<?php echo htmlentities($keywords); ?>"/></td>
                        </tr>
                        <tr>
                                <th>Product Dimensions</th>
                                <td><input type=text name="dimensions" id="bookProductDimensions" value="<?php echo htmlentities($productDimensions); ?>"/></td>
                                <th>Shipping Weight</th>
                                <td><input type=text name="shippingWeight" id="bookShippingWeight" value="<?php echo htmlentities($shippingWeight); ?>"/></td>
                        </tr>
                </table>
                <button id="update" name="Go" onclick="validateAndSubmit();">Update</button>
        </form>

</body>
</html>