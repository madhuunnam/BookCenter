<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Admin Lookup</title>
	<style>
	  	body { text-align: center; }
		table { 
			margin: 0 auto; /* or margin: 0 auto 0 auto */
	    	text-align:left; 		
	    }

		td { padding: 10px; }

		.submitBtnTd {
	    	text-align: center;
	    	vertical-align: center;
	    }

	    input { 
	    	height: 2em; 
	    	padding:5px;
	    }

	    input[type=submit] {
			-webkit-appearance: none;
			border-radius: 5px;
		} 

		 body {
            text-align: center;
        }

        table#queryResults {
            margin: 0 auto; /* or margin: 0 auto 0 auto */
            text-align:left;
            margin-top:20px;
            margin-bottom:20px;
        }

        td {
            padding: 5px;
        }
        #queryResults {
            border:1px solid #ddd;
            border-radius: 5px;
            padding:10px;
            background-color: #ddd;
        }

        #queryResults th {
            border:1px solid #ddd;
            background-color: #ddd;
            color:#222;
            text-align: center;
            border-radius: 5px;
            padding:10px;
        }

        #queryResults td {
            border-left:1px solid #fff;
            border-right:1px solid #fff;
            background-color: #fff;
        }

        .last {
            background-color: #ddd;
        }

	</style>
	<script type="text/javascript" src='jquery-1.4.1.js'></script>
    <script type="text/javascript">
    	$(document).ready(function () {
    	<?php
    		$sql = '';
    		if (!isset($_SESSION['adminID']) || $_SESSION['adminID'] == null || $_SESSION['adminID'] == '' ) {
                echo 'window.location.href = "login.php";';
            } else if (!empty($_POST)) {
    			echo "$('#isbn').val('".$_POST['isbn']."');";
    			echo "$('#firstName').val('".$_POST['firstName']."');";
    			echo "$('#lastName').val('".$_POST['lastName']."');";
    			echo "$('#storeName').val('".$_POST['storeName']."');";
    			echo "$('#type').val('".$_POST['type']."');";
    			echo "$('#fromDate').val('".$_POST['fromDate']."');";
    			echo "$('#toDate').val('".$_POST['toDate']."');";
    			echo "$('#duration').val('".$_POST['duration']."');";

    			if (isset($_POST['type']) && $_POST['type'] == "") {
    				if ($_POST['isbn'] == "" && $_POST['storeName'] == "" && $_POST['firstName'] == "" && $_POST['lastName'] == "" ) {
    					echo 'alert("Please enter an ISBN or Customer Name or Store Name");';
    				} else if ($_POST['isbn'] != "") {
    					$sql = 'select * from books where isbn="'.$_POST['isbn'].'"';
    				} else if ($_POST['firstName'] != "" && $_POST['lastName'] != "") {
    					$sql = 'select * from customers where firstName="'.$_POST['firstName'].'" and lastName="'.$_POST['lastName'].'"';
    				} else if ($_POST['firstName'] != "") {
    					$sql = 'select * from customers where firstName="'.$_POST['firstName'].'"';
    				} else if ($_POST['lastName'] != "") {
    					$sql = 'select * from customers where lastName="'.$_POST['lastName'].'"';
    				}else if ($_POST['storeName'] != "") {
    					$sql = 'select * from stores where storeName="'.$_POST['storeName'].'"';
    				}
    			} else {
    				$customerColumn = '';
    				$storeColumn = '';
    				$durationColumn = '';
    				if ($_POST['type'] == "inventory") {
    					$storeColumn = 'storeID';
    					$customerColumn = 'holderID';
    					$durationColumn = 'holdDate';
    				} else if ($_POST['type'] == "transactions") {
    					$storeColumn = 'storeID';
    					$customerColumn = 'custID';
    					$durationColumn = 'transTime';
    				} else if ($_POST['type'] == "activeorders") {
    					$storeColumn = 'storeID';
    					$customerColumn = 'custID';
    					$durationColumn = 'transTime';
    				} else if ($_POST['type'] == "outitems") {
    					$storeColumn = 'storeID';
    					$customerColumn = 'custID';
    					$durationColumn = 'outDate';
    				} else if ($_POST['type'] == "account") {
    					$storeColumn = 'storeID';
    					$customerColumn = 'custID';
    					$durationColumn = '';
    				} else if ($_POST['type'] == "lineitems") {
    					$durationColumn = 'dueDate';
    				} else if ($_POST['type'] == "bookreviews") {
    					$customerColumn = 'custID';
    					$durationColumn = 'reviewTime';
    				} else if ($_POST['type'] == "custreviews") {
    					$storeColumn = 'storeID';
    					$customerColumn = 'custID';
    					$durationColumn = 'reviewTime';
    				} else if ($_POST['type'] == "storereviews") {
    					$storeColumn = 'storeID';
    					$customerColumn = 'custID';
    					$durationColumn = 'reviewTime';
    				}  else if ($_POST['type'] == "customers") {
    					$customerColumn = 'custID';
    				}  else if ($_POST['type'] == "stores") {
    					$storeColumn = 'storeID';
    				} else if ($_POST['type'] == "admins") {
    					$durationColumn = 'insertDate';
    				} else if ($_POST['type'] == "libmembers") {
    					$storeColumn = 'storeID';
    					$customerColumn = 'custID';
    					$durationColumn = 'joinDate';
    				} 
    				

    				$durationClause = '';
    				if ($_POST['fromDate'] != '' || $_POST['toDate'] != '') {
	    				if ($_POST['fromDate'] != '') {
	    					if ($durationColumn != '') {
	    						$durationClause = ' and tbl.'.$durationColumn.' >= "'.$_POST['fromDate'].'" ';
	    					} 
	    				}	
	    				if ($_POST['toDate'] != '') {
	    					if ($durationColumn != '') {
	    						$durationClause .= ' and tbl.'.$durationColumn.' <= "'.$_POST['toDate'].'" ';
	    					} 
	    				}	
	    			} else if ($_POST['duration'] != 'All' && $durationColumn != '') {
	    				$date = new DateTime();
						$currDate = explode('-', $date->format('Y-m-d'));
						
						if ($_POST['duration'] == 'Month') {
							$durationClause = ' and tbl.'.$durationColumn.' > "'.$currDate[0].'-'.$currDate[1].'-01" ';
						} else if ($_POST['duration'] == 'Year') {
							$durationClause = ' and tbl.'.$durationColumn.' > "'.$currDate[0].'-01-01" ';
						} else {
							$quarter = '10';
							if (intval($currDate[1]) < 10 && intval($currDate[1]) >= 7) {
								$quarter = '07';
							} else if (intval($currDate[1]) < 7 && intval($currDate[1]) >= 4) {
								$quarter = '04';
							} else if (intval($currDate[1]) < 4 ) {
								$quarter = '01';
							}

							$durationClause = ' and tbl.'.$durationColumn.' >  "'.$currDate[0].'-'.$quarter. '-01" ';
						}
	    			}

	    			$customerJoin = '';
	    			if ($customerColumn != '' && ($_POST['firstName'] != "" || $_POST['lastName'] != "")) {
	    				$customerJoin = ' join customers c on c.custID = tbl.'. $customerColumn .' ';
	    				if ($_POST['firstName'] != "") {
	    					$customerJoin .= ' and c.firstName like "%'.$_POST['firstName'].'%" ';
	    				}
	    				if ($_POST['lastName'] != "") {
	    					$customerJoin .= ' and c.lastName like "%'.$_POST['lastName'].'%" ';
	    				}
	    			}

	    			$storeJoin = '';
	    			if ($storeColumn != "" && $_POST['storeName'] != '') {
	    				$storeJoin = ' join stores s on s.storeID = tbl.'.$storeColumn.' and s.storeName like "%'.$_POST['storeName'].'%" '; 
	    			}

	    			$isbnClause = '';
	    			if ($_POST['isbn'] != "" && ($_POST['type'] == "books" || $_POST['type'] == "inventory" || $_POST['type'] == "outitems" || $_POST['type'] == "lineitems" || $_POST['type'] == "bookreviews")) {
	    				$isbnClause = ' and tbl.isbn="'.$_POST['isbn'].'" ';
	    			}

	    			$selectColumns = 'tbl.*';
/*
	    			if ($_POST['type'] == 'books') {
	    				$selectColumns = 'tbl.isbn, tbl.title, tbl.author, tbl.category, tbl.subCat';
	    			} else if ($_POST['type'] == 'customers') {
	    				$selectColumns = 'tbl.custID, tbl.lastName, tbl.firstName, tbl.emailAddress, tbl.password, tbl.homeLib';
	    			} else if ($_POST['type'] == 'stores') {
	    				$selectColumns = 'tbl.storeID, tbl.storeName, tbl.question, tbl.answer, tbl.storeType, tbl.services';
	    			} else if ($_POST['type'] == 'storeassociations') {
	    				$selectColumns = 'tbl.storeName, tbl.motherStore';
	    			}else if ($_POST['type'] == 'messages') {
	    				$selectColumns = 'tbl.name, tbl.email, tbl.subject, tbl.msgText, tbl.replyText, tbl.replied, tbl.status';
	    			}else if ($_POST['type'] == 'branches') {
	    				$selectColumns = 'tbl.organID, tbl.organName, tbl.branchID, tbl.bname, tbl.emailAddress';
	    			}else if ($_POST['type'] == 'organizations') {
	    				$selectColumns = 'tbl.organID, tbl.name, tbl.cname, tbl.username, tbl.password, tbl.emailAddress';
	    			}
//- --- comment out on 7/30/15 to show all fields
*/ 


	    			$sql = 'select '.$selectColumns.' from '.$_POST['type'].' as tbl ';
	    			$sql .= $customerJoin;
	    			$sql .= $storeJoin;
	    			$sql .= ' where 1 ';
	    			$sql .= $isbnClause;
	    			$sql .= $durationClause; 
	    			print_r($sql);
    			}
    		}
    	?>
    	});
    </script>
</head>
<?php include 'NavigationBar.php';?>

<body>
<h2> Admin Lookup </h2>
	<form method=post action="adminLookup.php">
	<table> 
		<tr>
			<td> ISBN : </td>
			<td> <input type='text' name='isbn' id='isbn'> </td>
			<td> &nbsp; </td>
			<td> Look for  </td>
			<td> <Select id="type" name="type">
					<option value=""></option>
					<option value="admins">Admins</option>
					<option value="ledgers">Accounts</option>
					<option value="activeorders">Active Orders</option>
					<option value="books">Books</option>
					<option value="bookreviews">Book Reviews</option>
					<option value="branches">Branches</option>
					<option value="customers">Customers</option>
					<option value="custreviews">Customer Reviews</option>
					<option value="inventory">Inventory</option>
					<option value="libmembers">Library Memebers</option>
					<option value="lineitems">Line Items</option>
					<option value="messages">Messages</option>
					<option value="organizations">Organizations</option>
					<option value="outitems">Out Items</option>
					<option value="stores">Stores</option>
					<option value="storeassociations">Store Associations</option>
					<option value="storereviews">Store Reviews</option>
					<option value="transactions">Transactions</option>
				 </Select>
			</td>
		</tr>
		<tr>
			<td> Customer Name :  </td>
			<td> <input type="text" name="firstName" id="firstName" placeholder="First Name"> </td>
			<td> <input type="text" name="lastName" id="lastName" placeholder="Last Name"> </td>
			<td> Date from  </td>
			<td> <input type="text" name="fromDate" id="fromDate" placeholder="YYYY-MM-DD"></td>
			<td>  to
			     <input type="text" name="toDate" id="toDate" placeholder="YYYY-MM-DD"> 
			</td>
		</tr>
		<tr>
			<td> Store Name : </td>
			<td> <input type="text" name="storeName" id="storeName"> </td>
			<td> &nbsp; </td>
			<td> or Most recent </td>
			<td> <Select id="duration" name="duration">
					<option value="All">All</option>
					<option value="Month">Month</option>
					<option value="Quarter">Quarter</option>
					<option value="Year">Year</option>
				 </Select> 
			</td>
		</tr>
	</table>
	<br>
	<input type="submit" name="goButton" id="goButton" value="Go">
	</form>
	<br>
	<hr width='100%' style="align:center;">
	<br>
	<div id="results">
		<?php 
			if ($sql != "") {
				$dbconn = mysql_connect("localhost","webclient","12345678") or die("database error!".mysql_error());  
	            mysql_select_db("bookstore") or die("can not connect database：".mysql_error());  
	       		$results = mysql_query($sql);
				?>
				<table id="queryResults">
				<?php
				$columns = [];
				while($row = mysql_fetch_assoc($results)) {
					if (empty($columns)) {
						echo '<tr>';
						foreach (array_keys($row) as $column) {
							echo '<th>'.$column.'</th>';
        					$columns[] = $column;
    					}
    					echo '</tr>';
					}
					
					echo '<tr>';
					foreach ($columns as $column) {
        				echo '<td>'.$row[$column].'</td>';
    				}
    				echo '</tr>';
				}

				?>
				</table>

				<?php
				if (empty($columns)) {
					echo '<h4><i>No results found for the selection</i></h4>';
				}
			}
		?>
	</div>

</body>
</html>