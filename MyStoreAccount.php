<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Store Account</title>


<style>

  .action-box-rounded{
        border:1px solid;border-color:#09F;width:400px;margin:10px;margin-left:20px
   }
   
</style>

</head>
<?php include 'NavigationBar.php'; ?>
<body>

<div align="center">

<div class="action-box-rounded">
<div class="listbar">
<div class="listbox"><h4>Order Management</h4>
<ul>
<!--<li class="a-spacing-micro">
<a href="StoreViewOpenOrders.php">View Open Orders</a>
</li>-->
<li class="a-spacing-micro">
<a href="StoreViewAllOrders.php">View Order History</a>
</li>
</ul>
</div>
</div>
</div>

<br>

<div class="action-box-rounded">
<div class="listbar">
<div class="listbox"><h4>Book Management</h4>
<ul>
<li class"a-spacing-micro>
<a href="StoreViewAllBooks.php">View All Books</a>
</li>
<li class"a-spacing-micro>
<a href="InsertBook.php">Add a Book</a>
</li>
</ul>
</div>
</div>
</div>

<br>

<div class="action-box-rounded">
<div class="listbar">
<div class="listbox"><h4>Store Settings</h4>
<ul>
<li class"a-spacing-micro>
<a href="StoreAccountSetting.php">Account Setting</a>
</li>
</ul>
</div>
</div>
</div>


</div>


</body>
</html>