<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IFood</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container_wrapper_outter">
            <div style="position:fixed ;right:0px;">
        <ul id="bar">
            <li class="logo">
                <img style="float:left;" alt="" src="images/left.png"/>
            </li>
            <li>
                    <a href="login.php">Login</a> 
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
                	
              <div class="section_w590_content">
               
<form method="post" action="doGetPassword.php">
    <img id="LoginLogo" src="images/Main_logo_w.jpg" alt="IFood" />
    <br /><br /><br />
    <fieldset id="inputs" style="  margin-left: 240px;">
    <input  type="text" placeholder="Username" style="width: 280px;" name="username" autofocus required />
    <br />
    <input  type="text" placeholder="Email" style="width: 280px;" name="email" required />
    </fieldset>
    <fieldset id="actions" >
        <input type="submit" id="button" value="Submit" style="  margin-left: 310px;" />
        <br /><br /><a href="register.php">Register</a>
    </fieldset>
</form>                    
                    
                        
                        <div class="cleaner_h20"></div>
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
