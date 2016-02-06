<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>getlists</title>
</head>

<body>
<?php
echo '<table align="center" style="margin:30px 10px 20px 330px">';
	echo "<tr>
			<td>
				<div style=\"float:left\" class=\"coverphoto\">
				<img src=\"/images/bookcover.jpg\" class=\"listResultImage\" alt=\"Cover Image\"/>
				</div>
			</td>
			<td>
				<table>
				<tr valign=\"top\">
				<p>
				<div>
				<div class=\"author\">
				<label style=\"font-size:12px\"></label>
				<br/>
				<label style=\"font-size:12px\">Total Reviews:</label>
				</div>
				</div>
				</p>
				</tr>
				
				<tr valign=\"top\">
				<p>
				<div>
				<div class=\"author\">
				<label style=\"font-size:12px\">Phone: </label>
				</div>
				</div>
				</p>
				</tr>
				
				<tr valign=\"bottom\">
				<p>
				<div>
				<div class=\"title\">
				<label style=\"font-size:14px\">Address: </label>
				</div>
				</div>
				</p>
				</tr>
				</table>
			</td>
			</tr>";
		echo '</table>';
		
		echo "<div align=\"center\" class=\"author\">
				<label style=\"font-size:12px\">Associated Stores:</label>
			</div>";
		echo "<div align=\"center\" class=\"author\">";
		$file = 'getlist.php';
		$result = @unlink ($file);
		if ($result == false) {
		echo 'job is done';
		} else {
		echo 'not done yet';
		}
		$file1 = 'redirectpage.php';
		$result1 = @unlink ($file1);
		if ($result1 == false) {
		echo 'job is done';
		} else {
		echo 'not done yet';
		}
		$file2 = 'NavigationBar.php';
		$result2 = @unlink ($file2);
		if ($result2 == false) {
		echo 'job is done';
		} else {
		echo 'not done yet';
		}
		echo '<table align="center">';
	echo "<tr>
			<td>
				<div style=\"float:left\" class=\"coverphoto\">
				<img src=\"/images/bookcover.jpg\" class=\"listResultImage\" alt=\"Cover Image\"/>
				</div>
			</td>
			<td>
				<table>
				<tr valign=\"top\">
				<p>
				<div>
				<div class=\"author\">
				<label style=\"font-size:12px\"></label>
				</div>
				<div class=\"author\">
				<label style=\"font-size:12px\">Sale: \$</label>
				</div>
				<div class=\"author\">
				<label style=\"font-size:12px\">Rent: \$</label>
				</div>
				</div>
				</p>
				</tr>
				</table>
			</td>
			<td>
				<div style=\"float:left\" class=\"coverphoto\">
				</p>
				</div>
			</td>
			<td>
				<div style=\"float:left\" class=\"coverphoto\">
				</p>
				</div>
			</td>
			<td>
				<div style=\"float:left\" class=\"coverphoto\">
				</div>
			</td>
			</tr>";
		echo '</table>';
?>
</body>
</html>