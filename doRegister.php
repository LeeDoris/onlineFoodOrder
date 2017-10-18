<?php
session_start();
include 'dbFunctions.php';
    $username = $_POST['username']; 
    $nric=$_POST['nric'];
    $query = "SELECT user_name,nric FROM user WHERE user_name = '$username' OR nric='$nric'";
    $result= mysqli_query($link, $query) or die(mysqli_error($link));
    $msg=null;
    $rownum=mysqli_fetch_row($result);
        
    function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 
    if ($rownum != null){
        $msg = "Username or NRIC already exist! Please <a href='register.php'>Try Again</a>"; 
    }else{
        $target_path = "images/userimg/";
        $pic="defaultpic.jpg";
        $user_img = basename($_FILES['photo']['name']);
        $address=$_POST['address'];
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $email=$_POST['email'];
        $dob=$_POST['dob'];
        $phone_number=$_POST['phone_number'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $role=3;
        if ($user_img!=null){
            $filename = stripslashes($_FILES['photo']['name']);
            $extension = getExtension($filename);
            $extension = strtolower($extension);
            if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
                $msg= " Unknown Image extension ";
                }else{
           $target_path = $target_path.basename( $_FILES['photo']['name']);
           if(move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)){
           $insertQuery = "INSERT INTO user(nric,firstname,lastname,email,dateofbirth,address,user_name,phone_number,password,role,user_img,state) VALUES ('$nric','$firstname','$lastname','$email','$dob','$address','$username','$phone_number',SHA1('$password'),'$role','$user_img','Active')";
           $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link)); 
        if($inserted){
            $getUser = "SELECT user_id FROM user WHERE nric='$nric' ";
           $get = mysqli_query($link, $getUser) or die(mysqli_error($link)); 
           $row_user=mysqli_fetch_array($get);
           $user_id=$row_user['user_id'];
        $msg = "Registration submitted successfully!
            Welcome $username!   | <a href='index.php'>Go Home Page</a>";
         $condition = true;
         $_SESSION['user_name'] = $username;
         $_SESSION['role'] = $role;
         $_SESSION['user_id']=$user_id;
        }else{
        $msg = "Registration submission failed, please <a href='register.php'>Try Again</a>";
        }
    }
        }}else{
           $insertQuery = "INSERT INTO user(nric,firstname,lastname,email,dateofbirth,address,user_name,phone_number,password,role,user_img,state) VALUES ('$nric','$firstname','$lastname','$email','$dob','$address','$username','$phone_number',SHA1('$password'),'$role','$pic','Active')";
           $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link)); 
                   $msg = "Registration submitted successfully!
            Welcome $username!   | <a href='index.php'>Go Home Page</a>";
                    $_SESSION['user_name'] = $username;
         $_SESSION['role'] = $role;
         $_SESSION['user_id'] = $user_id;
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
            <li><a href="about_us.php">About US</a></li>s
</ul>
        
 </div>	
    <div id="content_wrapper">
        <div id="content">
        
        	<div id="main_column">
            	
                <div class="section_w590">
      
                    
                    <div class="section_w590_content">
                        <br /><br />
                    <p style="font-size: 14px;"><?php echo $msg?></p>
                    </div>
                    
                </div> 
                
                <div class="cleaner_h50"></div>
                
                <div class="section_w590">
                	   
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
    	Copyright © 2012 <a href="index.php">Reel Room</a>
    </div>

</div> 
<!-- end of container -->

</div>
</div>

</body>
</html>