<?php 
include 'dbFunctions.php';
if(isset($_GET['type']) && $_GET['type']!=null){
    $type=$_GET['type'];
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php if($type=="order"){ 
            $query = "SELECT * FROM terms_conditions WHERE type='order' ORDER BY id ASC ";
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
            ?>
            <h2>TERMS OF ONLINE ORDERING SYSTEM</h2>
            <?php while($row=  mysqli_fetch_array($result)){
                echo "<li>".$row['description']."</li>";
                echo "<br>";
            }?> 
        <?php
        }else{
            $query = "SELECT * FROM terms_conditions WHERE type='reservation' ORDER BY id ASC ";
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
            
            ?>
       <h2>TERMS FOR ONLINE RESERVATION</h2>

<h3>In booking a RESERVATION @ The IFood  you agree to the following terms and conditions:</h3>

<?php while($row=  mysqli_fetch_array($result)){
                echo "<li>".$row['description']."</li>";
                echo "<br>";
            }?> 
            <?php     
        }
?>
    </body>
</html>
<?php }else{
    echo "Nothing here.";
}?>