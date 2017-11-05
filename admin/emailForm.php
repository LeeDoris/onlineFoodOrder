<?php
session_start();
include 'dbFunctions.php';
$user_id=$_GET['userid'];
$type=$_GET['type'];
if ($type=="order"){
    $id=$_GET['order_id'];
}else{
    $id=$_GET['reservation_id'];
}
$getUser = "SELECT * FROM user WHERE user_id = '$user_id' ";
$resultUser= mysqli_query($link, $getUser) or die(mysqli_error($link));
$row=mysqli_fetch_array($resultUser);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body> 
        <form method="post" action="sendEmail.php">
            <input name="user_name" type="hidden" value="<?php echo $row['user_name'] ?>" />
            <input name="id" type="hidden" value="<?php echo $id; ?>" />
            <input name="type" type="hidden" value="<?php echo $type; ?>" />
        <table>
           <tr>
               <td>Email:</td>
               <td><input name="email" type="text" value="<?php echo $row['email'] ?>" /></td>
           </tr>
           <tr>
               <td>Subject:</td>
               <td><input name="subject" type="text" /></td>
           </tr>
           <tr>
               <td>Content:</td>
               <td><textarea rows ="5" cols="30" name ="body">Dear <?php echo $row['lastname'];?>:Best Regards,IFood</textarea></td>
           </tr>
           <tr>
               <td></td>
               <td><input type="submit" value ="Send"/></td>
           </tr>
        </table>
        </form>
    </body>
</html>
