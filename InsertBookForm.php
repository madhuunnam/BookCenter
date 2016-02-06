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

input {
	margin: 10px;
}
input[type=button] {
    		-webkit-appearance: none;
  			height: 1.5em;
  			width: 9em;
  			font-size: 0.8em;
  			border-radius: 5px;
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

bible=new Array("A. General", "B. Bibles", "C. Biblical Studies", "D. Biblical Reference", "E. Old Testament", "F. Moses's Books", "G. History Books", "H. Wisdom Literature", "I. Prophecy Books", "J. New Testament", "K. Jesus, Gospel, Acts", "L. Paul's Letters", "M. Common Letters", "N. Revelation", "O. Apocrypha");
theology=new Array("A. General", "B. Angelology and Demonology", "C. Anthropology", "D. Apologetics", "E. Christology", "F. Doctrinal", "G. Ecclesiology", "H. Eschatology", "I. Ethics", "J. History Theology", "K. Liberation Theology", "L. Mariology", "M. Pneumatology", "N. Process Theology", "O. Soteriology", "P. Systematic", "Q. Theological Thoughts");
christianlife=new Array("A. General", "B. Devotional", "C. Family", "D. Health and Emotion", "E. Inspirational", "F. Love and Marriage", "G. Men's Issues", "H. Parenting", "I. Personal Growth", "J. Prayer", "K. Professional Growth", "L. Relationships", "M. Servicing", "N. Social and Political Issues", "O. Spiritual Gifts", "P. Spiritual Growth", "Q. Spiritual Warfare", "R. Stewardship and Giving", "S. Trials and Suffering", "T. Understanding God's Will", "U. Women's Issues ");
christianministry=new Array("A. General", "B. Adult", "C. Care", "D. Children", "E. Counseling and Recovery", "F. Discipleship", "G. Education", "H. Evangelism", "I.  Leadership", "J. Missions", "K. Pastoral Resources", "L. Preaching", "M. Rituals and Practices", "N. Youth");
churchandchurchhistory=new Array("A. General", "B. Administration", "C. Biography", "D. Cannon", "E. Denominations", "F. Church Growth", "G. Church History", "H. The Apostolic Period 35-120", "I.  The Apologists 120-220", "J. The 3rd Century 220-305", "K. Imperial Church 305-476", "L. Early Middle Ages 476-999", "M. High Middle Ages 1000-1299", "N. Renaissance 1399-1499", "O. Reformation 16th 1500-1599", "P. Puritans 17th 1600-1699", "Q. Great Awakening 18th 1700-1799", "R. Second Awakening 19th 1800-1899", "S. Modern 20th 1900- present");
cddvdother=new Array("A. General", "B. Audio Tapes", "C. Video Tapes", "D. Bible on CD", "E. Children's Tapes, CDs, DVDs", "F. Christian Literature and Fiction", "G. Computer Software and other media", "H. Family", "I.  Holidays Music", "J. Hymnal", "K. Hymns Video/ Karaoke, Songs", "L. Playings/Instruments", "M. Sermons", "N. Testimonials");


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
		if(subcat == "F. Moses's Books"){
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
		if(subcat == "L. Paul's Letters"){
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


	function fetchInfo() {
		$.ajax({ // ajax call starts
		    url: "extractBookInfo.php?isbn=" + $('#isbn').val(), // JQuery loads serverside.php
		    type: "GET",
	        //dataType: 'json',

	        success: function(data) {
	        	/*code changes for fixing the autofill using isbn
				Added by Unnam on 7/27/2015 */
				var tempIndex = data.indexOf("reviews\": ,");
				var temp2 = data.substr(0, tempIndex+9);
				var temp4 = data.substr(tempIndex+9);
				var temp3 = "\"\"";
				var temp5= temp2+temp3+temp4;
				data = temp5;
				/*end of changes by Unnam*/
		        
	        	try {
				  	$.each( JSON.parse(data), function( key, val ) {
				  		if (key == 'error') {
					    	alert(val);
				  			return;
					    } else if (key == 'title') {
					    	$('#title').val(val);
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
					    } else if (key == 'url') {
					    	$('#bookAmazonURL').val(val);
					    } else if (key == 'keywords') {
					    	$('#bookKeywords').val(val);
					    }
					});
				} catch(err) {
					alert("Unable to get book information for the ISBN provided ; "  + err);
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
        } else if ($('#isbn').val() == "") {
        	alert("Please enter ISBN");
        }
//         var filepath = $('#fileUploadid').val();
//     	var path2 = $("input[name=fileToUpload]").val();
//     	var filename = path2.replace(/^.*\\/, "");
//     	alert(filename);
//     	alert(path2);
        
        data = {
                'title' : $('#title').val(),
                'author' : $('#author').val(),
                'publisher' : $('#publisher').val(),
                'bookPublishedYear' : $('#bookPublishedYear').val(),
                'bookProductFormatDetails' : $('#bookProductFormatDetails').val(),
                'bookPages' : $('#bookPages').val(),
                'bookLanguage' : $('#bookLanguage').val(),
                'isbn' : $('#isbn').val(),
                'isbn13' : $('#isbn13').val(),
                'bookProductDimensions' : $('#bookProductDimensions').val(),
                'bookShippingWeight' : $('#bookShippingWeight').val(),
                'bookAmazonStar' : $('#bookAmazonStar').val(),
                'bookAmazonReview' : $('#bookAmazonReview').val(),
                'bookFromBackCover' : $('#bookFromBackCover').val(),
                'bookAmazonURL' : $('#bookAmazonURL').val(),
                'bookAltTitle' : $('#bookAltTitle').val(),
                'bookSubTitle' : $('#bookSubTitle').val(),
                'bookEdition' : $('#bookEdition').val(),
                'bookEditionType' : $('#bookEditionType').val(),
                'bookCallNumber' : $('#bookCallNumber').val(),
                'audience' : $('#audience').val(),
                'bookContent' : $('#bookContent').val(),
                'bookCategory' : $('#bookCategory').val(),
                'bookSubCategory' : $('#bookSubCategory').val(),
                'bookSubSubCategory' : $('#bookSubSubCategory').val(),
                'bookKeywords' : $('#bookKeywords').val(),
                //'fileUploadid' : filename
                //'fileUploadid' : $("input[name=fileToUpload]").val()
            	}
 	 	$.ajax({
            
            url: 'InsertBook.php',
            data: data
 	 	}).done(function( response ) {
              responseJSON = JSON.parse(response);
              if (responseJSON['error'] != undefined) {
                  alert(responseJSON['error']);
              }
              else {
                  alert(responseJSON['success']);

              }
 	 	});	

    
    }

    $(document).on({
    ajaxStart: function() { $("#loading").show(); },
    ajaxStop: function() { $("#loading").hide(); }    
    });

</script>
</head>
<?php include 'NavigationBar.php'; ?>

<body>
	<h2>Insert Book (Register New ISBN)</h2>


	<div class="container" id="insertbook" align="center">

		<form id="insertBookForm" name="insert_book_form" method="POST" enctype="multipart/form-data">
			<table id="resultTable">
				<tr>
					<th>ISBN-13 or ISBN-10 <sup>*</sup></th>
					<td><input id="isbn" name="isbn" type=text /></td>
					<th>ISBN-10 Only</th>
					<td><input id="isbn13" name="isbn13" type=text /></td>
					<td><a href="#" id="search" name="Go" onclick="fetchInfo()">Auto
							Fill</a></td>
				</tr>

				<tr>
					<th>If no ISBN avail</th>
					<td><input type="button" id="reqISBN" name="reqISBN"
						onclick="generateISBN();" value="Request ISBN" /></td>

				
				
						
			</tr>
				<tr>
					<th>Title<sup>*</sup>
					</th>
					<td><input type=text id="title" name="title" /></td>
					<th>Alt Title</th>
					<td><input type=text name="altTitle" id="bookAltTitle" /></td>
				</tr>
				<tr>
					<th>Sub-Title</th>
					<td><input id="bookSubTitle" name="subTitle" type=text /></td>
					<th>Language</th>
					<td><input id="bookLanguage" name="language" type=text /></td>
				</tr>
				<tr>
					<th>Authors<sup>*</sup></th>
					<td><input type=text id="author" name="author" t /></td>
				</tr>
				<tr>
					<th>Edition Number</th>
					<td><input type=text name="edition" id="bookEdition" /></td>
					<th>Edition Type</th>
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
					<th>Call Number</th>
					<td><input type=text name="callNum" id="bookCallNumber" /></td>
					<th>Audience</th>
					<td><input type=text name="audience" id="audience" /></td>
				</tr>
				<tr>
					<th>Publisher</th>
					<td><input type=text id="publisher" name="publisher" /></td>
					<th>Published Date</th>
					<td><input type=text name="publishedDate" id="bookPublishedYear" /></td>
				</tr>
				<tr>
					<th>Product format Details</th>
					<td><input type=text name="productFormat"
						id="bookProductFormatDetails" /></td>
					<th>Pages</th>
					<td><input type=text name="pages" id="bookPages" /></td>
				</tr>
				<tr>
					<th>From Back Cover</th>
					<td><input type=text name="description" id="bookFromBackCover" /></td>
				</tr>
				<tr>
					<th>Content</th>
					<td><input type=text name="content" id="bookContent" /></td>
				</tr>
				<tr>
					<th>Category<sup>*</sup>
					</th>
					<td><select id="bookCategory" name="category">
							<option value="">Category</option>
							<option value="A. Bible">A. Bible</option>
							<option value="B. Theology">B. Theology</option>
							<option value="C. Christian Life">C. Christian Life</option>
							<option value="D. Christian Ministry">D. Christian Ministry</option>
							<option value="E. Church and Church History">E. Church and Church
								History</option>
							<option value="F. CD/DVD/Other">F. CD/DVD/Other</option>
					</select></td>
					<th>SubCategory<sup>*</sup>
					</th>
					<td><select id="bookSubCategory" name="subCategory">
							<option value="">Subcategory</option>
					</select></td>
				</tr>
				<tr>
					<th>SubSubCategory</th>
					<td><select id="bookSubSubCategory" name="subSubCategory">
							<option value="">Sub-Subcategory</option>
					</select></td>
					<th>Keywords</th>
					<td><input type=text name="keywords" id="bookKeywords" /></td>
				</tr>
				<tr>
					<th>Product Dimensions</th>
					<td><input type=text name="dimensions" id="bookProductDimensions" /></td>
					<th>Shipping Weight</th>
					<td><input type=text name="shippingWeight" id="bookShippingWeight" /></td>
				</tr>
			</table>
			<input type="button" id="insertBookID" name="insertBookButton"
				onclick="javascript:insertBook();" value="Insert" />
		</form>

	</div>
	<div id="loading"></div>
</body>
</html>