<?php
error_reporting("E_ALL");
       require_once "admin/class.phpmailer.php";
       include 'dbFunctions.php';
       
function createRandomPassword() {
    $chars = "ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789";
    $i = 0;
    $pass = '' ;

    while ($i <= 8) {
        $num = mt_rand(0,61);
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}
       
  $username = $_POST['username'];
  $query = "SELECT * FROM user WHERE user_name LIKE '$username' ";
    $result= mysqli_query($link, $query) or die(mysqli_error($link));
    $row=mysqli_fetch_array($result);
    if ($row['email']==$_POST['email']){
        $newpassword = createRandomPassword(); 
                $from = "douzi.doris@gmail.com";
        $to = $_POST['email'];
        $subject = "Hi!";
        $body = "Hi,here's your password : ".$newpassword;

        $host = "ssl://smtp.gmail.com";
        $port = "465";
        $username = "douzi.doris@gmail.com";
        $password = "848323abc";

        $headers = array ('From' => $from,
          'To' => $to,
          'Subject' => $subject);
        $smtp = Mail::factory('smtp',
          array ('host' => $host,
            'port' => $port,
            'auth' => true,
            'username' => $username,
            'password' => $password));

        $mail = $smtp->send($to, $headers, $body);
        if($mail){
$query = "UPDATE user SET password= SHA1('$newpassword')  WHERE user_name LIKE '$username'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
        }else{
            $msg = "Fail to change password.";
        }



        if (PEAR::isError($mail)) {
          echo("<p>" . $mail->getMessage() . "</p>");
         } else {
          $msg="Message successfully sent! Please check your email to get your password.";
         }
    }else{
        $msg= "Wrong Email address.";
    }
    ?>
<!DOCTYPE html>
<html>
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
                <?php if(!isset($_SESSION['user_name'])){ ?>
                    <a href="login.php">Login</a>
                <?php }else{ ?>
                    <a href="logOut.php">Logout</a>
            <ul> 
            <li><a href="usercenter.php">Member Center</a></li>
            </ul> 
                <?php } ?>
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
                	
              <div class="section_w590_content">
               <?php echo $msg;?>
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
    	Copyright © 2017 <a href="index.php">IFood</a>
    </div>

</div> 
<!-- end of container -->

</div>
</div>

</body>
</html>
