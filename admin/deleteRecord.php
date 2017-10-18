<?php
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
    include 'dbFunctions.php';
    $msg=null;
    if(isset ($_GET['user_id']) && $_GET['user_id']!=null){
        $user_id=$_GET['user_id'];
        $q="SELECT user_img FROM user WHERE user_id='$user_id'";
        $r = mysqli_query($link, $q) or die(mysqli_error($link));
        $row=mysqli_fetch_array($r);
        if($row[0]!="defaultpic.jpg"){
            unlink("../images/userimg/$row[0]");
        }
        $query="DELETE FROM user WHERE user_id='$user_id'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        if ($result){
            $msg="Delete successed.";
        }else{
            $msg="Delete failed.";
        }
   echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
   echo "  </script> ";
    }else if(isset($_GET['item_id']) && $_GET['item_id']!=null){
        $item_id=$_GET['item_id'];
                $q="SELECT item_image FROM item WHERE item_id='$item_id'";
        $r = mysqli_query($link, $q) or die(mysqli_error($link));
        $row=mysqli_fetch_array($r);
        if($row[0]!=null){
            unlink("../images/food/$row[0]");
        }
        $query="DELETE FROM item WHERE item_id='$item_id'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        if ($result){
            $msg="Delete successed.";
        }else{
            $msg="Delete failed.";
        }
        echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
echo "  </script> ";
    }else if(isset($_GET['id']) && $_GET['id']!=null){
            $id=$_GET['id'];
                $q="SELECT image FROM slide_show WHERE id='$id'";
        $r = mysqli_query($link, $q) or die(mysqli_error($link));
        $row=mysqli_fetch_array($r);
        if($row[0]!=null){
            unlink("../images/index/$row[0]");
        }
        $query="DELETE FROM slide_show WHERE id='$id'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        if ($result){
            $msg="Delete successed.";
        }else{
            $msg="Delete failed.";
        }
        echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
echo "  </script> ";
    }else if(isset($_GET['content_id']) && $_GET['content_id']!=null){
                    $id=$_GET['content_id'];
                $q="SELECT image FROM content WHERE content_id='$id'";
        $r = mysqli_query($link, $q) or die(mysqli_error($link));
        $row=mysqli_fetch_array($r);
        if($row[0]!=null){
            unlink("../images/content/$row[0]");
        }
        $query="DELETE FROM content WHERE content_id='$id'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        if ($result){
            $msg="Delete successed.";
        }else{
            $msg="Delete failed.";
        }
        echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
echo "  </script> ";
        
    }else if(isset($_GET['order_id']) && $_GET['order_id']!=null){
                   $id=$_GET['order_id'];
        $query="DELETE FROM orders WHERE order_id='$id'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $qy="DELETE FROM order_item WHERE order_id='$id' ";
        $rt = mysqli_query($link, $qy) or die(mysqli_error($link));
        if ($result && $rt){
            $msg="Delete successed.";
        }else{
            $msg="Delete failed.";
        }
   echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
echo "  </script> ";     
        
    }else if(isset($_GET['reservation_id']) && $_GET['reservation_id']!=null){
                   $id=$_GET['reservation_id'];
        $query="DELETE FROM reservation WHERE reservation_id='$id'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        if ($result){
            $msg="Delete successed.";
        }else{
            $msg="Delete failed.";
        }
   echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
echo "  </script> ";
    }else if(isset($_GET['cat_id']) && $_GET['cat_id']!=null){
        $id=$_GET['cat_id'];
        $query="DELETE FROM category WHERE id='$id'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        if ($result){
            $msg="Delete successed.";
        }else{
            $msg="Delete failed.";
        }
   echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
echo "  </script> ";
    }else if(isset($_GET['tc_id']) && $_GET['tc_id']!=null){
        $id=$_GET['tc_id'];
        $query="DELETE FROM terms_conditions WHERE id='$id'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        if ($result){
            $msg="Delete successed.";
        }else{
            $msg="Delete failed.";
        }
   echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
echo "  </script> ";
    }else{
                    $msg="Nothing here.";
   echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
echo "  </script> ";
    }
    
}
?>
