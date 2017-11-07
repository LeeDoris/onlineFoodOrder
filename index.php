<?php
session_start();
include 'dbFunctions.php';
$gc = "SELECT * FROM content ORDER BY content_id DESC LIMIT 1";
$getContent= mysqli_query($link, $gc) or die(mysqli_error($link));
$check=false;
if (!isset ($_SESSION['user_name']) ){
    $check=true;
}else{
    $un=$_SESSION['user_name'];
$users = "SELECT * FROM user WHERE user_name = '$un'";
$get= mysqli_query($link, $users) or die(mysqli_error($link));
$rowU=  mysqli_fetch_array($get);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IFood</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="css/js-image-slider.css" rel="stylesheet" type="text/css" />
<script src="js/js-image-slider.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
    
<script type="text/javascript">

$(document).ready(function(){
	$("a[rel^='prettyPhoto']").prettyPhoto();
});
	
</script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/zh_CN/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="container_wrapper_outter">
        <div style="position:fixed ;right:0px;">
        <ul id="bar">
            <li class="logo">
                <img style="float:left;" alt="" src="images/left.png"/>
            </li>
            <li>
                <?php if($check){ ?>
                    <a href="login.php">Login</a>
                <?php }else{
                    ?>
                    <a href="logOut.php">Logout</a>
            <ul> 
            <li><a href="usercenter.php">Member Center</a></li>
            <?php                      if($_SESSION['role']!=3){ ?>
                          <li><a href="admin/dashboard.php">Admin Center</a></li>
                     <?php }?>
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
            <li><a href="menu.php" >Menu</a></li>
            <li><a href="reservation.php">Reservation</a></li>
            <li><a href="order.php" >Order</a></li>
            <li><a href="trackOrder.php">My IFood</a></li>
            <li><a href="about_us.php">About US</a></li>
</ul>
        
 </div>	
    <!-- end of menu -->
    <div id="sliderFrame">
        <div id="slider">
            <?php $gImg = "SELECT * FROM slide_show ORDER BY id DESC LIMIT 5";
$getImg= mysqli_query($link, $gImg) or die(mysqli_error($link)); 
            while($imgs=mysqli_fetch_array($getImg)){
                $location=$imgs['image'];
                $alt=$imgs['title'];
                $tag=$imgs['type'];
                $link=$imgs['link_id'];
                if($tag=="Link"){
                ?>
            <a href="article.php?content_id=<?php echo $link;?>">
                <img src="images/index/<?php echo $location;?>" alt="<?php echo $alt;?>"/>
            </a>
                <?php
            }else{?>
            <img src="images/index/<?php echo $location;?>" alt="<?php echo $alt;?>"/>
                <?php
            }
            }
?>
        </div>
        <a id="mcis" href="http://www.menucool.com/horizontal/css-menu">Menucool CSS Menu helps you to create pure CSS menus</a>
    </div>
        
    <div id="content_wrapper">
        <div id="content">
        
        	<div id="main_column">
                    <div class="section_w590">
                       
                        <div class="section_w590_content">
                            <h2>What's new?</h2>
                            <?php while($row=mysqli_fetch_array($getContent)){
                                $content_id=$row['content_id'];
                                $title = $row['content_name'];
                                 $ptime=$row['post_time'];
                                 $stime=$row['start_time'];
                                 $etime=$row['end_time'];
                                 $pt=date('d-m-Y', strtotime($ptime));
                                 $compare = date('Y-m-d', strtotime("1970-01-01"));
                                 $stc = date('Y-m-d', strtotime($stime));
                                 $etc = date('Y-m-d', strtotime($etime));
                                 if ($compare!=$stc|| $compare!=$etc){
                                     $st=date('d-m-Y', strtotime($stime));
                                     $et=date('d-m-Y', strtotime($etime));
                                 }else{
                                     $st=null;
                                     $et=null;
                                 }
                                 $de = $row['description'];
                                 $cat=$row['category'];
                                 $image = $row['image'];
                                 $remark=$row['remarks'];
                                 ?>
                          
                            <h4><a href="article.php?content_id=<?php echo $content_id;?>"><?php echo $title;if($cat=="Promotion"){
                                echo "<img  src='images/hot.gif' />";
                            }
?></a></h4>
                            <?php if($st!=null){ ?>
                                <br />
                                <h3>Period:<?php echo $st;?> -- <?php echo $et;?></h3>&nbsp&nbsp&nbsp&nbsp
                                <?php
                            }
                      ?><h3>Post Time: <?php echo $pt;?>&nbsp&nbsp&nbsp&nbsp Tag: <?php echo $cat;?></h3>
                      <br />          
                      <p><?php echo $de;?></p>
                      <?php if($image!=null){
                          list($width, $height, $type, $attr) = getimagesize('images/content/'.$image);
                        if ($width>600){
                            $height=($width/$height)*600;
                            $width=600;
                            echo "<a href='images/content/$image' rel='prettyPhoto' ><img style='width='$width' height='$height' src='images/content/$image' /></a>";
                        }else{
                            echo "<a href='images/content/$image' rel='prettyPhoto' ><img src='images/content/$image' /></a>";
                        }
                          
                      }
                      ?>                    
                      <p style="font-size: 8px; color: gray;"><i><small><?php echo $remark;?></small></i></p>
                    <br /><br /><hr /><br /> <?php }?>
                    <div class="button_01 fr"><a href="promotion.php">View All</a></div>
                <br /><br />
                  </div>
                    
                </div> 
                
            </div> <!-- end of main column -->
            
            <div id="side_column">
            
            		<div class="side_column_section">
                   	  
                          <?php if ($check){
?><h3>Log in</h3>
<form method="post" action="doLogin.php">
    <fieldset id="inputs">
        <input style="width:130px;" id="username" type="text" placeholder="Username" name="username"  required />  
        <br />
        <input style="width:130px;" id="password" type="password" placeholder="Password" name="password" required />
    </fieldset>
    <fieldset id="actions">
        <input type="submit" id="button" value="Log in" />
        <a href="getPassword.php">Forgot your password?</a><a href="register.php">Register</a>
    </fieldset>
</form>                              
                                <?php }else{

                                    ?>
                                     <h3>Member Center</h3>
                                     <img width="150px" height ="150px" src="images/userimg/<?php echo $rowU['user_img'];?>" alt="Photo"/>
                                     <br />
                                     <?php
                                     echo "Welcome ".$_SESSION['user_name']."!";
                                     ?> 
                                     <br /><a href="usercenter.php">Member Center</a>
                                     <br /><a href="logOut.php">Log Out</a>
                                     <?php
                                } ?>

              </div>
                    
            
            	<div class="side_column_bottom"></div>
            </div> <!-- end of side column -->
            
        <div style="position: relative; float: right; top:20px; right: 30px; color: black;background: white;" class="fb-like-box" data-href="http://www.facebook.com/pages/The-Reel-Room/284414581188" data-width="220" data-height="300" data-show-faces="false" data-stream="true" data-header="false"></div>    
        <div class="cleaner"></div>
        </div> <!-- end of content -->

        <div class="cleaner"></div>
        <div class="content_bottom"></div>
        
	</div> <!-- end of content wrapper -->      
    
    <div id="footer">
    	Copyright © 2017 <a href="index.php">IFood</a>
    </div>
<!-- end of container -->

</div>
</div>


</div>
</body>
</html>