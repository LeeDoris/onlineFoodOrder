<?php
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
include 'dbFunctions.php';
require_once('paginator.class.php');
$query = "SELECT * FROM user_group ";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

$queryNum = "SELECT COUNT(*) FROM user";
$results = mysqli_query($link, $queryNum) or die(mysqli_error($link));
$num_rows=mysqli_fetch_row($results);
$pages = new Paginator;  
$pages->items_total = $num_rows[0];  
$pages->mid_range = 9;  
$pages->paginate();  
if($num_rows[0]!=0){
    $queryNum = "SELECT * FROM user  ORDER BY role ASC $pages->limit ";
}else{
     $queryNum = "SELECT * FROM user  ORDER BY role ASC ";
}
$resultR = mysqli_query($link, $queryNum) or die(mysqli_error($link));

if( (isset($_GET['state']) &&isset($_GET['user_id'])) &&($_GET['state']!=null && $_GET['user_id']!=null)){
    $s=$_GET['state'];
    $user_id=$_GET['user_id'];
    $query = "UPDATE user SET state='$s' WHERE user_id = '$user_id'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if($result){
    echo"  <script type='text/javascript'>";
    echo" alert('Update successfully!');";
    echo" history.go(-1);";
    echo "  </script> ";
    }else{
    echo"  <script type='text/javascript'>";
    echo" alert('Update failed!');";
    echo" history.go(-1);";
    echo "  </script> "; 
    }
}

if(isset($_POST['nric'])){
    $username = $_POST['username']; 
    $nric=$_POST['nric'];
    $query = "SELECT user_name,nric FROM user WHERE user_name = '$username' OR nric='$nric'";
    $result= mysqli_query($link, $query) or die(mysqli_error($link));
    $msg=null;
    $rownum=mysqli_fetch_row($result);
    if ($rownum != null){
        $msg = "Username or NRIC already exist! Please <a href='register.php'>Try Again</a>"; 
    }else{
        $pic="defaultpic.jpg";
        $address=$_POST['address'];
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $email=$_POST['email'];
        $dob=$_POST['dob'];
        $phone_number=$_POST['phone_number'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $role=$_POST['role'];
           $insertQuery = "INSERT INTO user(nric,firstname,lastname,email,dateofbirth,address,user_name,phone_number,password,role,user_img,state) VALUES ('$nric','$firstname','$lastname','$email','$dob','$address','$username','$phone_number',SHA1('$password'),'$role','$pic','Active')";
           $inserted = mysqli_query($link, $insertQuery) or die(mysqli_error($link)); 
if($inserted){
    $msg="New user added successfully.";
}else{
    $msg ="Add failed";
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
<script language="javascript" type="text/javascript" src="../datetimepicker.js"></script>
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
			<li><span><span><a href="contents.php">Contents</a></span></span></li>
			<li class="active"><span><span>Users</span></span></li>
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
				<li><a href="users.php">User List</a></li>
			</ul>
		</div>
		<div id="center-column">
			<div class="top-bar">
				<h1>Manage User</h1>
			</div><br /><br />
                        
                            <h2>User List</h2><br />
                            <?php if ($num_rows[0]==0){
                                echo "<h4>No User</h4>";
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
						<th class="first table-sortable:numeric" width="50">UserID<img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="table-sortable:asc">Full Name<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
						<th width="80" class="table-sortable:asc">Account Name<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
						<th width="80" class="table-sortable:numeric">Contact Number<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
						<th class="table-sortable:asc">Email<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
                                                <th class="table-sortable:asc">Account State<span></span><img src="../images/arrow.png" alt="Sortable"/></th>
                                                <th width="80" class="last">Actions</th>
					</tr>
                                        </thead>
                                             <?php $i=0;
                                                    while($rownumR=mysqli_fetch_array($resultR)){
                          $user_id=$rownumR['user_id'];
                          $firstname=$rownumR['firstname'];
                          $lastname=$rownumR['lastname'];
                          $fullname=$firstname."&nbsp".$lastname;
                          $username=$rownumR['user_name'];
                          $contact=$rownumR['phone_number'];
                          $email=$rownumR['email'];
                          $state=$rownumR['state'];
                          $i++;
                             if ($i%2==0){
                              echo "<tr>";
                          }else{
                              echo "<tr class='bg'>";
                          }
                      ?>
					
                                            <td class="first style1"><?php echo $user_id;?></td>
                          <td><?php echo $fullname;?></td>
                          <td><?php echo $username;?></td>
                          <td><?php echo $contact;?></td>
                          <td><?php echo $email;?></td>
                          <td><?php echo $state;?></td>
                          <td class="last"><a href="checkDetails.php?userid=<?php echo $user_id;?>"><img src="img/user.png" width="16" height="16" title="view" /></a>
                          <a href="updateForm.php?user_id=<?php echo $user_id;?>"><img src="img/user_edit.png" width="16" height="16" title="edit" /></a>
                          <?php if($_SESSION['role']==1){ ?>
                               <a href="deleteRecord.php?user_id=<?php echo $user_id;?>" onclick="return confirm('Are you sure you want to delete this user?')" ><img src="img/user_delete.png" width="16" height="16" title="delete" /></a>
                          <?php }?>
                         <?php if($state=="Active"){ 
                              $st="Block";
                              ?>
                              <a href="users.php?user_id=<?php echo $user_id;?>&state=<?php echo $st;?>"><img src="img/cancel.png" width="16" height="16" title="block user" /></a>
                              <?php }else{ 
                                  $st="Active";
                                  ?>
                                  <a href="users.php?user_id=<?php echo $user_id;?>&state=<?php echo $st;?>"><img src="img/accept.png" width="16" height="16" title="active user" /></a>
                             <?php }
                             ?>                         
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
            <h2>Check User</h2>
                 <form action="checkDetails.php?userid=" method="get">
                      User ID:
                  <input name="userid"   type="text"/>
                  <input type="submit" />
                  </form>
            <hr />
            <br />
            <h2>Add User</h2>
            <div>
                  <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="rform" id="rform" >
         <table>
             <tr><td>NRIC:</td>
                 <td><input type ="text" name="nric" /><i><span style="font-size: 10px; margin-left:10px;" id='rform_nric_errorloc' class="error_strings"></span></i></td>
             </tr>
             <tr><td>First Name:</td>
                 <td><input type ="text" name="firstname" /><i><span style="font-size: 10px; margin-left:10px;" id='rform_firstname_errorloc' class="error_strings"></span></i></td>
             </tr>
             <tr>
                 <td>Last Name:</td>
                 <td><input type ="text" name="lastname"/><i><span style="font-size: 10px; margin-left:10px;" id='rform_lastname_errorloc' class="error_strings"></span></i></td>
             </tr>
             <tr>
                 <td>Email:</td>
                 <td><input type="text" name="email"/><i><span style="font-size: 10px; margin-left:10px;" id='rform_email_errorloc' class="error_strings"></span></i></td>
             </tr>
             <tr>
             <td><label for="dob">Date of Birth</label></td>
                        <td><input id="dob" name ="dob" type="text" size="25" readonly="readonly"/><a href="javascript:NewCal('dob','yyyymmdd')"><img src="../images/cal.gif" width="20" height="20" border="1" alt="Pick a date" /></a><i><span style="font-size: 10px; margin-left:10px;" id='rform_dob_errorloc' class="error_strings"></span></i></td>
             </tr>
             <tr>
                 <td> Phone number:</td>
                 <td><input type ="text" name="phone_number" size="8"/><i><span style="font-size: 10px; margin-left:10px;" id='rform_phone_number_errorloc' class="error_strings"></span></i></td>
             </tr>
             <tr>
                 <td> Address:</td>
                 <td><input type ="text" name="address" size="50"/><i><span style="font-size: 10px; margin-left:10px;" id='rform_address_errorloc' class="error_strings"></span></i></td>
             </tr>
             <tr>
                 <td> Role:</td>
                 <td><select name="role">
                     <?php while($row=  mysqli_fetch_array($result)){ ?>
                      <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>   
                     <?php }?>    
                     </select>
                 </td>
             </tr>
              </table>
              <hr/>
         <table>
             <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" /><i><span style="font-size: 10px; margin-left:10px;" id='rform_username_errorloc' class="error_strings"></span></i></td>
                </tr>
             <tr>
                    <td>Password:</td>
                    <td><input type="password" name ="password"/><i><span style="font-size: 10px; margin-left:10px;" id='rform_password_errorloc' class="error_strings"></span></i></td>
                </tr>
             <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name ="confirmpassword"/><i><span style="font-size: 10px; margin-left:10px;" id='rform_confirmpassword_errorloc' class="error_strings"></span></i></td>
              </tr>
             <tr><td></td><td><input type="submit" value ="Submit" id="button"/></td>
             </tr>
          
         </table>
                  </form>
                </div>
<script language="JavaScript" type="text/javascript">
  var frmvalidator  = new Validator("rform");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("nric","req","Please enter a ID.");
    frmvalidator.addValidation("nric","num","Please enter a valid id.");
    frmvalidator.addValidation("firstname","req","Please enter your First Name");
    frmvalidator.addValidation("firstname","alpha","Please enter valid First Name");
    frmvalidator.addValidation("lastname","req","Please enter your Last Name");
    frmvalidator.addValidation("lastname","alpha","Please enter valid Last Name");
    frmvalidator.addValidation("email","maxlen=50");
    frmvalidator.addValidation("email","req","Please enter your Email.");
    frmvalidator.addValidation("email","email","Please enter a valid Email address.");
    frmvalidator.addValidation("dob","req","Please enter your date of birth.");
    frmvalidator.addValidation("phone_number","req","Please enter your phone number.");
    frmvalidator.addValidation("phone_number","num","Please enter a valid number.");
    frmvalidator.addValidation("phone_number","minlen=8","Please enter a valid number.");
    frmvalidator.addValidation("address","req","Please enter your address.");
    frmvalidator.addValidation("username","minlen=6","Please enter a valid username.");
    frmvalidator.addValidation("username","req","Please enter your user name.");
    frmvalidator.addValidation("password","minlen=8","Please enter a valid password.");
    frmvalidator.addValidation("password","req","Please enter your password.");
    frmvalidator.addValidation("confirmpassword","req","Please confir your password.");
    frmvalidator.addValidation("confirmpassword","eqelmnt=password","The confirmed password should be same as password.");
</script>
		</div>
		<div id="right-column">
			<strong class="h">INFO</strong>
			<div class="box"> </div>
	  </div>
	</div>
	<div id="footer"></div>
</div>
</body>
</html>
<?php  }?>