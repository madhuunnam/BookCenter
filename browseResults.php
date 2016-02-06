<?php
session_start();
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search Results</title>
</head>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!-- include the jquery ui library -->
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">

	$(document).ready(function() {
		<?php
			$showBoth = false;
			$locationURI = '';
			if ((isset($_GET['state'])   && $_GET['state'] != '') || (isset($_GET['city'])  && $_GET['city'] != '')) {
				$locationURI = '&state='. $_GET['state'];
				if (isset($_GET['city'])  && $_GET['city'] != '') {
					$locationURI .= '&city=' . $_GET['city'];
				}
			} 

			$catgoriesURI = '';
			if ((isset($_GET['bookcat'])  && $_GET['bookcat'] != '') || (isset($_GET['subcat'])  && $_GET['subcat'] != '')  || 
				(isset($_GET['subsubcat'])  && $_GET['subsubcat'] != '')) {
				$catgoriesURI = 'bookcat='. $_GET['bookcat'];
				if (isset($_GET['subcat'])  && $_GET['subcat'] != '') {
					$catgoriesURI .= '&subcat=' . $_GET['subcat'];
				}
				if (isset($_GET['subsubcat'])  && $_GET['subsubcat'] != '') {
					$catgoriesURI .= '&subsubcat=' . $_GET['subsubcat'];
				} else {
					$catgoriesURI = '&'.$catgoriesURI;
				}
			}
	
			if ($locationURI == '' && $catgoriesURI == '') {
				$showBoth = true;
			}
		?>
	});
	
</script>
<style type="text/css">

   body {
            text-align: center;
        }
body {
	margin: 10px auto;
	margin-top: 0px;
	font: 75%/120% Verdana,Arial, Helvetica, sans-serif;
}
div#container {
	text-align: left;
	margin:50px;
}

td {
	font-size: 12px !important;
}
ul#Categories li {
	padding:5px;
}

ul#Categories li.clicked,
ul#SubSubCategories li.clicked {
	padding:5px;
	background-color: #eee;
	border-radius: 10px;
}

ul#Categories li:hover a, 
ul#Categories li.clicked a,
ul#SubCategories li.clicked a  {
	display:inline;
	padding:0px;
	padding-right:3px;
	border:1px solid #222;
	color:#222;
	background-color: #ddd;
	text-decoration: none;
	border-radius: 15px;
	font-weight: bold;
	text-align: center;
	vertical-align: middle;
	margin:4px;
}

li.clicked ul.SubCategories a {
	display:none !important;
}

li.clicked ul.SubCategories li:hover a {
	display:inline !important;
	padding:0px;
	padding-right:3px;
	border:1px solid #222;
	color:#222;
	background-color: #ddd;
	text-decoration: none;
	border-radius: 15px;
	font-weight: bold;
	text-align: center;
	vertical-align: middle;
	margin:4px;
}

ul.SubCategories li.clicked {
	padding:5px;
	background-color: #fff !important;
	border-radius: 10px;
}

ul.SubSubCategories li.clicked {
	padding:5px;
	background-color: #eee !important;
	border-radius: 10px;
}

ul#Categories li a, li.clicked .SubCategories a,
ul#SubCategories li.clicked .SubSubCategories a {
	display:none;
}

.SubCategories, .SubSubCategories, .books {
	display:none;
}

li.clicked .SubCategories,
ul.SubCategories li.clicked .SubSubCategories,
ul.SubSubCategories li.clicked .books  {
	display:inherit ;
	margin-left:50px;
}

.getItDialog, #cartDialog {
	display:none;
}

#cartTable th, .checkoutBtn, .showcartBtn {
	background-color: #ddd;
	border-radius: 15px;
	padding:10px;
	text-decoration: none;
	color:#222;
	
}

.checkoutBtn, .showcartBtn {
	display:none;
}

.ui-dialog-content table#cartTable, .ui-dialog-content table#cartTotalsTable,  {
	font-size:11px !important;
}

.ui-dialog-content table#cartTable td, .ui-dialog-content table#cartTotalsTable td,  {
	padding: 2px !important;
}

</style>
<?php include 'NavigationBar.php'; ?>
<body>
<div> 
<?php
	if ((isset($_GET['state'])  && $_GET['state'] != '') || (isset($_GET['city']) && $_GET['city'] != '') || $showBoth) {

		$storeTypeClause = '';
		$storeTypeURI = "";
		if (isset($_GET['type']) && $_GET['type'] != '') {
			$storeTypeClause = ' and storeType="'.$_GET['type'].'" ' ;
			$storeTypeURI = "&type=".$_GET['type'];
		}

		$categoryClause = '';
		if (isset($_GET['bookcat'])  && $_GET['bookcat'] != '') {
			$categoryClause = ' and books.category = "'. $_GET['bookcat'].'"';
		} if (isset($_GET['subcat'])  && $_GET['subcat'] != '') {
			$categoryClause .= ' and books.subCat="' . $_GET['subcat'] . '"';
		}	if (isset($_GET['subsubcat'])  && $_GET['subsubcat'] != '') {
			$categoryClause .= ' and books.subSubCat="' . $_GET['subsubcat']. '"';
		}
		$heading = 'Browse stores by States';
		$sql = 'select count(storeID) as storeCount, state from ( ';
		$sql .= 'Select distinct state, stores.storeID from stores ';
		$sql .= ' join inventory on inventory.storeID = stores.storeID';
		$sql .= ' join books on books.isbn = inventory.isbn ' . $categoryClause;
		$sql .= ' where 1 ';
		$sql .= $storeTypeClause . $categoryClause;
		$sql .= ') as t group by state order by state';
		if (isset($_GET['state']) && $_GET['state'] != '') {
			$heading = 'Browse stores by Cities in ' . $_GET['state'];
			$sql = 'select count(storeID) as storeCount, state, city from ( ';
			$sql .= 'Select distinct state, city, stores.storeID from stores';
			$sql .= ' join inventory on inventory.storeID = stores.storeID';
			$sql .= ' join books on books.isbn = inventory.isbn ' . $categoryClause;
			$sql .= ' where state="'. $_GET['state'] . '"';
			$sql .= $storeTypeClause;
			$sql .= ') as t group by state, city order by state, city';
			$showingZip = false;
			if ( isset($_GET['city']) && $_GET['city'] != '') {
				$heading = 'Browse stores by Zipcode in '. $_GET['city'] . ' ' . $_GET['state'];
				$sql = 'select count(storeID) as storeCount, state, city, zip from ( ';
				$sql .= 'Select distinct state, city, zip, stores.storeID from stores';
				$sql .= ' join inventory on inventory.storeID = stores.storeID';
				$sql .= ' join books on books.isbn = inventory.isbn ' . $categoryClause;
				$sql .= ' where state="'. $_GET['state'] . '" and city="'. $_GET['city'] . '"';
				$sql .= $storeTypeClause . $categoryClause;
				$sql .= ') as t group by state, city, zip order by state, city, zip';
				$showingZip = true;
			}
		}

		echo '<h2>' . $heading . '</h2>';

		$dbconn = mysql_connect("localhost","webclient","12345678") or die("database error!".mysql_error());  
     	mysql_select_db("bookstore") or die("can not connect database：" . mysql_error());  
      	$results = mysql_query($sql);
      	//echo $sql;
      	echo '<ul>';
     	while($row = mysql_fetch_assoc($results)) {
     		$uri='state='.$row['state'];
     		$displayText = $row['state'];
     		if (isset($_GET['state']) && $_GET['state'] != '') {
     			$uri .= '&city='.$row['city'];
     			$displayText = $row['city'];
     		}
     		$url='browseResults.php?'.$uri.$storeTypeURI;
     		$storeListUrl = 'storeList.php?'.$uri.$storeTypeURI;

     		if (isset($_GET['city']) && $_GET['city'] != '') {
     			$url='storeList.php?state='.$row['state'].'&city='.$row['city'].'&zip='.$row['zip'].$storeTypeURI;
     			$displayText = $row['zip'] ;
     		}

     		$finalURL = $url.$catgoriesURI;
     		if ((!isset($_GET['city']) || (isset($_GET['city']) && $_GET['city'] == '')) && $row['storeCount'] <= 5) {
     			$finalURL = $storeListUrl.$catgoriesURI;
     		}

      		echo '<li><a href="'.$finalURL.'">'.$displayText.'</a> ('.$row['storeCount'].')</li>';
      	}
		echo '</ul>';
	}

	echo '<br><hr><br>';
	$storeClause = ' join stores S on S.storeID = inv.storeID ';
	if (isset($_GET['state']) && $_GET['state'] != '') {
		$storeClause .=  ' and S.state="'.$_GET['state'].'"';
	} if (isset($_GET['city']) && $_GET['city'] != '') {
		$storeClause .=  ' and S.city="'.$_GET['city'].'"';
	} if (isset($_GET['type']) && $_GET['type'] != '') {
		$storeClause .=  ' and S.storeType="'.$_GET['type'].'"';
	}

	if ((isset($_GET['bookcat'])  && $_GET['bookcat'] != '')|| (isset($_GET['subcat'])  && $_GET['subcat'] != '')  || 
		(isset($_GET['subsubcat'])  && $_GET['subsubcat'] != '') || $showBoth) {
		
		$heading = 'Browse stores by Categories';
		$sql = 'Select rtable.bookcat as bookcat, count(rtable.storeID) as storeCount from (Select distinct b.category as bookcat, inv.storeID as storeID from books b';
		$sql .= ' join inventory inv on inv.isbn = b.isbn '. $storeClause .') as rtable';
		$sql .= ' group by bookcat order by bookcat';
		
		if (isset($_GET['bookcat']) && $_GET['bookcat'] != '') {
			$heading = 'Browse stores by Subcategories of Category: ' . $_GET['bookcat'] ;
			$sql = 'Select rtable.bookcat as bookcat, rtable.subCat as subCat, count(rtable.storeID) as storeCount from (Select distinct b.category as bookcat, b.subCat as subCat, inv.storeID as storeID from books b';
			$sql .= ' join inventory inv on inv.isbn = b.isbn '. $storeClause;
			$sql .= ' where b.category="'.$_GET['bookcat'].'" ) as rtable';
			$sql .= ' group by rtable.bookcat, rtable.subCat order by rtable.bookcat, rtable.subCat';
			$showingZip = false;
			if ( isset($_GET['subcat']) && $_GET['subcat'] != '') {
				$heading = 'Browse stores by SubSubCategories for Subcategory: ' . $_GET['subcat'] . ' under Category: ' . $_GET['bookcat'] ;
				$sql = 'Select rtable.bookcat as bookcat, rtable.subCat as subCat, rtable.subSubCat as subSubCat, count(rtable.storeID) as storeCount from (Select distinct b.category as bookcat, b.subCat as subCat, b.subSubCat as subSubCat, inv.storeID as storeID from books b';
				$sql .= ' join inventory inv on inv.isbn = b.isbn '. $storeClause;
				$sql .= ' where b.category="'.$_GET['bookcat'].'" and b.subCat="'.$_GET['subcat'].'" ) as rtable';
				$sql .= ' group by rtable.bookcat, rtable.subCat, rtable.subSubCat order by rtable.bookcat, rtable.subCat, rtable.subSubCat';
				$showingZip = true;
			}
		}

		echo '<h2>' . $heading . '</h2>';
		$dbconn = mysql_connect("localhost","webclient","12345678") or die("database error!".mysql_error());  
     	mysql_select_db("bookstore") or die("can not connect database：" . mysql_error());  
      	$results = mysql_query($sql);
      	//echo $sql;
      	echo '<ul>';

      	$storeTypeURI = "";
		if (isset($_GET['type']) && $_GET['type'] != '') {
			$storeTypeURI = "&type=".$_GET['type'];
		}

		$resultCount = mysql_num_rows($results);
     	while($row = mysql_fetch_assoc($results)) {
     		$uri='bookcat='.str_replace('&', '%26', $row['bookcat']);
     		$displayText = $row['bookcat'];
     		if (isset($_GET['bookcat']) && $_GET['bookcat'] != '') {
     			$uri .= '&subcat='.str_replace('&', '%26', $row['subCat']);
     			$displayText = $row['subCat'];
     		}
     		$url='browseResults.php?'.$uri.$storeTypeURI;
     		$storeListUrl = 'storeList.php?'.$uri.$storeTypeURI;

     		if (isset($_GET['subcat']) && $_GET['subcat'] != '') {
     			$url='storeList.php?bookcat='.str_replace('&', '%26', $row['bookcat']).'&subcat='.str_replace('&', '%26', $row['subCat']).'&subsubcat='.str_replace('&', '%26', $row['subSubCat']).$storeTypeURI;
     			$displayText = $row['subSubCat'] ;
     			if ($displayText == '') {

     			}
     		}

     		$finalURL = $url.$locationURI;
     		if ((!isset($_GET['subcat']) || (isset($_GET['subcat']) && $_GET['subcat'] == '')) && $row['storeCount'] <= 5) {
     			$finalURL = $storeListUrl.$locationURI;
     		}

      		echo '<li><a href="'.$finalURL.'">'.$displayText.'</a>  ('.$row['storeCount'].')</li>';
      	}

      	if($resultCount == 0) {
      		echo '<li>No Results found </li>';
      	}
		echo '</ul>';
	}
?>


</body>
</html>