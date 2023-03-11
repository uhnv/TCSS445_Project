<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Husky Market</title>

        <link rel="stylesheet" href="css/review_admin.css">

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
   <div class="jumbotron"> 
            <h2>Select Order Number</h2>
            <hr class="my-4"> 
            <form method="GET" action="history_Order.php"> 
                <select name="orderNum" onchange='this.form.submit()'> 
                    <option selected>Select a name</option> 

                    <?php 
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME); 
                    if ( mysqli_connect_errno() )  
                    { 
                        die( mysqli_connect_error() );   
                    } 
                    $sql = "SELECT Order_Number FROM ORDERS ORDER BY Order_Number ASC;"; 
                    if ($result = mysqli_query($connection, $sql))  
                    { 
                        // loop through the data 
                        while($row = mysqli_fetch_assoc($result)) 
                        { 
                            echo '<option value="' . $row['Order_Number'] . '">';
                            echo  $row['Order_Number'] ;
                            echo "</option>"; 

                        } 
                        // release the memory used by the result set 
                        mysqli_free_result($result);  
                    }  
                    ?>  
                </select> 
                <?php 

                if ($_SERVER["REQUEST_METHOD"] == "GET")  
                { 
                    if (isset($_GET['orderNum']) )  
                    { 
                        $selected = $_GET['orderNum'];


                ?> 
                <p>&nbsp;</p> 
                <table class="table"> 
                    <thead> 
                        <tr class="table-success"> 
                            <th scope="col">Order #</th> 
                            <th scope="col">First Name</th> 
                            <th scope="col">Last Name</th> 
                            <th scope="col">Product_name</th> 
                            <th scope="col">Price per Item</th> 
                            <th scope="col">Total Items Ordered</th> 
                        </tr> 
                    </thead> 
                    <?php  

                        $sql = "SELECT O.Order_Number AS 'Order #', B.FirstName, B.LastName, P.Product_name, P.Price AS 'Price per Item', SUM(OI.Quantity) AS 'Total Items Ordered'
FROM ORDERS AS O
JOIN BUYER AS B ON O.Cust_ID = B.Cust_ID
JOIN ORDER_ITEMS AS OI ON O.Order_ID = OI.Order_ID
JOIN PRODUCT P ON OI.Product_ID = P.Product_ID
WHERE O.Order_Number = '{$selected}'
GROUP BY O.Order_Number, P.Product_name;"; 


                        if ($result = mysqli_query($connection, $sql))  
                        { 

                            while($row = mysqli_fetch_assoc($result)) 

                            {  
                    ?> 
                    <tr> 
                        <td><?php echo $row['Order #'] ?></td> 
                        <td><?php echo $row['FirstName'] ?></td> 
                        <td><?php echo $row['LastName'] ?></td> 
                        <td><?php echo $row['Product_name'] ?></td> 
                        <td><?php echo $row['Price per Item'] ?></td> 
                        <td><?php echo $row['Total Items Ordered'] ?></td>

                    </tr> 
                    <?php 
                            } 
                            // release the memory used by the result set 
                            mysqli_free_result($result);  
                        }  
                    } // end if (isset) 
                } // end if ($_SERVER) 
                    ?> 
                </table> 
       </form> 
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
