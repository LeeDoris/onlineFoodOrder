<?php
session_start();
include 'dbFunctions.php';
$currentMenu = null;
if (!isset($_GET['menuid'])){
    $currentMenu = 1;
}else{
    $currentMenu = $_GET['menuid'];
}
    $getItem = "SELECT * FROM item WHERE item_category = '$currentMenu' ";
    $resultItem= mysqli_query($link, $getItem) or die(mysqli_error($link));
        $getTitle = "SELECT id,name FROM category WHERE id=$currentMenu";
    $rT= mysqli_query($link, $getTitle) or die(mysqli_error($link));
    $rtitle = mysqli_fetch_array($rT);
    $menu_name=$rtitle['name'];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reel Room</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript">
function OpenPopup (c) {
window.open(c,
'window',
'width=350,height=380,scrollbars=yes,status=yes');
}
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
            <li><a href="trackOrder.php">My Reel Room</a></li>
            <li><a href="about_us.php">About US</a></li>
</ul>
        
 </div>	 
    <div id="content_wrapper">
        <div id="content">
        
        	<div id="main_column">
            	
                <div class="section_w590">
                	
                    <h2><?php echo $menu_name;?></h2>
                    <img src="images/food/Breakfast.jpg"  height="150" width="580"/>
                    
                    <div class="section_w590_content">
                        <table cellpadding="12">
                            <col width="400" />
                            <col width="50" />
                            
                            <?php 
                            while($item=mysqli_fetch_array($resultItem)){
                                $itemname = $item['item_name'];
                                $itemp = $item['item_price'];
                                $itemid = $item['item_id'];
                                ?>
                            <tr>
                                <td><a href="food_detail.php?itemid=<?php echo $itemid;?>" onclick="OpenPopup(this.href); return false"><?php echo $itemname; ?></a></td>
                                <td>$<?php echo $itemp; ?></td>
                            </tr>
                                <?php
                            }
                            ?>
                        </table>
                       
                    </div>
                    </div> 
                
                <div class="cleaner_h50"></div>
                
                <div class="section_w590">
                	   
              <div class="section_w590_content">
                    
                 
                        
                  </div>
                    
                </div> 
                
            </div> <!-- end of main column -->
            
            <div id="side_column">
            
            		<div class="side_column_section">
                   	  <h4>Categories</h4>
                 		 <ul class="category_list">
                                     <?php 
    $getMenu = "SELECT id,name FROM category";
    $result= mysqli_query($link, $getMenu) or die(mysqli_error($link));
    while($menu=mysqli_fetch_array($result)){
        $name = $menu['name'];
         $cat_id = $menu['id']
        ?>
                                     <li><a href="menu.php?menuid=<?php echo $cat_id; ?> "><?php echo $name; ?></a></li>
        <?php
    }
                                     ?>
                                </ul>
              </div>
                    
            
            	<div class="side_column_bottom"></div>
            </div> <!-- end of side column -->
        
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