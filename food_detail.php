<?php
session_start();
include 'dbFunctions.php';
$itemid=$_GET['itemid'];
$getItem = "SELECT item.*,category.name FROM item,category WHERE item.item_id LIKE '$itemid' AND category.id=item.item_category";
$resultItem= mysqli_query($link, $getItem) or die(mysqli_error($link));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/table.css" rel="stylesheet" type="text/css" media="screen" />
        <script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
        <title>Food</title>
        <script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto();
  });
</script>
    </head>
    <body>
        <table border="1">
         <?php 
                            while($item=mysqli_fetch_array($resultItem)){
                                $item_id=$item['item_id'];
                                $itemname = $item['item_name'];
                                $itemp = $item['item_price'];
                                if ($item['item_desc']==null){
                                $itemdes = "Null";
                                }else{
                                $itemdes = $item['item_desc'];
                                }
                                $itemcate = $item['name'];
                                $product=$item['product_id'];
                                $image=$item['item_image']
                                ?>
            <tr><td>
                    <?php if($image!=null){ ?>
                           <a href='images/food/<?php echo $image;?>' rel='prettyPhoto' ><img src="images/food/<?php echo $image;?>"  height="150" width="150"/></a>
                        <?php
                    }
?>
                 
                </td></tr>
            <tbody>
        <tr class="odd">
            <td>Item ID:</td>
            <td><?php echo $product;?></td>
        </tr>
            <tr>
            <td>Item Name:</td>
            <td><?php echo $itemname;?></td>
        </tr>
        <tr class="odd">
            <td>Item Category:</td>
            <td><?php echo $itemcate;?></td>
        </tr>
        <tr>
            <td>Item Price:</td>
            <td><?php echo $itemp;?></td>
        </tr>
        <tr class="odd">
            <td>Item Description:</td>
            <td><?php echo $itemdes;?></td>
        </tr>   
                <?php }?>
            </tbody>
    </table>
        <a href="javascript:window.close();">Close</a>
        <?php if(isset($_SESSION['role']) && $_SESSION['role']==1){ ?>
            <a href="admin/updateForm.php?item_id=<?php echo $item_id;?>">Edit</a>
        <? }?>
        </body>
</html>
