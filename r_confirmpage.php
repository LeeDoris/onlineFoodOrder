<?php
session_start();
include 'dbFunctions.php';
if (!isset($_SESSION['user_name'])){
    header('Location: login.php');
}else{
       require_once "admin/class.phpmailer.php";
       date_default_timezone_set('Asia/Singapore');
     $mail             = new PHPMailer();
$mail->IsSMTP(); 
$mail->SMTPAuth   = true;                  
$mail->SMTPSecure = "ssl";                 
$mail->Host       = "smtp.gmail.com";     
$mail->Port       = 465;                  
$mail->Username   = "douzi.doris@gmail.com";
$mail->Password   = "848323abc";
if($_POST['date']!=null){
$people=$_POST['people'];
$user_id=$_SESSION['user_id'];
$cdate = date('Y-m-d H:i', time());
}
$dates= $_POST['date'];
$comment= $_POST['comment'];
$insertQ="INSERT INTO reservation (date,people,comment,user_id,state,current) VALUES ('$dates','$people','$comment','$user_id','Pending','$cdate')";
$inserted = mysqli_query($link, $insertQ) or die(mysqli_error($link));

if($inserted){
    $message = "Submission successfully,pelease check your email for confirmation";
    $query = "SELECT admin_email FROM email WHERE id=2";
     $getEmail = mysqli_query($link, $query) or die(mysqli_error($link));
     $row=mysqli_fetch_array($getEmail);
     $to = $row['admin_email'];
    $mail->SetFrom('douzi.doris@gmail.com', 'IFood');
    $mail->AddReplyTo('douzi.doris@gmail.com',"IFood");
    $mail->Subject    = "New Reservation";
    $mail->Body = "A new reservation is coming.";
    $address = $to;
    $mail->AddAddress($to);
    if(!$mail->Send()) {
  $message =  "Mailer Error: " . $mail->ErrorInfo;
} else {
    $message="Reservation submit successfully, please check your email for confirmation, thank you!";
}
}
else{
    $message = "Submission failed";
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IFood</title>
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
            <li><a href="trackOrder.php">My IFood</a></li>
            <li><a href="about_us.php">About US</a></li>
</ul>
        
 </div>	
    <div id="content_wrapper">
        <div id="content">
        
        	<div id="main_column">
            	
                <div class="section_w590">
                    
                	<h2>Reservation information</h2>
                    <form method="post" action="confirmpage.php">
                     
                             <?php
                                 echo $message;
                                ?>
                         
                    </form>

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
    	Copyright © 2012 <a href="index.php">IFood</a>
    </div>

</div> 
<!-- end of container -->

</div>
</div>

</body>
</html>
<?php } ?>
