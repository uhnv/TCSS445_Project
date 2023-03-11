<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
require_once('config.php');

$connection = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

session_start();

if (!isset($_SESSION['customer_id'])) {
    // Redirect to login page if user is not logged in
    header('Location: login.html');
}

$customer_id = $_SESSION['customer_id'];

//TODO; FIX THIS QUERRY, DESIGN
// Retrieve orders from the database
$query = "SELECT ORDERS.Total_Price
          FROM ORDERS
          WHERE ORDERS.Cust_ID = $customer_id;";
      
// $result = mysqli_query($connection, $query);
// Execute the query and get the result
$result = $connection->query($query);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Orders</title>
    </head>
    <body>

        <h1>My Orders</h1>

        <?php if (mysqli_num_rows($result) > 0): ?>

        <table>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['order_id']; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['total_price'] / $row['quantity']; ?></td>
                <td><?php echo $row['total_price']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <?php else: ?>

        <p>No orders found.</p>

        <?php endif; ?>

        <a href="index.php">Back to Shopping</a>

    </body>
</html>

<?php mysqli_close($connection); ?>