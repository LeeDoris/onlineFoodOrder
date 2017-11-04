<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>IFOOD</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700' rel='stylesheet' type='text/css'>
    <script src="js/jquery.min.js"></script>
    <script language="javascript" type="text/javascript" src="datetimepicker.js"></script>
    <script src="js/simpleCart.min.js"></script>
    <script src="js/form_validator.js"></script>
</head>
<body>
<div class="header">
    <div class="container">
        <div class="logo">
            <a href="index.php"><img src="images/logo.png" class="img-responsive" alt=""></a>
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

                    <div class="clearfix"></div>
                </ul>
                <!-- script-for-nav -->
                <script>
                    $("span.menu").click(function () {
                        $(".head-nav ul").slideToggle(300, function () {
                            // Animation complete.
                        });
                    });
                </script>
                <!-- script-for-nav -->
            </div>
            <div class="header-right1">
                <ul id="bar">
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="container">
    <div class="register">
        <form enctype="multipart/form-data" method="post" action="doRegister.php" name="rform" id="rform">
            <div class="register-top-grid">
                <h3>PERSONAL INFORMATION</h3>
                <div class="wow fadeInLeft" data-wow-delay="0.4s">
                    <span>NRIC:<label>*</label></span>
                    <input type="text" name="nric">
                </div>
                <div class="wow fadeInRight" data-wow-delay="0.4s">
                    <span>First Name<label>*</label></span>
                    <input type="text" name="firstname">
                </div>
                <div class="wow fadeInLeft" data-wow-delay="0.4s">
                    <span>Last Name<label>*</label></span>
                    <input type="text" name="lastname">
                </div>
                <div class="wow fadeInRight" data-wow-delay="0.4s">
                    <span>Email Address<label>*</label></span>
                    <input type="text" name="email">
                </div>
                <div class="wow fadeInLeft" data-wow-delay="0.4s">
                    <span>Phone number<label>*</label></span>
                    <input type="text" name="phone_number">
                </div>
                <div class="wow fadeInRight" data-wow-delay="0.4s">
                    <span>Address<label>*</label></span>
                    <input type="text" name="address">
                </div>

                <div class="wow fadeInLeft" data-wow-delay="0.4s">
                    <span>Username<label>*</label></span>
                    <input type="text" name="username">
                </div>
                <div class="wow fadeInRight" data-wow-delay="0.4s">
                    <span>Password<label>*</label></span>
                    <input type="password" name="password">
                </div>
                <div class="wow fadeInLeft" data-wow-delay="0.4s">
                    <span>Confirm Password<label>*</label></span>
                    <input type="password" name="confirmpassword">
                </div>
                <div class="wow fadeInRight" data-wow-delay="0.4s">
                    <span>Date of Birth<label>*</label></span>
                    <input type="text" name="dob" id="dob">
                    <a href="javascript:NewCal('dob','yyyymmdd')"><img src="images/cal.gif" width="20" height="20" border="1" alt="Pick a date" /></a><i><span style="font-size: 10px; margin-left:10px;" id='rform_dob_errorloc' class="error_strings"></span></i>
                </div>
                <div class="wow fadeInLeft" data-wow-delay="0.4s">
                    <span>Photo</span>
                    <input type="file" name="photo">
                </div>
                <br />
            </div>
            <div style="float: left">
                <input type="submit" id="button" value="submit">
            </div>
        </form>
        <script language="JavaScript" type="text/javascript">
            var frmvalidator = new Validator("rform");
            frmvalidator.EnableOnPageErrorDisplay();
            frmvalidator.EnableMsgsTogether();
            frmvalidator.addValidation("nric", "req", "Please enter a NRIC.(Student ID for RP students)");
            frmvalidator.addValidation("firstname", "req", "Please enter your First Name");
            frmvalidator.addValidation("firstname", "alpha", "Please enter valid First Name");
            frmvalidator.addValidation("lastname", "req", "Please enter your Last Name");
            frmvalidator.addValidation("lastname", "alpha", "Please enter valid Last Name");
            frmvalidator.addValidation("email", "maxlen=50");
            frmvalidator.addValidation("email", "req", "Please enter your Email.");
            frmvalidator.addValidation("email", "email", "Please enter a valid Email address.");
            frmvalidator.addValidation("dob", "req", "Please enter your date of birth.");
            frmvalidator.addValidation("phone_number", "req", "Please enter your phone number.");
            frmvalidator.addValidation("phone_number", "num", "Please enter a valid number.");
            frmvalidator.addValidation("phone_number", "minlen=8", "Please enter a valid number.");
            frmvalidator.addValidation("address", "req", "Please enter your address.");
            frmvalidator.addValidation("username", "minlen=6", "Username should be at least 6 characters.");
            frmvalidator.addValidation("username", "req", "Please enter your user name.");
            frmvalidator.addValidation("password", "minlen=8", "Password should be at least 8 characters");
            frmvalidator.addValidation("password", "req", "Please enter your password.");
            frmvalidator.addValidation("confirmpassword", "req", "Please confir your password.");
            frmvalidator.addValidation("confirmpassword", "eqelmnt=password", "The confirmed password should be same as password.");
        </script>
        <div class="clearfix"></div>
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