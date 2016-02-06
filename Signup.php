<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Signup</title>
    <style type="text/css">
      #signupSelector {
        width: 30%;
        height: 400px;
        border: 3px solid;
        border-radius: 14px;
        border-color: #f5f5f5;
        margin: 0 auto;
        padding: 20px;
        left: 50%;
        top: 20%;
        margin-top: 3%;
        text-align: center;
      }

      .signupHeader {
        text-align: center;
        color:#555;
      }

      a.signupAnchor {
        border: 2px solid;
        border-radius: 14px;
        padding:20px 20px;
        font-size: 1.5em;
        background-color: #f5f5f5;
        width: 400px;
      }

      a.signupAnchor, hr {
        text-decoration: none;
        color:#aaa;
      }

      a.signupAnchor:hover {
        text-decoration: none;
        color:#555;
      }
    </style>
  </head>
  <body>
  <?php
    session_start();
    include 'NavigationBar.php'; 
  ?>

   <div id="signupSelector">
     <h1 class='signupHeader'>Sign-Up</h1>
     <hr><br><br><br>
     <span><a class='signupAnchor' href='customerSignup.php'> Customer Signup </a></span><br><br><br><br><br>
     <span><a class='signupAnchor'href='storeSignup2.php'> Store Signup </a></span></br><br><br><br><br>
     <span><a class='signupAnchor'href='adminSignup.php'> Admin Signup </a></span>
   </div> 
  </body>
</html>