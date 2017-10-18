<?php
session_start();
include 'dbFunctions.php';
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
$order_time=$rownumO['order_time'];
$collect_time=$rownumO['date'];
$total_price=$rownumO['total_price'];
$collection_type = $rownumO['type'];
$order_state = $rownumO['state'];
$address = $rownumO['address'];

$getOI="SELECT order_item.*,item.item_price,item.item_name FROM order_item,item WHERE order_item.order_id = $order_id AND order_item.item_id = item.item_id";
$resultOI= mysqli_query($link, $getOI) or die(mysqli_error($link));

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/table.css" rel="stylesheet" type="text/css" media="screen" />
        <title>Food</title>
    </head>
    <body>
        
         <h2>Order Detail</h2>
 
                  <table border="1">
                      <tbody>
                     <tr class="odd">
                      <td>Order ID:</td><td><?php echo $order_id;?></td>
                      </tr>
                      <tr>
                      <td>User Name:</td><td><?php echo $firstname."&nbsp".$lastname;?></td>
                      </tr>
                      <tr class="odd">
                      <td>Order Time</td><td><?php echo $order_time;?></td>
                      </tr>
                      <tr>
                      <td>Collection Time</td><td><?php echo $collect_time;?></td>
                      </tr>
                      <tr class="odd">
                      <td>Items</td><td> <table>
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
                             </table>
                      </tr>
                      <tr>
                      <td>Total Price</td><td><?php echo $total_price;?></td>
                      </tr>
                      <tr class="odd">
                      <td>Collection Type</td><td><?php echo $collection_type;?></td>
                      </tr>
                      <tr>
                      <td>Order State</td><td><?php echo $order_state;?></td>
                      </tr>
                      <tr class="odd">
                      <td>Delivery Address</td><td><?php echo $address;?></td>
                      </tr>
                      </tbody>
                  </table>
   
        <a href="javascript:window.close();">Close</a>
        </body>
</html>
