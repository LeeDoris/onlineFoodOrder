<?php
include 'dbFunctions.php';
if ($_POST['item_name'] != null) {
    $name = $_POST['item_name'];
    $price = $_POST['item_price'];
    $category = $_POST['category'];
    $desc = $_POST['description'];
    $insertQuery = "INSERT INTO item(item_name,item_price,item_category,item_desc) VALUES ('$name','$price','$category','$desc')";
    $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link));
    if ($inserted) {
        $msg = "New item added succeffully.";
    } else {
        $msg = "Item added failed, please try again!";
    }
} else {
    $msg = "Item added failed, please try again.";
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reel Room</title>
    <link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<div id="container_wrapper_outter">
    <div id="container_wrapper_inner">

        <div id="container">
            <br/>
            <form method="post" action="doLogin.php" name="logIn">
                <p id="login">User : <input type="text" name="username" id="username"/>
                    Password : <input type="password" name="password" id="password"/>
                    <input type="submit" value=" Login"/>
                    <a href="register.php">Register</a>
                </p>
            </form>
            <div id="menu">
                <ul>
                    <li><a href="index.php" class="current">Home</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="reservation.php" class="margin_r_330">Reservation</a></li>
                    <li><a href="order.php">Order</a></li>
                    <li><a href="about_us.php">About US</a></li>
                </ul>
                <div id="site_title">
                    <h1>
                        <a href="index.php">Reel Room</a>
                    </h1>
                </div>
            </div> <!-- end of menu -->
            <div id="banner">
                <div id="banner_section">
                </div> <!-- banner section -->
            </div> <!-- end of banner -->
            <div id="content_wrapper">
                <div id="content">

                    <div id="main_column">

                        <div class="section_w590">


                            <div class="section_w590_content">
                                <p><?php echo $msg ?></p>
                                <p><a href="manage_menu.php">Go Back</a></p>
                            </div>

                        </div>

                        <div class="cleaner_h50"></div>

                        <div class="section_w590">

                            <div class="section_w590_content">


                            </div>

                        </div>

                    </div> <!-- end of main column -->


                    <div class="cleaner"></div>
                </div> <!-- end of content -->

                <div class="cleaner"></div>
                <div class="content_bottom"></div>
            </div> <!-- end of content wrapper -->

            <div id="footer">
                Copyright © 2012 <a href="index.php">Reel Room</a>
            </div>

        </div>
        <!-- end of container -->

    </div>
</div>

</body>
</html>