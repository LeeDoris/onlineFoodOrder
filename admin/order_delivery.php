<?php
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
include 'dbFunctions.php';
require_once('paginator.class.php');
date_default_timezone_set('Asia/Singapore');
$date = date('Y-m-d', time());
$queryNum = "SELECT COUNT(*) FROM orders WHERE (type='delivery' AND date LIKE '$date%') AND state='Ready_for_collection' ";
$results = mysqli_query($link, $queryNum) or die(mysqli_error($link));
$num_rows=mysqli_fetch_row($results);
$pages = new Paginator;  
if ($num_rows[0]!=0){
$pages->items_total = $num_rows[0];  
$pages->mid_range = 9;  
$pages->paginate();
$queryNum = "SELECT * FROM orders WHERE (type='delivery' AND date LIKE '$date%') AND state='Ready_for_collection' ORDER BY date DESC $pages->limit ";
} else{
$queryNum = "SELECT * FROM orders WHERE (type='delivery' AND date LIKE '$date%') AND state='Ready_for_collection'  ORDER BY date DESC ";
}
$resultO = mysqli_query($link, $queryNum) or die(mysqli_error($link));    

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<style media="all" type="text/css">@import "css/all.css";</style>
       <script src="../js/jquery-1.4.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/table.js"></script>
<script language="javascript" type="text/javascript" src="../datetimepicker.js"></script>
<script src="js/filter.js" type="text/javascript"></script>
   <script type="text/javascript">
            $(document).ready(function(){
                var options = {
                    additionalFilterTriggers: [$('#quickfind')],
                    clearFiltersControls: [$('#cleanfilters')],
                    matchingRow: function(state, tr, textTokens) {
                        if (!state || !state.id) {
                            return true;
                        }
                        var child = tr.children('td:eq(2)');
                        if (!child) return true;
                        var val = child.text();
                        switch (state.id) {
                            default:
                                return true;
                        }
                    }
                };
                $("#tdfiltering").tableFilter(options);
            }); 
            
function OpenPopup (c) {
window.open(c,
'window',
'width=350,height=380,scrollbars=yes,status=yes');
}

        </script>
</head>
<body>
<div id="main">
	<div id="header">
		<a href="dashboard.php" class="logo" style="font-size:xx-large;color:orange;">IFood Admin Area</a>
		<ul id="top-navigation">
			<li><span><span><a href="dashboard.php">Homepage</a></span></span></li>
			<li class="active"><span><span>Orders</span></span></li>
			<li><span><span><a href="reservation.php">Reservations</a></span></span></li>
			<li><span><span><a href="statistics.php">Statistics</a></span></span></li>
			<li><span><span><a href="contents.php">Contents</a></span></span></li>
			<li><span><span><a href="users.php">Users</a></span></span></li>
                        <li><span><span><a href="logs.php">Logs</a></span></span></li>
                        <li><span><span><a href="setting.php">Settings</a></span></span></li>
                        <li style="position:relative;left:275px;"><span><span><a href="../logOut.php">Logout</a></span></span></li>
                        <li style="position:relative;left:275px;;"><span><span><a href="../index.php">View Site</a></span></span></li>
		</ul>
	</div>
	<div id="middle">
		<div id="left-column">
			<h3>Control Panel</h3>
			<ul class="nav">
                                <li><a href="order_kitchen.php">Kitchen</a></li>
                                <li><a href="order_collection.php">Collection</a></li>
                                <li><a href="order_delivery.php">Delivery</a></li>
                                <li><a href="orders.php">Orders Of Today</a></li>
				<li><a href="allorder.php">All orders</a></li>
			</ul>
		</div>
		<div id="center-column">
			<div class="top-bar">
				<h1>Manage Orders</h1>
			</div><br /><br />
                        
                            <h2>Order List</h2><br />
                            <?php if ($num_rows[0]==0){
                                echo "<h4>No orders</h4>";
                            } else{
?>                        Quick Filter:<input type='text' id='quickfind'/>
                <a id='cleanfilters' href='#'>Clear Filters</a><br /><br />
                <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing table-autosort" id="tdfiltering" cellpadding="0" cellspacing="0">
                                                  <thead>
					<tr>
						<th class="first table-sortable:numeric" >Order ID<img src="../images/arrow.png" alt="Sortable"/></th>
                                                <th class="table-sortable:date">Customer Name<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="table-sortable:date">Collection Time<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
                                                <th class="table-sortable:asc">Address<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="last" width="60">Actions</th>
					</tr>
                                        </thead>
                                    <tbody id="fbody">
                                               <?php $i=0;
                                               while($rownumO=mysqli_fetch_array($resultO)){
                          $order_id=$rownumO['order_id'];
                          $user_id=$rownumO['user_id'];
                          $collect_time=$rownumO['date'];
                          $address=$rownumO['address'];
                          $cd= date('d-m-Y H:i',strtotime($collect_time));
                           $order_time=$rownumO['order_time'];
                          $od= date('d-m-Y H:i',strtotime($order_time));
                          $type=$rownumO['type'];
                          if($rownumO['state']=="Ready_for_collection"){
                              $order_state="Ready";
                          }else{
                              $order_state=$rownumO['state'];
                          }
                          $i++;
                          if ($i%2==0){
                              echo "<tr>";
                          }else{
                              echo "<tr class='bg'>";
                          }
                          $q="SELECT * FROM user WHERE user_id='$user_id'";
                          $r = mysqli_query($link, $q) or die(mysqli_error($link));  
                          $getU=  mysqli_fetch_array($r);
                          $username=$getU['firstname']." ".$getU['lastname'];
                      ?>
					
                          <td class="first style1"><?php echo $order_id;?></td>
                          <td><a href="userInfo.php?userid=<?php echo $user_id;?>"  onclick="OpenPopup(this.href); return false"><?php echo $username;?></a></td>
                          <td><?php echo $cd;?></td>
                          <td><?php echo $address;?></td>
                          <td class="last">
                               <a href="quickPass.php?order_id=<?php echo $order_id;?>&from=delivery" onclick="return confirm('Are you sure you have deliveried this order?')" ><img src="img/accept.png" width="16" height="16" title="Finish" /></a>
                          <a href="checkDetails.php?order_id=<?php echo $order_id;?>"><img src="img/page_edit.png" width="16" height="16" title="Detail" /></a>
                             <?php if($_SESSION['role']==1){ ?>
                             <a href="emailForm.php?userid=<?php echo $user_id;?>&order_id=<?php echo $order_id;?>&type=order"  onclick="OpenPopup(this.href); return false"><img src="img/email.png" width="16" height="16" title="send email" /></a>
                          <a href="deleteRecord.php?order_id=<?php echo $order_id;?>" onclick="return confirm('Are you sure you want to delete this order?')"  ><img src="img/delete.png" width="16" height="16" title="Delete" /></a>
                          <?php }
                          ?>
                          </td>
                     
					
				<?php echo "</tr>"; }?>
                                        </tbody>
				</table>
				<div class="select">
					<strong>Other Pages: </strong>
					<?php echo $pages->display_jump_menu();?> 
                                        <strong>Items/Page: </strong>
                                        <?php echo $pages->display_items_per_page();?> 
                                </div>
                                	</div>
                                <?php }?>
		
                  <br /><br />
                  <h2>Check Order</h2>
                  <form action="checkDetails.php?order_id=" method="get">
                      Order ID:
                  <input name="order_id"   type="text"/>
                  <input type="submit" />
                  </form>

		</div>
		<div id="right-column">
			<strong class="h">INFO</strong>
			<div class="box"></div>
	  </div>
	</div>
	<div id="footer"></div>
</div>
</body>
</html>
<?php }?>