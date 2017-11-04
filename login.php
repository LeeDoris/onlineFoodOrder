<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>IFOOD</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700' rel='stylesheet' type='text/css'>
    <script src="js/jquery.min.js"></script>
    <script src="js/simpleCart.min.js"> </script>
</head>
<body>
<div class="header">
    <div class="container">
        <div class="logo">
            <a href="index.php"><img src="images/Logo.png" class="img-responsive" alt=""></a>
        </div>
        <div class="header-left">
            <div class="head-nav">
                <span class="menu"> </span>
                <ul>
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href=" promotion.php">Food</a></li>
                    <li><a href=" promotion.php?category=Promotion">Promotion</a></li>
                    <li><a href=" menu.php">Member</a></li>
                    <li><a href=" resturants.html">About Us</a></li>
                    <li><a href=" contact.html">Feedback</a></li>

                    <div class="clearfix"> </div>
                </ul>
                <!-- script-for-nav -->
                <script>
                    $( "span.menu" ).click(function() {
                        $( ".head-nav ul" ).slideToggle(300, function() {
                            // Animation complete.
                        });
                    });
                </script>
                <!-- script-for-nav -->
            </div>
            <div class="header-right1">
                <ul id="bar">
                    <li>
                            <a href="login.php">Login</a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<div class="login-page">
    <div class="container">
        <div class="account_grid">
            <div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s">
                <h3>NEW CUSTOMERS</h3>
                <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                <a class="acount-btn" href="register.php">Create an Account</a>
            </div>
            <div class="col-md-6 login-right wow fadeInRight" data-wow-delay="0.4s">
                <h3>REGISTERED CUSTOMERS</h3>
                <p>If you have an account with us, please log in.</p>
                <form method="post" action="doLogin.php">
                    <div>
                        <span>Email Address<label>*</label></span>
                        <input id="username" type="text" name="username" required>
                    </div>
                    <div>
                        <span>Password<label>*</label></span>
                        <input id="password" type="password" name="password" required>
                    </div>
                    <a class="forgot" href="getPassword.php">Forgot Your Password?</a>
                    <input type="submit" id="button" value="Login">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="footer-left">
            <p>Copyrights © 2017 IFOOD All rights reserved</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
</body>
</html>
