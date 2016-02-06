<?php
session_start();

/*added code for imageupload by Unnam*/
	$name = $_FILES['fileToUpload']['name'];
	$sourcepath = $_FILES['fileToUpload']['tmp_name']; 
 	$date = date_create();	
 	$filename = date_timestamp_get($date) . '-' .$_FILES['fileToUpload']['name'];
	$targetPath = "coverimages/".$filename; // Target path where file is to be stored
	move_uploaded_file($sourcepath,$targetPath) ;    // Moving Uploaded file
/*end of changes by Unnam*/
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
    		font-size: 1em !important;
    	}

    	.submitBtnTd {
    		text-align: center;
    		vertical-align: center;
    	}

    	input {
    		height: 2em;
    	}

    	input[type=submit], input[type=button] {
    		-webkit-appearance: none;
  			height: 1.5em;
  			width: 9em;
  			font-size: 0.8em;
  			border-radius: 5px;
		}
		input.search {
		 width: 17em;  height: 1.5em;
		}

		#motherDialog {
			display:none;
		}

		#childDialog {
			display:none;
		}

		.deleteBtn input {
			border-radius: 7px;
			font-size: 1em;
			width: 25px;
			background-color: #ddd;
			font-weight: bold;
			border:1px solid #aaa;
		}
	</style>
	
	<!-- <script type="text/javascript" src='jquery-1.4.1.js'></script> -->
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 
	<!-- include the jquery ui library -->
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script type="text/javascript">
	
		$( document ).ready(function() {
			$("#joinStore").click(function() {
				motherStore = $('#motherStore').val();
				if (motherStore == "") {
					alert("Please enter a mother store name");
				} else {
					$.ajax({
	            			url: 'checkStore.php?storeName=' + motherStore,
	            			type: "GET",
	            			crossDomain: true,
	            			success: function (response) {
	            				$("#motherStoreValue").val(response);
	            			},
	            			error: function (xhr, status) {
	            			    alert("Store does not exist");
	            			}
	        		});
				}
			});

			
			<?php 
				$con = mysqli_connect('localhost', 'webclient', '12345678', "bookstore");

                if (!$con) {
                    die("Failed to conect to MySQL: " . mysqli_error());
                }

                $sql = "SELECT * FROM stores WHERE storeID='".$_SESSION['storeID']."'";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($store = mysqli_fetch_assoc($result)) {
			?>

			$('#storeName').val("<?php echo $store['storeName']; ?>");
                        $('#altStoreName').val("<?php echo $store['altStoreName']; ?>"); // added Fu 5-19-15
			$('#storeAddr1').val("<?php echo $store['addrStNum'];  ?>");
			$('#storeAddr2').val("<?php echo $store['addrLine2'];  ?>");
			$('#city').val("<?php  echo $store['city']; ?>");
			$('#state').val("<?php echo $store['state']; ?>");
			$('#zip').val("<?php echo $store['zip']; ?>");
			$('#phone').val("<?php echo $store['phone']; ?>");
			$('#phone1').val("<?php echo $store['phone1']; ?>");
			$('#email').val("<?php echo $store['email']; ?>");
			$('#managerPassword').val("<?php echo $store['mgrPasswd']; ?>");
			$('#staffPassword').val("<?php echo $store['staffPasswd']; ?>");
			$('#securityQuestionAnswer').val("<?php echo $store['answer']; ?>");
			$('#securityQuestion option[value="<?php echo $store['question']; ?>"]').attr('selected', true);
			$('#securityQuestion').val('<?php echo $store['question']; ?>');
			$('#storeType option[value="<?php echo $store['storeType']; ?>"]').attr('selected', true);
			$('#storeType').val('<?php echo $store['storeType']; ?>');
			<?php
				foreach (explode(',', $store['services']) as $value) {
			?>
			$('#serviceAvailableSelection option[value="<?php echo $value; ?>"]').attr('selected', true);
			<?php
				}
			?>
			$('#keywords').val("<?php echo $store['keywords']; ?>");
			$('#website').val("<?php echo $store['website']; ?>");
			$('#openHours').val("<?php echo $store['openHour']; ?>");
			$('#managerName').val("<?php echo $store['mgrName']; ?>");
			$('#managerPhone').val("<?php echo $store['mgrPhone']; ?>");
			$('#managerEmail').val("<?php echo $store['mgrEmail']; ?>");
			$('#durationRent').val("<?php echo $store['dueRent']; ?>");
			$('#durationHold').val("<?php echo $store['dueHold']; ?>");
			$('#durationLend').val("<?php echo $store['dueLent']; ?>");
			$('#gracePeriod').val("<?php echo $store['graceRent']; ?>");
			$('#fineRate').val("<?php echo $store['fineRateRent']; ?>");
			$('#maxFine').val("<?php echo $store['maxFine']; ?>");
			$('#renewTimes').val("<?php echo $store['maxRenew']; ?>");
			$('#lendLimit').val("<?php echo $store['lentLimit']; ?>");
			$('#allowSelfCheckout').val("<?php echo $store['selfCheckout']; ?>");

			<?php
					}
				}
			?>
		});

		$( document ).ready(function() {
			$("#showMother").click(function() {
				$( "#motherDialog" ).dialog({
										      modal: true
										    });
  			});
			
			$("#showChildren").click(function() {
				$( "#childDialog" ).dialog({
										      modal: true
										    });
  			});

			$(".deleteMotherAssociation").click(function() {
				motherID = $(this).parent().parent().children(':first-child').html();
				
				$.ajax({
        			url: 'deleteStoreAssociations.php?associationType=mother&motherID=' + motherID,
        			type: "GET",
        			crossDomain: true,
        			success: function (response) {
        				alert("Association removed successfully");
        			},
        			error: function (xhr, status) {
        			    alert("Unable to delete association");
        			}
        		});

        		$(this).parent().parent().remove();
				
			});

			$(".deleteChildAssociation").click(function() {
				childID = $(this).parent().parent().children(':first-child').html();
				alert(childID);
				
				$.ajax({
        			url: 'deleteStoreAssociations.php?associationType=child&childID=' + childID,
        			type: "GET",
        			crossDomain: true,
        			success: function (response) {
        				alert("Association removed successfully");
        			},
        			error: function (xhr, status) {
        			    alert("Unable to delete association");
        			}
        		});

        		$(this).parent().parent().remove();
				
			});

		});

		function validateAndSubmit() {
			// if ($('#fileToUpload').val() == "") {
			// 	alert("Please select a logo");
			// 	return
			// }
			if ($('#storeName').val() == "") {
				alert("Please enter a store name");
				return
			}
			if ($('#storeAddr1').val() == "") {
				alert("Please enter a store address");
				return
			}
			if ($('#city').val() == "") {
				alert("Please enter a city");
				return
			}
			if ($('#state').val() == "") {
				alert("Please enter a state");
				return
			}
			if ($('#zip').val() == "") {
				alert("Please enter a zipcode");
				return
			}
			if ($('#phone').val() == "") {
				alert("Please enter a phone");
				return
			}
			if ($('#email').val() == "") {
				alert("Please enter a email");
				return
			}
			if ($('#managerPassword').val() == "") {
				alert("Please enter a manager password");
				return
			}
			if ($('#securityQuestion').val() == "") {
				alert("Please enter a security question");
				return
			}
			if ($('#storeType').val() == "") {
				alert("Please enter a store type");
				return
			}
			if ($('#serviceAvailableSelection').val() == null) {
				$('#serviceAvailable').val("")
			} else {
				$('#serviceAvailable').val($('#serviceAvailableSelection').val().toString());
			}

			if ($('#serviceAvailable').val() == "") {
				alert("Please select a service");
				return
			}

			$('#storeForm').submit();

		}

		<?php 
		$storeID = $_SESSION['storeID'];
		?>
		currentStoreID = '<?php echo $storeID; ?>';
		
		function batchShelfing() {
			data = {
	                'SID' : currentStoreID,
	            	}
	 	 	$.ajax({
	            method: "POST",
	            url: 'batchShelfing.php',
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
       	
		function printBatchLabels(){

			data = {
	                'SID' : currentStoreID,
	            	}
	 	 	$.ajax({
	            method: "POST",
	            url: 'printLabels.php',
	            data: data
	 	 	}).done(function( response ) {
	              responseJSON = JSON.parse(response);
	              if (responseJSON['error'] != undefined) {
	                  alert(responseJSON['error']);
	              }
	              else {
		              window.open(responseJSON['url'],'Download');
	              }
	          });		
		}

		function PrintNewLabels(){
			
			 window.open('newLabels.txt','Download');
			 
			 $.ajax({
		          url: 'printNewLabels.php',
		          data: {'file' : 'newLabels.txt'},
		          success: function (response) {
		          },
		          error: function () {
		             alert("file delete error");
		          }
			 });
		}
		
		function PrintShelfLabels(){
			
			window.open('BookCategoryEN.xlsx','Download');
		}
		

		var files;

		$( document ).ready(function() {
    		$('#fileToUpload').change(prepareUpload);
		});

		// Grab the files and set them to our variable
		function prepareUpload(event)
		{
		  files = event.target.files;
		}

	</script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
	<h2> Store Profile </h2>
	<table> 
		<form method="post" enctype="multipart/form-data" id="MyUploadForm"  action="storeProfile.php">
		<tr>
			<th> Store Logo * </th>
			
			<td> <img src="coverimages/uploading.gif" id="loaded-img" style="display:none;"/>
				 <input type="file" name="fileToUpload" > </td>
			<td> <input type="submit" value="Upload" "> </td>
		</tr>
		</form>

		<form id='storeForm' method='post' action='updateStore.php'  enctype="multipart/form-data">
		<input type="hidden" value="" id="imageFilename" name="imageFilename">
		<tr>
			<th> Store Name * </th>
			<td> <input type="text" name="storeName" id="storeName"> </td>
                        <th> Alternative Store Name * </th>                     <!-- added Fu 5-19-15 -->
			<td> <input type="text" name="altStoreName" id="altStoreName"> </td>  <!-- added Fu 5-19-15 -->
		</tr>
		<tr>
			<th> Store Address Line 1 * </th>
			<td> <input type="text" name="storeAddr1" id="storeAddr1"> </td>
		</tr>
		<tr>
			<th> Store Address Line 2 </th>
			<td> <input type="text" name="storeAddr2" id="storeAddr2"> </td>
		</tr>
		<tr>
			<th> City * </th>
			<td> <input type="text" name="city" id="city"> </td>
			<th> State * </th>
			<td> <input type="text" name="state" id="state"> </td>
			<th> Zip * </th>
			<td> <input type="text" name="zip" id="zip"> </td>
		</tr>
		<tr>
			<th> Phone * </th>
			<td> <input type="text" name="phone" id="phone"> </td>
			<th> Phone 1 </th>
			<td> <input type="text" name="phone1" id="phone1"> </td>
		</tr>
		<tr>
			<th> Email * </th>
			<td> <input type="text" name="email" id="email"> </td>
			<th> Manager<br>Password * </th>
			<td> <input type="password" name="managerPassword" id="managerPassword"> </td>
			<th> Staff<br>Password</th>
			<td> <input type="password" name="staffPassword" id="staffPassword"> </td>
		</tr>
		<tr>
			<th> Security Question * </th>
			<td colspan=3 > 
				<select name="securityQuestion" id="securityQuestion"> 
					<option value=""/>
					<option value="1">Name of your pet </option>
					<option value="2">Your first car make </option>
					<option value="3">Where did you meet your wife for the first time </option>
					<option value="4">Which school did you graduate from </option>
					<option value="5">What is your major </option>
				</select> 
			</td>
			<th> Answer </th>
			<td> <input type="text" name="securityQuestionAnswer" id="securityQuestionAnswer"> </td>
		</tr>
		<tr>
			<th> Store Type * </th>
			<td> <Select name="storeType" id="storeType">
                    <option value="Bookstore">Bookstore</option>
                    <option value="Public">Public</option>
                    <option value="Academic">Academic</option>
                    <option value="School">School</option>
                    <option value="Corporate">Corporate</option>
                    <option value="Church">Church</option>
                    <option value="Personal">Personal</option>


                </select>
			<th> Service Available * </th>
			<td rowspan="2"> <Select multiple id="serviceAvailableSelection">
                    <option value="Sell">Sell</option>
                    <option value="Lend">Lend</option>
                    <option value="Rent">Rent</option>
                    <option value="Return">Return</option>
                    <option value="Procure">Procure</option>
                </select>
                <input type=hidden name="serviceAvailable" id="serviceAvailable" value="">
			<th> Keywords</th>
			<td> <input type="text" name="keywords" id="keywords"> </td>
		</tr>
		<tr>
			<th> Website </th>
			<td> <input type="text" name="website" id="website" colspan=2 > </td>
            <td></td>
			<th> Open Hours </th>
			<td> <input type="text" name="openHours" id="openHours" colspan=2> </td>
		</tr>
		<tr>
			<th> Manager Name </th>
			<td> <input type="text" name="managerName" id="managerName"> </td>
			<th> Manager Phone </th>
			<td> <input type="text" name="managerPhone" id="managerPhone"> </td>
			<th> Manager Email</th>
			<td> <input type="text" name="managerEmail" id="managerEmail"> </td>
		</tr>
		<tr>
			<th> Duration Rent </th>
			<td> <input type="text" name="durationRent" id="durationRent"> </td>
			<th> Duration Lend </th>
			<td> <input type="text" name="durationLend" id="durationLend"> </td>
			<th> Duration Hold</th>
			<td> <input type="text" name="durationHold" id="durationHold"> </td>
		</tr>
		<tr>
			<th> Grace Period </th>
			<td> <input type="text" name="gracePeriod" id="gracePeriod"> </td>
			<th> Fine Rate($/hr) </th>
			<td> <input type="text" name="fineRate" id="fineRate"> </td>
			<th> Max Fine</th>
			<td> <input type="text" name="maxFine" id="maxFine"> </td>
		</tr>
		<tr>
			<th> Renew Times </th>
			<td> <input type="text" name="renewTimes" id="renewTimes"> </td>
			<th> Lend Limit </th>
			<td> <input type="text" name="lendLimit" id="lendLimit"> </td>
			<th> Allow Self Checkout</th>
			<td> <input type="Checkbox" name="allowSelfCheckout" id="allowSelfCheckout"> </td>
		</tr>
		<tr>
			<th> Associations </th>
			<td> <input type="button" name="showMother" id="showMother" value="Mother"> 
				 <div id="motherDialog" title="Mother Associations">
				 	<table>
				 		<tr>
				 			<th> Store ID </th>
				 			<th> Store Name </th>
				 		</tr>

				 	<?php 
						$con = mysqli_connect('localhost', 'webclient', '12345678', "bookstore");

		                if (!$con) {
		                    die("Failed to conect to MySQL: " . mysqli_error());
		                }

		                $sql = "SELECT motherID, motherStore FROM storeAssociations WHERE storeID=".$_SESSION['storeID'];
		                $result = mysqli_query($con, $sql);


		                if (mysqli_num_rows($result) > 0) {
		                    while($store = mysqli_fetch_assoc($result)) {
		                    	echo "<tr>";
		                    	echo "<td>" . $store['motherID'] . "</td>";
		                    	echo "<td>" . $store['motherStore'] . "</td>";
		                    	echo "<td class='deleteBtn'><input type='button' value='X' style='color:RED;' class='deleteMotherAssociation'></td>";
		                    	echo "</tr>";
		                    }
		                }
					?>
					</table>
				 </div></td>
			<th> </th>
			<td> <input type="button" name="showChildren" id="showChildren" value="Child">
				 <div id="childDialog" title="Child Associations">
				 	<table>
				 		<tr>
				 			<th> Store ID </th>
				 			<th> Store Name </th>
				 		</tr>

				 	<?php 
						$con = mysqli_connect('localhost', 'webclient', '12345678', "bookstore");

		                if (!$con) {
		                    die("Failed to conect to MySQL: " . mysqli_error());
		                }

		                $sql = "SELECT storeID, storeName FROM storeAssociations WHERE motherID=".$_SESSION['storeID'];
		                $result = mysqli_query($con, $sql);
		                if (mysqli_num_rows($result) > 0) {
		                	while($store = mysqli_fetch_assoc($result)) {
		                    	echo "<tr>";
		                    	echo "<td>" . $store['storeID'] . "</td>";
		                    	echo "<td>" . $store['storeName'] . "</td>";
		                    	echo "<td class='deleteBtn'><input type='button' value='X' style='color:RED;' class='deleteChildAssociation'></td>";
		                    	echo "</tr>";
		                    }
		                }

					?>
						</table>
				 </div></td>
			<th> </th>
		</tr>
		<tr>
		<br />
		<br />
		<th>Batch Mode CallNum and Labels </th>
		<td><input type="button" class = "search" id="batchMode" name="batch" value="Update CallNum in Batch Mode"  onclick="javascript:batchShelfing();">
					</td>
				
		<td><input type="button" class = "search" id="printBatchLabel" name="printBatchLabel" value="Print BookLabels in Batch Mode" onclick="javascript:printBatchLabels();">
					</td>
					</tr>
		<tr>
		<th> New Labels and Shelf Labels </th>
		<td><input type="button" class = "search" id="printNewLabel" name="printNewLabel" value="Print New Book Labels" onclick="javascript:PrintNewLabels();">
					</td>
		<td><input type="button" class = "search" id="printShelfLabel" name="printShelfLabel" value="Print Shelf Labels" onclick="javascript:PrintShelfLabels();">
					</td>
		</tr>
		<tr>
			<th> </th>
			<th> </th>
			<td> <input type="button" name="update" id="update" onclick="javascript:validateAndSubmit();" value="Update"> </td>
			<th> </th>
			<th> </th>
		</tr>
	</table>
	</form>
</body>
</html>
