<?php
session_start();

if(!isset($_SESSION['user_name'])){
   header('Location: login.php');
 }else{
include 'dbFunctions.php';
date_default_timezone_set('Asia/Singapore');
$date= $_POST['date'];
$sd= date('Y-m-d H:i',strtotime($date));
$cdate = date('d-m-Y H:i', time());
$people=$_POST['people'];
$comment=$_POST['comment'];
$getOptime="SELECT * FROM setting";
$opr= mysqli_query($link, $getOptime) or die(mysqli_error($link));
while($row=  mysqli_fetch_array($opr)){
    if($row['name']=="no_reservation"){
        $op_id=$row['id'];
        $r_s=date('H:i',strtotime($row['start_time']));
        $r_e=date('H:i',strtotime($row['end_time']));
    }else if($row['name']=="operationtime"){
        $operation_s=date('H:i',strtotime($row['start_time']));
        $operation_e=date('H:i',strtotime($row['end_time']));
    }
}
$getRule="SELECT * FROM rule";
$rules= mysqli_query($link, $getRule) or die(mysqli_error($link));
while($row=  mysqli_fetch_array($rules)){
    if($row['type']=="reservation_b"){
        $rb_id=$row['id'];
        $rb_limit=$row['limits'];
        $rb_time=$row['time'];
    }else if($row['type']=="reservation_a"){
        $ra_id=$row['id'];
        $ra_limit=$row['limits'];
        $ra_time=$row['time'];
    }
}

$rt = date('H:i', strtotime($date));
$compare=date('Y-m-d H:i', strtotime("+$ra_time hours"));
$getdays = $ra_time/24;
if ($rt>=$r_s && $rt<=$r_e){
   echo"  <script type='text/javascript'>";
   echo" alert('Sorry,no reservation is available from ".$r_s." to ".$r_e.".');";
   echo" history.go(-1);";
   echo "  </script> ";
}else if($rt<=$operation_s || $rt>=$operation_e){
   echo"  <script type='text/javascript'>";
   echo" alert('Sorry, our operation time is ".$operation_s." to ".$operation_e.". Please make sure your reservation time is within the range.');";
   echo" history.go(-1);";
   echo "  </script> ";
}else{
$rts = date('Y-m-d H:i', strtotime($date));
$normal=date('Y-m-d H:i', strtotime("+$rb_time hours"));
if($people>$ra_limit && $rts<$compare){
   echo"  <script type='text/javascript'>";
   echo" alert('Sorry, reservations for more than ".$ra_limit." pax must be made ".$getdays." days in advance.');";
   echo" history.go(-1);";
   echo "  </script> ";
}else if($people<$rb_limit && $rts<$normal){
   echo"  <script type='text/javascript'>";
   echo" alert('Sorry, reservations for less than ".$rb_limit." pax must be made ".$rb_time." hour(s) in advance.');";
   echo" history.go(-1);";
   echo "  </script> ";   
}else{
        
        
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reel Room</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="css/table.css" rel="stylesheet" type="text/css" />
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
            <li><a href="trackOrder.php">My Reel Room</a></li>
            <li><a href="about_us.php">About US</a></li>
</ul>
        
 </div>	
    <div id="content_wrapper">
        <div id="content">
        
        	<div id="main_column">
            	
                <div class="section_w590">
                    
                	<h2>Reservation information</h2>
                   
                    
                    <div class="section_w590_content">
 <form method="post" action="r_confirmpage.php">
                     <input type="hidden" name="date" value="<?php echo $sd ?>" />
                     <input type="hidden" name="people" value="<?php echo $people ?>" />
                     <input type="hidden" name="comment" value="<?php echo $comment ?>" />
                         <table border="1" style="font-size: 16px;">
                             <tbody>
                         <tr>
                          <td>Reservation Date Time:</td>
                             <td><?php echo $date; ?></td>
                         </tr>
                          <tr class="odd">
                             <td>Number of people:</td>
                           <td><?php echo $people; ?></td>
                          </tr>
                          <tr>
                          <td>Comments:</td>
                             <td><?php echo $comment; ?></td>
                         </tr>
                             </tbody>
                         </table>
                        <input type="submit" id="button" value =" Confirm"/>
                              <input type="button" id ="button" value="Back" onClick="history.go(-1);return true;" />
                    </form>

                  
          
                        
                    </div>
                    
                </div> 
                
                
            </div> <!-- end of main column -->
            
        
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
<?php }  } } ?>