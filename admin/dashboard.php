<?php
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
include 'dbFunctions.php';
date_default_timezone_set('Asia/Singapore');
$date = date('Y-m-d', time());
$queryNum = "SELECT COUNT(*) FROM orders WHERE order_time LIKE '$date%'";
$results = mysqli_query($link, $queryNum) or die(mysqli_error($link));
$num_rows=mysqli_fetch_row($results);

$query = "SELECT COUNT(*) FROM reservation  WHERE current LIKE '$date%' ";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$num=mysqli_fetch_row($result);


$queryOP = "SELECT COUNT(*) FROM orders WHERE date LIKE '$date%' AND (state='Accepted' OR state='Ready_for_collection') ";
$resultsOP = mysqli_query($link, $queryOP) or die(mysqli_error($link));
$num_rowsOP=mysqli_fetch_row($resultsOP);

$queryRP = "SELECT COUNT(*) FROM reservation  WHERE date LIKE '$date%' AND state='Pending' ";
$resultRP = mysqli_query($link, $queryRP) or die(mysqli_error($link));
$numRP=mysqli_fetch_row($resultRP);


$start = date('Y-m-d',strtotime('this week'));
$end = date('Y-m-d',strtotime('next week'));
$qw = "SELECT COUNT(*) FROM reservation WHERE current BETWEEN '$start' AND '$end'";
$rnum = mysqli_query($link, $qw) or die(mysqli_error($link));
$r_n=mysqli_fetch_row($rnum);
$qweek = "SELECT COUNT(*),current FROM reservation WHERE current BETWEEN '$start' AND '$end' GROUP BY day(current),month(current)";
$rweek = mysqli_query($link, $qweek) or die(mysqli_error($link));


$q_num="SELECT COUNT(*) FROM orders  WHERE order_time BETWEEN '$start' AND '$end' ";
$onum = mysqli_query($link, $q_num) or die(mysqli_error($link));
$o_n=mysqli_fetch_row($onum);
$q="SELECT COUNT(*),order_time FROM orders  WHERE order_time BETWEEN '$start' AND '$end' GROUP BY day(order_time),month(order_time);";
$rq = mysqli_query($link, $q) or die(mysqli_error($link));

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="refresh" content="600" >
        <style media="all" type="text/css">@import "css/all.css";</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.jqplot.min.css" />
<script type="text/javascript" src="js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="js/jqplot.pointLabels.min.js"></script>
<script type="text/javascript" src="js/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="js/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="js/jqplot.cursor.min.js"></script>
<link type="text/css" href="css/jquery-ui.min.css" rel="stylesheet" /> 
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
</head>
<body>
               <script class="code" type="text/javascript">
    $(document).ready(function() {
        $.jqplot.config.enablePlugins = false;
        
          var reservation=new Array();
          var highR=0;
            <?php
                                if($r_n[0]==0){ ?>
                                    reservation.push(null);
                             <?php   }else{
        while($rs=  mysqli_fetch_array($rweek)){
       ?>
                   var linex=new Array();
               linex.push('<?php echo $rs['current'] ?>');
               linex.push(<?php echo $rs['COUNT(*)'] ?>);
               if(highR<<?php echo $rs['COUNT(*)']?>){
                   highR=<?php echo  $rs['COUNT(*)']?>
               }
               reservation.push(linex);
               
               <?php
        }}
        ?>
                
         
          var order=new Array();
          var highO=0;
                
                                <?php
                                if($o_n[0]==0){ ?>
                                    order.push(null);
                             <?php   }else{
        while($ro=  mysqli_fetch_array($rq)){
       ?>
                   var linex=new Array();
               linex.push('<?php echo $ro['order_time'] ?>');
               linex.push(<?php echo $ro['COUNT(*)'] ?>);
               if(highO<<?php echo $ro['COUNT(*)']?>){
                   highO=<?php echo  $ro['COUNT(*)']?>
               }
               order.push(linex);
               
               
               <?php
        } }
        ?>
                var high=0;
                if(highO<=highR){
                    high=highR;
                }else{
                    high=highO;
                }
               
                
   plot3 = $.jqplot('chart3', [reservation,order], {
       animate: !$.jqplot.use_excanvas,
    axes:{
        yaxis:{
             min:0, 
            max: (high+1),
            tickInterval: 1
        },
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
             min:'<?php echo $start;?>', 
            max:'<?php echo $end?>',
            tickInterval:'1 days',
                     tickOptions:{formatString:'%b %#d'}
        }
    },
                   series:[
            {label:'Reservation'},
            {label:'Order'}
        ],
        // Show the legend and put it outside the grid, but inside the
        // plot container, shrinking the grid to accomodate the legend.
        // A value of "outside" would not shrink the grid and allow
        // the legend to overflow the container.
        legend: {
            show: true,
            placement: 'outsideGrid'
        },
     highlighter: {
        show: true,
        sizeAdjust: 7.5
      }
  });
    
    });
</script> 

<div id="main">
	<div id="header">
		<a href="dashboard.php" class="logo" style="font-size:xx-large;color:orange;">IFood Admin Area</a>
		<ul id="top-navigation">
			<li class="active"><span><span>Homepage</span></span></li>
			<li><span><span><a href="orders.php">Orders</a></span></span></li>
			<li><span><span><a href="reservation.php">Reservations</a></span></span></li>
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
			<h3>Orders</h3>
			<ul class="nav">
				<li><a href="orders.php">Orders Of Today</a></li>
                                <li><a href="reservation.php">Reservation Of Today</a></li>
			</ul>
		</div>
		<div id="center-column">
			<div class="top-bar">
				<h1>DashBoard</h1>
			</div><br />
                        
            <div style="margin-top:30px; border: 1px solid #9097A9;">
                 <h2 style="background:#9097A9; color: white; margin: 0px 0px 0px 0px; height:25px;">Right Now</h2>
                 <p>You have received <a href="orders.php" style="text-decoration:underline;"><b><?php echo $num_rows[0];?></b></a> orders and <a href="reservation.php" style="text-decoration:underline;"><b><?php echo $num[0];?></b></a> reservations for today.</p>
            <p>You have <a href="orders.php" style="text-decoration:underline;"><b><?php echo $num_rowsOP[0];?></b></a> orders and <a href="reservation.php" style="text-decoration:underline;"><b><?php echo $numRP[0];?></b></a> reservations need to process.</p>
            </div>
                        
                        <div style="margin-top:30px; border: 1px solid #9097A9;">
                             <h2 style="background:#9097A9; text-align: center;color: white; margin: 0px 0px 0px 0px; height:25px;">Order and Reservation For This Week</h2>
                        <div id="chart3" style=" width:620px;height:200px;"></div>
                        </div>
                        
                        
                         <div class="table" style="margin-top:30px; border: 1px solid #9097A9; width: 280px;">
                             <h2 style="background:#9097A9; text-align: center;color: white; margin: 0px 0px 0px 0px; height:25px;">Reservations for this week</h2>
                             <br />
				<table width="280px;">
                                         <thead style ="background:#9097A9;">
					<tr>
						<th>Date</th>
						<th>Amount</th>
					</tr>
                                        </thead>
                                    <tbody style="text-align:center;">
                                                   
        <?php 
        $rweek = mysqli_query($link, $qweek) or die(mysqli_error($link));
          while($rs=  mysqli_fetch_array($rweek)){
              $date=date('d-m-Y',  strtotime($rs['current']));
               echo " <tr><td valign='top' style='border:1px solid #9097A9'>".$date."</td>";
      echo "<td valign='top' style='border:1px solid #9097A9'>".$rs['COUNT(*)']."</td></tr>";
  }
        ?>
    
                                        </tbody>
				</table>
                         </div>
                        
                                                 <div class="table" style="float: left; left:50px;margin-top:30px; border: 1px solid #9097A9; width: 280px;">
                             <h2 style="background:#9097A9; text-align: center;color: white; margin: 0px 0px 0px 0px; height:25px;">Orders for this week</h2>
                             <br />
				<table width="280px;">
                                         <thead style ="background:#9097A9;">
					<tr>
						<th>Date</th>
						<th>Amount</th>
					</tr>
                                        </thead>
                                    <tbody style="text-align:center;">
                                                   
        <?php 
        $rq = mysqli_query($link, $q) or die(mysqli_error($link));
          while($rs=  mysqli_fetch_array($rq)){
              $date=date('d-m-Y',  strtotime($rs['order_time']));
               echo " <tr><td valign='top' style='border:1px solid #9097A9'>".$date."</td>";
      echo "<td valign='top' style='border:1px solid #9097A9'>".$rs['COUNT(*)']."</td></tr>";
  }
        ?>
    
                                        </tbody>
				</table>
                         </div>
                        
                        
                        
		</div>
	</div>
	<div id="footer"></div>
</div>
</body>
</html>
<?php }?>