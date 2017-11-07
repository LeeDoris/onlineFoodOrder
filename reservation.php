<?php
//error_reporting("E_ALL");
if (!isset($_SESSION)){
session_start();
}
if(!isset($_SESSION['user_name'])){
   header('Location: login.php');
 }else{
   
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IFood</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="datetimepicker.js"></script>
<script src="js/form_validator.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
function OpenPopup (c) {
window.open(c,
'window',
'width=500,height=400,scrollbars=yes,status=yes');
}
</script>
</head>
<body>
<div id="container_wrapper_outter">
    <div style="position:fixed ;right:0px;">
        <ul id="bar">
            <li class="logo">
                <img style="float:left;" alt="" src="images/left.png"/>
            </li>
            <li>
                    <a href="logOut.php">Logout</a>
            <ul> 
            <li><a href="usercenter.php">Member Center</a></li>
            </ul> 
            </li>
        </ul>
        <img style="float:left;" alt="" src="images/right.png"/>
    </div>
<div id="container_wrapper_inner">
<div id="container">
    
    <div id="menu">
        
        <div id="main_Logo"></div>
    <ul id="nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="promotion.php">News</a></li>
            <li><a href="menu.php" >Menu</a></li>
            <li><a href="reservation.php">Reservation</a></li>
            <li><a href="order.php" >Order</a></li>
            <li><a href="trackOrder.php">My IFood</a></li>
            <li><a href="about_us.php">About US</a></li>
</ul>
        
 </div>	
    <div id="content_wrapper">
        <div id="content">
        
        	<div id="main_column">
  
                <div class="section_w590"> 
                    <h2>Reservation</h2> 
                    <div class="section_w590_content">
                       
        <form name="reservation" id="reservation" action="doReservation.php" method="post">
            <table>
                       <tr><td><label><b>Date and Time : </b></label></td>
                        <td><input id="date" name ="date" type="text" size="16" readonly="readonly" /><a href="javascript:NewCal('date','DDMMYYYY','true','24')"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date" /></a>
                        <i><span style="font-size: 10px; margin-left:10px;" id='reservation_date_errorloc' class="error_strings"></span></i>
          <br /><small><i> - Use Date Picker to pick your reservation time.</i></small></td>
          </tr>
                       <tr><td><b>Number of people :</b></td><td><input name="people" type="text" /><i><span style="font-size: 10px; margin-left:10px;" id='reservation_people_errorloc' class="error_strings"></span></i></td></tr>
                        <tr><td><b>Comments:</b></td><td><textarea rows ="5" cols="30" name ="comment"></textarea></td></tr>
                        <tr></tr><tr></tr>
                        <tr><td></td><td><input type="checkbox" name="terms" value="Yes" />I <b>agree</b> with this <a href="termsandconditions.php?type=reservation" onclick="OpenPopup(this.href); return false">Terms and Condition</a><i><span style="font-size: 10px; margin-left:10px;" id='reservation_terms_errorloc' class="error_strings"></span></i></td></tr>
          		<tr><td></td><td><input type="submit" id="button" value="RESERVE NOW" style="margin-top: 10px;" /></td></tr>
        </table>
        </form>
                        <script language="JavaScript" type="text/javascript">
  var frmvalidator  = new Validator("reservation");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("date","req","Please specify your reservation time.");
    frmvalidator.addValidation("people","req","Please specify number of people.");
    frmvalidator.addValidation("people","num","Please type valid number.");
    frmvalidator.addValidation("terms","shouldselchk=Yes","Please agree our terms and conditions.");
</script>
                    </div>
                    
                </div> 
            </div> <!-- end of main column -->
       
        <div class="cleaner"></div>
        </div> <!-- end of content -->

        <div class="cleaner"></div>
        <div class="content_bottom"></div>
	</div> <!-- end of content wrapper -->      
    
    <div id="footer">
    	Copyright © 2017 <a href="index.php">IFood</a>
    </div>
     
</div> 
<!-- end of container -->

</div>
</div>

</body>
</html>
<?php } ?>