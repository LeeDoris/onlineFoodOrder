<?php
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
include 'dbFunctions.php';
$qd = "SELECT * FROM category";
$msg=null;
$getCategory= mysqli_query($link, $qd) or die(mysqli_error($link));
if(isset($_POST['name'])){
    $name=$_POST['name'];
    $insert = "INSERT INTO category (name) VALUES ('$name')";
    $insertedCat = mysqli_query($link, $insert) or die(mysqli_error($link));
    if($insertedCat){
        $msg="New category added sucessfully.";
    }else{
        $msg="New category added failed.";
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
   </head>
<body>
<div id="main">
	<div id="header">
		<a href="dashboard.php" class="logo" style="font-size:xx-large;color:orange;">Reel Room Admin Area</a>
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
				<h1>Manage Category</h1>
			</div><br />
                <h2>Category List</h2><br />
                <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing table-autosort" id="tdfiltering" cellpadding="0" cellspacing="0">
                                    <thead>
					<tr>
						<th class="first table-sortable:numeric" >Category ID<img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="table-sortable:asc">Category Name<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
                                                <th class="last">Actions</th>
					</tr>
                                        </thead>
                                             <?php $i=0;
                                                    while($rowCat=mysqli_fetch_array($getCategory)){
                                                        $category_id=$rowCat['id'];
                          $name=$rowCat['name'];
                          $i++;
                             if ($i%2==0){
                              echo "<tr>";
                          }else{
                              echo "<tr class='bg'>";
                          }
                      ?>
                          <td class="first style1"><?php echo $category_id;?></td>
                          <td><?php echo $name;?></td>
                          <td class="last">
                          <a href="updateForm.php?cat_id=<?php echo $category_id;?>"><img src="img/page_edit.png" width="16" height="16" title="Edit" /></a>
                          <a href="deleteRecord.php?cat_id=<?php echo $category_id;?>"><img src="img/cancel.png" width="16" height="16" title="Delete" /></a>
                          </td>
                     
					
				<?php echo "</tr>"; }?>
				</table>
			</div>
                <br /><br />
                <h2>Add New Category</h2>
       <form enctype="multipart/form-data" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form" id="form">
         <table>
             <tr><td>Name:</td>
                 <td><input type ="text" name="name"/><i><span style="font-size: 10px; margin-left:10px;" id='form_name_errorloc' class="error_strings"></span></i></td>
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
    frmvalidator.addValidation("name","req","Please enter category name.");
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