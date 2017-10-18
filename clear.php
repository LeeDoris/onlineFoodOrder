<?php
error_reporting("E_ALL");
include('shopping_cart.class.php');
session_start();
$Cart = new Shopping_Cart('shopping_cart');

$Cart->emptyCart();

$Cart->save();

header('Location: order.php');

?>
