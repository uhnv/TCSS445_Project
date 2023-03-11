<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('config.php');
session_start();
if (!isset($_SESSION['customer_id'])) {
    // Redirect to login page if user is not logged in
    header('Location: login.html');
}
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Check if the product is already in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        // If it is, increase the quantity by 1
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        // If it's not, add it to the cart with a quantity of 1
        require_once('config.php');
        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM PRODUCT WHERE product_id='$product_id'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION['cart'][$product_id] = array(
                "name" => $row["product_name"],
                "price" => $row["price"],
                "quantity" => 1
            );
        }

        $conn->close();
    }
}

// Redirect back to the products page
header('Location: product.php');
exit();
?>
