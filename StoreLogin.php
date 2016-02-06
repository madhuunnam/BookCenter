<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>


<style>

   .column-middle{
        border:1px solid;border-color:#09F;width:400px;border-bottom:none
   }
   .column-bottom{
        border:1px solid;border-color:#09F;width:400px
   }
   
</style>

</head>

<body>
    <div class="column-middle" style="margin:auto" align="center">
	
	<form action="StoreLoginchecking.php" id="login-form" method="POST" name="login_form">
	<input type="hidden" name="csrftok" class="csrftok" value="a01311fd90c4e0855d6cb88df89acf507cfd5aebf7fc84d95344d99c8e84c718">
	<h2>Store Login</h2>
	<p>
	Please enter your email address and password to log in.
	</p>
	<p>
	<label> Email Address</label>
	<input type="hidden" name="context" value="">
	<input type="email" maxlength="64" size="20" class="form200" name="username" value="">
	</p>
	
	<p>
	<label> Password</label>
	<input autocomplete="off" type="password" size="20" class="form200" name="password">
	</p>
    
	<p class="formLabel"><a href="/forgot">Forgot your password?</a></p>
	
	
	<p  style="margin:auto">
	<button name="store_submit" type="submit" value="Log In" class="ybtn ybtn-small"><span>Log In</span></button>
	</p>
			
	</form>
	
	</div>
    
    <div class="column-bottom" style="margin:auto" align="center">
	<div id="login-to-signup">
	<h2>No Account Yet?</h2>
	<p>That's okay.</p>
	<a href="StoreSignup.php" id="sign-up" class="ybtn ybtn-primary">Sign Up</a>
	</div>
	
	</div>

</body>
</html>