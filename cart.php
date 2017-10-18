<?php
ob_start();
session_start();
include("shopping_cart.class.php");
$Cart = new Shopping_Cart('shopping_cart');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Shopping Cart</title>
		<script src="js/jquery-1.2.6.pack.js" type="text/javascript"></script>
		<script src="js/jquery.color.js" type="text/javascript"></script>
		<script src="js/cart.js" type="text/javascript"></script>
		<link href="css/cart.css" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<body>
		<div id="container">
			<h1>Shopping Cart</h1>
<?php if ( $Cart->hasItems() ) : ?>
			<form action="cart_action.php" method="get">
				<table id="cart">
					<tr>
						<th>Quantity</th>
						<th>Item</th>
						<th>Unit Price</th>
						<th>Total</th>
						<th>Remove</th>
					</tr>
                                    <tr>
					<?php
                                        $total_q = 0;
						$total_price = 0;
						foreach ( $Cart->getItems() as $order_code=>$quantity ) :
							$total_price += $quantity*$Cart->getItemPrice($order_code);
                                                $total_q +=$quantity;
                                                $name=$Cart->getItemName($order_code);
                                                $up= $Cart->getItemPrice($order_code);
                                                $ep=$Cart->getItemPrice($order_code)*$quantity;
                                                
					?>
						<?php echo $i++%2==0 ? "<tr>" : "<tr class='odd'>"; ?>
							<td class="quantity center"><input type="text" name="quantity[<?php echo $order_code; ?>]" size="3" value="<?php echo $quantity; ?>" tabindex="<?php echo $i; ?>" /></td>
							<td class="item_name"><?php echo $name ; ?></td>
							<td class="unit_price">$<?php echo $up; ?></td>
							<td class="extended_price">$<?php echo round($ep, 2); ?></td>
							<td class="remove center"><input type="checkbox" name="remove[]" value="<?php echo $order_code; ?>" /></td>
						</tr>
					<?php endforeach; ?>
					<tr><td colspan="4"></td><td id="total_price">$<?php echo  number_format((float)$total_price, 2, '.', '');?></td></tr>
				</table>
				<input type="submit" name="update" value="Update cart" />
			</form>
			<?php else: ?>
				<p class="center">You have no items in your cart.</p>
			<?php endif; ?>
		</div>
	</body>
</html>