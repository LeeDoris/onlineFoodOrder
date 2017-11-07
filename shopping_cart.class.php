<?php
error_reporting("E_ALL");

class Shopping_Cart
{

    var $cart_name;       // The name of the cart/session variable
    var $items = array(); // The array for storing items in the cart

    /**
     * __construct() - Constructor. This assigns the name of the cart
     *                 to an instance variable and loads the cart from
     *                 session.
     *
     * @param string $name The name of the cart.
     */
    function __construct($name)
    {
        $this->cart_name = $name;
        $this->items = $_SESSION[$this->cart_name];
    }

    /**
     * setItemQuantity() - Set the quantity of an item.
     *
     * @param string $order_code The order code of the item.
     * @param int $quantity The quantity.
     */
    function setItemQuantity($order_code, $quantity)
    {
        $this->items[$order_code] = $quantity;
    }

    /**
     * getItemPrice() - Get the price of an item.
     *
     * @param string $order_code The order code of the item.
     * @return int The price.
     */

    function getItemPrice($order_code)
    {
        $HOST = 'localhost';
        $USERNAME = 'root';
        $PASSWORD = '';
        $DB = 'orderOnline';

        $link = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DB) or die(mysqli_connect_error());
        $getItem = "SELECT item_price FROM item WHERE item_id LIKE '$order_code' ";
        $result = mysqli_query($link, $getItem) or die(mysqli_error($link));
        $row = mysqli_fetch_array($result);
        if ($row == null) {
            return "No item";
        } else {
            $price = $row['item_price'];
            return number_format((float)$price, 2, '.', '');
        }
    }

    function emptyCart()
    {
        $this->items = array(); // this will empty the array by redefining it
    }

    /**
     * getItemName() - Get the name of an item.
     *
     * @param string $order_code The order code of the item.
     */
    function getItemName($order_code)
    {
        // This is where the code that retrieves product names
        // goes. We'll just return something generic for this tutorial.
        $HOST = 'localhost';
        $USERNAME = 'root';
        $PASSWORD = '';
        $DB = 'orderOnline';

        $link = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DB) or die(mysqli_connect_error());
        $getItem = "SELECT item_name FROM item WHERE item_id LIKE '$order_code' ";
        $result = mysqli_query($link, $getItem) or die(mysqli_error($link));
        $row = mysqli_fetch_array($result);
        if ($row == null) {
            return "No item";
        } else {
            return (string)$row['item_name'];
        }
    }


    /**
     * getItems() - Get all items.
     *
     * @return array The items.
     */
    function getItems()
    {
        return $this->items;
    }

    /**
     * hasItems() - Checks to see if there are items in the cart.
     *
     * @return bool True if there are items.
     */
    function hasItems()
    {
        return (bool)$this->items;
    }

    /**
     * getItemQuantity() - Get the quantity of an item in the cart.
     *
     * @param string $order_code The order code.
     * @return int The quantity.
     */
    function getItemQuantity($order_code)
    {
        return (float)$this->items[$order_code];
    }

    /**
     * clean() - Cleanup the cart contents. If any items have a
     *           quantity less than one, remove them.
     */
    function clean()
    {
        foreach ($this->items as $order_code => $quantity) {
            if ($quantity < 1)
                unset($this->items[$order_code]);
        }
    }

    /**
     * save() - Saves the cart to a session variable.
     */
    function save()
    {
        $this->clean();
        $_SESSION[$this->cart_name] = $this->items;
    }
}

?>
