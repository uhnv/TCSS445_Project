<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Husky Market</title>

        <link rel="stylesheet" href="css/product.css">

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
                    <li><a href="review_Admin.php">Custormer Infor</a></li>
                    <li><a href="history_Order.php">History Order</a></li>
                    <li><a href="inventory.php">Inventory</a></li>
                    <li><a href="track_shipping.php">Shipping</a></li>
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
    <div class="row">
        <div class="content">

            <?php
            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Build the SQL query to get all products grouped by product_type
$sql = "SELECT * FROM PRODUCT GROUP BY Product_type ORDER BY Product_type ASC";

// Execute the query and get the result
$result = $conn->query($sql);

// Check if any products were found
if ($result->num_rows > 0) {
    // Display each product type and its products
    while($row = $result->fetch_assoc()) {
        echo "<h2 >" . $row["Product_type"] . "</h2>";
        echo "<div class='products'>";
        // Build the SQL query to get the products of the selected type
        $type = $row["Product_type"];
        $sql_products = "SELECT * FROM PRODUCT WHERE Product_type='$type'";
        $result_products = $conn->query($sql_products);

        // Display each product as a card
        while($row_products = $result_products->fetch_assoc()) {
     echo "<a href='add_to_cart.php?product_id=" . $row_products["Product_id"] . "' class='card' onclick='return confirm(\"Are you sure you want to add " . $row_products["Product_name"] . " to your cart?\")'>
    <h3>" . $row_products["Product_name"] . "</h3>
    <p class='description'>" . $row_products["Description"] . "</p>
    <p class='price'>$" . $row_products["Price"] . "</p>
</a>";

        }
        echo "</div>";
    }
} else {
    echo "<p>No products found.</p>";
}

            // Close the database connection
            $conn->close();
            ?>

        </div>
    </div>
    <footer>
        <p>&copy; 2023 Husky Market. All rights reserved.</p>
    </footer>
    <script>
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
