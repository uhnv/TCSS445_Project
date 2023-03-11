<?php
require_once('config.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once('config.php');

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Get the customer ID from the session
    $customer_id = $_SESSION['customer_id'];

    // Check if the cart is not empty
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        // Connect to the database
        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);

        }
        // Get the incremented order ID
        $incremented_order_id = "SELECT MAX(Order_ID)+1 FROM ORDER_ITEMS";
        $result = $conn->query($incremented_order_id);
        $row = $result->fetch_row();
        $order_id = $row[0];

        // Create the order number with the format ORD+num
        $order_number = "ORD" . str_pad($order_id - 1, STR_PAD_LEFT);

        // Insert the order into the orders table
        $total_price = 0;
        $line_item_id = 1;

        foreach ($_SESSION['cart'] as $product_id => $item) {
            $quantity = $item['quantity'];
            $sql = "SELECT * FROM PRODUCT WHERE Product_id='$product_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $price = $row['Price'];
                    $subtotal = $price * $quantity;
                    $total_price += $subtotal;

                    $sql = "INSERT INTO ORDER_ITEMS (Order_ID, Line_Item_ID, Product_ID, Quantity) VALUES ($order_id, $line_item_id, $product_id, $quantity)";
                    $conn->query($sql);

                    $line_item_id++;
                }
            }
        }

// Insert the order into the orders table with order number
$sql = "INSERT INTO ORDERS (Cust_ID, Total_Price, Order_Number) VALUES ('$customer_id', '$total_price', '$order_number')";
$conn->query($sql);

// Close the database connection
$conn->close();

// Clear the cart
unset($_SESSION['cart']);

// Redirect to the Orders tab
header('Location: cart.php');
exit;
    } else {
        // The cart is empty
        echo "<p>Your cart is empty.</p>";
    }
} else {
    // The user is not logged in
    echo "<p>You need to log in to check out.</p>";
}

?>