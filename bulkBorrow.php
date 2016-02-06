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
$sql .= ' join inventory I on I.isbn = B.isbn and (I.quantity > 1  or (I.quantity = 1 and I.holderID is null))';
$sql .= ' and I.storeID='.$_POST['storeID'].' and '.$column.' in '.$inValues;

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
			'salePrice' => $row['salesPrice'],
			'rentPrice' => $row['rentPrice'],
			'type' => 'borrow',
			'idx' => $row['idx']
		);

		$foundFields[] = $row[$field];
	}

	$responseJSON['found'] = $foundFields;
	$responseJSON['cartItems'] = $cartItems;
} else {
	$responseJSON = array('error' => 'found no books in inventory of the library');
}

echo json_encode($responseJSON);
?>