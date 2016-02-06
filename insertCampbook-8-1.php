<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Insert Book</title>
<style type="text/css">
	div.container {
		margin-top:20px !important;
		padding:10px !important;
		border:1px solid #eee;
		border-radius: 10px;
		width:50%;
		margin:auto;
	}

	input, button {
		margin:10px;
	}

	a {
		font-size: 0.8em;
	}

	button {
		padding: 5px;
  		border-radius: 4px;
	}


	div#loading {
		display:    none;
    	position:   fixed;
    	z-index:    1000;
    	top:        0;
    	left:       0;
    	height:     100%;
    	width:      100%;
		background: rgba(0, 0, 0, 0.8)
					url('coverimages/ajax_loader_gray_350.gif') 
                	50% 50% 
                	no-repeat;
	}
</style>
<script type="text/javascript" src='js/jquery-2.1.1.min.js'></script>
<script type="text/javascript" src='js/categories.js'></script>
<script type="text/javascript">
	function fetchInfo() {
		$.ajax({ // ajax call starts
		    url: "extractBookInfoCampus.php?isbn=" + $('#isbn').val(), // JQuery loads serverside.php
		    type: "GET",
	        //dataType: 'json',

	        success: function(data) {

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

    var categoriesJSONList = getCategoriesJSONList();
    $(document).ready(function() {
    	$('#bookCategory').empty();
      	$('#bookCategory').append(new Option('Category', '', true, true));
      	$('#bookSubCategory').empty();
      	$('#bookSubCategory').append(new Option('Subcategory', '', true, true));
      	$('#bookSubSubCategory').empty();
      	$('#bookSubSubCategory').append(new Option('Sub-Subcategory', '', true, true));
    	$.each(categoriesJSONList, function(k,v) {
    		$('#bookCategory').append(new Option(k, k, false, false));
    	});

    	$('#bookCategory').change(function() {
          $('#bookSubCategory').empty();
          $('#bookSubCategory').append(new Option('Subcategory', '', true, true));
          $('#bookSubSubCategory').empty();
          $('#bookSubSubCategory').append(new Option('Sub-Subcategory', '', true, true));
          $.each(categoriesJSONList[$('#bookCategory').val()], function(k, v) {
              $('#bookSubCategory').append(new Option(k, k, false, false));
          });
      });  

      $('#bookSubCategory').change(function() {
          $('#bookSubSubCategory').empty();
          $('#bookSubSubCategory').append(new Option('Sub-Subcategory', '', true, true));
          $.each(categoriesJSONList[$('#bookCategory').val()][$('#bookSubCategory').val()], function(k, v) {
              $('#bookSubSubCategory').append(new Option(v, v, false, false));
          });
      });



    <?php 
    	if(!isset($_SESSION['type']) || $_SESSION['type'] != 'Store') {
            echo " window.location.href='homepage.php';";
        }
        
    	if (!empty($_POST)) { ?>
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
		    ob_start(); 
			
			$storeID = $_SESSION['storeID'];
			$title = $_POST['title'];
			$author = $_POST['author'];
			$publisher = $_POST['publisher'];
			$bookPublishedYear = $_POST['publishedDate'];
			$bookProductFormatDetails = $_POST['productFormat'];
			$bookPages = $_POST['pages'];
			$bookLanguage = $_POST['language'];
			$isbn = $_POST['isbn'];
			$isbn13 = $_POST['isbn13'];
			if($isbn13 == '') {
				$isbn13 = $isbn;
			}
			$bookProductDimensions = $_POST['dimensions'];
			$bookShippingWeight = $_POST['shippingWeight'];
			$bookAmazonStar = $_POST['rating'];
			$bookAmazonReview = $_POST['reviews'];
			$bookFromBackCover = str_replace("'", "\'", $_POST['description']);
			$bookAmazonURL = $_POST['url'];

			$bookAltTitle = $_POST['altTitle'];
			$bookSubTitle = $_POST['subTitle'];
			$bookEdition = $_POST['edition'];
			$bookEditionType = $_POST['editionType'];
			$bookCallNumber = $_POST['callNum'];
			$audience = $_POST['audience'];
			$bookContent = $_POST['content'];
			$bookCategory = $_POST['category'];
			$bookSubCategory = $_POST['subCategory'];
			$bookSubSubCategory = $_POST['subSubCategory'];
			$bookKeywords = $_POST['keywords'];

			
			if($title == null && $isbn == null &&  $isbn13 == null &&  $author == null && $bookSubCategory == null &&  $bookCategory == null)  {
				//do nothing
			} else if($title == null || $isbn == null || $isbn13 == null || $author == null || $bookSubCategory == null || $bookCategory == null) {
		        echo 'alert("One of the required field is missing. Please make sure all the fields marked with * are filled correctly");';
		    } else {  
				$checkingduplicate = "select * from books where isbn='".$isbn13."' or isbn10='".$isbn."'";
				$sql="INSERT INTO `books`(`title`, `insertDate`, `isbn`, `isbn10`, `author`, `publisherName`, `callNum`, `subTitle`, `altTitle`, `audience`, `language`, `editionType`, `edtionNumber`, `amzonStar`, `amazonReviews`, `amazonRevLink`, `category`, `subCat`, `subSubCat`, `pubDate`, `keywords`, `contents`, `fromBackCover`, `productFormatDetail`, `productDimensions`, `shippingWeight`, `pages`) VALUES ('".$title."', CURRENT_DATE, '".$isbn13."','".$isbn."','".$author."','".$publisher."','".$bookCallNumber."','".$bookSubTitle."','".$bookAltTitle."','".$audience."','".$bookLanguage."','".$bookEditionType."','".$bookEdition."','".$bookAmazonStar."','".$bookAmazonReview."','".$bookAmazonURL."','".$bookCategory."','".$bookSubCategory."','".$bookSubSubCategory."','".$bookPublishedYear."','".$bookKeywords."','".$bookContent."','".$bookFromBackCover."','".$bookProductFormatDetails."','".$bookProductDimensions."','".$bookShippingWeight."','".$bookPages."')";
				 
	            $dbconn = mysql_connect("localhost","webclient","12345678") or die("database error!".mysql_error());  
	            mysql_select_db("bookstore") or die("can not connect database：".mysql_error());  
	       
	            $result_indb = mysql_query($checkingduplicate) or die("can not run the sql language:".mysql_error());  
		          
				if(mysql_fetch_row($result_indb))
				{
		        	echo 'alert("Book matching the isbn-10/isbn-13 already exists");';
				}
				else
				{  
					$result = mysql_query($sql);
					if (!$result) {
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
    });


</script>
</head>
<?php include 'NavigationBar.php'; ?>

<body>
<h2> Insert Book (Register New ISBN)</h2>
<div class="container" id="insertbook"  align="center">

<form id="insertBookForm" name="insert_book_form" action="insertCampBook.php" method="POST">
	<table id="resultTable">
       <tr> 
        <th> ISBN-10 </th><td ><input id="isbn" name="isbn" type=text/></td>
        <th> ISBN-13 </th><td ><input id="isbn13" name="isbn13" type=text/></td>
        <td><a href="#" id="search" name="Go" onclick="fetchInfo()">Auto Fill</a></td>
      </tr>
			<tr> 
				<th> Title<sup>*</sup> </th><td><input  type=text id="title" name="title" /></td>
        <th> Alt Title </th><td><input  type=text name="altTitle" id="bookAltTitle"/></td>
			</tr>
			<tr> 
				<th> Sub-Title </th><td ><input id="bookSubTitle" name="subTitle" type=text/></td>
				<th> Language </th><td ><input id="bookLanguage" name="language" type=text/></td>
			</tr>
			<tr>
				<th> Authors<sup>*</sup></th><td><input type=text id="author" name="author"  t/></td>
			</tr>
			<tr> 
				<th> Edition Number </th><td><input type=text name="edition" id="bookEdition"/></td>
				<th> Edition Type </th><td><input type=text name="editionType" id="bookEditionType"/></td>
			</tr>
			<tr> 
				<th> Amazon Star <input type=text name="rating" id="bookAmazonStar"/></th>
				<th> Amazon Reviews <input type=text name="reviews" id="bookAmazonReview"/></th>
				<th colspan=2> Amazon URL <input type=text size=50 name="url" id="bookAmazonURL"/></th>
			</tr>
			<tr>
				<th> Call Number </th><td><input type=text name="callNum" id="bookCallNumber"/></td>
				<th> Audience </th><td><input type=text name="audience" id="audience"/></td>
			</tr>
			<tr> 
				<th> Publisher </th><td><input type=text id="publisher" name="publisher" /></td>
				<th> Published Date </th><td><input type=text name="publishedDate" id="bookPublishedYear"/></td>
			</tr>
			<tr> 
				<th> Product format Details </th><td><input type=text name="productFormat" id="bookProductFormatDetails"/></td>
				<th> Pages </th><td><input type=text name="pages" id="bookPages"/></td>
			</tr>
			<tr>
				<th> From Back Cover </th><td><input type=text name="description" id="bookFromBackCover"/></td>
			</tr>
			<tr>
				<th> Content </th><td><input type=text name="content" id="bookContent"/></td>
			</tr>
			<tr> 
				<th> Category<sup>*</sup> </th>
				<td>
					<select id="bookCategory" name="category">
                      <option value=""/>
                      <option value="ANTIQUES &amp; COLLECTIBLES">ANTIQUES &amp; COLLECTIBLES</option>
                      <option value="ARCHITECTURE">ARCHITECTURE</option>
                      <option value="ART">ART</option>
                      <option value="BIBLES">BIBLES</option>
                      <option value="BIOGRAPHY &amp; AUTOBIOGRAPHY">BIOGRAPHY</option>
                      <option value="BODY, MIND &amp; SPIRIT">BODY, MIND &amp; SPIRIT</option>
                      <option value="BUSINESS &amp; ECONOMICS">BUSINESS &amp; ECONOMICS</option>
                      <option value="COMICS &amp; GRAPHIC NOVELS">COMICS &amp; GRAPHIC NOVELS</option>
                      <option value="COMPUTERS">COMPUTERS</option>
                      <option value="COOKING">COOKING</option>
                      <option value="CRAFTS &amp; HOBBIES">CRAFTS &amp; HOBBIES</option>
                      <option value="DESIGN">DESIGN</option>
                      <option value="DRAMA">DRAMA</option>
                      <option value="EDUCATION">EDUCATION</option>
                      <option value="FAMILY &amp; RELATIONSHIPS">FAMILY &amp; RELATIONSHIPS</option>
                      <option value="FICTION">FICTION</option>
                      <option value="FOREIGN LANGUAGE STUDY">FOREIGN LANGUAGE STUDY</option>
                      <option value="GAMES">GAMES</option>
                      <option value="GARDENING">GARDENING</option>
                      <option value="HEALTH &amp; FITNESS">HEALTH &amp; FITNESS</option>
                      <option value="HISTORY">HISTORY</option>
                      <option value="HOUSE &amp; HOME">HOUSE &amp; HOME</option>
                      <option value="HUMOR">HUMOR</option>
                      <option value="JUVENILE FICTION">JUVENILE FICTION</option>
                      <option value="JUVENILE NONFICTION">JUVENILE NONFICTION</option>
					</select>
				</td>
				<th> SubCategory<sup>*</sup> </th>
				<td>
					<select id="bookSubCategory" name="subCategory">
                      <option value=""/>
                      <option value="ANTIQUES &amp; COLLECTIBLES">ANTIQUES &amp; COLLECTIBLES</option>
                      <option value="ARCHITECTURE">ARCHITECTURE</option>
                      <option value="ART">ART</option>
                      <option value="BIBLES">BIBLES</option>
                      <option value="BIOGRAPHY &amp; AUTOBIOGRAPHY">BIOGRAPHY</option>
                      <option value="BODY, MIND &amp; SPIRIT">BODY, MIND &amp; SPIRIT</option>
                      <option value="BUSINESS &amp; ECONOMICS">BUSINESS &amp; ECONOMICS</option>
                      <option value="COMICS &amp; GRAPHIC NOVELS">COMICS &amp; GRAPHIC NOVELS</option>
                      <option value="COMPUTERS">COMPUTERS</option>
                      <option value="COOKING">COOKING</option>
                      <option value="CRAFTS &amp; HOBBIES">CRAFTS &amp; HOBBIES</option>
                      <option value="DESIGN">DESIGN</option>
                      <option value="DRAMA">DRAMA</option>
                      <option value="EDUCATION">EDUCATION</option>
                      <option value="FAMILY &amp; RELATIONSHIPS">FAMILY &amp; RELATIONSHIPS</option>
                      <option value="FICTION">FICTION</option>
                      <option value="FOREIGN LANGUAGE STUDY">FOREIGN LANGUAGE STUDY</option>
                      <option value="GAMES">GAMES</option>
                      <option value="GARDENING">GARDENING</option>
                      <option value="HEALTH &amp; FITNESS">HEALTH &amp; FITNESS</option>
                      <option value="HISTORY">HISTORY</option>
                      <option value="HOUSE &amp; HOME">HOUSE &amp; HOME</option>
                      <option value="HUMOR">HUMOR</option>
                      <option value="JUVENILE FICTION">JUVENILE FICTION</option>
                      <option value="JUVENILE NONFICTION">JUVENILE NONFICTION</option>
					</select>
				</td>
			</tr>
			<tr> 
				<th> SubSubCategory </th>
				<td>
					<select id="bookSubSubCategory" name="subSubCategory">
                      <option value=""/>
                      <option value="ANTIQUES &amp; COLLECTIBLES">ANTIQUES &amp; COLLECTIBLES</option>
                      <option value="ARCHITECTURE">ARCHITECTURE</option>
                      <option value="ART">ART</option>
                      <option value="BIBLES">BIBLES</option>
                      <option value="BIOGRAPHY &amp; AUTOBIOGRAPHY">BIOGRAPHY</option>
                      <option value="BODY, MIND &amp; SPIRIT">BODY, MIND &amp; SPIRIT</option>
                      <option value="BUSINESS &amp; ECONOMICS">BUSINESS &amp; ECONOMICS</option>
                      <option value="COMICS &amp; GRAPHIC NOVELS">COMICS &amp; GRAPHIC NOVELS</option>
                      <option value="COMPUTERS">COMPUTERS</option>
                      <option value="COOKING">COOKING</option>
                      <option value="CRAFTS &amp; HOBBIES">CRAFTS &amp; HOBBIES</option>
                      <option value="DESIGN">DESIGN</option>
                      <option value="DRAMA">DRAMA</option>
                      <option value="EDUCATION">EDUCATION</option>
                      <option value="FAMILY &amp; RELATIONSHIPS">FAMILY &amp; RELATIONSHIPS</option>
                      <option value="FICTION">FICTION</option>
                      <option value="FOREIGN LANGUAGE STUDY">FOREIGN LANGUAGE STUDY</option>
                      <option value="GAMES">GAMES</option>
                      <option value="GARDENING">GARDENING</option>
                      <option value="HEALTH &amp; FITNESS">HEALTH &amp; FITNESS</option>
                      <option value="HISTORY">HISTORY</option>
                      <option value="HOUSE &amp; HOME">HOUSE &amp; HOME</option>
                      <option value="HUMOR">HUMOR</option>
                      <option value="JUVENILE FICTION">JUVENILE FICTION</option>
                      <option value="JUVENILE NONFICTION">JUVENILE NONFICTION</option>
					</select>
				</td>
				<th> Keywords </th><td><input type=text name="keywords" id="bookKeywords"/></td>
			</tr>
			<tr> 
				<th> Product Dimensions </th><td><input type=text name="dimensions" id="bookProductDimensions"/></td>
				<th> Shipping Weight </th><td><input type=text name="shippingWeight" id="bookShippingWeight"/></td>
			</tr>
		</table>
		<button id="search" name="Go" onclick="javascript:insertBook();">Insert</button>
	</form>

</div>
<div id="loading">
</div>
</body>
</html>