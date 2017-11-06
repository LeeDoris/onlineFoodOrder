<?php
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
include 'dbFunctions.php';
$select=null;
if(isset($_GET['item_id']) && $_GET['item_id']!=null){
    $item_id=$_GET['item_id'];
    $queryNum = "SELECT * FROM item WHERE item_id = $item_id";
    $resultR = mysqli_query($link, $queryNum) or die(mysqli_error($link));
    $rownumR=mysqli_fetch_array($resultR);
    $product_id=$rownumR['product_id'];
    $name=$rownumR['item_name'];
    $category=$rownumR['item_category'];
    $price=$rownumR['item_price'];
    $desc=$rownumR['item_desc'];
    $img=$rownumR['item_image'];
    $query = "SELECT id,name FROM category";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $select="item";
}else if(isset($_GET['user_id']) && $_GET['user_id']!=null){
$user_id=$_GET['user_id'];
$getUser = "SELECT * FROM user WHERE user_id LIKE '$user_id' ";
$resultUser= mysqli_query($link, $getUser) or die(mysqli_error($link));
$userinfo=mysqli_fetch_array($resultUser);
$first_name = $userinfo['firstname'];
$last_name = $userinfo['lastname'];
$email = $userinfo['email'];
$address = $userinfo['address'];
$dob = $userinfo['dateofbirth'];
$pn = $userinfo['phone_number'];
$account_name = $userinfo['user_name'];
$role=$userinfo['role'];
$img=$userinfo['user_img'];
$select="user";
$state=$userinfo['state'];
}else if(isset($_GET['content_id']) && $_GET['content_id']!=null){
    $content_id=$_GET['content_id'];
$getContent = "SELECT * FROM content WHERE content_id LIKE '$content_id' ";
$resultC= mysqli_query($link, $getContent) or die(mysqli_error($link));
$rownumR=mysqli_fetch_array($resultC);
$content_id=$rownumR['content_id'];
$name=$rownumR['content_name'];
$pt=$rownumR['post_time'];
$startt=$rownumR['start_time'];
$endt=$rownumR['end_time'];
$st=date('d-m-Y', strtotime($startt));
$et=date('d-m-Y', strtotime($endt));
$compare = date('d-m-Y', strtotime("01-01-1970"));
if ($compare==$st && $compare==$et){
     $st=null;
   $et=null;
   }
$category=$rownumR['category'];
$desc=$rownumR['description'];
$img=$rownumR['image'];
$remark=$rownumR['remarks'];
$select="content";
}else if(isset($_GET['cat_id']) && $_GET['cat_id']!=null){
    $catid=$_GET['cat_id'];
    $getCat = "SELECT * FROM category WHERE id = '$catid' ";
    $resultCat= mysqli_query($link, $getCat) or die(mysqli_error($link));
    $row=mysqli_fetch_array($resultCat);
    $name = $row['name'];
    $select="category";
}else if(isset($_GET['slider_id']) && $_GET['slider_id']!=null){
    $slider_id=$_GET['slider_id'];
    $getSlider = "SELECT * FROM slide_show WHERE id = '$slider_id' ";
    $resultS= mysqli_query($link, $getSlider) or die(mysqli_error($link));
    $row=mysqli_fetch_array($resultS);
    $title=$row['title'];
    $image=$row['image'];
    $type=$row['type'];
    $c_t=$row['create_time'];
    $link_id=$row['link_id'];
    $select="slider";
}else if(isset($_GET['tc_id'])&&$_GET['tc_id']!=null){
    $id=$_GET['tc_id'];
    $getTC = "SELECT * FROM terms_conditions WHERE id = '$id' ";
    $result= mysqli_query($link, $getTC) or die(mysqli_error($link));
    $row=mysqli_fetch_array($result);
    $des=$row['description'];
    $select="tc";
}else{
        echo"  <script type='text/javascript'>";
   echo" alert('Nothing here...');";
   echo" history.go(-1);";
echo "  </script> ";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Admin</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<style media="all" type="text/css">@import "css/all.css";</style>
        <script language="javascript" type="text/javascript" src="../datetimepicker.js"></script>
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
				<h1>Update</h1>
			</div><br /><br />
                            <div class="table">
                                <form enctype="multipart/form-data" method="post" action="updateRecord.php">
                                    <?php if($select=="item"){  ?>
                                              <input name="item_id" value="<?php echo $item_id;?>" type="hidden" />
				<table class="listing" cellpadding="0" cellspacing="0">
                                    <tbody>
                                    <tr class="bg">
                                        <td>Product ID:</td><td><input name="product_id" value="<?php echo $product_id;?>" type="text" size="4"/></td>
                                    </tr>
                                    <tr>
                                        <td>Item Name:</td><td><input name="item_name" value="<?php echo $name;?>" type="text" /></td>
                                    </tr>
                                    <tr class="bg">
                                        
                                        <td>Category:</td><td><select name="category">
                                        <?php while($row=mysqli_fetch_array($result)){
                                            $cat=$row['name'];
                                            $cat_id=$row['id'];
                                            if($cat_id==$category){
                                                echo "<option value ='$cat_id' selected>".$cat."</option>";
                                            }else{
                                                echo "<option value ='$cat_id'>".$cat."</option>";
                                            }
                                        }?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Price:</td><td><input name="price" value="<?php echo $price;?>" type="text" /></td>
                                    </tr>
                                    <tr class="bg">
                                        <td>Description:</td><td><input name="desc" value="<?php echo $desc;?>" type="text" /></td>
                                    </tr>
                                    <tr>
                                        <td>Image:</td><td>
                                                            <?php if($img!=null){ ?>
                    <img src="../images/food/<?php echo $img;?>" width="80" height="80" /> <br />
                <?php }
?>
                                            <input name="image" value="<?php echo $img;?>" type="file" /></td>
                                    </tr>
                                        </tbody>
				</table>
                                        <?php
                                    }else if($select=="user"){ ?>
                                         <h2>User Detail</h2>
                      <div class="table">
                  <table  class="listing" cellpadding="0" cellspacing="0">
                      <input name="user_id" value="<?php echo $user_id;?>" type="hidden" />
           <tbody>
            <tr>
            <td>First Name:</td>
            <td><input name="firstname" value="<?php echo $first_name;?>" type="text" /></td>
        </tr>
            <tr class="bg">
            <td>Last Name:</td>
            <td><input name="lastname" value="<?php echo $last_name;?>" type="text" /></td>
        </tr>
        <tr>
            <td><label for="dob">Date of Birth</label></td>
            <td><input id="dob" name ="dob" type="text" size="25"  value="<?php echo $dob;?>" /><a href="javascript:NewCal('dob','yyyymmdd')"><img src="../images/cal.gif" width="20" height="20" border="1" alt="Pick a date" /></a></td>
        </tr>
            <tr class="bg">
            <td>Email:</td>
            <td><input name="email" value="<?php echo $email;?>" type="text" /></td>
        </tr>
        <tr>
            <td>Phone Number:</td>
            <td><input name="phonenumber" value="<?php echo $pn;?>" type="text" /></td>
        </tr>
        <tr class="bg">
            <td>Account Name:</td>
            <td><input name="account_name" value="<?php echo $account_name;?>" type="text" /></td>
        </tr> 
        <tr>
            <td>Address:</td>
            <td><input name="address" value="<?php echo $address;?>" type="text" /></td>
        </tr>
               <tr class="bg">
            <td>Role:</td>
            <?php
            $q="SELECT * FROM user_group";
            $result= mysqli_query($link, $q) or die(mysqli_error($link));
            ?>
            <td>
            <select name="role">
                                                <?php while($row=mysqli_fetch_array($result)){
                                                        $id=$row['id'];
                                                        $name=$row['name'];
                                                    if($role==$row['id']){
                                                        echo "<option value='$id' selected>$name</option>";
                                                    }else{
                                                        echo "<option value='$id'>$name</option>";
                                                    }
                                                }
                                                ?>
                
            </select>
            </td>
        </tr>
          <tr>
                                        <td>Image:</td><td>
                    <img src="../images/userimg/<?php echo $img;?>" width="80" height="80" /> <br />
                <input name="image" value="<?php echo $img;?>" type="file" />
            </td>
                                    </tr>
                             <tr class="bg">
            <td>State:</td>
            <td><select name="state" width="80px;">
                    <?php if ($state=="Active"){ ?>
                        <option value="Active" selected="selected">Active</option> 
                        <option value="Block">Block</option>
                    <? }else{
                    ?>
                        <option value="Active">Active</option> 
                        <option value="Block" selected="selected">Block</option>
                    <?php }?>
                </select></td>
        </tr>
            </tbody>
                  </table>
                          </div>
                                        <?php
                                    }else if($select=="content"){ ?>
                                        <h2>Content Detail</h2>
                      <div class="table">
                  <table  class="listing" cellpadding="0" cellspacing="0">
                      <input name="content_id" value="<?php echo $content_id;?>" type="hidden" />
           <tbody>
            <tr>
            <td>Content ID:</td>
            <td><?php echo $content_id;?></td>
        </tr>
            <tr class="bg">
            <td>Name:</td>
            <td><input name="name" value="<?php echo $name;?>" type="text" /></td>
        </tr>
        <tr>
            <td>Post Time</td>
            <td><?php echo $pt;?></td>
        </tr>
        <tr class="bg">
            <td><label for="st">Start Time</label></td>
            <td><input id="st" name ="st" type="text" size="25" readonly="readonly" value="<?php echo $st;?>" /><a href="javascript:NewCal('st','yyyymmdd')"><img src="../images/cal.gif" width="20" height="20" border="1" alt="Pick a date" /></a></td>
        </tr>
        <tr>
            <td><label for="et">End Time</label></td>
            <td><input id="et" name ="et" type="text" size="25" readonly="readonly" value="<?php echo $et;?>" /><a href="javascript:NewCal('et','yyyymmdd')"><img src="../images/cal.gif" width="20" height="20" border="1" alt="Pick a date" /></a></td>
        </tr>
        <tr class="bg">
            <td>Category:</td>
            <td><select name="category">
                                <?php if($category=="Promotion"){
                                                echo "<option value ='$category' selected>".$category."</option>";
                                                echo "<option value ='Share'>Share</option>";
                                                echo "<option value ='Others'>Others</option>";
                                            }else if($category=="Share"){
                                                echo "<option value ='$category' selected>".$category."</option>";
                                                echo "<option value ='Promotion'>Promotion</option>";
                                                echo "<option value ='Others'>Others</option>";
                                            }else{
                                                echo "<option value ='$category' selected>".$category."</option>";
                                                echo "<option value ='Share'>Share</option>";
                                                echo "<option value ='Promotion'>Promotion</option>";
                                            }?>
                </select></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><textarea rows ="5" cols="30" name ="description" value="<?php echo $desc;?>"><?php echo $desc;?></textarea></td>
                 </tr> 
        <tr class="bg">
            <td>Image:</td>
            <td>
                <?php if($img!=null){ ?>
                    <img src="../images/content/<?php echo $img;?>" width="80" height="80" /> <br />
                <?php }
?>
                <input name="image" value="<?php echo $img;?>" type="file" />
            </td>
        </tr>
               <tr>
            <td>Remark:</td>
            <td><textarea rows ="5" cols="30" name ="remarks" value="<?php echo $remark;?>" ><?php echo $remark;?></textarea></td>
        </tr>
            </tbody>
                  </table>
                          </div>
            <?php
                                    }else if($select=="category"){ ?>
                                      <h2>Category Detail</h2>
                      <div class="table">
                  <table  class="listing" cellpadding="0" cellspacing="0">
           <tbody>
           <tr>
            <td>ID:</td>
            <td><input name="cat_id" value="<?php echo $catid;?>" type="hidden" /><?php echo $catid;?></td>
            </tr>
            <tr>
            <td  class="bg">Name:</td>
            <td><input name="name" value="<?php echo $name;?>" type="text" /></td>
            </tr>
            </tbody>
                  </table>
                          </div>  
                                    <?}else if($select=="slider"){ ?> 
                                              <h2>Slider Detail</h2>
                      <div class="table">
                  <table  class="listing" cellpadding="0" cellspacing="0">
           <tbody>
           <tr class="bg">
            <td>ID:</td>
            <td><input name="slider_id" value="<?php echo $slider_id;?>" type="hidden" /><?php echo $slider_id;?></td>
            </tr>
            <tr>
            <td>Title:</td>
            <td><input name="title" value="<?php echo $title;?>" type="text" /></td>
            </tr>
            <tr class="bg">
            <td>Type:</td>
            <td>
                <select name="type">
                <?php 
                if($type=="nonlink"){
                    echo "<option  value ='$type' selected>".$type."<option>";
                    echo "<option  value ='Link'>Link<option>";
                }else if($type=="Link"){
                    echo "<option value ='nonlink'>nonink<option>";
                    echo "<option  value ='$type' selected>".$type."<option>";
                }
                ?>
                    </select></td>
            </tr>
            <tr>
            <td>Create Time:</td>
            <td><?php echo $c_t;?></td>
            </tr>
            <tr class="bg">
            <td>Image:</td>
            <td>
                <?php if($image!=null){ ?>
                    <img src="../images/index/<?php echo $image;?>" width="120" height="80" /> <br />
                <?php }
?>
                <input name="image" value="<?php echo $image;?>" type="file" /></td>
            </tr>
            <tr>
            <td>Link ID:</td>
            <td>
            <select name="link_id">
            <?php 
            $qy="SELECT content_id FROM content";
            $result= mysqli_query($link, $qy) or die(mysqli_error($link));
            while($row=mysqli_fetch_array($result)){
                if($row['content_id']==$link_id){
                  echo "<option selected='selected'>".$row['content_id']."</option>"; 
                }else{
                  echo "<option>".$row['content_id']."</option>";   
                } 
            }
            if ($link_id==0){
              echo "<option selected='selected'>".$link_id."</option>";  
            }
            ?>
            </select></td>
            </tr>
            </tbody>
                  </table>
                          </div>
                                              <?php }else if($select=="tc"){?>
                          <h2>T&amp;C Detail</h2>
                      <div class="table">
                  <table  class="listing" cellpadding="0" cellspacing="0">
           <tbody>
           <tr class="bg">
            <td>ID:</td>
            <td><?php echo $id;?></td>
            </tr>
               <tr>
                   <td>Description:</td>
                   <input type="hidden" name="tc_id" value="<?php echo $id?>" />
                   <td><textarea name="desc"  rows ="10" cols="40"><?php echo $des; ?></textarea></td>
               </tr>
            </tbody>
                  </table>
                          </div>
                                              
                                              
                                      
                                    <?php }
                                    if($_SESSION['role']==1){ ?>
                                         <input style="position: relative; left: 400px;" type="submit"  value="Change" />
                                    <?php }
                                    ?>
                                    <input style="position: relative; left: 420px;" type="button" value="Back" onClick="history.go(-1);return true;" />
                              </form>
                                    
			</div>
		</div>
		 <div id="right-column">
	  </div>
	</div>
	<div id="footer"></div>
</div>
</body>
</html>
<?php }?>