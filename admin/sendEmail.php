<?php
session_start();
error_reporting("E_ALL");
       require_once "class.phpmailer.php";
       include 'dbFunctions.php';
       $query = "SELECT admin_email FROM email WHERE id=1";
       $getEmail = mysqli_query($link, $query) or die(mysqli_error($link));
       $row=mysqli_fetch_array($getEmail);
       $from = $row['admin_email'];
        $msg=null;
        $to =  $_POST['email'];
        $subject = $_POST['subject'];
        $user = $_POST['user_name'];
        $currentdate=date('Y-m-d H:i', time());

$mail             = new PHPMailer();
$body = $_POST['body'];
$mail->IsSMTP(); 
$mail->SMTPAuth   = true;                  
$mail->SMTPSecure = "ssl";                 
$mail->Host       = "smtp.gmail.com";     
$mail->Port       = 465;                  
$mail->Username   = "reelroomrp@gmail.com"; 
$mail->Password   = "901031szl";           
$mail->SetFrom($from, 'Reel Room');
$mail->AddReplyTo($from,"Reel Room");
$mail->Subject    = $_POST['subject'];
$mail->Body = $body;
$address = $to;
$mail->AddAddress($address, "".$user."");


if(!$mail->Send()) {
  $msg =  "Mailer Error: " . $mail->ErrorInfo;
} else {
  $msg =  "Message sent!";
   $id=$_POST['id'];
          $type=$_POST['type'];
          $editor=$_SESSION['user_name'];
           $des = "Send email to ".$user."(email:".$to.") about ".$type." (id:".$id .")-Content:".$body;
         $currentdate=date('Y-m-d H:i', time());
       $insertQuery = "INSERT INTO log (editor,event_id,type,description,time) VALUES ('$editor','$id','email','$des','$currentdate')";
       $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link));
}

   echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
   echo "  </script> ";
?>