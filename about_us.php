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
                <?php if(!isset($_SESSION['user_name'])){ ?>
                    <a href="login.php">Login</a>
                <?php }else{ ?>
                    <a href="logOut.php">Logout</a>
            <ul> 
            <li><a href="usercenter.php">Member Center</a></li>
            </ul> 
                <?php } ?>
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
            	
                <div class="section_w590">
                	
                    <h2>About Us</h2>
                    
                    <div class="section_w590_content">
                    	<p style ="font-size: 15pt; color: maroon"><b><i>We are here!</i></b></p>
                        <p style ="font-size: 13pt">Nanyang Technological Univerisity, Tamarind Halls, BLK 24-10-38, 38 Nanyang Crescent, Singapore 636866</p>
                       <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.sg/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=9+Woodlands+Ave+9,+738964&amp;aq=&amp;sll=1.443841,103.783722&amp;sspn=0.014973,0.022724&amp;ie=UTF8&amp;hq=&amp;hnear=9+Woodlands+Avenue+9,+738964&amp;t=m&amp;ll=1.453816,103.786039&amp;spn=0.030031,0.036564&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com.sg/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=9+Woodlands+Ave+9,+738964&amp;aq=&amp;sll=1.443841,103.783722&amp;sspn=0.014973,0.022724&amp;ie=UTF8&amp;hq=&amp;hnear=9+Woodlands+Avenue+9,+738964&amp;t=m&amp;ll=1.453816,103.786039&amp;spn=0.030031,0.036564&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left">View Larger Map</a></small>                       
					   <p style ="font-size: 15pt; color: maroon"><b><i>Contact us!</i></b></p>
                        <p style ="font-size: 13pt"> +65 83891612</p>
                        <p style ="font-size: 15pt; color: maroon"><b><i>Like us!</i></b></p>
                    </div>
                    
                </div> 
                
                <div class="cleaner_h50"></div>
                
                <div class="section_w590">
                	
                    
                    
              <div class="section_w590_content">
                    
                    
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