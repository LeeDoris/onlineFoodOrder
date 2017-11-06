<?php
//error_reporting("E_ALL");
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['user_name'])) {
    header('Location: login.php');
} else {
    require_once "admin/class.phpmailer.php";
    date_default_timezone_set('Asia/Singapore');
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->Username = "douzi.doris@gmail.com";
    $mail->Password = "848323abc";
    include 'dbFunctions.php';
    $message = null;
    $condition = false;
    $collectdate = $_POST['date'];
    $collection_date = date('Y-m-d H:i', strtotime($collectdate));
    if ($_POST['type'] == "delivery" && ($_POST['address'] == null || $_POST['postcode'] = null)) {
        echo "  <script type='text/javascript'>";
        echo " alert('You should specify your delivery address!');";
        echo " history.go(-2);";
        echo "  </script> ";
    } else {
        $order_id = $_POST['order_id'];
        $userid = $_SESSION['user_id'];
        $totalp = $_POST['total_price'];
        $collect = $_POST['type'];
        $items = array($_POST['item']);
        $num_item = $_POST['n_i'] - 1;
        $count = 0;
        $currentdate = $_POST['c_date'];
        if ($collect == "delivery") {
            $currentdate = date('Y-m-d H:i', time());
            $address = $_POST['address'] . " " . $_POST['postcode'];
            $totalp = $totalp + 5;
            $insertQuery = "INSERT INTO orders(order_id,user_id,total_price,type,date,state,address,order_time) VALUES ('$order_id','$userid','$totalp','$collect','$collection_date','Accepted','$address','$currentdate')";
        } else {
            $currentdate = date('Y-m-d H:i', time());
            $insertQuery = "INSERT INTO orders(order_id,user_id,total_price,type,date,state,order_time) VALUES ('$order_id','$userid','$totalp','$collect','$collection_date','Accepted','$currentdate')";
        }
        $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link));
        if ($inserted) {
            while ($count <= $num_item) {
                $item_id = $items[0][$count + 1]['name'];
                $item_q = $items[0][$count + 1]['quantity'];
                $count++;
                $insertQuery = "INSERT INTO order_item (order_id,item_id,quantity) VALUES ('$order_id','$item_id','$item_q')";
                $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link));
                if ($inserted) {
                    $message = "Submission successfully";
                } else {
                    $message = "Submission failed,order_item";
                }
            }
            $query = "SELECT admin_email FROM email WHERE id=2";
            $getEmail = mysqli_query($link, $query) or die(mysqli_error($link));
            $row = mysqli_fetch_array($getEmail);
            $to = $row['admin_email'];
            $mail->SetFrom('douzi.doris@gmail.com', 'IFood');
            $mail->AddReplyTo('douzi.doris@gmail.com', "IFood");
            $mail->Subject = "New Order";
            $mail->Body = "A new order is coming.";
            $address = $to;
            $mail->AddAddress($to);
            if (!$mail->Send()) {
                $message = "Mailer Error: " . $mail->ErrorInfo;
            } else {
                $message = "Order submission successfully, thank you for ordering with us!";
            }
            $condition = true;
        } else {
            $message = "Submission failed,please try again.1";
        }

        ?>

        <!DOCTYPE html>
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <title>IFood</title>
            <link href="style.css" rel="stylesheet" type="text/css"/>
        </head>
        <body>
        <div id="container_wrapper_outter">
            <div style="position:fixed ;right:0px;">
                <ul id="bar">
                    <li class="logo">
                        <img style="float:left;" alt="" src="images/left.png"/>
                    </li>
                    <li>
                        <a href="logOut.php">Logout</a>
                        <ul>
                            <li><a href="usercenter.php">Member Center</a></li>
                        </ul>
                    </li>
                </ul>
                <img style="float:left;" alt="" src="images/right.png"/>
            </div>
            <div id="container_wrapper_inner">
                <div id="container">

                    <div id="menu">

                        <div id="main_Logo"></div>
                        <ul id="nav">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="promotion.php">News</a></li>
                            <li><a href="promotion.php?category=Promotion">Promotion</a></li>
                            <li><a href="menu.php">Menu</a></li>
                            <li><a href="reservation.php">Reservation</a></li>
                            <li><a href="order.php">Order</a></li>
                            <li><a href="trackOrder.php">My IFood</a></li>
                            <li><a href="about_us.php">About US</a></li>
                        </ul>

                    </div>
                    <div id="content_wrapper">
                        <div id="content">

                            <div id="main_column">

                                <div class="section_w590">

                                    <h2>Order information</h2>


                                    <?php
                                    echo $message;
                                    ?>
                                    <br/>
                                    <?php if ($condition) {
                                        include('shopping_cart.class.php');
                                        session_start();
                                        $Cart = new Shopping_Cart('shopping_cart');

                                        $Cart->emptyCart();

                                        $Cart->save();
                                        ?>
                                        <br/>
                                        <p><b>Collection Time : <?php echo $collection_date; ?></b></p>
                                        <?php
                                    }
                                    ?>
                                    <div class="section_w590_content">


                                    </div>

                                </div>

                                <div class="cleaner_h50"></div>

                                <div class="section_w590">


                                    <div class="section_w590_content">


                                        <div class="cleaner_h20"></div>


                                    </div>

                                </div>

                            </div> <!-- end of main column -->


                            <div class="cleaner"></div>
                        </div> <!-- end of content -->

                        <div class="cleaner"></div>
                        <div class="content_bottom"></div>
                    </div> <!-- end of content wrapper -->

                    <div id="footer">
                        Copyright © 2017 <a href="index.php">IFood</a>
                    </div>

                </div>
                <!-- end of container -->

            </div>
        </div>

        </body>
        </html>
    <?php }
} ?>