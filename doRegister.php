<?php
session_start();
include 'dbFunctions.php';
$username = $_POST['username'];
$nric = $_POST['nric'];
$query = "SELECT user_name,nric FROM user WHERE user_name = '$username' OR nric='$nric'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$msg = null;
$rownum = mysqli_fetch_row($result);

function getExtension($str)
{

    $i = strrpos($str, ".");
    if (!$i) {
        return "";
    }
    $l = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
}

if ($rownum != null) {
    $msg = "Username or NRIC already exist! Please <a href='register.php'>Try Again</a>";
} else {
    $target_path = "images/userimg/";
    $pic = "defaultpic.jpg";
    $user_img = basename($_FILES['photo']['name']);
    $address = $_POST['address'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $phone_number = $_POST['phone_number'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = 3;
    if ($user_img != null) {
        $filename = stripslashes($_FILES['photo']['name']);
        $extension = getExtension($filename);
        $extension = strtolower($extension);
        if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
            $msg = " Unknown Image extension ";
        } else {
            $target_path = $target_path . basename($_FILES['photo']['name']);
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)) {
                $insertQuery = "INSERT INTO user(nric,firstname,lastname,email,dateofbirth,address,user_name,phone_number,password,role,user_img,state) VALUES ('$nric','$firstname','$lastname','$email','$dob','$address','$username','$phone_number',SHA1('$password'),'$role','$user_img','Active')";
                $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link));
                if ($inserted) {
                    $getUser = "SELECT user_id FROM user WHERE nric='$nric' ";
                    $get = mysqli_query($link, $getUser) or die(mysqli_error($link));
                    $row_user = mysqli_fetch_array($get);
                    $user_id = $row_user['user_id'];
                    $msg = "Registration submitted successfully!
            Welcome $username!   | <a href='index.php'>Go Home Page</a>";
                    $condition = true;
                    $_SESSION['user_name'] = $username;
                    $_SESSION['role'] = $role;
                    $_SESSION['user_id'] = $user_id;
                } else {
                    $msg = "Registration submission failed, please <a href='register.php'>Try Again</a>";
                }
            }
        }
    } else {
        $insertQuery = "INSERT INTO user(nric,firstname,lastname,email,dateofbirth,address,user_name,phone_number,password,role,user_img,state) VALUES ('$nric','$firstname','$lastname','$email','$dob','$address','$username','$phone_number',SHA1('$password'),'$role','$pic','Active')";
        $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link));
        $msg = "Registration submitted successfully!
            Welcome $username!   | <a href='index.php'>Go Home Page</a>";
        $_SESSION['user_name'] = $username;
        $_SESSION['role'] = $role;
        $_SESSION['user_id'] = $user_id;
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
                <?php echo $msg ?>
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