<?php
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
include 'dbFunctions.php';
require_once('paginator.class.php');
$queryNum = "SELECT COUNT(*) FROM item";
$results = mysqli_query($link, $queryNum) or die(mysqli_error($link));
$num_rows=mysqli_fetch_row($results);
$pages = new Paginator;  
$pages->items_total = $num_rows[0];  
$pages->mid_range = 9;  
$pages->paginate();  
$queryNum = "SELECT item.*,category.name FROM item,category WHERE item.item_category=category.id  ORDER BY item_category ASC $pages->limit ";
$resultR = mysqli_query($link, $queryNum) or die(mysqli_error($link));

    function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
$qd = "SELECT * FROM category";
$msg=null;
$getCategory= mysqli_query($link, $qd) or die(mysqli_error($link));
if(isset($_POST['item_name'])){
       $name=$_POST['item_name'];
   $price=$_POST['item_price'];
   $category=$_POST['category'];
   $product_id = $_POST['product_id'];
   $desc=$_POST['description'];
   $target_path = "../images/food/";
   $photoname = basename($_FILES['image']['name']);
   $image=$_FILES['image']['name'];
   if ($photoname!=null){
  $filename = stripslashes($_FILES['image']['name']);
        $extension = getExtension($filename);
  $extension = strtolower($extension);
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
$msg= " Unknown Image extension ";
  }else{
          $target_path = $target_path.basename( $_FILES['image']['name']); 
   if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)){
       if($category=="Other"){
           $newcatname = $_POST['newcategory'];
           $insert = "INSERT INTO category (name) VALUES ('$newcatname')";
           $insertedCat = mysqli_query($link, $insert) or die(mysqli_error($link));
           $insertQuery = "INSERT INTO item(item_name,item_price,item_category,item_desc,product_id,item_image) VALUES ('$name','$price','$newcatname','$desc','$product_id','$photoname')";
       $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link));
       }else{
           $insertQuery = "INSERT INTO item(item_name,item_price,item_category,item_desc,product_id,item_image) VALUES ('$name','$price','$category','$desc','$product_id','$photoname')";
       $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link));
       }
       
        if($inserted){
        $msg = "New item added succeffully.";
        }else{
        $msg = "Item added failed, please try again!";
        }
}else{
     $msg = "Item added failed, please try again.(images)";
}

   

}}else{
           if($category=="Other"){
           $newcatname = $_POST['newcategory'];
           $insert = "INSERT INTO category (name) VALUES ('$newcatname')";
           $insertedCat = mysqli_query($link, $insert) or die(mysqli_error($link));
           $rtv = "SELECT id FROM category WHERE name='$newcatname'";
           $rtvc = mysqli_query($link, $rtv) or die(mysqli_error($link));
           $newcid=mysqli_fetch_array($rtvc);
           $ncid=$newcid['id'];
           $insertQuery = "INSERT INTO item(item_name,item_price,item_category,item_desc,product_id,item_image) VALUES ('$name','$price','$ncid','$desc','$product_id','$photoname')";
       $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link));
       }else{
           $insertQuery = "INSERT INTO item(item_name,item_price,item_category,item_desc,product_id,item_image) VALUES ('$name','$price','$category','$desc','$product_id','$photoname')";
       $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link));
       }
        if($inserted){
        $msg = "New item added succeffully.";
        }else{
        $msg = "Item added failed, please try again!";
        }
}
   echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
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
       <script src="../js/jquery-1.4.1.min.js" type="text/javascript"></script>
       <script src="../js/form_validator.js" type="text/javascript"></script>
<script type="text/javascript" src="js/table.js"></script>
<script src="js/filter.js" type="text/javascript"></script>
   <script type="text/javascript">
            $(document).ready(function(){

                // Initialise picn table filtering Plugin hrer

                var options = {

                    additionalFilterTriggers: [$('#quickfind')],

                    clearFiltersControls: [$('#cleanfilters')],

                    matchingRow: function(state, tr, textTokens) {

                        if (!state || !state.id) {

                            return true;

                        }

                        var child = tr.children('td:eq(2)');

                        if (!child) return true;

                        var val = child.text();

                        switch (state.id) {

                            default:

                                return true;
                        }

                    }

                };

                var $category = $('#category'), $newcategory = $('#newcategory');
$category.change(function () {
    if ($category.val() == 'Other') {
        $newcategory.removeAttr('disabled');
         $("#hint").show("fast");
    } else {
        $newcategory.attr('disabled', 'disabled').val('');
        $("#hint").hide("fast");
    }
}).trigger('change'); 
$("#hint").hide();
                $("#tdfiltering").tableFilter(options);

            }); 

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
			<li class="active"><span><span>Contents</span></span></li>
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
				<li><a href="contents.php">Mange Article/Promotions</a></li>
				<li><a href="menu.php">Mange Menu</a></li>
                                <li><a href="category.php">Mange Category</a></li>
                                <li><a href="terms.php">Mange Terms&amp;Condition</a></li>
				<li><a href="slider.php">Image Slider(Index)</a></li>
			</ul>
		</div>
		<div id="center-column">
			<div class="top-bar">
				<h1>Manage Menu</h1>
			</div><br /><br />
                        
                            <h2>Item List</h2><br />
                            <?php if ($num_rows[0]==0){
                                echo "<h4>Empty Menu</h4>";
                            } else{
?>                       
                            Quick Filter:<input type='text' id='quickfind'/>
                <a id='cleanfilters' href='#'>Clear Filters</a>
                            <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing table-autosort" id="tdfiltering" cellpadding="0" cellspacing="0">
                                    <thead>
					<tr>
						<th class="first table-sortable:numeric" width="70">ProductID<img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="table-sortable:asc">Item Name<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="table-sortable:asc">Category<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
						<th width="50" class="table-sortable:numeric">Price<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="table-sortable:asc">Description<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
                                                <th class="table-sortable:asc">Image<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
                                                <th width="50" class="last">Actions</th>
					</tr>
                                        </thead>
                                             <?php $i=0;
                                                    while($rownumR=mysqli_fetch_array($resultR)){
                                                        $item_id=$rownumR['item_id'];
                          $product_id=$rownumR['product_id'];
                          $name=$rownumR['item_name'];
                          $category=$rownumR['item_category'];
                          $price=$rownumR['item_price'];
                          $desc=$rownumR['item_desc'];
                          $img=$rownumR['item_image'];
                          $i++;
                             if ($i%2==0){
                              echo "<tr>";
                          }else{
                              echo "<tr class='bg'>";
                          }
                      ?>
					
                                            <td class="first style1"><?php echo $product_id;?></td>
                          <td><?php echo $name;?></td>
                          <?php $q="SELECT name FROM category WHERE id=$category"; 
                          $getCat_id= mysqli_query($link, $q) or die(mysqli_error($link));
                          $row=  mysqli_fetch_array($getCat_id);
                          ?>
                          <td><?php echo $row['name'];?></td>
                          <td><?php echo $price;?></td>
                          <td><?php echo $desc;?></td>
                          <td>
                          <?php if ($img!=null){ ?>
                            <img src="../images/food/<?php echo $img;?>" width="40" height="40" />   
                          <?php }else{
                              echo $img;
                          }?>
                          
                          </td>
                          <td class="last">
                          <a href="updateForm.php?item_id=<?php echo $item_id;?>"><img src="img/page_edit.png" width="16" height="16" title="Edit" /></a>
                          <a href="deleteRecord.php?item_id=<?php echo $item_id;?> " onclick="return confirm('Are you sure you want to delete this item?')" ><img src="img/cancel.png" width="16" height="16" title="Delete" /></a>
                          </td>
                     
					
				<?php echo "</tr>"; }?>
				</table>
                                <?php }?>
				<div class="select">
					<strong>Other Pages: </strong>
					<?php echo $pages->display_jump_menu();?> 
                                        <strong>Items/Page: </strong>
                                        <?php echo $pages->display_items_per_page();?> 
                                </div>
			</div>
                <br /><br />
                <h2>Add New item</h2>
       <form enctype="multipart/form-data" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form" id="form">
         <table>
             <tr>
                 <td>Food ID:</td>
                 <td><input type ="text" name="product_id"/><i><span style="font-size: 10px; margin-left:10px;" id='form_product_id_errorloc' class="error_strings"></span></i></td>
             </tr>
             <tr><td>Name:</td>
                 <td><input type ="text" name="item_name"/><i><span style="font-size: 10px; margin-left:10px;" id='form_item_name_errorloc' class="error_strings"></span></i></td>
             </tr>
             <tr>
                 <td>Price:</td>
                 <td><input type="text" name="item_price" /><i><span style="font-size: 10px; margin-left:10px;" id='form_item_price_errorloc' class="error_strings"></span></i></td>
             </tr>
             <tr>
                <td>Category: </td>
                <td><select name="category" id="category">
                <?php
                while ($rows=mysqli_fetch_array($getCategory)){
                    $cat_id=$rows['id'];
                    ?>
                    <option value="<?php echo $cat_id;?>" ><?php echo $rows['name'];?></option>
                <?php
                    }
                ?><option>Other</option>
                </select><input type="text" name="newcategory" class="text" id="newcategory" /><span id="hint">(Please enter new category if you choose Other)</span><i><span style="font-size: 10px; margin-left:10px;" id='rform_category_errorloc' class="error_strings"></span></i></td>
                </tr>
                <tr> 
                <td>Image: </td>
                <td><input name="image" type="file" /></td>
                </tr>
                <tr>
                 <td>Description:</td>
                 <td><textarea rows ="5" cols="30" name ="description"></textarea></td>
             </tr>
            <tr><td></td><td><input type="submit" value ="Add"/></td>
             </tr>
         </table>
              </form>
                    <hr />
                    <script language="JavaScript" type="text/javascript">
  var frmvalidator  = new Validator("form");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("product_id","req","Please enter product ID.");
    frmvalidator.addValidation("item_name","req","Please enter item name.");
    frmvalidator.addValidation("item_price","req","Please enter item price.");
    frmvalidator.addValidation("category","req","Please enter item category.");
    frmvalidator.addValidation("product_id","num","Please enter a valid product ID.");
    frmvalidator.addValidation("item_price","num","Please enter a valid price.");
</script>
                    <br /> <br />
		</div>
		 <div id="right-column">

	  </div>
	</div>
	<div id="footer"></div>
</div>
</body>
</html>
<?php }?>