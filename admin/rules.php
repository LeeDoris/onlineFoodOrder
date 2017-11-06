<?php
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
include 'dbFunctions.php';
$getSetting = "SELECT * FROM rule";
$result= mysqli_query($link, $getSetting) or die(mysqli_error($link));
while($row=  mysqli_fetch_array($result)){
    if($row['type']=="order_b"){
        $ob_id=$row['id'];
        $ob_limit=$row['limits'];
        $ob_time=$row['time'];
    }else if($row['type']=="order_a"){
        $oa_id=$row['id'];
        $oa_limit=$row['limits'];
        $oa_time=$row['time'];
    }else if($row['type']=="reservation_b"){
        $rb_id=$row['id'];
        $rb_limit=$row['limits'];
        $rb_time=$row['time'];
    }else{
        $ra_id=$row['id'];
        $ra_limit=$row['limits'];
        $ra_time=$row['time'];
    }
}
$query="SELECT * FROM email";
$result_email= mysqli_query($link, $query) or die(mysqli_error($link));
while($getEmail=  mysqli_fetch_array($result_email)){
    if($getEmail['id']==1){
        $send_id=$getEmail['id'];
        $send_email=$getEmail['admin_email'];
    }else{
        $receive_id=$getEmail['id'];
        $receive_email=$getEmail['admin_email'];
    }
}

if(isset($_POST['id'])){
    $id=$_POST['id'];
  $lt=$_POST['amount'];
  $time=$_POST['hours'];
  $update = "UPDATE rule SET limits='$lt', time='$time' WHERE id=$id";
  $result_update= mysqli_query($link, $update) or die(mysqli_error($link));
  if($result_update){
   echo"  <script type='text/javascript'>";
   echo "  </script> ";
  }else{
   echo"  <script type='text/javascript'>";
   echo "  </script> ";
  } 
  
}else if(isset($_POST['email_id'])){
    $id=$_POST['email_id'];
    $email_address=$_POST['email'];
     $update = "UPDATE email SET admin_email='$email_address' WHERE id=$id";
  $result_update= mysqli_query($link, $update) or die(mysqli_error($link));
  if($result_update){
   echo"  <script type='text/javascript'>";
   echo "  </script> ";
  }else{
   echo"  <script type='text/javascript'>";
   echo "  </script> ";
  } 
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<meta  http-equiv="content-type" content="text/html; charset=utf-8" />
	<style media="all" type="text/css">@import "css/all.css";</style>
       <script src="js/jquery-1.4.1.min.js" type="text/javascript"></script>
    <script src="../js/form_validator.js" type="text/javascript"></script>
</head>
<body>
<div id="main">
	<div id="header">
		<a href="dashboard.php" class="logo" style="font-size:xx-large;color:orange;">IFood Admin Area</a>
		<ul id="top-navigation">
			<li><span><span><a href="dashboard.php">Homepage</a></span></span></li>
			<li><span><span><a href="orders.php">Orders</a></span></span></li>
			<li><span><span><a href="reservation.php">Reservations</a></span></span></li>
			<li><span><span><a href="contents.php">Contents</a></span></span></li>
			<li><span><span><a href="users.php">Users</a></span></span></li>
                        <li><span><span><a href="logs.php">Logs</a></span></span></li>
                        <li class="active"><span><span>Settings</span></span></li>
                        <li style="position:relative;left:275px;"><span><span><a href="../logOut.php">Logout</a></span></span></li>
                        <li style="position:relative;left:275px;;"><span><span><a href="../index.php">View Site</a></span></span></li>
		</ul>
	</div>
	<div id="middle">
		<div id="left-column">
			<h3>Control Panel</h3>
			<ul class="nav">
				<li><a href="setting.php">Time Settings</a></li>
                                <li><a href="rules.php">Rule Settings</a></li>
			</ul>
		</div>
		<div id="center-column">
			<div class="top-bar">
				<h1>Settings</h1>
			</div>
                <div>
                    
                        <br /><br />
                        <h2>Orders</h2>
                        <div>
                       <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form1" id="form1">
                           <input type="hidden" name="id" value="<?php echo $ob_id;?>" />
                           <p>For orders $<input type="text" name="amount" value="<?php echo $ob_limit;?>" size="5"/> and below, customer must order <input type="text" name="hours" value="<?php echo $ob_time;?>" size="3" /> hour(s) in advance.
                           <input type="submit" value="Change" /></p>
                       </form>
                       <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form2" id="form2">
                           <input type="hidden" name="id" value="<?php echo $oa_id;?>" />
                           <p>For orders $<input type="text" name="amount" value="<?php echo $oa_limit;?>" size="5"/> and above, customer must order <input type="text" name="hours" value="<?php echo $oa_time;?>" size="3" /> hour(s) in advance.
                        <input type="submit" value="Change" /></p>
                       </form>
                            <hr />
                       </div>
                        <h2>Reservation</h2>
                        <div>
                       <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form3" id="form3">
                           <input type="hidden" name="id" value="<?php echo $rb_id;?>" />
                           <p>For reservation <input type="text" name="amount" value="<?php echo $rb_limit;?>" size="5"/> pax and below, customer must made <input type="text" name="hours" value="<?php echo $rb_time;?>" size="3" /> hour(s) in advance.
                           <input type="submit" value="Change" /></p>
                       </form>
                       <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form4" id="form4">
                           <input type="hidden" name="id" value="<?php echo $ra_id;?>" />
                           <p>For reservation <input type="text" name="amount" value="<?php echo $ra_limit;?>" size="5"/> pax and above, customer must made <input type="text" name="hours" value="<?php echo $ra_time;?>" size="3" /> hour(s) in advance.
                           <input type="submit" value="Change" /></p>
                       </form>
                            <hr />
                       </div>
                        <h2>General Settings</h2>
                        <div>
                            <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form5" id="form5">
                           <input type="hidden" name="email_id" value="<?php echo $send_id;?>" />
                           <p>Email address for sending emails: <input type="text" name="email" value="<?php echo $send_email;?>" /><input type="submit" value="Change" /></p>
                       </form>
                              <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form6" id="form6">
                           <input type="hidden" name="email_id" value="<?php echo $receive_id;?>" />
                           <p>Email address for receiving emails: <input type="text" name="email" value="<?php echo $receive_email;?>" /><input type="submit" value="Change" /></p>
                       </form>
                        </div>
                        
                        
                <script language="JavaScript" type="text/javascript">
                  var frmvalidator1  = new Validator("form1");
                    frmvalidator1.EnableOnPageErrorDisplay();
                    frmvalidator1.EnableMsgsTogether();
                    frmvalidator1.addValidation("amount","req","Please enter amount.");
                    frmvalidator1.addValidation("hours","req","Please enter time.");
                  var frmvalidator2  = new Validator("form2");
                    frmvalidator2.EnableOnPageErrorDisplay();
                    frmvalidator2.EnableMsgsTogether();
                    frmvalidator2.addValidation("amount","req","Please enter amount.");
                    frmvalidator2.addValidation("hours","req","Please enter time.");
                 var frmvalidator3  = new Validator("form3");
                    frmvalidator3.EnableOnPageErrorDisplay();
                    frmvalidator3.EnableMsgsTogether();
                    frmvalidator3.addValidation("amount","req","Please enter amount.");
                    frmvalidator3.addValidation("hours","req","Please enter time.");
                 var frmvalidator4  = new Validator("form4");
                    frmvalidator4.EnableOnPageErrorDisplay();
                    frmvalidator4.EnableMsgsTogether();
                    frmvalidator4.addValidation("amount","req","Please enter amount.");
                    frmvalidator4.addValidation("hours","req","Please enter time.");
                     var frmvalidator5  = new Validator("form5");
                    frmvalidator5.EnableOnPageErrorDisplay();
                    frmvalidator5.EnableMsgsTogether();
                    frmvalidator5.addValidation("email","req","Please enter email.");
                    frmvalidator5.addValidation("email","email","Please enter valid email.");
                     var frmvalidator6  = new Validator("form6");
                    frmvalidator6.EnableOnPageErrorDisplay();
                    frmvalidator6.EnableMsgsTogether();
                    frmvalidator6.addValidation("email","req","Please enter email.");
                    frmvalidator6.addValidation("email","email","Please enter valid email.");
                </script>
                </div>

		</div>
		<div id="right-column">
			<strong class="h">INFO</strong>
			<div class="box"></div>
	  </div>
	</div>
	<div id="footer"></div>
</div>
</body>
</html>
<?php }?>