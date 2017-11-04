<?php
session_start();
include 'dbFunctions.php';
$msg = null;
if (!isset($_SESSION['user_name'])) {
    header('Location: login.php');
} else {
    $user_name = $_SESSION['user_name'];
    $selectQuery = "SELECT * FROM user WHERE user_name = '$user_name'";

    $select_profile = mysqli_query($link, $selectQuery) or die(mysqli_error($link));
    $row = mysqli_fetch_array($select_profile);
    if (isset($_POST['email']) || isset($_POST['phone_number']) || isset($_POST['address'])) {
        $c = false;
        $user_name = $_SESSION['user_name'];
        $Email = $_POST['email'];
        $Phone_num = $_POST['phone_number'];
        $ads = $_POST['address'];
        $Address = htmlentities($ads, ENT_QUOTES);
        $target_path = "images/userimg/";
        $photoname = basename($_FILES['image']['name']);
        if ($photoname != null) {
            $target_path = $target_path . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                $updateQuery = "UPDATE user SET email='$Email',phone_number='$Phone_num',address='$Address',user_img='$photoname' WHERE user_name = '$user_name' ";
                $result = mysqli_query($link, $updateQuery) or die(mysqli_error($link));
                if ($result) {
                    $msg = "Update succeffully.";
                } else {
                    $msg = "Update failed, please try again!";
                }
            } else {
                $msg = "Update failed, please try again!(images)";
            }
        } else {
            $updateQuery = "UPDATE user SET email='$Email',phone_number='$Phone_num',address='$Address' WHERE user_name = '$user_name' ";
            $update_profile = mysqli_query($link, $updateQuery) or die(mysqli_error($link));

            if ($update_profile) {
                $msg = "Update profile successfully!";
            } else {
                $msg = "Update profile failed!";
            }
        }

        echo "  <script type='text/javascript'>";
        echo " alert('$msg');";
        echo " history.go(-1);";
        echo "  </script> ";

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
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet'
              type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,700' rel='stylesheet' type='text/css'>
        <script src="js/jquery.min.js"></script>
        <script src="js/simpleCart.min.js"></script>
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
                        <li class="dropdown" id="nav-mark-btn">
                            <a class="dropdown-toggle">Dashboard<span class="caret"></span></a>
                            <ul class="dropdown-menu" id="mark-info" style="padding: 0px">
                                <li><a href="usercenter.php">User Center</a></li>
                                <?php if ($_SESSION['role'] != 3) { ?>
                                    <li><a href="admin/dashboard.php">User Center</a></li>
                                <?php } ?>
                                <li><a href="logOut.php">Logout &nbsp;</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="login-page" id="box">
        <div class="row">
            <div class="col-md-8">
                <form enctype="multipart/form-data" method="post"
                      action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                    <table>
                        <tr>
                            <td>NRIC:</td>
                            <td><?php echo $row['nric']; ?></td>
                        </tr>
                        <tr>
                            <td>First name:</td>
                            <td><?php echo $row['firstname'] ?></td>
                        </tr>
                        <tr>
                            <td>Last name:</td>
                            <td><?php echo $row['lastname'] ?></td>
                        </tr>
                        <tr>
                            <td>Date of birth:</td>
                            <td><?php echo $row['dateofbirth'] ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><input type="text" name="email" value="<?php echo $row['email'] ?>"/>
                            </td>
                        </tr>

                        <tr>
                            <td> Phone number:</td>
                            <td><input type="text" name="phone_number" size="8"
                                       value="<?php echo $row['phone_number'] ?>"/></td>
                        </tr>

                        <tr>
                            <td>Address:</td>
                            <td><input type="text" name="address" size="50"
                                       value="<?php echo $row['address'] ?>"/></td>
                        </tr>
                        <tr>
                            <td>User image:</td>
                            <td><img width="150px" height="150px"
                                     src="images/userimg/<?php echo $row['user_img']; ?>"
                                     alt="Photo"/><br/><input type="file" name="image"/></td>
                        </tr>
                    </table>
                    <hr/>
                    <input style="margin-left: 100px;" type="submit" value="Change"
                           style="margin-left: 0px;"/>
                </form>
            </div>
            <div class="col-md-4">
                <h3>Control panel</h3>
                <ul>
                    <li><a href="trackOrder.php">Track My Order/Reservation</a></li>
                    <li><a href="usercenter.php">Edit profiles</a></li>
                    <li><a href="changepassword.php">Change password</a></li>
                    <li><a href="logOut.php">Log Out</a></li>
                </ul>
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
<?php } ?>