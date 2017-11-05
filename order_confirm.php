<?php
//error_reporting("E_ALL");
session_start();
if(!isset($_SESSION['user_name'])){
 header('Location: login.php');
 }else{
include 'dbFunctions.php';
include("shopping_cart.class.php");
date_default_timezone_set('Asia/Singapore');
$Cart = new Shopping_Cart('shopping_cart');
$disable = "disabled";
if ( $Cart->hasItems() ) : 
    $disable=null;
endif;
$total=0;
foreach ( $Cart->getItems() as $order_code=>$quantity ) :
$total += $quantity*$Cart->getItemPrice($order_code);
endforeach;
$showdate=$_POST['date'];
$query = "SELECT order_id FROM orders ORDER BY order_id DESC";
$results= mysqli_query($link, $query) or die(mysqli_error($link));
$rowOI=mysqli_fetch_array($results);
$orderid =  $rowOI[0]+1;
$order_id=str_pad($orderid, 4, "0", STR_PAD_LEFT); 
$currentdate=date('Y-m-d H:i', time());
$getOptime="SELECT * FROM setting";
$opr= mysqli_query($link, $getOptime) or die(mysqli_error($link));
while($row=  mysqli_fetch_array($opr)){
    if($row['name']=="operationtime"){
        $op_id=$row['id'];
        $operation_s=date('H:i',strtotime($row['start_time']));
        $operation_e=date('H:i',strtotime($row['end_time']));
    }else if($row['name']=="order_cutoff"){
        $o_id=$row['id'];
        $order_s=date('H:i',strtotime($row['start_time']));
        $order_e=date('H:i',strtotime($row['end_time']));
    }
}
$getRule="SELECT * FROM rule";
$rules= mysqli_query($link, $getRule) or die(mysqli_error($link));
while($row=  mysqli_fetch_array($rules)){
    if($row['type']=="order_b"){
        $ob_id=$row['id'];
        $ob_limit=$row['limits'];
        $ob_time=$row['time'];
    }else if($row['type']=="order_a"){
        $oa_id=$row['id'];
        $oa_limit=$row['limits'];
        $oa_time=$row['time'];
    }
}
$ct = date('H:i', time());
$hm = date('H:i', strtotime($showdate));
$compare=date('Y-m-d H:i', strtotime("+$oa_time hours"));
$getdays=$oa_time/24;
$normal=date('Y-m-d H:i', strtotime("+$ob_time hours"));
$cd = date('Y-m-d H:i', strtotime($showdate));
$odate = date('Y-m-d', strtotime($showdate));
$cdate=date('Y-m-d',time());
if ($hm<=$operation_s || $hm>=$operation_e){
   echo"  <script type='text/javascript'>";
   echo" alert('Sorry, our operation time is ".$operation_s." to ".$operation_e.". Please make sure your order time is within the range.');";
   echo" history.go(-1);";
   echo "  </script> ";
}else if($ct>=$order_e && $odate==$cdate){
   echo"  <script type='text/javascript'>";
   echo" alert('Sorry,all orders for today must be made before the cut off time- ".$order_e." daily.');";
   echo" history.go(-1);";
   echo "  </script> ";   
}else if($total>=$oa_limit && $cd<$compare){
   echo"  <script type='text/javascript'>";
   echo" alert('Sorry,for orders $".$oa_limit." and above, you must order ".$getdays." day in advance.');";
   echo" history.go(-1);";
   echo "  </script> ";   
}else if($total<$ob_limit && $cd<$normal){
   echo"  <script type='text/javascript'>";
   echo" alert('Sorry,for orders $".$ob_limit." and below, you must order ".$ob_time." hour(s) in advance.');";
   echo" history.go(-1);";
   echo "  </script> ";   
}else{

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>IFood</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.2.6.pack.js" type="text/javascript"></script>
		<script src="js/jquery.color.js" type="text/javascript"></script>
		<script src="js/thickbox.js" type="text/javascript"></script>
		<script src="js/cart.js" type="text/javascript"></script>
		<link href="css/thickbox.css" rel="stylesheet" type="text/css" media="screen" />
                <link href="css/table.css" rel="stylesheet" type="text/css" media="screen" />

<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
 
  $("input[name$='type']").click(function(){
 
  var radio_value = $(this).val();
 
  if(radio_value=='self_collection') {
     $("#address_box").hide("fast");
  }
  else if(radio_value=='delivery') {
   $("#address_box").show("slow");
   }
  });
 
  $("#address_box").hide();
 
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
                    <h2>Order Summary</h2>
                	
                    <div class="section_w590_content">
                        
 <form name="form" method="post" action="confirm.php">
        <label>Order ID:<input name ="order_id" size="5" readonly="readonly" value="<?php echo $order_id;?>" type="hidden"/><b><?php echo $order_id;?></b></label>
        <table  border="1">  <col width="300" />
                            <col width="80" /><col width="80" /><col width="80" />
                            
                                <thead>
    	<tr>
        	
            <th>Item</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total</th>
            
        </tr>
    </thead>
            <tfoot>
    	<tr>
        	<td colspan="4" ><em>This is your order summary. No cancelation 2 HOURS BEFORE your collection time.</em></td>
       
        </tr>
    </tfoot>
            <tr>
					<?php
                                        $n_i = 0;
                                        $total_q = 0;
						$total_price = $i = 0;
						foreach ( $Cart->getItems() as $order_code=>$quantity ) :
                                                    $n_i++;
							$total_price += $quantity*$Cart->getItemPrice($order_code);
                                                $total_q +=$quantity;
                                                $name = $Cart->getItemName($order_code);
                                                $u_price=$Cart->getItemPrice($order_code);
                                                $i_price=$Cart->getItemPrice($order_code)*$quantity;
					?>
						<?php echo $i++%2==0 ? "<tr>" : "<tr class='odd'>"; ?>
							<td><input type="hidden" name="item[<?php echo $n_i; ?>][name]" value="<?php echo $order_code; ?>" /><?php echo  $name;?></td>
                                                        <td><input type="hidden" name="item[<?php echo $n_i; ?>][quantity]" value="<?php echo $quantity; ?>" /><?php echo $quantity; ?></td>
							<td><input type="hidden" name="item[<?php echo $n_i; ?>][price]" value="<?php echo $u_price; ?>" />$<?php echo $u_price; ?></td>
							<td><input type="hidden" name="item[<?php echo $n_i; ?>][t_p]" value="<?php echo $i_price; ?>" />$<?php echo $i_price; ?></td>
						</tr>
					<?php endforeach; ?>
                 <tr><td class="total">Total</td><td colspan="2"></td><td class="total" id="total_price"><input type="hidden" name="total_price" value="<?php echo round($total_price,2); ?>" />$<?php echo round($total_price,2); ?></td></tr>
                                                <?php if($total_price>=100){ ?>
                 <tr><td colspan="4">Notice: For orders $100.00 and above,we require 50% deposit. Otherwise your order wouldn't be accepted.</td></tr>
                                                    <?php }
                                                ?>
                                        </table>
        <input type="hidden" name="n_i" value="<?php echo $n_i; ?>" />
                  Collection Time: <label id="collect"><input type="hidden" name="date" value="<?php echo $collection_date=date('Y-m-d H:i', strtotime($showdate));?>" /><?php echo $showdate;?></label><br />
     <br /><input type="hidden" name="c_date" value="<?php echo $currentdate;?>" />
                  <label>Collection Type:</label>&nbsp&nbsp<input type="radio" name="type" value="self_collection" checked />Self Collection
                            <input type="radio" name="type" value="delivery" /> Delivery ($5)
                   <br /><br />
                                <fieldset id="address_box">
        <input type="text" placeholder="Address" name="address" size="60"autofocus  />-
        <input type="text" placeholder="Postcode" size="6" name="postcode"  />
    </fieldset><br />
                             <input id="button" type="submit" value ="Confirm <?php echo $disable;?>" <?php echo $disable; ?> />
                             <input id="button" type="button" value="Cancel" onClick="window.location.href='clear.php'" />
            </form>
            
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
    	Copyright © 2017 <a href="index.php">IFood</a>
    </div>

</div> 
<!-- end of container -->

</div>
</div>

</body>
</html>
<?php } }?>