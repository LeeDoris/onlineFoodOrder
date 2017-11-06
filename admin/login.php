<?php
session_start();
include 'dbFunctions.php';
$msg=null;
if (isset($_SESSION['role']) && $_SESSION['role']!=3){
    header('Location: dashboard.php');
}else if(isset($_SESSION['role']) && $_SESSION['role']==3){
    header('Location: no_permission.php');
}else{
if(isset($_POST['username'])){
    $username = $_POST['username']; 
    $pw = sha1($_POST['password']);
    $select = "SELECT * FROM user WHERE user_name = '$username'";
    $selectUser = mysqli_query($link, $select) or die(mysqli_error($link));
    $row=mysqli_fetch_array($selectUser);
    if ($row == null){
        $msg = "Wrong username or password."; 
    }else if ($pw !=$row['password']){
         $msg = "Wrong username or password."; 
    }else{
        if ($row['role']==1){
            $_SESSION['user_name'] = $username;
         $_SESSION['role'] = $row['role'];
         $_SESSION['user_id'] = $row['user_id'];
            header('Location: dashboard.php');
        }else{
             header('Location: no_permission.php');
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Admin</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<style media="all" type="text/css">@import "css/all.css";</style>
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
                        <li><span><span><a href="setting.php">Settings</a></span></span></li>
                        <li style="position:relative;left:275px;;"><span><span><a href="../index.php">View Site</a></span></span></li>
		</ul>
	</div>
	<div id="middle">
		<div id="left-column">
			<h3>View Site</h3>
			<ul class="nav">
				<li><a href="../index.php">Index</a></li>
				<li><a href="../menu.php">Menu</a></li>
				<li><a href="../reservation.php">Reservation</a></li>
				<li><a href="../order.php">Order</a></li>
				<li><a href="../trackOrder.php">Track Orders/Reservation</a></li>
                                <li><a href="../about_us.php">About us</a></li>
                                <li><a href="../logOut.php">Log Out</a></li>
			</ul>
		</div>
		<div id="center-column">
			<div class="top-bar">
				<h1>Login</h1>
			</div><br /><br />
                        <form style="  margin-left: 200px;margin-top: 100px;" name="form1" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" >
                            <table>
                           <tr><td><label>Username:</label></td><td><input name="username" type="text" /></td></tr>
                           <tr><td><label>Password:</label></td><td><input name="password" type="password" /></td></tr>
                           <tr><td></td><td><input type="submit" value="Log in" /></td></tr>
                           </table>
                            <?php echo $msg;?>
                        </form>
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
<?php } ?>