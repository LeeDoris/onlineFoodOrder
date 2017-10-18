<?php

include('shopping_cart.class.php');
session_start();
$Cart = new Shopping_Cart('shopping_cart');

if ( !empty($_GET['order_code']) && !empty($_GET['quantity']) ) {
	$quantity = $Cart->getItemQuantity($_GET['order_code'])+$_GET['quantity'];
	$Cart->setItemQuantity($_GET['order_code'], $quantity);
}

if ( !empty($_GET['quantity']) ) {
	foreach ( $_GET['quantity'] as $order_code=>$quantity ) {
		$Cart->setItemQuantity($order_code, $quantity);
	}
}

if ( !empty($_GET['remove']) ) {
	foreach ( $_GET['remove'] as $order_code ) {
		$Cart->setItemQuantity($order_code, 0);
	}
}

$Cart->save();

header('Location: cart.php');

?>