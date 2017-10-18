<?php
//error_reporting("E_ALL");
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
        function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 
include 'dbFunctions.php';
      if (isset ($_POST['product_id'])){
    $item_id=$_POST['item_id'];
    $product_id = $_POST['product_id'];
    $name=$_POST['item_name'];
    $category=$_POST['category'];
    $price=$_POST['price'];
    $desc=$_POST['desc'];
    $image=$_FILES['image']['name'];
   $target_path = "../images/food/";
   $photoname = basename($_FILES['image']['name']);
   if ($photoname!=null){
         $filename = stripslashes($_FILES['image']['name']);
        $extension = getExtension($filename);
  $extension = strtolower($extension);
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
$msg= " Unknown Image extension ";
  }else{
                $target_path = $target_path.basename( $_FILES['image']['name']); 
   if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)){
       $query = "UPDATE item SET product_id= '$product_id',item_name= '$name',item_category= '$category',item_price= '$price',item_desc= '$desc',item_image= '$photoname' WHERE item_id = '$item_id'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if($result){
        $msg = "Update succeffully.";
        }else{
        $msg = "Update failed, please try again!";
        }
}else{
     $msg = "Update failed, please try again!(images)";
}
  }
  
   }else{
       $query = "UPDATE item SET product_id= '$product_id',item_name= '$name',item_category= '$category',item_price= '$price',item_desc= '$desc' WHERE item_id = '$item_id'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if($result){
        $msg = "Update succeffully.";
        }else{
        $msg = "Update failed, please try again!";
        }
   }
    
        echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
echo "  </script> ";
}else if(isset ($_POST['user_id'])){
    $user_id=$_POST['user_id'];
    $fn = $_POST['firstname'];
    $ln=$_POST['lastname'];
    $dob=$_POST['dob'];
    $email=$_POST['email'];
    $pn=$_POST['phonenumber'];
    $address=$_POST['address'];
    $an=$_POST['account_name'];
    $role=$_POST['role'];
    $state=$_POST['state'];
    $image=$_FILES['image']['name'];
   $target_path = "../images/userimg/";
   $photoname = basename($_FILES['image']['name']);
   if ($photoname!=null){
         $filename = stripslashes($_FILES['image']['name']);
        $extension = getExtension($filename);
  $extension = strtolower($extension);
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
$msg= " Unknown Image extension ";
  }else{
                $target_path = $target_path.basename( $_FILES['image']['name']); 
   if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)){
       $query = "UPDATE user SET firstname= '$fn',lastname= '$ln',email= '$email',address= '$address',dateofbirth= '$dob',user_name= '$an',role='$role',user_img='$photoname',state='$state' WHERE user_id = '$user_id'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if($result){
        $msg = "Update succeffully.";
        }else{
        $msg = "Update failed, please try again!";
        }
}else{
     $msg = "Update failed, please try again!(images)";
}
  }
  
   }else{
       $query = "UPDATE user SET firstname= '$fn',lastname= '$ln',email= '$email',address= '$address',dateofbirth= '$dob',user_name= '$an',role='$role',state='$state' WHERE user_id = '$user_id'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if($result){
        $msg = "Update succeffully.";
        }else{
        $msg = "Update failed, please try again!";
        }
   }
    
        echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
echo "  </script> ";
    
}else if(isset ($_POST['content_id'])){
    $content_id=$_POST['content_id'];
    $name = $_POST['name'];
    $st=$_POST['st'];
    $et=$_POST['et'];
    $category=$_POST['category'];
    $d=$_POST['description'];
    $re=$_POST['remarks'];
    $image=$_FILES['image']['name'];
   $target_path = "../images/content/";
   $photoname = basename($_FILES['image']['name']);
   if ($photoname!=null){
         $filename = stripslashes($_FILES['image']['name']);
        $extension = getExtension($filename);
  $extension = strtolower($extension);
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
$msg= " Unknown Image extension ";
  }else{
                $target_path = $target_path.basename( $_FILES['image']['name']); 
   if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)){
       if($st==null){
           $query = "UPDATE content SET content_name= '$name',category= '$category',description= '$d',remarks= '$re',image='$photoname' WHERE content_id = '$content_id'";
       }else{
           $query = "UPDATE content SET content_name= '$name',start_time= '$st',end_time= '$et',category= '$category',description= '$d',remarks= '$re',image='$photoname' WHERE content_id = '$content_id'";
       }
       $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if($result){
        $msg = "Update succeffully.";
        }else{
        $msg = "Update failed, please try again!";
        }
}else{
     $msg = "Update failed, please try again!(images)";
}
  }
  
   }else{
       if($st==null){
           $query = "UPDATE content SET content_name= '$name',category= '$category',description= '$d',remarks= '$re',image='$photoname' WHERE content_id = '$content_id'";
       }else{
           $query = "UPDATE content SET content_name= '$name',start_time= '$st',end_time= '$et',category= '$category',description= '$d',remarks= '$re',image='$photoname' WHERE content_id = '$content_id'";
       }
       
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if($result){
        $msg = "Update succeffully.";
        }else{
        $msg = "Update failed, please try again!";
        }
   }
    
        echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
echo "  </script> ";
    
}else if(isset($_POST['cat_id'])){
    $id=$_POST['cat_id'];
    $name=$_POST['name'];
    $query = "UPDATE category SET name= '$name' WHERE id = '$id'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if($result){
        $msg = "Update succeffully.";
        }else{
        $msg = "Update failed, please try again!";
        }
        echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
echo "  </script> ";
}else if(isset($_POST['slider_id'])){
    $id=$_POST['slider_id'];
    $title=$_POST['title'];
    $type=$_POST['type'];
    $link_id=$_POST['link_id'];
      $image=$_FILES['image']['name'];
   $target_path = "../images/index/";
   $image = basename($_FILES['image']['name']);
   if ($image!=null){
         $filename = stripslashes($_FILES['image']['name']);
        $extension = getExtension($filename);
  $extension = strtolower($extension);
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
$msg= " Unknown Image extension ";
  }else{
                $target_path = $target_path.basename( $_FILES['image']['name']); 
   if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)){
      $query = "UPDATE slide_show SET title= '$title',type= '$type',link_id= '$link_id',image='$image' WHERE id = '$id'";
      $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if($result){
        $msg = "Update succeffully.";
        }else{
        $msg = "Update failed, please try again!";
        }
}else{
     $msg = "Update failed, please try again!(images)";
}
  }
  
   }else{
       $query = "UPDATE slide_show SET title= '$title',type= '$type',link_id= '$link_id' WHERE id = '$id'";
      $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if($result){
        $msg = "Update succeffully.";
        }else{
        $msg = "Update failed, please try again!";
        }
   }
    
        echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
echo "  </script> ";
}else if(isset($_POST['tc_id']) && $_POST['tc_id']!=null){
    $id=$_POST['tc_id'];
    $des=$_POST['desc'];
    $query = "UPDATE terms_conditions SET description= '$des' WHERE id = '$id'";
      $result = mysqli_query($link, $query) or die(mysqli_error($link));
      if($result){
          $msg="Update successfully!";
      }else{
          $msg="Update failed, please try again!";
      }
              echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
echo "  </script> ";
}else{
        echo"  <script type='text/javascript'>";
   echo" alert('Nothing here...');";
   echo" history.go(-1);";
echo "  </script> ";
}
}
?>
