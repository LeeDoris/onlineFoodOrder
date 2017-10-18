<?php
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
include 'dbFunctions.php';
require_once('paginator.class.php');
$msg=null;


$queryNum = "SELECT COUNT(*) FROM terms_conditions";
$results = mysqli_query($link, $queryNum) or die(mysqli_error($link));
$num_rows=mysqli_fetch_row($results);
$pages = new Paginator;  
$pages->items_total = $num_rows[0];  
$pages->mid_range = 9;  
$pages->paginate();  
if($num_rows[0]==0){
    $query="SELECT * FROM terms_conditions ORDER BY id DESC";
}else{
    $query="SELECT * FROM terms_conditions ORDER BY id DESC $pages->limit";
}
$result=mysqli_query($link, $query) or die(mysqli_error($link));

if(isset($_POST['description']) && $_POST['description']!=null){
    $type=$_POST['type'];
    $des=$_POST['description'];
    $insertQuery="INSERT INTO terms_conditions (type,description) VALUES('$type','$des')";
    $insert=mysqli_query($link, $insertQuery) or die(mysqli_error($link));
    if($insert){
        $msg="Added success";
    }else{
        $msg="Added fail";
    }
    
   echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(0);";
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
				<h1>Mange Terms&amp;Condition</h1>
			</div><br />
                <h2>Category List</h2><br />
                <?php 
                if($num_rows[0]==0){
                    echo "Nothing here.";
                }else{
                ?>
                <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing table-autosort" cellpadding="0" cellspacing="0">
                                    <thead>
					<tr>
						<th class="first table-sortable:numeric" >ID<img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="table-sortable:asc">Type<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
                                                <th class="table-sortable:asc" width="230px">Description<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
                                                <th class="last">Actions</th>
					</tr>
                                        </thead>
                                             <?php $i=0;
                                                    while($row=mysqli_fetch_array($result)){
                                                        $id=$row['id'];
                                                        $type=$row['type'];
                                                        $desc=$row['description'];
                                                        $i++;
                                             if ($i%2==0){
                                              echo "<tr>";
                                             }else{
                                              echo "<tr class='bg'>";
                                             }?>
                          <td class="first style1"><?php echo $id;?></td>
                          <td><?php echo $type;?></td>
                          <td><?php echo $desc;?></td>
                          <td class="last">
                          <a href="updateForm.php?tc_id=<?php echo $id; ?>"><img src="img/page_edit.png" width="16" height="16" title="Edit" /></a>
                          <a href="deleteRecord.php?tc_id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this t_c?')" ><img src="img/cancel.png" width="16" height="16" title="Delete" /></a>
                          </td>
				<?php echo "</tr>"; }?>
				</table>
                                <div class="select">
					<strong>Other Pages: </strong>
					<?php echo $pages->display_jump_menu();?> 
                                        <strong>Items/Page: </strong>
                                        <?php echo $pages->display_items_per_page();?> 
                                </div>
			</div>
                <?php } ?>
                <br /><br />
                <h2>Add New T&amp;C</h2>
       <form enctype="multipart/form-data" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form" id="form">
         <table>
             <tr><td>Type:</td>
                 <td><input type="radio" name="type" value="order" checked="checked" />Order &nbsp;&nbsp; <input type="radio" name="type" value="reservation" />Reservation</td>
             </tr>
             <tr><td>Description:</td>
                 <td><textarea name="description" rows ="5" cols="30"></textarea><i><span style="font-size: 10px; margin-left:10px;" id='form_description_errorloc' class="error_strings"></span></i></td>
             </tr>
         </table>
                    <hr />
           <input  style="margin-left:190px;" type="submit" value ="Add"/>
              </form>
                    <script language="JavaScript" type="text/javascript">
  var frmvalidator  = new Validator("form");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("description","req","Please enter contents.");
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