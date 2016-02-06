<?php

$con = mysql_connect('localhost', 'webclient', '12345678');
                    
if (!$con) {
    die('Failed to conect to MySQL: ' . mysql_error());
}

 $db_selected = mysql_select_db("bookstore");

if (!$db_selected) {
    die('Can\'t use the db :' . mysql_error());
}

$field = $_POST['field'];
$arrayJSON = $_POST['values'];
$type = $_POST['type'];

$inValues = '(';
foreach ($arrayJSON as $key => $value) {
	if ($key != 0) {
		$inValues .= ', ';
	}
	$inValues .= '"'.$value.'"';
}
$inValues .= ')';

$column = 'I.isbn';
if ($field == 'callNum') {
	$column = 'B.callNum';
} else if ($field == 'privateCallNum') {
	$column = 'I.privateCallNum';
}

$sql = 'select B.title, I.isbn, I.salesPrice, I.rentPrice, I.privateCallNum, B.callNum, I.idx from books B';
$sql .= ' join inventory I on I.isbn = B.isbn';
$sql .= ' and I.storeID='.$_POST['storeID'].' and '.$column.' in '.$inValues;
if ($type == 'rentReturn' || $type == 'borrowReturn') {
	$custID = isset($_POST['custID']) ? $_POST['custID']:"";
	$sql .= ' join outitems O on O.isbn = I.isbn and O.storeID = I.storeID and O.custID='.$custID;
	if ($type == 'rentReturn') {
		$sql .= ' and O.type="rent"';
	} else {
		$sql .= ' and O.type="borrow"';
	}
} else {
	$sql .= ' and (I.quantity > 1  or (I.quantity = 1 and I.holderID is null))';
}

$responseJSON = array();
$foundFields = array();
$cartItems = array();
//echo $sql;
$result = mysql_query($sql);
if (mysql_num_rows($result) > 0) {
	while($row = mysql_fetch_assoc($result)) {
		$cartItems[] = array(
			'item' => $row['title'],
			'qty' => 1,
			'desc' => '',
			'isbn' => $row['isbn'],
			'callNum' => $row['callNum'],
			'privateCallNum' => $row['privateCallNum'],
			'salePrice' => $row['salesPrice'],
			'rentPrice' => $row['rentPrice'],
			'type' => $type,
			'idx' => $row['idx']
		);

		$foundFields[] = $row[$field];
	}

	$responseJSON['found'] = $foundFields;
	$responseJSON['cartItems'] = $cartItems;
} else {
	if ($type == 'rentReturn' || $type == 'borrowReturn') {
		$responseJSON = array('error' => 'found no out items for this user in the library');
	} else {
		$responseJSON = array('error' => 'found no books in inventory of the library');
	}
}

echo json_encode($responseJSON);
?>