<?php
//error_reporting("E_ALL");
session_start();
if(!isset($_SESSION['user_name'])){
   header('Location: login.php');
 }else{
include 'dbFunctions.php';
include("shopping_cart.class.php");
$Cart = new Shopping_Cart('shopping_cart');
$currentMenu = null;
if (!isset($_GET['menuid'])){
    $currentMenu = "1";
}else{
    $currentMenu = $_GET['menuid'];
}
    $getItem = "SELECT * FROM item WHERE item_category LIKE '$currentMenu' ";
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
<title>IFood</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.2.6.pack.js" type="text/javascript"></script>
    <script language="javascript" type="text/javascript" src="datetimepicker.js"></script>
        
		<script src="js/jquery.color.js" type="text/javascript"></script>
		<script src="js/thickbox.js" type="text/javascript"></script>
		<script src="js/cart.js" type="text/javascript"></script>
		<link href="css/thickbox.css" rel="stylesheet" type="text/css" media="screen" />
<script src="js/form_validator.js" type="text/javascript"></script>

<script type="text/javascript" language="javascript">
function OpenPopup (c) {
window.open(c,
'window',
'width=500,height=400,scrollbars=yes,status=yes');
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
            <li><a href="menu.php" >Menu</a></li>
            <li><a href="reservation.php">Reservation</a></li>
            <li><a href="order.php" >Order</a></li>
            <li><a href="trackOrder.php">My IFood</a></li>
            <li><a href="about_us.php">About US</a></li>
</ul>
        
 </div>	    
    <div id="content_wrapper">
        <div id="content">
        
        	<div id="main_column">
            	
                <div class="section_w590">
                	
                 <h2>Categories</h2>
            
                                     <?php 
    $getMenu = "SELECT id,name FROM category";
    $result= mysqli_query($link, $getMenu) or die(mysqli_error($link));
    while($menu=mysqli_fetch_array($result)){
        $name = $menu['name'];
        $id = $menu['id'];
        ?>
                                   <a href="order.php?menuid=<?php echo $id; ?> "><?php echo $name; ?></a> | 
        <?php
    }
                                     ?>
                               
                   	 <br /><br />
                   <h1><?php echo $menu_name;?></h1> 
                  
                   
                    <div class="section_w590_content">
                        
                        <br /><br />
                     
                                <table cellpadding="12" class="productWrap">
                            <col width="350" />
                            <col width="80" />
                            <?php 
                            while($item=mysqli_fetch_array($resultItem)){
                                $itemname = $item['item_name'];
                                $itemp = $item['item_price'];
                                $id=$item['item_id'];
                                ?>

				<tr><td><a href="food_detail.php?itemid=<?php echo $id;?>" onclick="OpenPopup(this.href); return false"><?php echo $itemname; ?></a></label><input type="hidden" name="order_code" value="<?php echo $id;?>" /></td>
				<td><?php echo $itemp?></td>
				<td><a href="cart_action.php?order_code=<?php echo $id;?>&quantity=1&TB_iframe=true&height=400&width=780" class="thickbox"><img src="images/add-to-basket2.gif" alt="Add To Basket" width="111" height="32" /></a></td>
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
                <h3>My Shopping Cart</h3>
                
                    
            <h4><a href="cart.php?KeepThis=true&TB_iframe=true&height=400&width=780" title="Your Shopping Cart" class="thickbox">View Details</a></h4>
            <h4><a href="clear.php">Empty Cart</a></h4>
              <br /><br />
            	<div class="side_column_bottom"></div>
                <form method="post" action="order_confirm.php" name="orders" id="orders">
                    <h4><b>Collection Time:</b></h4>
                   <input id="date" name ="date" type="text" size="16" readonly="readonly"/><a href="javascript:NewCal('date','ddmmyyyy','true','24')"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"/></a>
                    <br /><i><span style="font-size: 10px; margin-left:10px;" id='orders_date_errorloc' class="error_strings"></span></i>
                   <br /><small><i> - Use Date Picker to set your collection time.</i></small>
                   <br /><br />
                   <input type="checkbox" name="terms" value="Yes" />I <b>agree</b> with this <a href="termsandconditions.php?type=order" onclick="OpenPopup(this.href); return false">Terms and Condition</a>
                        <br /><i><span style="font-size: 10px; margin-left:10px;" id='orders_terms_errorloc' class="error_strings"></span></i><br />
                        
                <input type="submit" id="button" value =" Check Out"/>
                </form>
                                        <script language="JavaScript" type="text/javascript">
  var frmvalidator  = new Validator("orders");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("date","req","Please specify your collection time.");
    frmvalidator.addValidation("terms","shouldselchk=Yes","Please agree this terms and conditions.");
</script>
            </div> <!-- end of side column -->
        
        <div class="cleaner"></div>
        </div> <!-- end of content -->

        <div class="cleaner"></div>
        <div class="content_bottom"></div>
	</div> <!-- end of content wrapper -->      
    
    <div id="footer">
    	Copyright © 2012 <a href="index.php">IFood</a>
    </div>

</div> 
<!-- end of container -->

</div>
</div>

</body>
</html>


<?php } ?>