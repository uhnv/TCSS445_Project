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
            <form method="GET" action="review_Admin.php"> 
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
                            <th scope="col">Customers_Name</th> 
                            <th scope="col">Order_Number</th> 
                            <th scope="col">Email</th> 
                            <th scope="col">Phone</th> 
                            <th scope="col">Total Order Price</th> 
                            <th scope="col">Shipping cost</th> 
                            <th scope="col">Total Payment</th> 
                        </tr> 
                    </thead> 
                    <?php  

                        $sql = "SELECT O.Order_Number, CONCAT(B.Firstname, ' ', B.LastName) AS 'Customers_Name', B.Email, B.Phone, 
O.Total_price AS 'Total Order Price', 
S.Shipping_Cost AS 'Shipping cost',
O.Total_Price + S.Shipping_cost AS 'Total Payment'
FROM ORDERS AS O
JOIN BUYER AS B ON O.Cust_ID = B.Cust_ID
JOIN TRACK AS T ON O.Order_Number = T.Order_Num
JOIN SHIPPING AS S ON T.Tracking_ID = S.Tracking_ID
WHERE O.Order_Number = '{$selected}';"; 


                        if ($result = mysqli_query($connection, $sql))  
                        { 

                            while($row = mysqli_fetch_assoc($result)) 

                            {  
                    ?> 
                    <tr> 
                        <td><?php echo $row['Customers_Name'] ?></td> 
                        <td><?php echo $row['Order_Number'] ?></td> 
                        <td><?php echo $row['Email'] ?></td> 
                        <td><?php echo $row['Phone'] ?></td> 
                        <td><?php echo $row['Total Order Price'] ?></td> 
                        <td><?php echo $row['Shipping cost'] ?></td> 
                        <td><?php echo $row['Total Payment'] ?></td> 

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
