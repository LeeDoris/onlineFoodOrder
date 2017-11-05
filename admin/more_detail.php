<?php
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
include 'dbFunctions.php';
require_once('paginator.class.php');
$queryNum = "SELECT COUNT(*) FROM orders ";
$results = mysqli_query($link, $queryNum) or die(mysqli_error($link));
$num_rows=mysqli_fetch_row($results);
$pages = new Paginator;  
$pages->items_total = $num_rows[0];  
$pages->mid_range = 9;  
$pages->paginate();
$queryNum = "SELECT SUM(order_item.quantity),item.item_name FROM order_item,item  WHERE item.item_id=order_item.item_id GROUP BY item.item_id ORDER BY SUM(quantity) DESC $pages->limit";
$resultO = mysqli_query($link, $queryNum) or die(mysqli_error($link));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Admin</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<style media="all" type="text/css">@import "css/all.css";</style>
       <script src="../js/jquery-1.4.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/table.js"></script>
<script src="js/filter.js" type="text/javascript"></script>
   <script type="text/javascript">
            $(document).ready(function(){
                // Initialise picn table filtering Plugin hrer
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

        </script>
</head>
<body>
<div id="main">
	<div id="header">
		<a href="dashboard.php" class="logo" style="font-size:xx-large;color:orange;">IFood Admin Area</a>
		<ul id="top-navigation">
			<li><span><span><a href="dashboard.php">Homepage</a></span></span></li>
			<li><span><span><a href="orders.php">Orders</a></span></span></li>
			<li><span><span><a href="reservation.php">Reservations</a></span></span></li>
			<li  class="active"><span><span>Statistics</span></span></li>
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
				<li><a href="statistics.php">Statistics</a></li>
				<li><a href="more_detail.php">Item Sold</a></li>
			</ul>
		</div>
		<div id="center-column">
			<div class="top-bar">
				<h1>Statistics</h1>
			</div><br /><br />
                        
                            <h2>Item sold</h2><br />
                            <?php if ($num_rows[0]==0){
                                echo "<h4>No orders</h4>";
                            } else{
?>                        Quick Filter:<input type='text' id='quickfind'/>
                <a id='cleanfilters' href='#'>Clear Filters</a>
                            <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing table-autosort" id="tdfiltering" cellpadding="0" cellspacing="0">
                                                  <thead>
					<tr>
                                                <th class="first table-sortable:asc">Item Name<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="table-sortable:numeric">Total sold<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
					</tr>
                                        </thead>
                                    <tbody id="fbody">
                                               <?php $i=0;
                                               while($rownumO=mysqli_fetch_array($resultO)){
                                                   $itemname = $rownumO[1];
                                                   $quantity=$rownumO[0];
                          $i++;
                          if ($i%2==0){
                              echo "<tr>";
                          }else{
                              echo "<tr class='bg'>";
                          }
                      ?>
					
                                            <td class="first"><?php echo $itemname;?></td>
                          <td class="last"><?php echo $quantity;?></td>
                     
					
				<?php echo "</tr>"; }?>
                                        </tbody>
				</table>
                                <?php }?>
                                <div class="select">
					<strong>Other Pages: </strong>
					<?php echo $pages->display_jump_menu();?> 
                                        <strong>Items/Page: </strong>
                                        <?php echo $pages->display_items_per_page();?> 
                                </div>
			</div>
                  <br /><br />

		</div>
		 <div id="right-column">
	  </div>
	</div>
	<div id="footer"></div>
</div>
</body>
</html>
<?php }?>