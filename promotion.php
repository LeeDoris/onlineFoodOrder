<?php
//error_reporting("E_ALL");
session_start();
include 'dbFunctions.php';
require_once('paginator.class.php');

if(isset($_GET['category']) && $_GET['category']!=null){
    $cat=$_GET['category'];
    $queryNum = "SELECT COUNT(*) FROM content WHERE category ='$cat'";
$results = mysqli_query($link, $queryNum) or die(mysqli_error($link));
$num_rows=mysqli_fetch_row($results);
$pages = new Paginator;  
$pages->items_total = $num_rows[0];  
$pages->mid_range = 9;  
$pages->paginate();  
   $getContent = "SELECT * FROM content WHERE category ='$cat' ORDER BY content_id DESC  $pages->limit ";    
}else{
    $queryNum = "SELECT COUNT(*) FROM content";
$results = mysqli_query($link, $queryNum) or die(mysqli_error($link));
$num_rows=mysqli_fetch_row($results);
$pages = new Paginator;  
$pages->items_total = $num_rows[0];  
$pages->mid_range = 9;  
$pages->paginate();  
    $getContent = "SELECT * FROM content  ORDER BY content_id DESC  $pages->limit ";  
}
$resultContent= mysqli_query($link, $getContent) or die(mysqli_error($link));
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IFood</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="css/tool_bar.css" rel="stylesheet" type="text/css" />
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
<div id="container_wrapper_outter">
            <div style="position:fixed ;right:0px;">
        <ul id="bar">
            <li class="logo">
                <img style="float:left;" alt="" src="images/left.png"/>
            </li>
            <li>
                <?php if(!isset($_SESSION['user_name'])){ ?>
                    <a href="login.php">Login</a>
                <?php }else{ ?>
                    <a href="logOut.php">Logout</a>
            <ul> 
            <li><a href="usercenter.php">Member Center</a></li>
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
            <li><a href="menu.php" >Menu</a></li>
            <li><a href="reservation.php">Reservation</a></li>
            <li><a href="order.php" >Order</a></li>
            <li><a href="trackOrder.php">My IFood</a></li>
            <li><a href="about_us.php">About US</a></li>
</ul>
        
 </div>	
    <!-- end of menu -->
        
    <div id="content_wrapper">
        <div id="content">
        
        	<div id="main_column">
                    <div class="section_w590" style="width:860px;">
                       <h2>What's new?</h2>
                        <div class="section_w590_content">
                            <br /><br />
                            <?php while($row=mysqli_fetch_array($resultContent)){
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
                    <?php echo $pages->display_pages().$pages->display_jump_menu();?> 
                </div> 
            </div> <!-- end of main column -->
        
        
	</div> <!-- end of content wrapper -->
        <!-- end of container -->


        <div class="cleaner"></div>
        </div> <!-- end of content -->
        <div class="cleaner"></div>
        <div class="content_bottom"></div>
        
	</div> <!-- end of content wrapper -->    
<div id="footer">
    	Copyright © 2017 <a href="index.php">IFood</a>
</div>
</div>
</div>
</div>
</body>
</html>