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

    	input[type=submit], input[type=button] {
    		-webkit-appearance: none;
  			height: 1.5em;
  			width: 9em;
  			font-size: 0.8em;
  			border-radius: 5px;
		}
	</style>
	<script type="text/javascript" src='jquery-1.4.1.js'></script>
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

		var files;

		$( document ).ready(function() {
    		$('#fileToUpload').change(prepareUpload);
		});

		// Grab the files and set them to our variable
		function prepareUpload(event)
		{
		  files = event.target.files;
		}

		function uploadImage(e) {
			$("#loaded-img").show();
			    var data = new FormData();
			    $.each(files, function(key, value)
			    {
			        data.append(key, value);
			    });
			    var formURL = $(this).attr("action");
			    $.ajax({
					url: 'uploadImage.php', // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						$("#loaded-img").attr('src', 'coverimages/' + data);
						$("#loaded-img").show();
						$('#imageFilename').val(data);
					}
			    });//unbind. to stop multiple form submit.
											
			return false;
		}
	</script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
	<h2> Store Signup </h2>
	<table> 
		<form action="uploadImage.php" method="post" enctype="multipart/form-data" id="MyUploadForm" onsubmit="return uploadImage(this);">
		<tr>
			<th> Store Logo * </th>
			
			<td> <img src="coverimages/uploading.gif" id="loaded-img" style="display:none;"/>
				 <input type="file" name="fileToUpload" id="fileToUpload"> </td>
			<td> <input type="button" value="Upload" name="uploadBtn" id="uploadBtn" onclick="return uploadImage();"> </td>
		</tr>
		</form>

		<form id='storeForm' method='post' action='insertStore.php'  enctype="multipart/form-data">
		<input type="hidden" value="" id="imageFilename" name="imageFilename">
		<tr>
			<th> Store Name * </th>
			<td> <input type="text" name="storeName" id="storeName"> </td>
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
		<?php
			if (isset($_SESSION['type']) && $_SESSION['type']=='Store') {
		?>
			<th> Associations </th>
			<td> <input type="button" name="showMother" id="showMother" value="Mother"> </td>
			<th> </th>
			<td> <input type="button" name="showChildren" id="showChildren" value="Child"> </td>
			<th> </th>
		</tr>
		<tr>
			<th> </th>
			<th> </th>
			<td> <input type="button" name="update" id="update" onclick="javascript:validateAndSubmit();" value="Update"> </td>
			<th> </th>
			<th> </th>
		<?php
			} else {
		?>
			<th> Mother Store </th>
			<td> <input type="text" name="motherStore" id="motherStore"> </td>
			<td> <input type="button" name="joinStore" id="joinStore" value="Join"> 
				 <input type="hidden" name="motherStoreValue" id="motherStoreValue" value=""> </td>
		</tr>
			<th> </th>
			<th> </th>
			<td> <input type="button" name="signUp" id="signUp" onclick="javascript:validateAndSubmit();" value="Sign Up"> </td>
			<th> </th>
			<th> </th>
		<?php
			} 
		?>
		</tr>
	</table>
	</form>
</body>
</html>
