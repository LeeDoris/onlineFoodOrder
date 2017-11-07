<?php
session_start();
include 'dbFunctions.php';
$msg=null;
if (!isset($_SESSION['user_name'])){
    header('Location: login.php');
}else{
     $user_name=$_SESSION['user_name'];
    $selectQuery="SELECT * FROM user WHERE user_name = '$user_name'";

$select_profile = mysqli_query($link, $selectQuery) or die(mysqli_error($link));
$row=mysqli_fetch_array($select_profile);
if(isset($_POST['email'])||isset($_POST['phone_number']) ||isset($_POST['address']) ){
$c=false;
$user_name=$_SESSION['user_name'];
$Email= $_POST['email'];
$Phone_num=$_POST['phone_number'];
$ads= $_POST['address'];
$Address = htmlentities($ads,ENT_QUOTES);
$target_path = "images/userimg/";
$photoname = basename($_FILES['image']['name']);
if ($photoname!=null){
$target_path = $target_path.basename( $_FILES['image']['name']); 
   if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)){
      $updateQuery="UPDATE user SET email='$Email',phone_number='$Phone_num',address='$Address',user_img='$photoname' WHERE user_name = '$user_name' ";  
      $result = mysqli_query($link, $updateQuery) or die(mysqli_error($link));
    if($result){
        $msg = "Update succeffully.";
        }else{
        $msg = "Update failed, please try again!";
        }
}else{
     $msg = "Update failed, please try again!(images)";
}
}else{
    $updateQuery="UPDATE user SET email='$Email',phone_number='$Phone_num',address='$Address' WHERE user_name = '$user_name' ";
$update_profile = mysqli_query($link, $updateQuery) or die(mysqli_error($link));

if ($update_profile) {
$msg="Update profile successfully!";
 }else {
$msg="Update profile failed!";
 }
}

echo"  <script type='text/javascript'>";
echo" alert('$msg');";
echo" history.go(-1);";
echo "  </script> ";

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
            <li><a href="menu.php" >Menu</a></li>
            <li><a href="reservation.php">Reservation</a></li>
            <li><a href="order.php" >Order</a></li>
            <li><a href="trackOrder.php">My IFood</a></li>
            <li><a href="about_us.php">About US</a></li>
</ul>
        
 </div>	
    

    
    <div id="content_wrapper">
        <div id="content">
                    <div style="margin-top: 10px"id="side_column">
            
            		<div class="side_column_section">
                                     <h3>Control panel</h3>
                                     <ul>
                                     <li><a href="trackOrder.php">Track My Order/Reservation</a></li>
                                     <li><a href="usercenter.php">Edit profiles</a></li>
                                     <li><a href="changepassword.php">Change password</a></li>
                                     <li><a href="logOut.php">Log Out</a></li>
                                     </ul>
                        </div>
            	<div  class="side_column_bottom"></div>
            </div> <!-- end of side column -->
        	<div id="main_column">
            	
                <div class="section_w590">
                    
                	
                    <h2>Edit profiles</h2>
                    
        <form enctype="multipart/form-data" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" > 
                       
         <table>
             <tr>
                 <td>NRIC:</td>
                 <td><?php echo $row['nric'];?></td>
             </tr>
             <tr>
                 <td>First name:</td>
                 <td><?php echo $row['firstname'] ?></td>
             </tr>
             <tr>
                 <td>Last name:</td>
                 <td><?php echo $row['lastname'] ?></td>
             </tr>
             <tr>
                 <td>Date of birth:</td>
                 <td><?php echo $row['dateofbirth'] ?></td>
             </tr>
             <tr>
                 <td>Email:</td>
                 <td><input type="text" name="email" value="<?php echo $row['email'] ?>"/></td>
             </tr>
            
             <tr>
                 <td> Phone number:</td>
                 <td><input type ="text" name="phone_number" size="8" value="<?php echo $row['phone_number'] ?>" /></td>
             </tr>
             
              <tr>
                 <td>Address:</td>
                 <td><input type="text" name="address" size="50" value="<?php echo $row['address'] ?>"/></td>
             </tr>
              <tr>
                 <td>User image:</td>
                 <td><img width="150px" height ="150px" src="images/userimg/<?php echo $row['user_img'];?>" alt="Photo"/><br /><input type="file" name="image" /></td>
             </tr>
              </table>
       
             <hr/>
              <input style="margin-left: 100px;" type="submit" value="Change" style="margin-left: 0px;"/>   
            
       
      
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
    	Copyright © 2017 <a href="index.php">IFood</a>
    </div>
     
</div> 
<!-- end of container -->

</div>
</div>

</body>
</html>
<?php } ?>