<?php
session_start();
include 'dbFunctions.php';
$user_id=$_GET['userid'];
$getUser = "SELECT * FROM user WHERE user_id LIKE '$user_id' ";
$resultUser= mysqli_query($link, $getUser) or die(mysqli_error($link));
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../css/table.css" rel="stylesheet" type="text/css" media="screen" />
        <title>User</title>
    </head>
    <body>
        <table border="1">
         <?php 
                            while($userinfo=mysqli_fetch_array($resultUser)){
                                $first_name = $userinfo['firstname'];
                                $last_name = $userinfo['lastname'];
                                $email = $userinfo['email'];
                                $address = $userinfo['address'];
                                $dob = $userinfo['dateofbirth'];
                                $pn = $userinfo['phone_number'];
                                $account_name = $userinfo['user_name'];
                                ?>
            <tbody>
        <tr class="odd">
            <td>User ID:</td>
            <td><?php echo $user_id;?></td>
        </tr>
            <tr>
            <td>First Name:</td>
            <td><?php echo $first_name;?></td>
        </tr>
            <tr class="odd">
            <td>Last Name:</td>
            <td><?php echo $last_name;?></td>
        </tr>
        <tr>
            <td>Date Of Birth:</td>
            <td><?php echo $dob;?></td>
        </tr>
            <tr class="odd">
            <td>Email:</td>
            <td><?php echo $email;?></td>
        </tr>
        <tr>
            <td>Phone Number:</td>
            <td><?php echo $pn;?></td>
        </tr>
        <tr class="odd">
            <td>Account Name:</td>
            <td><?php echo $account_name;?></td>
        </tr> 
        <tr>
            <td>Address:</td>
            <td><?php echo $address;?></td>
        </tr>
        
                <?php }?>
            </tbody>
    </table>
        <a href="javascript:window.close();">Close</a>
        </body>
</html>
