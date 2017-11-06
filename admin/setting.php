<?php
session_start();
if ($_SESSION['role']==3){
    header('Location: no_permission.php');
}else if(!isset($_SESSION['role'])){
    header('Location:login.php');
}else{
include 'dbFunctions.php';
$getSetting = "SELECT * FROM setting";
$result= mysqli_query($link, $getSetting) or die(mysqli_error($link));
while($row=  mysqli_fetch_array($result)){
    if($row['name']=="operationtime"){
        $op_id=$row['id'];
        $operation_s=date('H:i',strtotime($row['start_time']));
        $operation_e=date('H:i',strtotime($row['end_time']));
    }else if($row['name']=="order_cutoff"){
        $o_id=$row['id'];
        $order_s=date('H:i',strtotime($row['start_time']));
        $order_e=date('H:i',strtotime($row['end_time']));
    }else if($row['name']=="no_reservation"){
        $r_id=$row['id'];
        $reservation_s=date('H:i',strtotime($row['start_time']));
        $reservation_e=date('H:i',strtotime($row['end_time']));
    }
}
if(isset($_POST['id'])){
  $id=$_POST['id'];
  $st=$_POST['st'];
  $et=$_POST['et'];
  $update = "UPDATE setting SET start_time='$st', end_time='$et' WHERE id=$id";
  $result_update= mysqli_query($link, $update) or die(mysqli_error($link));
  if($result_update){
   echo"  <script type='text/javascript'>";
   echo" alert('Change saved.');";
   echo" history.go(0);";
   echo "  </script> ";
  }else{
   echo"  <script type='text/javascript'>";
   echo" alert('Change failed.');";
   echo" history.go(0);";
   echo "  </script> ";
  } 
  
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<meta  http-equiv="content-type" content="text/html; charset=utf-8" />
	<style media="all" type="text/css">@import "css/all.css";</style>
       <script src="js/jquery-1.4.1.min.js" type="text/javascript"></script>
      <link rel="stylesheet" href="css/jquery-ui-1.8.14.custom.css" type="text/css" />
    <link rel="stylesheet" href="css/jquery.ui.timepicker.css" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
    <script type="text/javascript" src="js/jquery.ui.timepicker.js"></script>
    <script src="../js/form_validator.js" type="text/javascript"></script>
     <script type="text/javascript">
            $(document).ready(function() {
                $('#timepicker_start').timepicker({
                    showLeadingZero: false,
                    onHourShow: tpStartOnHourShowCallback,
                    onMinuteShow: tpStartOnMinuteShowCallback
                });
                $('#timepicker_end').timepicker({
                    showLeadingZero: false,
                    onHourShow: tpEndOnHourShowCallback,
                    onMinuteShow: tpEndOnMinuteShowCallback
                });
                 $('#timepicker_start_order').timepicker({
                    showLeadingZero: false,
                    onHourShow: tpStartOnHourShowCallback,
                    onMinuteShow: tpStartOnMinuteShowCallback
                });
                $('#timepicker_end_order').timepicker({
                    showLeadingZero: false,
                    onHourShow: tpEndOnHourShowCallback,
                    onMinuteShow: tpEndOnMinuteShowCallback
                });
                 $('#timepicker_start_r').timepicker({
                    showLeadingZero: false,
                    onHourShow: tpStartOnHourShowCallback,
                    onMinuteShow: tpStartOnMinuteShowCallback
                });
                $('#timepicker_end_r').timepicker({
                    showLeadingZero: false,
                    onHourShow: tpEndOnHourShowCallback,
                    onMinuteShow: tpEndOnMinuteShowCallback
                });
            });
            function tpStartOnHourShowCallback(hour) {
                var tpEndHour = $('#timepicker_end').timepicker('getHour');
                // all valid if no end time selected
                if ($('#timepicker_end').val() == '') { return true; }
                // Check if proposed hour is prior or equal to selected end time hour
                if (hour <= tpEndHour) { return true; }
                // if hour did not match, it can not be selected
                return false;
            }
            function tpStartOnMinuteShowCallback(hour, minute) {
                var tpEndHour = $('#timepicker_end').timepicker('getHour');
                var tpEndMinute = $('#timepicker_end').timepicker('getMinute');
                // all valid if no end time selected
                if ($('#timepicker_end').val() == '') { return true; }
                // Check if proposed hour is prior to selected end time hour
                if (hour < tpEndHour) { return true; }
                // Check if proposed hour is equal to selected end time hour and minutes is prior
                if ( (hour == tpEndHour) && (minute < tpEndMinute) ) { return true; }
                // if minute did not match, it can not be selected
                return false;
            }
            function tpEndOnHourShowCallback(hour) {
                var tpStartHour = $('#timepicker_start').timepicker('getHour');
                // all valid if no start time selected
                if ($('#timepicker_start').val() == '') { return true; }
                // Check if proposed hour is after or equal to selected start time hour
                if (hour >= tpStartHour) { return true; }
                // if hour did not match, it can not be selected
                return false;
            }
            function tpEndOnMinuteShowCallback(hour, minute) {
                var tpStartHour = $('#timepicker_start').timepicker('getHour');
                var tpStartMinute = $('#timepicker_start').timepicker('getMinute');
                // all valid if no start time selected
                if ($('#timepicker_start').val() == '') { return true; }
                // Check if proposed hour is after selected start time hour
                if (hour > tpStartHour) { return true; }
                // Check if proposed hour is equal to selected start time hour and minutes is after
                if ( (hour == tpStartHour) && (minute > tpStartMinute) ) { return true; }
                // if minute did not match, it can not be selected
                return false;
            }
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
			<li><span><span><a href="users.php">Users</a></span></span></li>
                        <li><span><span><a href="logs.php">Logs</a></span></span></li>
                        <li class="active"><span><span>Settings</span></span></li>
                        <li style="position:relative;left:275px;"><span><span><a href="../logOut.php">Logout</a></span></span></li>
                        <li style="position:relative;left:275px;;"><span><span><a href="../index.php">View Site</a></span></span></li>
		</ul>
	</div>
	<div id="middle">
		<div id="left-column">
			<h3>Control Panel</h3>
			<ul class="nav">
				<li><a href="setting.php">Time Settings</a></li>
                                <li><a href="rules.php">Rule Settings</a></li>
			</ul>
		</div>
		<div id="center-column">
			<div class="top-bar">
				<h1>Settings</h1>
			</div>
                <div>
                    
                        <br /><br />
                        <table>
                       <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form1" id="form1">
                           <input type="hidden" name="id" value="<?php echo $op_id; ?>" />
                        <tr height="100px"> <td><b>Operation Time:</b></td>
                         <td>Start time :
        <input type="text" name="st" style="width: 70px" id="timepicker_start" value="<?php echo $operation_s; ?>" /></td>
        <td>End time :
        <input type="text" name="et" style="width: 70px" id="timepicker_end" value="<?php echo $operation_e;?>" /></td>
        <td><input type="Submit" value="Change" name="submit"/></td>
                        </tr>
                        </form>
                        <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form2" id="form2">
                            <input type="hidden" name="id" value="<?php echo $o_id; ?>" />
                        <tr><td><b>Order Cut-off Time Daily:</b></td>
        <input type="hidden" name="st" style="width: 70px" id="timepicker_start_order" value="<?php echo $order_s; ?>" />
        <td><input type="text" name="et" style="width: 70px" id="timepicker_end_order" value="<?php echo $order_e;?>" /></td>
        <td><input type="Submit" value="Change" name="submit"/></td>
                        </tr>
                        </form>
                        <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="form3" id="form3">
                            <input type="hidden" name="id" value="<?php echo $r_id; ?>" />
                        <tr height="100px"><td><b>No reservation during:</b></td>
                         <td>Start time :
        <input type="text" name="st" style="width: 70px" id="timepicker_start_r" value="<?php echo $reservation_s; ?>" /></td>
        <td>End time :
        <input type="text" name="et" style="width: 70px" id="timepicker_end_r" value="<?php echo $reservation_e;?>" /></td>
        <td><input type="Submit" value="Change" name="submit"/></td>
                        </tr>
                        </form>
                        </table>
                    
                <script language="JavaScript" type="text/javascript">
                  var frmvalidator1  = new Validator("form1");
                    frmvalidator1.EnableOnPageErrorDisplay();
                    frmvalidator1.EnableMsgsTogether();
                    frmvalidator1.addValidation("st","req","Please enter time.");
                    frmvalidator1.addValidation("et","req","Please enter time.");
                 var frmvalidator2  = new Validator("form2");
                    frmvalidator2.EnableOnPageErrorDisplay();
                    frmvalidator2.EnableMsgsTogether();
                    frmvalidator2.addValidation("st","req","Please enter time.");
                    frmvalidator2.addValidation("et","req","Please enter time.");
                 var frmvalidator3  = new Validator("form3");
                    frmvalidator3.EnableOnPageErrorDisplay();
                    frmvalidator3.EnableMsgsTogether();
                    frmvalidator3.addValidation("st","req","Please enter time.");
                    frmvalidator3.addValidation("et","req","Please enter time.");
                </script>
                </div>

		</div>
		<div id="right-column">
			<strong class="h">INFO</strong>
			<div class="box"></div>
	  </div>
	</div>
	<div id="footer"></div>
</div>
</body>
</html>
<?php }?>