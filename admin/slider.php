<?php
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
    include 'dbFunctions.php';
    require_once('paginator.class.php');
    function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
$queryNum = "SELECT COUNT(*) FROM slide_show";
$results = mysqli_query($link, $queryNum) or die(mysqli_error($link));
$num_rows=mysqli_fetch_row($results);
$pages = new Paginator;  
$pages->items_total = $num_rows[0];  
$pages->mid_range = 9;  
$pages->paginate();
if($num_rows[0]==0){
$query = "SELECT * FROM slide_show  ORDER BY create_time DESC";    
}else{
    $query = "SELECT * FROM slide_show  ORDER BY create_time DESC $pages->limit ";
}
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$msg=null;
if(isset($_POST['title'])){
       $name=$_POST['title'];
   $type=$_POST['type'];
   if($type=="Link"){
       $link_id=$_POST['link_id'];
   }else{
       $link_id=null;
   }
   $currentdate=date('Y-m-d H:i', time());
   $target_path = "../images/index/";
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
       $insertQuery = "INSERT INTO slide_show (title,image,type,create_time,link_id) VALUES ('$name','$photoname','$type','$currentdate','$link_id')";
       $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link));
        if($inserted){
        $msg = "New slide added succeffully.";
        }else{
        $msg = "Slide added failed, please try again!";
        }
}else{
     $msg = "Slide added failed, please try again.(images)";
}

}
}
else{
 $insertQuery = "INSERT INTO slide_show (title,image,type,create_time,link_id) VALUES ('$name','$photoname','$type','$currentdate','$link_id')";
       $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link));
        if($inserted){
        $msg = "New slide added succeffully.";
        }else{
        $msg = "Slide added failed, please try again!";
        }
}

   echo"  <script type='text/javascript'>";
   echo" alert('$msg');";
   echo" history.go(-1);";
echo "  </script> ";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<style media="all" type="text/css">@import "css/all.css";</style>
        <script src="../js/jquery-1.4.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/table.js"></script>
<script src="js/filter.js" type="text/javascript"></script>
<script src="../js/form_validator.js" type="text/javascript"></script>
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
				<h1>Manage Slides</h1>
			</div><br /><br /><br />
                 <h2>Slides</h2>
                 <?php if($num_rows==0){
                     echo "No slides.";
                 }else{
?>             Quick Filter:<input type='text' id='quickfind'/>
                <a id='cleanfilters' href='#'>Clear Filters</a>
                                             <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing table-autosort" id="tdfiltering" cellpadding="0" cellspacing="0">
                                    <thead>
					<tr>
						<th class="first table-sortable:numeric" width="30">ID<img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="table-sortable:asc">Title<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="table-sortable:asc">Image<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="table-sortable:date">Create Time<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
                                                <th class="table-sortable:asc">Type<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="table-sortable:numeric">Link ID<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
                                                <th width="50" class="last">Actions</th>
					</tr>
                                        </thead>
                                             <?php $i=0;
                                                    while($row=mysqli_fetch_array($result)){
                                                        $id=$row['id'];
                          $title=$row['title'];
                          $img=$row['image'];
                          $type=$row['type'];
                          $ct=$row['create_time'];
                          $tt= date('d-m-Y H:i',strtotime($ct));
                          $link_id=$row['link_id'];
                          $i++;
                             if ($i%2==0){
                              echo "<tr>";
                          }else{
                              echo "<tr class='bg'>";
                          }
                      ?>
					
                                            <td class="first style1"><?php echo $id;?></td>
                          <td><?php echo $title;?></td>
                          <td><?php echo $img;?></td>
                          <td><?php echo $tt;?></td>
                          <td><?php echo $type;?></td>
                          <td><?php echo $link_id;?></td>
                          <td class="last">
                          <a href="updateForm.php?slider_id=<?php echo $id;?>"><img src="img/page_edit.png" width="16" height="16" alt="Edit" /></a>
                          <a href="deleteRecord.php?id=<?php echo $id;?>" onclick="return confirm('Are you sure you want to delete this slider?')" ><img src="img/cancel.png" width="16" height="16" alt="Delete" /></a>
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
                 <hr />
                 <br /><br />
                        <h2>Add New Slide</h2>
       <form enctype="multipart/form-data" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" id="form" name="form">
           <table>
             <tr><td>Title:</td>
                 <td><input type ="text" name="title"/><i><span style="font-size: 10px; margin-left:10px;" id='form_title_errorloc' class="error_strings"></span></i></td>
             </tr>
                <tr> 
                <td>Image(width:940px,height:316px): </td>
                <td><input name="image" type="file" /><i><span style="font-size: 10px; margin-left:10px;" id='form_file_errorloc' class="error_strings"></span></i></td>
                </tr>
                <tr>
                 <td>Type:</td>
                 <td><input type="radio" name="type" value="nonlink" checked />Non-Link &nbsp;&nbsp; <input type="radio" name="type" value="Link" />Link To Promotion/Article</td>
             </tr>
               <tr><td>Promotion/Article ID (Optional):</td><td><input type="text" name="link_id" /></td></tr>
               <tr><td></td><td><i><small>Please insert the Promotion/Article ID you want to link to.</small></i></td></tr>
            <tr><td></td><td><input type="submit" value ="Add"/></td>
             </tr>
         </table>
              </form>
                    <hr />
                    <script language="JavaScript" type="text/javascript">
                  var frmvalidator  = new Validator("form");
                    frmvalidator.EnableOnPageErrorDisplay();
                    frmvalidator.EnableMsgsTogether();
                    frmvalidator.addValidation("title","req","Please enter title.");
                    frmvalidator.addValidation("image","req","Please upload an image.");
                </script>
                    <?php echo $msg;?>
                    <br /> 
		 </div>
		 <div id="right-column">

	  </div>
	</div>
	<div id="footer"></div>
</div>
</body>
</html>
<?php } ?>