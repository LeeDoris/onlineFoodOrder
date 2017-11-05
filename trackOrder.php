<?php
//error_reporting("E_ALL");
session_start();
if(!isset($_SESSION['user_name'])){
 header('Location: login.php');
 }else{
include 'dbFunctions.php';
$user_id=$_SESSION['user_id'];

$querys = "SELECT COUNT(*) FROM orders WHERE user_id LIKE '$user_id'";
$resultO = mysqli_query($link, $querys) or die(mysqli_error($link));
$num_rowO=mysqli_fetch_row($resultO);

$queryNumO = "SELECT * FROM orders WHERE user_id LIKE '$user_id' ORDER BY date DESC ";
$result = mysqli_query($link, $queryNumO) or die(mysqli_error($link));


$querys = "SELECT COUNT(*) FROM reservation WHERE user_id LIKE '$user_id'";
$results = mysqli_query($link, $querys) or die(mysqli_error($link));
$num_rows=mysqli_fetch_row($results);

$queryNum = "SELECT * FROM reservation WHERE user_id LIKE '$user_id' ORDER BY date DESC ";
$resultR = mysqli_query($link, $queryNum) or die(mysqli_error($link));

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IFood</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="css/table.css" rel="stylesheet" type="text/css" media="screen" />
<script src="js/jquery-1.4.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" language="javascript">
function OpenPopup (c) {
window.open(c,
'window',
'width=500,height=480,scrollbars=yes,status=yes');
}

 $(document).ready(function() {
      $.expr[':'].containsIgnoreCase = function(n,i,m){
          return jQuery(n).text().toUpperCase().indexOf(m[3].toUpperCase())>=0;
      };
  
      $("#searchInput").keyup(function(){

          $("#fbody").find("tr").hide();
          var data = this.value.split(" ");
          var jo = $("#fbody").find("tr");
          $.each(data, function(i, v){
               jo = jo.filter("*:containsIgnoreCase('"+v+"')");
          });

          jo.show();

      }).focus(function(){
          this.value="";
          $(this).css({"color":"black"});
          $(this).unbind('focus');
      }).css({"color":"#C0C0C0"});
      
            $("#searchInput2").keyup(function(){

          $("#fbody2").find("tr").hide();
          var data = this.value.split(" ");
          var jo = $("#fbody2").find("tr");
          $.each(data, function(i, v){
               jo = jo.filter("*:containsIgnoreCase('"+v+"')");
          });

          jo.show();

      }).focus(function(){
          this.value="";
          $(this).css({"color":"black"});
          $(this).unbind('focus');
      }).css({"color":"#C0C0C0"});
      
  });
  
  $(function() {
    $("table").tablesorter({
        headers: {
            6: { sorter:'customDate' }
        }
    });
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
        <div id="content" >
                            <div style="margin-top: 10px" id="side_column">
            
            		<div class="side_column_section">
                                     <h3>Control panel</h3>
                                     <ul>
                                     <li><a href="trackOrder.php">Track My Order/Reservation</a></li>
                                     <li><a href="usercenter.php">Edit profiles</a></li>
                                     <li><a href="changepassword.php">Change password</a></li>
                                     <li><a href="logOut.php">Log Out</a></li>
                                     </ul>
                        </div>
            	<div  class="side_column_bottom"></div>
            </div> 
        	<div id="main_column">
            	
                <div class="section_w590" style="width: 990px;">
                    
                	<h2>Order information</h2>

                    
                    <div class="section_w590_content">
                               <?php if ($num_rowO[0]==0){
                        echo "No order history.";
                    }else{
?>
                     <label>Quick Filter:</label><input id="searchInput" value="Type To Filter" /><br/>
                         <table id="table" border="1"> 
                            
                                <thead>
    	<tr>
        	
            <th style="font-size: 12px;">Order ID<span>&nbsp;</span><img src="images/arrow.png" alt="Sortable"/></th>
            <th width="120" style="font-size: 12px;">Order Time<span>&nbsp;</span><img src="images/arrow.png" alt="Sortable"/></th>
            <th width="120" style="font-size: 12px;">Collection Time<span>&nbsp;</span><img src="images/arrow.png" alt="Sortable"/></th>
            <th style="font-size: 12px;" >Total Price<span>&nbsp;</span><img src="images/arrow.png" alt="Sortable"/></th>
            <th style="font-size: 12px;" >State<span>&nbsp;</span><img src="images/arrow.png" alt="Sortable"/></th>
            <th style="font-size: 12px;" >Detail<span>&nbsp;</span><img src="images/arrow.png" alt="Sortable"/></th>
        </tr>
    </thead>
                            <tbody id="fbody">
                            <?php 
                            while($rows=mysqli_fetch_array($result)){
                                $order_id=$rows['order_id'];
                                $collection_time = $rows['date'];
                                $order_time=$rows['order_time'];
                                $ct= date('d-m-Y H:i',strtotime($collection_time));
                                $ot= date('d-m-Y H:i',strtotime($order_time));
                                $type = $rows['type'];
                                if ($type=="self_collection"){
                                    $type="Self Collect";
                                }
                                $tp = $rows['total_price'];
                                $state = $rows['state'];
                                if($state=="Ready_for_collection"){
                                    $state = "Ready";
                                }
                                $o_id=str_pad($order_id, 4, "0", STR_PAD_LEFT); 
                                ?>
                            
                           <tr><td><?php echo $o_id;?></td>
                               <td><?php echo $ot;?></td>
                           <td><?php echo $ct;?></td>
                           <td><?php echo $tp;?></td> 
                           <td><?php echo $state;?></td> 
                           <td><a href="orderdetail_t.php?order_id=<?php echo $order_id; ?>" onclick="OpenPopup(this.href); return false">Detail</a></td>
                           </tr>
                            <?php
                            }
?>  </tbody>
                              	</table>
                        
                        
                        
                        <?php } ?>
                    </div>
                    
                </div> 
                <br /><br /><br />
                
                <div class="section_w590">
                	<h2>Reservation</h2>
                   
                    
              <div class="section_w590_content" style="width: 990px;">
                    <?php if ($num_rows[0]==0){
                        echo "No reservation history.";
                    }else{
?>
                  <label>Quick Filter:</label><input id="searchInput2" value="Type To Filter" /><br/>
                     <table id="table"  border="1">
                            
                                <thead>
    	<tr>
        	
            <th style="font-size: 12px;">Reservation ID<span>&nbsp;</span><img src="images/arrow.png" alt="Sortable"/></th>
            <th style="font-size: 12px;">Reservation Time<span>&nbsp;</span><img src="images/arrow.png" alt="Sortable"/></th>
            <th style="font-size: 12px;">Reserved Time<span>&nbsp;</span><img src="images/arrow.png" alt="Sortable"/></th>
            <th style="font-size: 12px;">Number of People<span>&nbsp;</span><img src="images/arrow.png" alt="Sortable"/></th>
            <th style="font-size: 12px;">State<span>&nbsp;</span><img src="images/arrow.png" alt="Sortable"/></th>
        </tr>
    </thead>
                            <tbody id="fbody2">
                            <?php 
                            while($rowsR=mysqli_fetch_array($resultR)){
                                $reservation_id=$rowsR['reservation_id'];
                                $r_time = $rowsR['date'];
                             
                                $rd= date('d-m-Y H:i',strtotime($r_time));
                                $c_time = $rowsR['current'];
                                $rc= date('d-m-Y H:i',strtotime($c_time));
                                $people=$rowsR['people'];
                                $state = $rowsR['state'];
                                $r_id=str_pad($reservation_id, 4, "0", STR_PAD_LEFT);
                                ?>
                            
                           <tr><td><?php echo $r_id;?></td>
                               <td><?php echo $rc;?></td>
                           <td><?php echo $rd;?></td> 
                           <td  style="text-align: center;"><?php echo $people;?></td> 
                           <td><?php echo $state;?></td> 
                           </tr>
                            <?php
                            }
?>  </tbody>
                              	</table>
                        <?php }?>

                        
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
          
          
<?php }?>