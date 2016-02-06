<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact</title>


<style>

  .action-box-rounded{
        border:1px solid;border-color:#09F;width:400px;margin:10px;margin-left:20px
   }
   
</style>

</head>
<?php include 'NavigationBar.php'; ?>
<body>


<div class="row-fluid" align="center">
    <div class="action-box-rounded">
    	<div class="listbox"><h4>Visit Us</h4>
            <ul>
                <li>1400 Spring Garden St.</li>
                <li>Greensboro, NC 27412</li>
            </ul>
        </div>
    </div>
    
    <br>
    
    <div class="action-box-rounded">
    	<div class="listbox"><h4>Call Us</h4>
            <ul>
                <li>Sales (919) 888-8888</li>
                <li>General (919) 888-8888</li>
            </ul>
        </div>       
    </div>

	<br>

    <div class="action-box-rounded">
    	<div class="listbox"><h4>Hours</h4>
        	<ul>
                <li>Mon-Sat 9-9</li>    
                <li>Sunday 11-7</li>    
        	</ul>
        </div>       
    </div>
    
    <br>

    <div class="action-box-rounded">
    	<div class="listbox"><h4>Email Us</h4>
            <ul>
                <li>CSC@uncg.edu</li> 
            </ul>
        </div>       
    </div>
</div>

</body>
</html>