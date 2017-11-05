<?php
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
include 'dbFunctions.php';
$queryType = "SELECT COUNT(*), type FROM orders GROUP BY type";
$resultT = mysqli_query($link, $queryType) or die(mysqli_error($link));
$query = "SELECT SUM(order_item.quantity),item.product_id,item.item_name FROM order_item,item WHERE item.item_id=order_item.item_id GROUP BY item.product_id ORDER BY SUM(order_item.quantity) DESC LIMIT 5";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$rtype = mysqli_query($link, $queryType) or die(mysqli_error($link));
$q="SELECT COUNT(*),order_time FROM orders  GROUP BY day(order_time),month(order_time);";
$rq = mysqli_query($link, $q) or die(mysqli_error($link));
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<meta  http-equiv="content-type" content="text/html; charset=utf-8" />
	<style media="all" type="text/css">@import "css/all.css";</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.jqplot.min.css" />
<script type="text/javascript" src="js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="js/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="js/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="js/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="js/jqplot.pointLabels.min.js"></script>
<script type="text/javascript" src="js/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="js/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="js/jqplot.cursor.min.js"></script>
<link type="text/css" href="css/jquery-ui.min.css" rel="stylesheet" /> 
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="js/jqplot.canvasAxisTickRenderer.min.js"></script>



<script type="text/javascript">
    $(document).ready(function() {
        $.jqplot.config.enablePlugins = false;
         $("#tabs").tabs();
   var s1 = new Array();
   
        <?php 
        while($row=  mysqli_fetch_array($resultT)){
       ?>
               var ars = new Array();
               ars.push('<?php echo $row['type'] ?>');
               ars.push(<?php echo $row['COUNT(*)'] ?>);
               s1.push(ars);
               <?php
        }
        ?>
       
       
  var plot1 = jQuery.jqplot ('chart1', [s1], 
    { 
 title: 'Order type distribution', 
      seriesDefaults: {
        shadow: false, 
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: { 
          startAngle: 180, 
          sliceMargin: 4, 
          showDataLabels: true } 
      }, 
      legend: { show:true, location: 'w' }
    }
  );
        
        
        
            
        
          var line=new Array();
                <?php 
        while($rs=  mysqli_fetch_array($rq)){
       ?>
               var linex=new Array();
               linex.push('<?php echo $rs['order_time'] ?>');
               linex.push(<?php echo $rs['COUNT(*)'] ?>);
               line.push(linex);
               <?php
        }
        ?>
          
   plot3 = $.jqplot('chart3', [line], {
       animate: !$.jqplot.use_excanvas,
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
                     tickOptions:{formatString:'%b %#d'}
        }
    },
    series:[{lineWidth:4, markerOptions:{style:'circle'}}],
     highlighter: {
        show: true,
        sizeAdjust: 7.5
      },
        cursor: {
            show: true,
            zoom: true,
            looseZoom: true,
            showTooltip: true,
      followMouse: true,       
      showTooltipOutsideZoom: true,       
      constrainOutsideZoom: false
        }
  });
        
              
       var s2 = new Array();
        var ticks1 = new Array();
        
                <?php 
        while($rows=mysqli_fetch_array($result)){
       ?>
               s2.push(<?php echo $rows[0] ?>);
               ticks1.push('<?php echo $rows[2] ?>');
               <?php
        }
        ?>
         
        plot2 = $.jqplot('chart2', [s2], {
           animate: !$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true },
                        rendererOptions: {
            barWidth: 30     // width of the bars.  null to calculate automatically.
        }
            },
               axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
        tickOptions: {
          angle: -30
        }
    },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks1
                }
            },
            highlighter: { show: true }
        });

        $('#tabs').bind('tabsshow', function(event, ui) {
            if (ui.index == 1 && plot2._drawCount == 0) {
            plot2.replot();
          }else if(ui.index == 0 && plot3._drawCount == 0){
              plot3.replot();
              plot1.replot();
          }
        });

    
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
				<li><a href="more_detail.php">Sales</a></li>
			</ul>
		</div>
		<div id="center-column">
			<div class="top-bar">
				<h1>Statistics</h1>
			</div><br /><br />
                                   
                          <div id="tabs">
    <ul><li><a href="#tabs-2">Order Summary</a></li>
      <li><a href="#tabs-1">Product Sales</a></li>
      
      
    </ul>   
    <div id="tabs-2">
      <p>This plot is a summary of our orders, you can highlight specific period to see details.</p>
      <div id="chart3" ></div><br /><br /> <br /> <?php
      $total =0;
      while($rt=  mysqli_fetch_array($rtype)){ 
          echo $rt['type'].":".$rt['COUNT(*)']."&nbsp&nbsp&nbsp&nbsp";
          $total+=$rt['COUNT(*)'];
      }
      echo "<br /> <b>Total orders:".$total."</b>";
      ?><div id="chart1" ></div>   
    </div>
    <div id="tabs-1">
      <p>Top 5 food sales:</p>
     <div id="chart2" style=" width:580px; height:200px;"></div> 
    </div>
    
  </div> 

		</div>
		<div id="right-column">

	  </div>
	</div>
	<div id="footer"></div>
</div>
</body>
</html>
<?php }?>