<?php
//error_reporting("E_ALL");
require_once "class.phpmailer.php";
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
include 'dbFunctions.php';
$mail             = new PHPMailer();
$mail->IsSMTP(); 
$mail->SMTPAuth   = true;                  
$mail->SMTPSecure = "ssl";                 
$mail->Host       = "smtp.gmail.com";     
$mail->Port       = 465;                  
$mail->Username   = "reelroomrp@gmail.com"; 
$mail->Password   = "901031szl";           
if (isset ($_POST['order_id'])){
    $msg=null;
    $order_id = $_POST['order_id'];
    $state=$_POST['state'];
    $query = "UPDATE orders SET state= '$state' WHERE order_id LIKE '$order_id'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $queryU = "SELECT user.firstname,user.email FROM user, orders WHERE orders.order_id ='$order_id'AND user.user_id=orders.user_id";
    $r_user = mysqli_query($link, $queryU) or die(mysqli_error($link));
    $user = mysqli_fetch_array($r_user);
    $user_name = $user['firstname'];
    $email=$user['email'];
    $subject = "Order Uptate! - Reel Room.";
    $body = "Dear ".$user_name.","."\r\n\r\n"." Your order (id:".$order_id .") state has been changed to  ".$state.".\r\n\r\n"." If you have any query, please feel free to contact our staff - 63682566. "."\r\n\r\n"."Regards,\r\n"."Reel Room";
    $query = "SELECT admin_email FROM email WHERE id=1";
    $getEmail = mysqli_query($link, $query) or die(mysqli_error($link));
    $row=mysqli_fetch_array($getEmail);
    $from = $row['admin_email'];
$mail->SetFrom($from, 'Reel Room');
$mail->AddReplyTo($from,"Reel Room");
$mail->Subject    = $subject;
$mail->Body = $body;
$mail->AddAddress($email, "".$user_name."");
if(!$mail->Send()) {
  $msg =  "Mailer Error: " . $mail->ErrorInfo;
} else {
                  $sbj = htmlentities($subject,ENT_QUOTES);
             $con = htmlentities($body,ENT_QUOTES);
          $msg="State changed successfully and an email has been sent to customer!";
         $tp="order";
         $cs="Change_State";
         $des = "Order (id:".$order_id .") state changed to "."$state";
         $currentdate=date('Y-m-d H:i', time());
         $editor=$_SESSION['user_name'];
       $insertQuery = "INSERT INTO log (editor,event_id,type,description,time) VALUES ('$editor','$order_id','$cs','$des','$currentdate')";
       $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link));
}

   echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
   echo "  </script> ";
}else if(isset ($_POST['reservation_id'])){
    $msg=null;
    $reservation_id = $_POST['reservation_id'];
    $state=$_POST['state'];
    $query = "UPDATE reservation SET state= '$state' WHERE reservation_id LIKE '$reservation_id'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $queryU = "SELECT user.firstname,user.email FROM user, reservation WHERE reservation.reservation_id ='$reservation_id'AND user.user_id=reservation.user_id";
    $r_user = mysqli_query($link, $queryU) or die(mysqli_error($link));
    $user = mysqli_fetch_array($r_user);
    $email = $user['email'];
    $user_name=$user['firstname'];
    $subject = "Reservation Uptate! - Reel Room.";
    $body = "Dear ".$user_name.","."\r\n\r\n"." Your reservation (id:".$reservation_id.") state has been changed to  ".$state.".\r\n\r\n"." If you have any query, please feel free to contact our staff - 63682566. "."\r\n\r\n"."Regards,"."\r\n\r\n"."Reel Room";
    $query = "SELECT admin_email FROM email WHERE id=1";
    $getEmail = mysqli_query($link, $query) or die(mysqli_error($link));
    $row=mysqli_fetch_array($getEmail);
    $from = $row['admin_email'];
$mail->SetFrom($from, 'Reel Room');
$mail->AddReplyTo($from,"Reel Room");
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email, "".$user_name."");
if(!$mail->Send()) {
  $msg =  "Mailer Error: " . $mail->ErrorInfo;
} else {
              $sbj = htmlentities($subject,ENT_QUOTES);
             $con = htmlentities($body,ENT_QUOTES);
          $msg="State changed successfully and an email has been sent to customer!";
         $tp="reservation";
         $des = "Reservation (id:".$reservation_id .") state changed to "."$state";
         $currentdate=date('Y-m-d H:i', time());
         $cs="Change_State";
         $editor=$_SESSION['user_name'];
       $insertQuery = "INSERT INTO log (editor,event_id,type,description,time) VALUES ('$editor','$reservation_id','$cs','$des','$currentdate')";
       $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link));
         }
   echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
   echo "  </script> ";
}
}
?>
