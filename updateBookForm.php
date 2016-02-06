<?php
session_start ();

/*added code for image upload by Unnam*/
if(isset( $_FILES['fileToUpload']['name'])){
	$getIsbn=$_SESSION['isbn'];
	$name = $_FILES['fileToUpload']['name'];
	$sourcepath = $_FILES['fileToUpload']['tmp_name'];
	$date = date_create();
	$filename = $getIsbn ;
	$targetPath = "coverimages/".$filename; // Target path where file is to be stored
	move_uploaded_file($sourcepath,$targetPath) ;    // Moving Uploaded file
	$_POST['isbn'] = $getIsbn;
	/*end of changes by Unnam*/
}
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


bible=new Array("A. General", "B. Bibles", "C. Biblical Studies", "D. Biblical Reference", "E. Old Testament", "F. Moses Books", "G. History Books", "H. Wisdom Literature", "I. Prophecy Books", "J. New Testament", "K. Jesus, Gospel, Acts", "L. Pauls Letters", "M. Common Letters", "N. Revelation", "O. Apocrypha");
theology=new Array("A. General", "B. Angelology and Demonology", "C. Anthropology", "D. Apologetics", "E. Christology", "F. Doctrinal", "G. Ecclesiology", "H. Eschatology", "I. Ethics", "J. History Theology", "K. Liberation Theology", "L. Mariology", "M. Pneumatology", "N. Process Theology", "O. Soteriology", "P. Systematic", "Q. Theological Thoughts");
christianlife=new Array("A. General", "B. Devotional", "C. Family", "D. Health and Emotion", "E. Inspirational", "F. Love and Marriage", "G. Mens Issues", "H. Parenting", "I. Personal Growth", "J. Prayer", "K. Professional Growth", "L. Relationships", "M. Servicing", "N. Social and Political Issues", "O. Spiritual Gifts", "P. Spiritual Growth", "Q. Spiritual Warfare", "R. Stewardship and Giving", "S. Trials and Suffering", "T. Understanding Gods Will", "U. Womens Issues ");
christianministry=new Array("A. General", "B. Adult", "C. Care", "D. Children", "E. Counseling and Recovery", "F. Discipleship", "G. Education", "H. Evangelism", "I.  Leadership", "J. Missions", "K. Pastoral Resources", "L. Preaching", "M. Rituals and Practices", "N. Youth");
churchandchurchhistory=new Array("A. General", "B. Administration", "C. Biography", "D. Cannon", "E. Denominations", "F. Church Growth", "G. Church History", "H. The Apostolic Period 35-120", "I.  The Apologists 120-220", "J. The 3rd Century 220-305", "K. Imperial Church 305-476", "L. Early Middle Ages 476-999", "M. High Middle Ages 1000-1299", "N. Renaissance 1399-1499", "O. Reformation 16th 1500-1599", "P. Puritans 17th 1600-1699", "Q. Great Awakening 18th 1700-1799", "R. Second Awakening 19th 1800-1899", "S. Modern 20th 1900- present");
cddvdother=new Array("A. General", "B. Audio Tapes", "C. Video Tapes", "D. Bible on CD", "E. Childrens Tapes, CDs, DVDs", "F. Christian Literature and Fiction", "G. Computer Software and other media", "H. Family", "I.  Holidays Music", "J. Hymnal", "K. Hymns Video/ Karaoke, Songs", "L. Playings/Instruments", "M. Sermons", "N. Testimonials");


BiblicalStudies=new Array("a. General", "b. Biblical Criticism, Interpretation", "c. Exegesis and Hermeneutics ");
BiblicalReference=new Array("a. General", "b. Commentary", "c. Concordance", "d. Dictionary", "e. Atlas", "f. Handbooks", "g. Language Study");
MosesBooks=new Array("a. General", "b. Genesis", "c. Exodus", "d. Leviticus", "e. Numbers", "f. Deuteronomy");
HistoryBooks=new Array("a. General", "b. Joshua", "c. Judges", "d. Ruth", "e. Samuel 1,2", "f. Kings 1,2", "g. Chronicles 1,2", "h. Ezra", "i. Nehemiah", "j. Esther");
WisdomLiterature=new Array("a. General", "b. Job", "c. Psalms", "d. Proverbs", "e. Ecclesiastes", "f. Song of Solomon");
ProphecyBooks=new Array("a. General", "b. Isaiah", "c. Jeremiah", "d. Lamentations", "e. Ezekiel", "f. Daniel", "g. Minor Prophets");
JesusGospelActs=new Array("a. General", "b. Matthew", "c. Mark", "d. Luke", "e. John", "f. Acts");
PaulsLetters=new Array("a. General", "b. Romans", "c. Corinthians 1,2", "d. Galatians", "e. Philippians", "f. Ephesians", "g. Colossians", "h. Thessalonians 1,2", "i. Timothy 1, 2", "j. Titus", "k. Philemon");
CommonLetters=new Array("a. General", "b. Hebrews", "c. James", "d. Peter 1,2", "e. John 1, 2, 3", "f. Jude");
Apologetics=new Array("a. General", "b. Other religions", "c. Cults", "d. Science", "e. Philosophy and Humanities", "f. Culture");
TheologicalThoughts=new Array("a. General", "b. Calvinism", "c. Arminianism", "d. Covenant", "e. Times", "f. Catholic", "g. Liberal", "h. New Orthodoxy", "i. Conservative, evangelical");
Education=new Array("a. General", "b. Adults", "c. Children and Youth");
Biography=new Array("a. General", "b. Biblical", "c. Modern American", "d. Modern Other Countries", "(ancient in history periods)");
Denominations=new Array("a. General", "b. Amish", "c. Anglican", "d. Baptist", "e. Calvinist", "f. Catholic", "g. Christian Science", "h. Episcopalian", "i. Jehovah's witness", "j. Lutheran", "k. Mennonite", "l. Methodist", "m. Mormon", "n. Orthodox", "o. Pentecostal and Charismatic", "p. Presbyterian", "q. Protestant", "r. Quaker", "s. Unitarian", "t. United Church of Christ");

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

	    if(subcat == 'C. Biblical Studies'){
			BiblicalStudies.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		
		if(subcat == 'D. Biblical Reference'){
			BiblicalReference.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == "F. Moses Books"){
			MosesBooks.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == 'G. History Books'){
			HistoryBooks.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == 'H. Wisdom Literature'){
			WisdomLiterature.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == 'I. Prophecy Books'){
			ProphecyBooks.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == 'K. Jesus, Gospel, Acts'){
			JesusGospelActs.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == "L. Pauls Letters"){
			PaulsLetters.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == 'M. Common Letters'){
			CommonLetters.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == 'D. Apologetics'){
			Apologetics.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == 'Q. Theological Thoughts'){
			TheologicalThoughts.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == 'G. Education'){
			Education.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == 'C. Biography'){
			Biography.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		if(subcat == 'E. Denominations'){
			Denominations.forEach(function(t) { 
	            $('#bookSubSubCategory').append('<option>'+t+'</option>');
	        });
		}
		
}

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
    else if ( isset($_POST['autofill'])) {

    
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
        $_SESSION["isbn"] = $_POST['isbn'];
       
        $checkingExist = "select * from books where isbn='" . $_POST['isbn'] . "' or isbn10='" . $_POST['isbn'] . "';";
       
        $result_indb = mysql_query ( $checkingExist ) or die ( "can not run the sql language:" . mysql_error () );
        $row = mysql_fetch_array( $result_indb );
       
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
        //error_log("ISBN VALUE after querying" .$isbn);
        $isbn10 = $row ['isbn10'];
        //error_log("ISBN10 VALUE after querying" .$isbn10);
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

        <form name = "isbnForm" action = "updateBookForm.php" method ="POST">
             ISBN-13 or ISBN-10 <sup>*</sup>
             <input id="isbn" name="isbn" type=text />
             <button  type = "submit" name="autofill" >Auto Fill</button>
        </form>
        
        <form method="POST" enctype="multipart/form-data" id="MyUploadForm"  action="updateBookForm.php">
        <table id="resultTable">
		<tr>
			<th> Cover Image </th>
			
			<td> <img src="coverimages/uploading.gif" id="loaded-img" style="display:none;"/>
				 <input type="file" name="fileToUpload" > </td>
			<td> <input type="submit" value="Upload" > </td>
		</tr>
		</table>
		</form>

        <form id="updateBookForm" name="update_book_form" action="updateBook.php" method="POST">
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
                                <td><input type=text name="description" id="bookFromBackCover" width = 1000px value="<?php echo htmlentities($fromBackCover); ?>"/></td>
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
                                                <option value="A. Bible">A. Bible</option>
                                                <option value="B. Theology">B. Theology</option>
                                                <option value="C. Christian Life">C. Christian Life</option>
                                                <option value="D. Christian Ministry">D. Christian Ministry</option>
                                                <option value="E. Church and Church History">E. Church and Church History</option>
                                                <option value="F. CD/DVD/Other">F. CD/DVD/Other</option>
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