<?php
session_start ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Insert Chinese Book</title>
<style type="text/css">
div.container {
	margin-top: 20px !important;
	padding: 10px !important;
	border: 1px solid #eee;
	border-radius: 10px;
	width: 60%;
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
/*
function populateSelect(){
	
    cat=$('#bookCategory').val();
    $('#bookSubCategory').html('');
   
	
    if(cat=='A. Bible'){
        bible.forEach(function(t) { 
            $('#bookSubCategory').append('<option>'+t+'</option>');
        });
    }
    
    if(cat=='B. Theology'){
        theology.forEach(function(t) {
            $('#bookSubCategory').append('<option>'+t+'</option>');
        });
    }
	
	if(cat=='C. Christian Life'){
		christianlife.forEach(function(t) {
            $('#bookSubCategory').append('<option>'+t+'</option>');
        });
    }
    
	if(cat=='D. Christian Ministry'){
		christianministry.forEach(function(t) {
            $('#bookSubCategory').append('<option>'+t+'</option>');
        });
    }
	
	
	if(cat=='E. Church and Church History'){
		churchandchurchhistory.forEach(function(t) {
            $('#bookSubCategory').append('<option>'+t+'</option>');
        });
    }
	
	if(cat=='F. CD/DVD/Other'){
		cddvdother.forEach(function(t) {
            $('#bookSubCategory').append('<option>'+t+'</option>');
        });
    }

}
*/

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


	function fetchInfo() {
		$.ajax({ // ajax call starts
		    //url: "extractBookInfo.php?isbn=" + $('#isbn').val(), // JQuery loads serverside.php
                    url: "extractBookInfoCampus.php?isbn=" + $('#isbn').val(), // JQuery loads serverside.php
		    type: "GET",
	        //dataType: 'json',

	        success: function(data) {
				/*code changes for fixing the autofill using isbn
				Added by Unnam on 7/27/2015 */
/*
				var tempIndex = data.indexOf("reviews\": ,");
				var temp2 = data.substr(0, tempIndex+9);
				var temp4 = data.substr(tempIndex+9);
				var temp3 = "\"\"";
				var temp5= temp2+temp3+temp4;
				data = temp5;
				alert(temp5);
*/
				/*end of changes by Unnam*/
		        
	        	try {
				  	$.each( JSON.parse(data), function( key, val ) {
				  		if (key == 'error') {
					    	alert(val);
				  			return;
					    } else if (key == 'title') {
					    	$('#title').val(val);
					    } else if (key == 'altTitle') {
					    	$('#bookAltTitle').val(val);
					    } else if (key == 'author') {
					    	$('#author').val(val);
					    } else if (key == 'language') {
					    	$('#bookLanguage').val(val);
					    } else if (key == 'publisher') {
					    	$('#publisher').val(val);
					    } else if (key == 'publishedDate') {
					    	$('#bookPublishedYear').val(val);
					    } else if (key == 'productFormat') {
					    	$('#bookProductFormatDetails').val(val);
					    } else if (key == 'pages') {
					    	$('#bookPages').val(val);
					    } else if (key == 'isbn10') {
					    	$('#isbn').val(val);
					    } else if (key == 'isbn13') {
					    	$('#isbn13').val(val);
					    } else if (key == 'productDimensions') {
					    	$('#bookProductDimensions').val(val);
					    } else if (key == 'shippingWeight') {
					    	$('#bookShippingWeight').val(val);
					    } else if (key == 'rating') {
					    	$('#bookAmazonStar').val(val);
					    } else if (key == 'category') {
					    	$('#bookCategory').append('<option value="' + val + '" selected>' + val + '</option>');
					    } else if (key == 'subCategory') {
					    	$('#bookSubCategory').append('<option value="' + val + '" selected>' + val + '</option>');
					    } else if (key == 'subSubCategory') {
					    	$('#bookSubSubCategory').append('<option value="' + val + '" selected>' + val + '</option>');
					    } else if (key == 'reviews') {
					    	$('#bookAmazonReview').val(val);
					    } else if (key == 'description') {
					    	$('#bookFromBackCover').val(val);
					    } else if (key == 'url') {
					    	$('#bookAmazonURL').val(val);
					    } else if (key == 'keywords') {
					    	$('#bookKeywords').val(val);
					    } else if (key == 'result') {
					    	alert(" Found " + val + " Results");
					    }
					});
				} catch(err) {

					var length = data.length;
					var trimmedData = data.substring(2, length -2);
					alert (trimmedData);
					trimmedData.split('","').forEach(function(entry) {
						var splittedEntry = entry.split('": "');
						var key = splittedEntry[0];
						var val = splittedEntry[1];
						if (key == 'error') {
					    	alert(val);
				  			return;
					    } else if (key == 'title') {
					    	$('#title').val(val);
					    } else if (key == 'altTitle') {
					    	$('#bookAltTitle').val(val);
					    } else if (key == 'author') {
					    	$('#author').val(val);
					    } else if (key == 'language') {
					    	$('#bookLanguage').val(val);
					    } else if (key == 'publisher') {
					    	$('#publisher').val(val);
					    } else if (key == 'publishedDate') {
					    	$('#bookPublishedYear').val(val);
					    } else if (key == 'productFormat') {
					    	$('#bookProductFormatDetails').val(val);
					    } else if (key == 'pages') {
					    	$('#bookPages').val(val);
					    } else if (key == 'isbn10') {
					    	$('#isbn').val(val);
					    } else if (key == 'isbn13') {
					    	$('#isbn13').val(val);
					    } else if (key == 'productDimensions') {
					    	$('#bookProductDimensions').val(val);
					    } else if (key == 'shippingWeight') {
					    	$('#bookShippingWeight').val(val);
					    } else if (key == 'rating') {
					    	$('#bookAmazonStar').val(val);
					    } else if (key == 'reviews') {
					    	$('#bookAmazonReview').val(val);
					    } else if (key == 'description') {
					    	$('#bookFromBackCover').val(val);
					    } else if (key == 'category') {
					    	$('#bookCategory').append('<option value="' + val + '" selected>' + val + '</option>');
					    } else if (key == 'subCategory') {
					    	$('#bookSubCategory').append('<option value="' + val + '" selected>' + val + '</option>');
					    } else if (key == 'audience') {
					    	$('#audience').val(val);
					    } else if (key == 'url') {
					    	$('#bookAmazonURL').val(val);
					    } else if (key == 'keywords') {
					    	$('#bookKeywords').val(val);
					    } else if (key == 'result') {
					    	alert(" Found " + val + " Results");
					    }
					});
					// alert("Unable to get book information for the ISBN provided ; "   + err);

				}
			}
		});
	}

    function generateISBN() {
    	//alert("Do you want to generate new ISBN");
    	 	$.ajax({
             method: "POST",
             url: "generateISBN.php",
           }).done(function( response ) {
               responseJSON = JSON.parse(response);
               if (responseJSON['error'] != undefined) {
                   alert("Error occured while generating new ISBN. Please try again");
               }
               else {
            	   alert("ISBN generated successfully");
                   var newisbn = responseJSON['newisbn'];
                   $('#isbn').val(newisbn);
               }
           });
        }    

    function insertBook() {
        if ($('#bookCategory').val() == "") {
            alert("Please select a Category");
        } else if ($('#bookSubCategory').val() == "") {
            alert("Please select a Subcategory");
        } else if ($('#title').val() == "") {
        	alert("Please enter a Title");
        } else if ($('#author').val() == "") {
        	alert("Please enter Authors");
        }
    }

    //var categoriesJSONList = getCategoriesJSONList();
    //$(document).ready(function() {
//     	$('#bookCategory').empty();
//       	$('#bookCategory').append(new Option('Category', '', true, true));
//       	$('#bookSubCategory').empty();
//       	$('#bookSubCategory').append(new Option('Subcategory', '', true, true));
//       	$('#bookSubSubCategory').empty();
//       	$('#bookSubSubCategory').append(new Option('Sub-Subcategory', '', true, true));
//     	$.each(categoriesJSONList, function(k,v) {
//     		$('#bookCategory').append(new Option(k, k, false, false));
//     	});

//     	$('#bookCategory').change(function() {
//           $('#bookSubCategory').empty();
//           $('#bookSubCategory').append(new Option('Subcategory', '', true, true));
//           $('#bookSubSubCategory').empty();
//           $('#bookSubSubCategory').append(new Option('Sub-Subcategory', '', true, true));
//           $.each(categoriesJSONList[$('#bookCategory').val()], function(k, v) {
//               $('#bookSubCategory').append(new Option(k, k, false, false));
//           });
//       });  

//       $('#bookSubCategory').change(function() {
//           $('#bookSubSubCategory').empty();
//           $('#bookSubSubCategory').append(new Option('Sub-Subcategory', '', true, true));
//           $.each(categoriesJSONList[$('#bookCategory').val()][$('#bookSubCategory').val()], function(k, v) {
//               $('#bookSubSubCategory').append(new Option(v, v, false, false));
//           });
   //   });



    <?php
				if (! isset ( $_SESSION ['type'] ) || $_SESSION ['type'] != 'Store') {
					echo " window.location.href='homepage.php';";
				}
				if (! empty ( $_POST )) {
					?>
		$('#title').val('<?php echo $_POST['title']; ?>');
		$('#author').val('<?php echo $_POST['author']; ?>');
		$('#publisher').val('<?php echo $_POST['publisher']; ?>');
		$('#bookPublishedYear').val('<?php echo $_POST['publishedDate']; ?>');
		$('#bookProductFormatDetails').val('<?php echo $_POST['productFormat']; ?>');
		$('#bookPages').val('<?php echo $_POST['pages']; ?>');
		$('#bookLanguage').val('<?php echo $_POST['language']; ?>');
		$('#isbn').val('<?php echo $_POST['isbn']; ?>');
		$('#isbn13').val('<?php echo $_POST['isbn13']; ?>');
		$('#bookProductDimensions').val('<?php echo $_POST['dimensions']; ?>');
		$('#bookShippingWeight').val('<?php echo $_POST['shippingWeight']; ?>');
		$('#bookAmazonStar').val('<?php echo $_POST['rating']; ?>');
		$('#bookAmazonReview').val('<?php echo $_POST['reviews']; ?>');
		$('#bookFromBackCover').val('<?php echo str_replace("'", "\'", $_POST['description']); ?>');
    	$('#bookAmazonURL').val('<?php echo $_POST['url']; ?>');

    	$('#bookAltTitle').val('<?php echo $_POST['altTitle']; ?>');
    	$('#bookSubTitle').val('<?php echo $_POST['subTitle']; ?>');
    	$('#bookEdition').val('<?php echo $_POST['edition']; ?>');
    	$('#bookEditionType').val('<?php echo $_POST['editionType']; ?>');
    	$('#bookCallNumber').val('<?php echo $_POST['callNum']; ?>');
    	$('#audience').val('<?php echo $_POST['audience']; ?>');
    	$('#bookContent').val('<?php echo $_POST['content']; ?>');
    	$('#bookCategory').val('<?php echo $_POST['category']; ?>');
    	$('#bookSubCategory').val('<?php echo $_POST['subCategory']; ?>');
    	$('#bookSubSubCategory').val('<?php echo $_POST['subSubCategory']; ?>');
    	$('#bookKeywords').val('<?php echo $_POST['keywords']; ?>');

    	<?php
					ob_start ();
					
					$storeID = $_SESSION ['storeID'];
					$title = $_POST ['title'];
					$author = $_POST ['author'];
					$publisher = $_POST ['publisher'];
					$bookPublishedYear = $_POST ['publishedDate'];
					$bookProductFormatDetails = $_POST ['productFormat'];
					$bookPages = $_POST ['pages'];
					$bookLanguage = $_POST ['language'];
					$isbn = $_POST ['isbn'];
					$isbn13 = $_POST ['isbn13'];
					if ($isbn13 == '') {
						$isbn13 = $isbn;
					}
					$bookProductDimensions = $_POST ['dimensions'];
					$bookShippingWeight = $_POST ['shippingWeight'];
					$bookAmazonStar = $_POST ['rating'];
					$bookAmazonReview = $_POST ['reviews'];
					$bookFromBackCover = str_replace ( "'", "\'", $_POST ['description'] );
					$bookAmazonURL = $_POST ['url'];
					
					$bookAltTitle = $_POST ['altTitle'];
					$bookSubTitle = $_POST ['subTitle'];
					$bookEdition = $_POST ['edition'];
					$bookEditionType = $_POST ['editionType'];
					$bookCallNumber = $_POST ['callNum'];
					$audience = $_POST ['audience'];
					$bookContent = $_POST ['content'];
					$bookCategory = $_POST ['category'];
					$bookSubCategory = $_POST ['subCategory'];
					$bookSubSubCategory = $_POST ['subSubCategory'];
					$bookKeywords = $_POST ['keywords'];
					
					if ($title == null && $isbn == null && $isbn13 == null && $author == null && $bookSubCategory == null && $bookCategory == null) {
						// do nothing
					} else if ($title == null || $isbn == null || $isbn13 == null || $author == null || $bookSubCategory == null || $bookCategory == null) {
						echo 'alert("One of the required field is missing. Please make sure all the fields marked with * are filled correctly");';
					} else {
						$checkingduplicate = "select * from books where isbn='" . $isbn13 . "' or isbn10='" . $isbn . "'";
						$sql = "INSERT INTO `books`(`title`, `insertDate`, `isbn`, `isbn10`, `author`, `publisherName`, `callNum`, `subTitle`, `altTitle`, `audience`, `language`, `editionType`, `editionNumber`, `amazonStar`, `amazonReviews`, `amazonRevLink`, `category`, `subCat`, `subSubCat`, `pubDate`, `keywords`, `contents`, `fromBackCover`, `productFormatDetail`, `productDimensions`, `shippingWeight`, `pages`) VALUES ('" . $title . "', CURRENT_DATE, '" . $isbn13 . "','" . $isbn . "','" . $author . "','" . $publisher . "','" . $bookCallNumber . "','" . $bookSubTitle . "','" . $bookAltTitle . "','" . $audience . "','" . $bookLanguage . "','" . $bookEditionType . "','" . $bookEdition . "','" . $bookAmazonStar . "','" . $bookAmazonReview . "','" . $bookAmazonURL . "','" . $bookCategory . "','" . $bookSubCategory . "','" . $bookSubSubCategory . "','" . $bookPublishedYear . "','" . $bookKeywords . "','" . $bookContent . "','" . $bookFromBackCover . "','" . $bookProductFormatDetails . "','" . $bookProductDimensions . "','" . $bookShippingWeight . "','" . $bookPages . "')";
						
						$dbconn = mysql_connect ( "localhost", "webclient", "12345678" ) or die ( "database error!" . mysql_error () );
						mysql_select_db ( "bookstore" ) or die ( "can not connect database：" . mysql_error () );
						
						$result_indb = mysql_query ( $checkingduplicate ) or die ( "can not run the sql language:" . mysql_error () );
						
						if (mysql_fetch_row ( $result_indb )) {
							echo 'alert("Book matching the isbn-10/isbn-13 already exists");';
						} else {
							$result = mysql_query ( $sql );
							if (! $result) {
								echo 'alert("Unable to insert the book. Please try again");';
								echo "//" . $sql;
							} else {
								echo 'alert("Book insert successfull.");';
								echo 'window.location.href = "homepage.php";';
							}
						}
					}
				}
				?>

		$(document).on({
    		ajaxStart: function() { $("#loading").show();    },
     		ajaxStop: function() { $("#loading").hide(); }    
		});
    
</script>
</head>
<?php include 'NavigationBar.php'; ?>

<body>

	<h2>输入中文书籍</h2>
	<div class="container" id="insertbook" align="center">

		<form id="insertBookForm" name="insert_book_form"
			action="insertCampbook.php" method="POST">
			<table id="resultTable">
				<tr>
					<th>ISBN-10<sup>*</sup></th>
					<td><input id="isbn" name="isbn" type=text /></td>
					<th>ISBN-13</th>
					<td><input id="isbn13" name="isbn13" type=text /></td>
					<td width=90%><a href="#" id="search" name="Go" onclick="fetchInfo()">自动填充</a></td>
				</tr>

                                <tr>
					<th>如果本书没有ISBN</th>
					<td><input type="button" id="reqISBN" name="reqISBN"
						onclick="generateISBN();" value="请求 ISBN" /></td>
						
        			</tr>

				<tr>
					<th>书名<sup>*</sup>
					</th>
					<td><input type=text id="title" name="title" /></td>
					<th>英文书名</th>
					<td><input type=text name="altTitle" id="bookAltTitle" /></td>
				</tr>
				<tr>
					<th>副标题</th>
					<td><input id="bookSubTitle" name="subTitle" type=text /></td>
					<th>语言</th>
					<td><input id="bookLanguage" name="language" type=text /></td>
				</tr>
				<tr>
					<th>作者<sup>*</sup></th>
					<td><input type=text id="author" name="author" t /></td>
				</tr>
				<tr>
					<th>版本</th>
					<td><input type=text name="edition" id="bookEdition" /></td>
					<th>版本类型</th>
					<td><input type=text name="editionType" id="bookEditionType" /></td>
				</tr>
				<tr>
					<th>Amazon Star <input type=text name="rating" id="bookAmazonStar" /></th>
					<th>Amazon Reviews <input type=text name="reviews"
						id="bookAmazonReview" /></th>
					<th colspan=2>Amazon URL <input type=text size=50 name="url"
						id="bookAmazonURL" /></th>
				</tr>
				<tr>
					<th>本馆书号</th>
					<td><input type=text name="callNum" id="bookCallNumber" /></td>
					<th>读者</th>
					<td><input type=text name="audience" id="audience" /></td>
				</tr>
				<tr>
					<th>出版社</th>
					<td><input type=text id="publisher" name="publisher" /></td>
					<th>出版日期</th>
					<td><input type=text name="publishedDate" id="bookPublishedYear" /></td>
				</tr>
				<tr>
					<th>产品信息</th>
					<td><input type=text name="productFormat"
						id="bookProductFormatDetails" /></td>
					<th>页数</th>
					<td><input type=text name="pages" id="bookPages" /></td>
				</tr>
				<tr>
					<th>书背信息</th>
					<td><input type=text name="description" id="bookFromBackCover" /></td>
				</tr>
				<tr>
					<th>目录</th>
					<td><input type=text name="content" id="bookContent" /></td>
				</tr>
				<tr>
					<th>主类<sup>*</sup>
					</th>
					<td><select id="bookCategory" name="category">
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
					<th>次类<sup>*</sup>
					</th>
					<td><select id="bookSubCategory" name="subCategory">
							<option value="">次类</option>
					</select></td>
				</tr>
				<tr>
					<th>小类</th>
				 	<td><select id="bookSubSubCategory" name="subSubCategory">
							<option value="">Sub-Subcategory</option>
					</select></td>
					<th>关键字</th>
					<td><input type=text name="keywords" id="bookKeywords" /></td>
				</tr>
				<tr>
					<th>尺寸</th>
					<td><input type=text name="dimensions" id="bookProductDimensions" /></td>
					<th>重量</th>
					<td><input type=text name="shippingWeight" id="bookShippingWeight" /></td>
				</tr>
			</table>
			<button id="search" name="Go" onclick="javascript:insertBook();">提交</button>
		</form>

	</div>
	<div id="loading"></div>
</body>
</html>