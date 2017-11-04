<?php
include 'dbFunctions.php';
session_start();
$msg = null;
$condition = false;
if (isset($_POST)) {
    $username = $_POST['username'];
    $pw = sha1($_POST['password']);
    $select = "SELECT * FROM user WHERE user_name = '$username'";
    $selectUser = mysqli_query($link, $select) or die(mysqli_error($link));
    $row = mysqli_fetch_array($selectUser);
    if ($row == null) {
        $msg = "Wrong username or password.";
        $condition = false;
    } else if ($pw != $row['password']) {
        $msg = "Wrong username or password.";
        $condition = false;
    } else if ($row['state'] == "Block") {
        $msg = "Sorry, your account is currently blocked by our system.";
    } else {
        $_SESSION['user_name'] = $username;
        $_SESSION['role'] = $row['role'];
        $_SESSION['user_id'] = $row['user_id'];
        $condition = true;
    }
}
?>
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
    <script src="js/simpleCart.min.js"></script>
    <script language="javascript" type="text/javascript">
        function gou(secs, a) {
            if (--secs > 0) {
                setTimeout("gou(" + secs + "," + a + ")", 1000);
            }
            else {
                if (a) {
                    location = 'index.php';
                } else {
                    history.back();
                }
            }
        }
    </script>
    <style>
        * {
            padding: 0;
            margin: 0
        }

        body, html {
            height: 100%;
        }

        #box {
            margin: 0 auto;
            height: 100%;
        }
    </style>
</head>
<body>
<div id="box">
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
                        <li>
                            <a href="login.php">Login</a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div style="text-align: center">
            <h1>
                <?php
                if ($condition == true && $_SESSION['role'] == 3) {
                    echo "Login success:" . $_SESSION['user_name'] . "<br/>";
                    echo "Auto-direct to home page after 5 seconds" . "<br/>";
                    echo "<script>gou(5,1)</script>";

                } else if ($condition == true && $_SESSION['role'] != 3) {
                    header('Location: admin/dashboard.php');
                } else {
                    echo $msg . "<br/>";
                    echo "Please try again. (5 seconds)" . "<br/>";
                    echo "<script>gou(5,0)</script>";
                }
                ?>
            </h1>
        </div>
    </div>
</div>
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
