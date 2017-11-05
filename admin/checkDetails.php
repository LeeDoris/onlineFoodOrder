<?php
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
include 'dbFunctions.php';
$select=null;
if (isset($_GET['order_id'])){
$select="order";
$order_id = $_GET['order_id'];

$getO = "SELECT * FROM orders  WHERE order_id LIKE $order_id";
$resultO= mysqli_query($link, $getO) or die(mysqli_error($link));
$rownumO=mysqli_fetch_array($resultO);
$user_id = $rownumO['user_id'];
$getUser = "SELECT * FROM user  WHERE user_id LIKE $user_id";
$resultUser= mysqli_query($link, $getUser) or die(mysqli_error($link));
$rowUser=mysqli_fetch_array($resultUser);
$firstname = $rowUser['firstname'];
$lastname = $rowUser['lastname'];
$order_id=$rownumO['order_id'];
$collect_time=$rownumO['date'];
$cd= date('d-m-Y H:i',strtotime($collect_time));
$total_price=$rownumO['total_price'];
$collection_type = $rownumO['type'];
$order_state = $rownumO['state'];
$order_time=$rownumO['order_time'];
$od= date('d-m-Y H:i',strtotime($order_time));
$address = $rownumO['address'];
$getOI="SELECT order_item.*,item.item_price,item.item_name FROM order_item,item WHERE order_item.order_id = $order_id AND order_item.item_id = item.item_id";
$resultOI= mysqli_query($link, $getOI) or die(mysqli_error($link));
$state = array(
'Accepted' => "Accepted",
'Ready_for_collection' => "Ready_for_collection",
'Collected' => "Collected",
'Cancelled' => "Cancelled"
);
function generateSelect($name = '', $options = array(),$currentSate) {
    $html = '<select name="'.$name.'">';
    foreach ($options as $option => $value) {
        if($value==$currentSate){
             $html .= '<option value='.$value.' selected>'.$option.'</option>';
        }else{
             $html .= '<option value='.$value.'>'.$option.'</option>';
        }
    }
    $html .= '</select>';
    return $html;
}

}else if(isset($_GET['reservation_id'])){
    $select="reservation";
    $reservation_id=$_GET['reservation_id'];
$getR = "SELECT * FROM reservation where reservation_id = $reservation_id ";
$resultR= mysqli_query($link, $getR) or die(mysqli_error($link));
$rownumR=mysqli_fetch_array($resultR);
$user_id = $rownumR['user_id'];
//get User name
$getUser = "SELECT * FROM user  WHERE user_id LIKE $user_id";
$resultUser= mysqli_query($link, $getUser) or die(mysqli_error($link));
$rowUser=mysqli_fetch_array($resultUser);
$firstname = $rowUser['firstname'];
$lastname = $rowUser['lastname'];
$reservation_time=$rownumR['current'];
$rt= date('d-m-Y H:i',strtotime($reservation_time));
$reserved_time=$rownumR['date'];
$rd= date('d-m-Y H:i',strtotime($reserved_time));
$total_people=$rownumR['people'];
$reservation_state = $rownumR['state'];
$comment = $rownumR['comment'];

$state = array(
    'Accepted' => "Accepted",
'Pending' => "Pending",
'Rejected' => "Rejected"
);
function generateSelect($name = '', $options = array(),$currentSate) {
    $html = '<select name="'.$name.'">';
    foreach ($options as $option => $value) {
        if($value==$currentSate){
             $html .= '<option value='.$value.' selected>'.$option.'</option>';
        }else{
             $html .= '<option value='.$value.'>'.$option.'</option>';
        }
    }
    $html .= '</select>';
    return $html;
}
}else if(isset($_GET['userid'])){
    $select="user";
    $user_id=$_GET['userid'];
$getUser = "SELECT * FROM user WHERE user_id LIKE '$user_id' ";
$resultUser= mysqli_query($link, $getUser) or die(mysqli_error($link));
$userinfo=mysqli_fetch_array($resultUser);
$first_name = $userinfo['firstname'];
$last_name = $userinfo['lastname'];
$email = $userinfo['email'];
$address = $userinfo['address'];
$dob = $userinfo['dateofbirth'];
$dobfm= date('d-m-Y',strtotime($dob));
$pn = $userinfo['phone_number'];
$account_name = $userinfo['user_name'];
$img = $userinfo['user_img'];
$user_state = $userinfo['state'];
$role = $userinfo['role'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Admin</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<style media="all" type="text/css">@import "css/all.css";</style>
        
        <script type="text/javascript" language="javascript">
function OpenPopup (c) {
window.open(c,
'window',
'width=350,height=380,scrollbars=yes,status=yes');
}
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
			<li><span><span><a href="statistics.php">Statistics</a></span></span></li>
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
				<li><a href="javascript:history.go(-1)">Go Back</a></li>
			</ul>
		</div>
		<div id="center-column">
			<div class="top-bar">
				<h1>Check Detail</h1>
			</div><br /><br />
                        <?php if($select=="order"){
                           ?>
                        <h2>Order Detail</h2>
                         <form method="post" action="updateState.php">
                              <div class="table">
                                  <table  class="listing" cellpadding="0" cellspacing="0">
                      <tbody>
                     <tr class="bg">
                      <td>Order ID:</td><td colspan="3"><input type="hidden" name="order_id" value="<?php echo $order_id ?>" /><?php echo $order_id;?></td>
                      </tr>
                      <tr>
                      <td>User Name:</td><td colspan="3"><a href="userInfo.php?userid=<?php echo $user_id;?>" onclick="OpenPopup(this.href); return false"><?php echo $firstname."&nbsp".$lastname;?></a></td>
                      </tr>
                      <tr class="bg">
                      <td>Order Time</td><td colspan="3"><?php echo $od;?></td>
                      </tr>
                      <tr>
                      <td>Collection Time</td><td colspan="3"><?php echo $cd;?></td>
                      </tr>
                      <tr class="bg">
                      <td>Items</td><td> <table style="margin-left:80px;" >
    <tr>
     <td>Name</td>
     <td>Unit*Price</td>
     <td>SubTotal</td>
   </tr>
                         <?php while($rownumOI=mysqli_fetch_array($resultOI)){
                          $item_name=$rownumOI['item_name'];
                          $item_q=$rownumOI['quantity'];
                          $item_p=$rownumOI['item_price'];
                          $item_sub=$item_q*$item_p;
                      ?>
                         
   <tr>
     <td><?php echo $item_name;?></td>
     <td><?php echo $item_q;?>*$<?php echo $item_p;?></td>
     <td>$<?php echo $item_sub;?></td>
   </tr>
                       <?php }?>
                             </table></td> 
                      </tr>
                      <tr>
                      <td>Total Price</td><td colspan="3"><?php if ($collection_type=="delivery"){
                          echo $total_price."($5 for delivery)";}else{
                               echo $total_price;
                          }
                          ?></td>
                      </tr>
                      <tr class="bg">
                      <td>Collection Type</td><td colspan="3"><?php echo $collection_type;?></td>
                      </tr>
                      <tr>
                      <td>Address</td><td colspan="3"><?php echo $address;?></td>
                      </tr>
                      <tr class="bg">
                      <td>Order State</td><td colspan="3"><?php echo $html = generateSelect('state', $state,$order_state);?>
                          <?php if($_SESSION['role']==1){ ?>
                              <input type="submit" value ="Edit"/>
                          <?php }?>
                          </td>
                      </tr>
                      </tbody>
                  </table></div>
                  </form> <p><a href="javascript:history.go(-1)">Go Back</a></p></div>
                 
                 
                      <?php  }else if($select=="reservation"){ ?>
                           <h2>Reservation Detail</h2>
                  <form method="post" action="updateState.php">
                      <div class="table">
                  <table  class="listing" cellpadding="0" cellspacing="0">
                      <tbody>
                     <tr class="bg">
                      <td>Reservation ID</td><td><input type="hidden" name="reservation_id" value="<?php echo $reservation_id ?>" /><?php echo $reservation_id;?></td>
                      </tr>
                     <tr>
                      <td>User Name</td><td><a href="userInfo.php?userid=<?php echo $user_id;?>" onclick="OpenPopup(this.href); return false"><?php echo $firstname."&nbsp".$lastname;?></a></td>
                      </tr>
                      <tr class="bg">
                      <td>Create Time</td><td><?php echo $rt;?></td>
                      </tr>
                      <tr>
                      <td>Reserved Time</td><td><?php echo $rd;?></td>
                      </tr>
                      <tr class="bg">
                      <td>Number of People</td><td><?php echo $total_people;?></td>
                      </tr>
                      <tr>
                      <td>Comments:</td><td><?php echo $comment;?></td>
                      </tr>
                      <tr class="bg">
                       <td>Reservation State</td><td>
                           <?php echo $html = generateSelect('state', $state,$reservation_state);?>
                           <?php if($_SESSION['role']==1){ ?>
                              <input type="submit" value ="Edit"/>
                          <?php }?></td>
                      </tr>
                      </tbody>
                  </table>
                          </div>
                  </form>
                  <p><a href="javascript:history.go(-1)">Go Back</a></p>
                     <?php }else if($select=="user"){ ?>
                   <h2>User Detail</h2>
                      <div class="table">
                  <table  class="listing" cellpadding="0" cellspacing="0">
           <tbody>
        <tr class="bg">
            <td>User ID:</td>
            <td><?php echo $user_id;?></td>
        </tr>
            <tr>
            <td>First Name:</td>
            <td><?php echo $first_name;?></td>
        </tr>
            <tr class="bg">
            <td>Last Name:</td>
            <td><?php echo $last_name;?></td>
        </tr>
        <tr>
            <td>Date Of Birth:</td>
            <td><?php echo $dobfm;?></td>
        </tr>
            <tr class="bg">
            <td>Email:</td>
            <td><?php echo $email;?></td>
        </tr>
        <tr>
            <td>Phone Number:</td>
            <td><?php echo $pn;?></td>
        </tr>
        <tr class="bg">
            <td>Account Name:</td>
            <td><?php echo $account_name;?></td>
        </tr> 
        <tr>
            <td>Address:</td>
            <td><?php echo $address;?></td>
        </tr>
        <tr class="bg">
            <td>Role:</td>
            <?php 
            $q="SELECT name FROM user_group WHERE id='$role'";
            $result= mysqli_query($link, $q) or die(mysqli_error($link));
            $row=mysqli_fetch_array($result);
            ?>
            <td><?php echo $row['name'];?></td>
        </tr> 
        <tr>
            <td>Image:</td>
            <td><?php echo $img;?></td>
        </tr> 
        <tr class="bg">
            <td>Account State:</td>
            <td><?php echo $user_state;?></td>
        </tr>
            </tbody>
                  </table>
                          </div>
                  <p><a href="javascript:history.go(-1)">Go Back</a></p>
                         <?php
                     }
                     ?>
                  </div>
	<div id="footer"></div>
</div>
</body>
</html>
<?php } ?>