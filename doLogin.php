<?php
include 'dbFunctions.php';
session_start();
$msg = null;
$condition = false;
if(isset($_POST)){
    $username = $_POST['username']; 
    $pw = sha1($_POST['password']);
    $select = "SELECT * FROM user WHERE user_name = '$username'";
    $selectUser = mysqli_query($link, $select) or die(mysqli_error($link));
    $row=mysqli_fetch_array($selectUser);
    if ($row == null){
        $msg = "Wrong username or password."; 
        $condition = false;
    }else if ($pw !=$row['password']){
         $msg = "Wrong username or password."; 
        $condition = false;
    }else if($row['state']=="Block"){
        $msg="Sorry, your account is currently blocked by our system.";
    }else{
         $_SESSION['user_name'] = $username;
         $_SESSION['role'] = $row['role'];
         $_SESSION['user_id'] = $row['user_id'];
   $condition = true;

    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reel Room</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">   
function gou(secs,a){    
 if(--secs>0){    
     setTimeout("gou("+secs+","+a+")",1000);    
     }    
 else{    
      if(a){
    location='index.php';  
	 }  else{
         history.back();    
         }
     }     
 }    
</script> 
</head>
<body>
<div id="container_wrapper_outter">
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
                	
              <div class="section_w590_content">
<?php 
if($condition==true && $_SESSION['role']==3){
        echo "Login success:".$_SESSION['user_name']."<br/>";
echo "Auto-direct to home page after 5 seconds"."<br/>";
echo "<script>gou(5,1)</script>";
    
}else if($condition==true && $_SESSION['role']!=3){
    header('Location: admin/dashboard.php');
}
else{
echo $msg."<br/>";
echo "Please try again. (5 seconds)"."<br/>";
echo "<script>gou(5,0)</script>";
}
?>          
                    
                        
                        <div class="cleaner_h20"></div>
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
