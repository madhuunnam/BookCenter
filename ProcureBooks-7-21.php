<?php
session_start()
?>
<html>
<head>
<style>
		body {
			text-align: center;
		}

		table {
    		margin: 0 auto; /* or margin: 0 auto 0 auto */
    		text-align:left; 		
    	}

    	td {
    		padding: 10px;
    	}

    	.submitBtnTd {
    		text-align: center;
    		vertical-align: center;
    	}

    	input {
    		height: 2em;
    	}

    	input[type=submit] {
    		-webkit-appearance: none;
  			height: 2em;
  			width: 12em;
  			font-size: 1em;
  			border-radius: 5px;
		}

		input[type=button] {
    		-webkit-appearance: none;
  			padding:5px;
  			font-size: 0.95em;
  			border-radius: 5px;
		}

		input[type=radio] {
			margin-right: 10px;
			margin-top: 10px;
		}

		.anchorButton {
			padding:10px;
			border:1px solid #aaa;
			background-color: #ddd;
			color: #222;
			font-weight: bold;
			cursor: pointer;
			text-decoration: none;
		}
	</style>
	<script type="text/javascript" src='jquery-1.4.1.js'></script>
	<script type="text/javascript">
	function takeToHomePage() {
			window.location = 'homepage.php';
		}

	function checkIsbnExists() {
		alert("Hi");
		var isbn = $('#isbn').val();
		if ((isbn.length == 10 || isbn.length == 13)) {
		data = {
                'isbn' : isbn
            }
 	 	$.ajax({
            method: "POST",
            url: "checkBooks.php",
            data: data
          }).done(function( response ) {
        	  responseJSON = JSON.parse(response);
 			 if (responseJSON['false'] != undefined) {
                 alert(responseJSON['false']); 
   				window.location = 'InsertBook.php';
               }
 			 else {
 				  alert(responseJSON['true']);
 			 }
          }
		}
	}
		
	
	</script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
<h2> Procure Books </h2>
	<form method=post action="ProcureBooks.php">
	<table> 
		<tr>
			<th>Books are all procured/purchased from Store </th>
			<td> <input type="text" name="storename" id="storename" placeholder = "Store Name"> </td>
		</tr>
		<tr>
			<th> ISBN * </th>
			<td> <input type="text" name="isbn" id="isbn" onmouseup="javascript:checkIsbnExists()" onkeyup="javascript:checkIsbnExists()"> </td>
		</tr>
		<tr>
			<th> Qunatity </th>
			<td> <input type="text" name="quantity" id="quantity" value="1"> </td>
		</tr>
		<tr>
			<th> Price </th>
			<td> <input type="text" name="Price" id="Price" placeholder = "Purchase Price"> </td>
		</tr>
		<tr>
		<td> <input type="button" name="Add to Cart" value = "Add to Cart" id="addToCart" > </td>
		<td> <input type="button" name="Procure" value = "Procure" id="procure" > </td>
		<td> <input type="button" name="done" id="done" value="Done" onclick="javascript:takeToHomePage();"> </td>
		</tr>
		
	</table>
</body>
</html>