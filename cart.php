<?php
require_once('config.php');
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Husky Market - Cart</title>
        <link rel="stylesheet" href="css/cart.css">
    </head>
    <body>
        <header>
            <nav>
                <div class="logo">
                    <a href="index.html"><img src="img/huskylogo.png" alt="Husky Market"></a>
                </div>
                <div class="nav-links">
                    <ul>
                        <li><a href="product.php">Products</a></li>
                        <li><a href="#">Orders</a></li>
                        <li><a href="about.html">About</a></li>
                    </ul>
                </div>
                <div class="nav-buttons" id="nav-buttons">
                    <a href="cart.php" id="cart-button">
                        <img src="img/cart-icon.png" alt="Cart" width="20" height="20">
                    </a>

                    <a href="login.html" class="sign-in" id="button1">Sign in</a>
                    <a href="signup.html" class="sign-up" id="button2">Sign up</a>
                    <a href="#" style="display:none;" id="manage-button">Manage Account</a>
                    <a href="#" id="logout-button" style="display:none;">Log Out</a>
                </div>
            </nav>
        </header>

        <main>
            <div class="cart-container">
                <h1>Your Cart</h1>
                <?php
                if (!isset($_SESSION['customer_id'])) {
                    // Redirect to login page if user is not logged in
                    header('Location: login.html');
                }
                if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                    echo "<table>";
                    echo "<tr><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th></tr>";
                    $total_price = 0;
                    foreach ($_SESSION['cart'] as $product_id => $item) {
                        $quantity = $item['quantity'];
                        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT * FROM PRODUCT WHERE Product_id='$product_id'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $product_name = $row['Product_name'];
                                $price = $row['Price'];
                                $subtotal = $price * $quantity;
                                $total_price += $subtotal;
                                echo "<tr>";
                                echo "<td>$product_name</td>";
                                echo "<td>$quantity</td>";
                                echo "<td>$price</td>";
                                echo "<td>$subtotal</td>";
                                echo "<td><form method='post' action='remove_from_cart.php'><input type='hidden' name='product_id' value='$product_id'><button type='submit'>Remove</button></form></td>";
                                echo "</tr>";
                            }
                        }
                        $conn->close();
                    }
                    echo "<tr><td colspan='3' style='text-align:right'>Total Price:</td><td>$total_price</td></tr>";
                    echo "</table>";
                    echo "<div class='checkout'>";
                } else {
                    echo "<p>Your cart is empty.</p>";
                }
                ?>
                <a href="product.php" class="continue-shopping">Continue Shopping</a>
                <?php
                if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                    echo "<a href='checkout.php' class='checkout-button'>Checkout</a>";
                }
                ?>
            </div>
            </main>

        <footer>
            <p>&copy; 2023 Husky Market. All rights reserved.</p>
        </footer>
        <script>ß
            // Check if the user is logged in        // Set the session storage item to false if it hasn't been set yet
            if (!sessionStorage.getItem("loggedIn")) {
                sessionStorage.setItem("loggedIn", "false");
            }

            if (sessionStorage.getItem("loggedIn") === "true") {
                // User is logged in, show the user management icon
                document.getElementById("button1").style.display = "none";
                document.getElementById("button2").style.display = "none";
                document.getElementById('manage-button').style.display = 'inline-block';
                document.getElementById('logout-button').style.display = 'inline-block';

            }


            const logoutLink = document.getElementById('logout-button');

            logoutLink.addEventListener('click', () => {
                sessionStorage.removeItem('loggedIn');
                window.location.href = 'index.html';
            });

        </script>
    </body>

</html>