<?php
session_start();
include 'dbFunctions.php';
$msg=null;
if (!isset($_SESSION['user_name'])){
    header('Location: login.php');
}else{
    if(isset($_POST['old_password'])){
        $c =false;
    $userid=$_SESSION['user_id'];
$Old_password= $_POST['old_password'];
$New_password=$_POST['new_password'];
$Confirm_new_password=$_POST['confirm_new_password'];
$query="SELECT * FROM user Where user_id='$userid'";
$password = mysqli_query($link, $query) or die(mysqli_error($link));
$row=mysqli_fetch_array($password);
$msg=null;
if($row['password']!= sha1($Old_password)){
 
$msg ="Your old password is wrong,please try agagin !";
 }
 else{

$resetQuery="UPDATE user SET password=sha1('$New_password')WHERE user_id = '$userid' ";
$password_reset = mysqli_query($link, $resetQuery) or die(mysqli_error($link));
$c=true;
 }

if ($c) {
$msg="Your password has changed successfully!";
 }else {
$msg="Change password failed!";
 }
 }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reel Room</title>
<link href="style.css" rel="stylesheet" type="text/css" />
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
                    

                    <h2>Change password</h2>
                    
        <form  method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" > 
                       
         <table>
          
             <tr>
                 <td>Old password:</td>
                 <td><input type="password" name="old_password"/></td>
             </tr>
            
             <tr>
                 <td>New password:</td>
                 <td><input type ="password" name="new_password"/></td>
             </tr>
             
              <tr>
                 <td>Confirm new password:</td>
                 <td><input type="password" name="confirm_new_password"/></td>
             </tr>
              </table>
              <hr />
              <input type="submit" value="Apply" style="margin-left: 0px;"/>
        
              </form>
                    <div class="section_w590_content">
                          <?php echo $msg;?>
                    </div>
                    
                </div> 
                
                <div class="cleaner_h50"></div>
                
            </div> <!-- end of main column -->
            
                        	<div style="margin-top: 10px"id="side_column">
            
            		<div class="side_column_section">


                                     <h3>Control panel</h3>
                                     <li><a href="trackOrder.php">Track My Order/Reservation</a></li>
                                     <li><a href="usercenter.php">Edit profiles</a></li>
                                     <li><a href="changepassword.php">Change password</a></li>
                                     <li><a href="logOut.php">Log Out</a></li>
              </div>
                                    <div  class="side_column_bottom"></div>
        <div class="cleaner"></div>
        </div> <!-- end of content -->
     <div class="cleaner"></div>
        </div> <!-- end of content -->

        <div class="cleaner"></div>
        <div class="content_bottom"></div>
	</div> <!-- end of content wrapper -->      
    
    <div id="footer">
    	Copyright Â© 2012 <a href="index.php">Reel Room</a>
    </div>

</div> 
<!-- end of container -->

</div>
</div>

</body>
</html>
<?php } ?>