<?php
session_start()
?>
<html>
<head>
	<title>
		Store Editor
	</title>
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
	</style>
	<script type="text/javascript" src='jquery-1.4.1.js'></script>
	<script type="text/javascript">
	<?php
		if (!isset($_SESSION["type"]) || $_SESSION["type"] !== 'Store' ) {
			echo "window.location.href='Login.php';";
		}
	?>
		var shelvedItems = [];
		var tid = "";
		function clearInput() {
			$( "input[id='bookRef']" ).val( "" );
		}

		function shelfAndRegister(addTransaction) {
			values = [];
			$("input[name='bookRef[]']").each(function() {
				if ($(this).val() != "") {
					values.push($(this).val());
				}
			});

			if(values.length > 0) {
				var data = {};
			    data['bookRef'] = values;
			    data['key'] = $('#key').val();
			    data['tid'] = tid;
			    $.ajax({
					url: 'bulkPutOnShelf.php', // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					dataType: 'json',
					success: function(data)   // A function to be called if request succeeds
					{
						tid = data['tid'];
						if(data['status'] == 'error') {
							if (data['error'] == 'LoginERROR') {
								alert('Please login');
								window.location.href="Login.php"; 
							} else {
								alert (data['error']);
							}
						} else if(data['status'] == 'Success') {
							shelvedItems = shelvedItems.concat(data['succeeded']);
							if (addTransaction) {
								registerTransaction(undefined);
							} else {
								alert("Successfully shelved all the items");
							}
							clearInput();
						} else {
							shelvedItems = shelvedItems.concat(data['succeeded']);
							if (addTransaction) {
								registerTransaction(data["missedValues"]);
							} else {
								alert("We were unable to shelf these items: " + data["missedValues"]);
							}
							clearInput();
						}
					}
			    });//unbind. to stop multipl
			} else if (shelvedItems.length > 0){
				registerTransaction(undefined);
			}


		    if (!addTransaction) {
		    	$('#key').attr('disabled', 'disabled');
		    } else {
		    	$('#key').removeAttr('disabled');
		    }
		}

		function registerTransaction(erroredValues) {
			var data = {};
		    data['shelvedItems'] = shelvedItems;
		    data['key'] = $('#key').val();
			data['tid'] = tid;
		    $.ajax({
				url: 'registerBulkTransaction.php', // Url to which the request is send
				type: "POST",             // Type of request to be send, called as method
				data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				dataType: 'json',
				success: function(data)   // A function to be called if request succeeds
				{

					if(data['status'] == 'error') {
						if (data['error'] == 'LoginERROR') {
							alert('Please login');
							window.location.href="Login.php"; 
						} else if (data['error'] == 'FailedTransaction'){
							alert ("Items have been shelved but, we are unable to register a transaction.");
						} else {
							alert(data['error']);
						}
					} else if(data['status'] == 'Success') {
						shelvedItems = shelvedItems.concat(data['succeeded']);
						if (erroredValues == undefined) {
							alert("Successfully shelved all the items and included a transaction");
						} else {
							alert("We were unable to shelve the following items but, we created a transaction for all the succeeded items. Un-Shelved items: " + erroredValues)
						}
						shelvedItems = [];
						tid='';
					} else {
						if (erroredValues == undefined) {
							alert("Successfully shelved all the items. we were unable to included a transaction for all of them. Here are the items missing from lineitems: " + data['missedValues']);
						} else {
							alert("We were unable to shelve all items and include these items in lineitems. Un-Shelved items: " + erroredValues + ",\n items missing from lineitems: " +  data['missedValues']);
						}
						shelvedItems = [];
						tid='';
					}
				}
		    });//unbind. to stop multipl
		}

		$(document).ready(function() {
			$('#more').click(function() {
				shelfAndRegister(false);
			});
			$('#putOnShelf').click(function() {
				shelfAndRegister(true);
			});
		});
	</script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
	<h2> Bulk Shelfing </h2>
	<form method=post action="bulkPutOnShelf.php">
	<table> 
		<tr>
			<td>  </td>
			<td>  </td>
			<td> Fill by : <Select id="key" name="key">
					<option value="isbn">ISBN</option>
					<option value="privateCallNum">Private Call Number</option>
				 </Select> </td>
			<td>  </td>
			<td>  </td>
		</tr>
		<tr>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
		</tr>
		<tr>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
		</tr>
		<tr>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
		</tr>
		<tr>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
			<td> <input type="text" name="bookRef[]" id="bookRef"> </td>
		</tr>
		<tr>
			<td colspan="2" class="submitBtnTd"> <input type="button" name="more" id="more" value="More"> </td>
			<td colspan="1" class="submitBtnTd"> <input type="button" name="putOnShelf" id="putOnShelf" value="Put on Shelf"> </td>
			<td colspan="2" class="submitBtnTd"> <input type="button" onclick="window.location.href='homepage.php';" name="done" id="done" value="Done"> </td>
			
		</tr>
	</table>
	</form>
</body>
</html>
