<?php
session_start();
include 'dbFunctions.php';
$gc = "SELECT * FROM content ORDER BY content_id DESC LIMIT 1";
$getContent = mysqli_query($link, $gc) or die(mysqli_error($link));
$check = false;
if (!isset ($_SESSION['user_name'])) {
    $check = true;
} else {
    $un = $_SESSION['user_name'];
    $users = "SELECT * FROM user WHERE user_name = '$un'";
    $get = mysqli_query($link, $users) or die(mysqli_error($link));
    $rowU = mysqli_fetch_array($get);
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
    <script src="js/jquery.min.js"></script>
    <script src="js/simpleCart.min.js"></script>
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
                    <?php if ($check) { ?>
                        <li><a href="login.php">Login</a></li>
                    <?php } else {
                        ?>
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
                    <?php } ?>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- banner -->
<div class="banner">
    <div class="container">
        <div class="b_room">
            <div class="booking_room"><br/>
                <div class="reservation">
                    <div class="book-top">
                        <div class="b-search">
                            <div class="boo-lef">
                                <i class="sear"></i>
                                <p>Search</p>
                            </div>
                        </div>
                        <div class="pick">
                            <div class="boo-lef">
                                <i class="sele"></i>
                                <p>Pick</p>
                            </div>
                        </div>
                        <div class="delv">
                            <div class="boo-lef">
                                <i class="ca-r"></i>
                                <p>Delivered</p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <ul>
                        <li class="span1_of_1">
                            <!----------start section_room----------->
                            <form>
                                <input type="text" class="textbox" value="Resturant Name" onfocus="this.value = '';"
                                       onblur="if (this.value == '') {this.value = 'Resturant Name';}">
                            </form>
                        </li>
                        <li class="span1_of_1">
                            <!----------start section_room----------->
                            <div class="section_room">
                                <select id="country" onchange="change_country(this.value)" class="frm-field required">
                                    <option value="null">Enter City Name</option>
                                    <option value="null">popular areas</option>
                                    <option value="AX">Maroubra</option>
                                    <option value="AX">Ultimo</option>
                                </select>
                            </div>
                        </li>
                        <li class="span1_of_3">
                            <div class="date_btn">
                                <form action="resturants.html">
                                    <input type="submit" value="Find resturants">
                                </form>
                            </div>
                        </li>
                        <div class="clearfix"></div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- promotion -->
<div class="latis">
    <div class="container">
        <div class="col-md-4 latis-left">
            <h3>Maecenas ornare enim</h3>
            <img src="images/4.jpg" class="img-responsive" alt="">
            <div class="special-info grid_1 simpleCart_shelfItem">
                <p>Cum sociis natodiculus mus.rhoncus egestas ac sit </p>
                <div class="cur">
                    <div class="cur-left">
                        <div class="item_add"><span class="item_price"><a class="morebtn hvr-rectangle-in" href="#">Add to cart</a></span>
                        </div>
                    </div>
                    <div class="cur-right">
                        <div class="item_add"><span class="item_price"><h6>only $45.00</h6></span></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 latis-left">
            <h3>Dis parturient montes</h3>
            <img src="images/1.jpg" class="img-responsive" alt="">
            <div class="special-info grid_1 simpleCart_shelfItem">
                <p>Cum sociis natodiculus mus.rhoncus egestas ac sit </p>
                <div class="cur">
                    <div class="cur-left">
                        <div class="item_add"><span class="item_price"><a class="morebtn hvr-rectangle-in" href="#">Add to cart</a></span>
                        </div>
                    </div>
                    <div class="cur-right">
                        <div class="item_add"><span class="item_price"><h6>only $55.00</h6></span></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 latis-left">
            <h3>Curabitur congue blandit</h3>
            <img src="images/3.jpg" class="img-responsive" alt="">
            <div class="special-info grid_1 simpleCart_shelfItem">
                <p>Cum sociis natodiculus mus.rhoncus egestas ac sit </p>
                <div class="cur">
                    <div class="cur-left">
                        <div class="item_add"><span class="item_price"><a class="morebtn hvr-rectangle-in" href="#">Add to cart</a></span>
                        </div>
                    </div>
                    <div class="cur-right">
                        <div class="item_add"><span class="item_price"><h6>only $65.00</h6></span></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- menu -->
<div class="feature">
    <div class="container">
        <div class="fle-xsel">
            <ul id="flexiselDemo3">
                <li>
                    <img src="images/1p.jpg" class="img-responsive" alt="">
                </li>
                <li>
                    <img src="images/2p.jpg" class="img-responsive" alt="">
                </li>
                <li>
                    <img src="images/3p.png" class="img-responsive" alt="">
                </li>
                <li>
                    <img src="images/4p.jpg" class="img-responsive" alt="">
                </li>
                <li>
                    <img src="images/5p.jpg" class="img-responsive" alt="">
                </li>
                <li>
                    <img src="images/6p.jpg" class="img-responsive" alt="">
                </li>
                <li>
                    <img src="images/7p.jpg" class="img-responsive" alt="">
                </li>
                <li>
                    <img src="images/8p.jpg" class="img-responsive" alt="">
                </li>
            </ul>
            <script type="text/javascript">
                $(window).load(function () {
                    $("#flexiselDemo3").flexisel({
                        visibleItems: 8,
                        animationSpeed: 1000,
                        autoPlay: true,
                        autoPlaySpeed: 3000,
                        pauseOnHover: true,
                        enableResponsiveBreakpoints: true,
                        responsiveBreakpoints: {
                            portrait: {
                                changePoint: 480,
                                visibleItems: 2
                            },
                            landscape: {
                                changePoint: 640,
                                visibleItems: 3
                            },
                            tablet: {
                                changePoint: 768,
                                visibleItems: 3
                            }
                        }
                    });
                });
            </script>
            <script type="text/javascript" src="js/jquery.flexisel.js"></script>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- chefs -->
<div class="magnust">
    <div class="container">
        <h3>Chefs</h3>
        <div class="col-md-4 magnust-top">
            <div class="magnust-left">
                <img src="images/staff/staff.jpg" class="img-responsive" alt="">
            </div>
            <div class="magnust-right">
                <h4><a href="#">TONY GEMIGNANI</a></h4>
                <p> Specialties:Pizza, Pasta, Italian Cuisine</p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-4 magnust-top">
            <div class="magnust-left">
                <img src="images/staff/staff1.jpg" class="img-responsive" alt="">
            </div>
            <div class="magnust-right">
                <h4><a href="#">MOURAD LAHLOU</a></h4>
                <p> Specialties:Modern Moroccan Cuisine</p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-4 magnust-top">
            <div class="magnust-left">
                <img src="images/staff/staff2.jpg" class="img-responsive" alt="">
            </div>
            <div class="magnust-right">
                <h4><a href="#">CURTIS DI FEDE</a></h4>
                <p> Specialties:Japanese, Italian, Californian</p>
            </div>
            <div class="clearfix"></div>
        </div>
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


<div id="container_wrapper_outter">
    <div style="position:fixed ;right:0px;">
        <ul id="bar">
            <li class="logo">
                <img style="float:left;" alt="" src="images/left.png"/>
            </li>
            <li>
                <?php if ($check) { ?>
                    <a href="login.php">Login</a>
                <?php } else {
                    ?>
                    <a href="logOut.php">Logout</a>
                    <ul>
                        <li><a href="usercenter.php">Member Center</a></li>
                        <?php if ($_SESSION['role'] != 3) { ?>
                            <li><a href="admin/dashboard.php">Admin Center</a></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
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
                    <li><a href="trackOrder.php">My Reel Room</a></li>
                    <li><a href="about_us.php">About US</a></li>
                </ul>
            </div>
            <!-- end of menu -->
            <div id="sliderFrame">
                <div id="slider">
                    <?php $gImg = "SELECT * FROM slide_show ORDER BY id DESC LIMIT 5";
                    $getImg = mysqli_query($link, $gImg) or die(mysqli_error($link));
                    while ($imgs = mysqli_fetch_array($getImg)) {
                        $location = $imgs['image'];
                        $alt = $imgs['title'];
                        $tag = $imgs['type'];
                        $link = $imgs['link_id'];
                        if ($tag == "Link") {
                            ?>
                            <a href="article.php?content_id=<?php echo $link; ?>">
                                <img src="images/index/<?php echo $location; ?>" alt="<?php echo $alt; ?>"/>
                            </a>
                            <?php
                        } else {
                            ?>
                            <img src="images/index/<?php echo $location; ?>" alt="<?php echo $alt; ?>"/>
                            <?php
                        }
                    }
                    ?>
                </div>
                <a id="mcis" href="http://www.menucool.com/horizontal/css-menu">Menucool CSS Menu helps you to create
                    pure CSS menus</a>
            </div>
            <div id="content_wrapper">
                <div id="content">
                    <div id="main_column">
                        <div class="section_w590">
                            <div class="section_w590_content">
                                <h2>What's new?</h2>
                                <?php while ($row = mysqli_fetch_array($getContent)) {
                                    $content_id = $row['content_id'];
                                    $title = $row['content_name'];
                                    $ptime = $row['post_time'];
                                    $stime = $row['start_time'];
                                    $etime = $row['end_time'];
                                    $pt = date('d-m-Y', strtotime($ptime));
                                    $compare = date('Y-m-d', strtotime("1970-01-01"));
                                    $stc = date('Y-m-d', strtotime($stime));
                                    $etc = date('Y-m-d', strtotime($etime));
                                    if ($compare != $stc || $compare != $etc) {
                                        $st = date('d-m-Y', strtotime($stime));
                                        $et = date('d-m-Y', strtotime($etime));
                                    } else {
                                        $st = null;
                                        $et = null;
                                    }
                                    $de = $row['description'];
                                    $cat = $row['category'];
                                    $image = $row['image'];
                                    $remark = $row['remarks'];
                                    ?>
                                    <h4><a href="article.php?content_id=<?php echo $content_id; ?>"><?php echo $title;
                                            if ($cat == "Promotion") {
                                                echo "<img  src='images/hot.gif' />";
                                            }
                                            ?></a></h4>
                                    <?php if ($st != null) { ?>
                                        <br/>
                                        <h3>Period:<?php echo $st; ?> -- <?php echo $et; ?></h3>&nbsp&nbsp&nbsp&nbsp
                                        <?php
                                    }
                                    ?><h3>Post Time: <?php echo $pt; ?>&nbsp&nbsp&nbsp&nbsp
                                    Tag: <?php echo $cat; ?></h3>
                                    <br/>
                                    <p><?php echo $de; ?></p>
                                    <?php if ($image != null) {
                                        list($width, $height, $type, $attr) = getimagesize('images/content/' . $image);
                                        if ($width > 600) {
                                            $height = ($width / $height) * 600;
                                            $width = 600;
                                            echo "<a href='images/content/$image' rel='prettyPhoto' ><img style='width='$width' height='$height' src='images/content/$image' /></a>";
                                        } else {
                                            echo "<a href='images/content/$image' rel='prettyPhoto' ><img src='images/content/$image' /></a>";
                                        }
                                    }
                                    ?>
                                    <p style="font-size: 8px; color: gray;"><i>
                                            <small><?php echo $remark; ?></small>
                                        </i></p>
                                    <br/><br/>
                                    <hr/><br/> <?php } ?>
                                <div class="button_01 fr"><a href="promotion.php">View All</a></div>
                                <br/><br/>
                            </div>
                        </div>
                    </div> <!-- end of main column -->
                    <div id="side_column">
                        <div class="side_column_section">
                            <?php if ($check) {
                                ?><h3>Log in</h3>
                                <form method="post" action="doLogin.php">
                                    <fieldset id="inputs">
                                        <input style="width:130px;" id="username" type="text" placeholder="Username"
                                               name="username" required/>
                                        <br/>
                                        <input style="width:130px;" id="password" type="password" placeholder="Password"
                                               name="password" required/>
                                    </fieldset>
                                    <fieldset id="actions">
                                        <input type="submit" id="button" value="Log in"/>
                                        <a href="getPassword.php">Forgot your password?</a><a href="register.php">Register</a>
                                    </fieldset>
                                </form>
                            <?php } else {
                                ?>
                                <h3>Member Center</h3>
                                <img width="150px" height="150px" src="images/userimg/<?php echo $rowU['user_img']; ?>"
                                     alt="Photo"/>
                                <br/>
                                <?php
                                echo "Welcome " . $_SESSION['user_name'] . "!";
                                ?>
                                <br/><a href="usercenter.php">Member Center</a>
                                <br/><a href="logOut.php">Log Out</a>
                                <?php
                            } ?>
                        </div>
                        <div class="side_column_bottom"></div>
                    </div> <!-- end of side column -->
                    <div
                        style="position: relative; float: right; top:20px; right: 30px; color: black;background: white;"
                        class="fb-like-box" data-href="http://www.facebook.com/pages/The-Reel-Room/284414581188"
                        data-width="220" data-height="300" data-show-faces="false" data-stream="true"
                        data-header="false"></div>
                    <div class="cleaner"></div>
                </div> <!-- end of content -->
                <div class="cleaner"></div>
                <div class="content_bottom"></div>
            </div> <!-- end of content wrapper -->
            <div id="footer">
                Copyright © 2012 <a href="index.php">Reel Room</a>
            </div>
            <!-- end of container -->
        </div>
    </div>
</div>
</body>
</html>