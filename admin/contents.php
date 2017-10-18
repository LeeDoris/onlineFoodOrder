<?php
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
    include 'dbFunctions.php';
    $msg2=null;
    require_once('paginator.class.php');
$queryNum = "SELECT COUNT(*) FROM content";
$results = mysqli_query($link, $queryNum) or die(mysqli_error($link));
$num_rows=mysqli_fetch_row($results);
$pages = new Paginator;  
$pages->items_total = $num_rows[0];  
$pages->mid_range = 9;  
$pages->paginate();  
$queryNum = "SELECT * FROM content  ORDER BY content_id DESC $pages->limit ";
$resultR = mysqli_query($link, $queryNum) or die(mysqli_error($link));

    function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 if(isset($_POST['name'])){
               $name=$_POST['name'];
   $stime=$_POST['start_time'];
   $st=date('Y-m-d', strtotime($stime));
   $etime=$_POST['end_time'];
   $et=date('Y-m-d', strtotime($etime));
   $ptime=$_POST['post_time'];
   $pt=date('Y-m-d', strtotime($ptime));
   $category = $_POST['category'];
   $desc=$_POST['description'];
   $remarks=$_POST['remarks'];
       $target_path = "../images/content/";
   $photoname = basename($_FILES['image']['name']);
   $target_path = $target_path.basename( $_FILES['image']['name']); 
       $image=$_FILES['image']['name'];
   if ($photoname!=null){
  $filename = stripslashes($_FILES['image']['name']);
        $extension = getExtension($filename);
  $extension = strtolower($extension);
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
$msg2= " Unknown Image extension ";
  }else{
   $im=basename($_FILES['image']['name']);
   if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)){
       $insertQuery = "INSERT INTO content(content_name,start_time,end_time,post_time,category,description,image,remarks) VALUES ('$name','$st','$et','$pt','$category','$desc','$photoname','$remarks')";
       $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link));
        if($inserted){
            if($category=="Promotion"){
                 $msg2 = "New Promotion added succeffully.";
            }else{
                $msg2 = "New article added succeffully.";
            }
        }else{
        $msg2 = "Content added failed, please try again!";
        }
}else{
     $msg2 = "Content added failed, please try again.(images)";
}
}}else{
       $insertQuery = "INSERT INTO content(content_name,start_time,end_time,post_time,category,description,image,remarks) VALUES ('$name','$st','$et','$pt','$category','$desc','$photoname','$remarks')";
       $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link));
        if($inserted){
            if($category=="Promotion"){
                 $msg2 = "New Promotion added succeffully.";
            }else{
                $msg2 = "New article added succeffully.";
            }
        }else{
        $msg2 = "Content added failed, please try again!";
        }
}

   echo"  <script type='text/javascript'>";
   echo" alert('$msg2');";
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
				<h1>Manage Contents</h1>
			</div><br /> <br />
                        
                                  
                            <h2>Contents List</h2><br />
                            <?php if ($num_rows[0]==0){
                                echo "<h4>Empty Content</h4>";
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
						<th class="first table-sortable:numeric" width="10">ID<img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="table-sortable:asc">Content Name<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="table-sortable:date">Post Time<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="table-sortable:asc">Category<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
                                                <th class="table-sortable:asc">Description<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
                                                <th width="50" class="last">Actions</th>
					</tr>
                                        </thead>
                                             <?php $i=0;
                                                    while($rownumR=mysqli_fetch_array($resultR)){
                                                        $content_id=$rownumR['content_id'];
                          $name=$rownumR['content_name'];
                          $pt=$rownumR['post_time'];
                          $startt=$rownumR['start_time'];
                          $endt=$rownumR['end_time'];
                          $compare = date('Y-m-d', strtotime("1970-01-01"));
                                 if ($compare!=$startt && $compare!=$endt){
                                     $st=date('d-m-Y', strtotime($startt));
                                     $et=date('d-m-Y', strtotime($endt));
                                 }else{
                                     $st=null;
                                     $et=null;
                                 }
                          $category=$rownumR['category'];
                          $desc=$rownumR['description'];
                          $img=$rownumR['image'];
                          $remark=$rownumR['remarks'];
                         
                          $i++;
                             if ($i%2==0){
                              echo "<tr>";
                          }else{
                              echo "<tr class='bg'>";
                          }
                      ?>
					
                                            <td class="first style1"><?php echo $content_id;?></td>
                          <td><?php echo $name;?></td>
                          <td><?php echo $pt;?></td>
                          <td><?php echo $category;?></td>
                          <td><?php echo $desc;?></td>
                          <td class="last">
                          <a href="updateForm.php?content_id=<?php echo $content_id;?>"><img src="img/page_edit.png" width="16" height="16" alt="Edit" /></a>
                          <a href="deleteRecord.php?content_id=<?php echo $content_id;?>"><img src="img/cancel.png" width="16" height="16" alt="Delete" /></a>
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
                <br />
                        
                        
                 <h2>Add New Promotion/Article</h2>
                 <form enctype="multipart/form-data" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" id="form" name="form">
                 <table>
                 <tr>
                 <td>Title:</td>
                 <td><input type ="text" name="name" /><i><span style="font-size: 10px; margin-left:10px;" id='form_name_errorloc' class="error_strings"></span></i></td>
                 </tr>
                 <tr>
                 <td>Start Time:</td>
                 <td><input id="start_time" name ="start_time" type="text" size="25" readonly="readonly"/><a href="javascript:NewCal('start_time','ddmmyyyy')"><img src="../images/cal.gif" width="20" height="18" border="1" alt="Pick a date" /></a></td>
                 </tr>
                 <tr>
                 <td>End Time:</td>
                 <td><input id="end_time" name ="end_time" type="text" size="25" readonly="readonly"/><a href="javascript:NewCal('end_time','ddmmyyyy')"><img src="../images/cal.gif" width="20" height="18" border="1" alt="Pick a date" /></a></td>
                 </tr>
                 <tr>
                 <td><input type ="hidden" name="post_time" value="<?php echo date('Y-m-d H:i', time());?>" /></td>
                 </tr>
                 <tr>
                 <td>Category:</td>
                 <td><select name="category"><option>Promotion</option><option>Share</option><option>Others</option></select></td>
                 </tr>
                 <tr>
                 <td>Description:</td>
                 <td><textarea rows ="5" cols="30" name ="description"></textarea><i><span style="font-size: 10px; margin-left:10px;" id='form_description_errorloc' class="error_strings"></span></i></td>
                 </tr>
                 <tr> 
                 <td>Image: </td>
                 <td><input name="image" type="file" /></td>
                 </tr>
                 <tr> 
                 <td>Remarks: </td>
                 <td><textarea rows ="5" cols="30" name ="remarks"></textarea></td>
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
                    frmvalidator.addValidation("name","req","Please enter title.");
                    frmvalidator.addValidation("description","req","Please enter content.");
                </script>
		 </div>
		 <div id="right-column">
	  </div>
	</div>
	<div id="footer"></div>
</div>
</body>
</html>
<?php } ?>