<?php
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
    include 'dbFunctions.php';
    if(isset($_GET['order_id']) && $_GET['order_id']!=null  && $_GET['from']!=null){
        $from=$_GET['from'];
        $order_id=$_GET['order_id'];
        if($from=="kitchen"){
            $query = "UPDATE orders SET state= 'Ready_for_collection' WHERE order_id = '$order_id'";
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
        }else if($from=="counter"){
            $query = "UPDATE orders SET state= 'Collected' WHERE order_id = '$order_id'";
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
        }else if($from=="delivery"){
            $query = "UPDATE orders SET state= 'Collected' WHERE order_id = '$order_id'";
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
        }
   echo"  <script type='text/javascript'>";
   echo" alert('Update successfully.');";
   echo" history.go(-1);";
   echo "  </script> ";
    }else{
   echo"  <script type='text/javascript'>";
   echo" alert('Nothing here..');";
   echo" history.go(-1);";
   echo "  </script> ";
    }
}
?>
