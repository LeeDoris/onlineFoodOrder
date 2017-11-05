<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IFood</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="js/form_validator.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="datetimepicker.js"></script>
</head>
<body>

<div id="container_wrapper_outter">
<div id="container_wrapper_inner">

<div id="container">
	 
    <div id="menu">
        
        <div id="main_Logo"></div>
    <ul id="nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="promotion.php">News</a></li>
            <li><a href="promotion.php?category=Promotion">Promotion</a></li>
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
            	
                <div class="section_w590" style="width: 800px;">
                	
                    <h2>Register</h2>
                      
        <form enctype="multipart/form-data" method="post" action="doRegister.php" name="rform" id="rform"> 
                    
         <table>
             <tr><td>NRIC(Student ID for RP students):</td>
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
                        <td><input id="dob" name ="dob" type="text" size="25" readonly="readonly"/><a href="javascript:NewCal('dob','yyyymmdd')"><img src="images/cal.gif" width="20" height="20" border="1" alt="Pick a date" /></a><i><span style="font-size: 10px; margin-left:10px;" id='rform_dob_errorloc' class="error_strings"></span></i></td>
             </tr>
             <tr>
                 <td> Phone number:</td>
                 <td><input type ="text" name="phone_number" size="8"/><i><span style="font-size: 10px; margin-left:10px;" id='rform_phone_number_errorloc' class="error_strings"></span></i></td>
             </tr>
             <tr>
                 <td> Address:</td>
                 <td><input type ="text" name="address" size="50"/><i><span style="font-size: 10px; margin-left:10px;" id='rform_address_errorloc' class="error_strings"></span></i></td>
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
              <tr>
                    <td>Photo:</td>
                    <td><input type="file" name ="photo"/><i><span style="font-size: 10px; margin-left:10px;"></span></i></td>
              </tr>
             <tr><td></td><td><input type="submit" value ="Submit" id="button"/></td>
             </tr>
          
         </table>
              </form>
<script language="JavaScript" type="text/javascript">
  var frmvalidator  = new Validator("rform");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("nric","req","Please enter a NRIC.(Student ID for RP students)");
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
    frmvalidator.addValidation("username","minlen=6","Username should be at least 6 characters.");
    frmvalidator.addValidation("username","req","Please enter your user name.");
    frmvalidator.addValidation("password","minlen=8","Password should be at least 8 characters");
    frmvalidator.addValidation("password","req","Please enter your password.");
    frmvalidator.addValidation("confirmpassword","req","Please confir your password.");
    frmvalidator.addValidation("confirmpassword","eqelmnt=password","The confirmed password should be same as password.");
</script>

                    
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