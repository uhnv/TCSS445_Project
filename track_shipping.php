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
            <form method="GET" action="track_shipping.php"> 
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
                            <th scope="col">Customer_Name</th> 
                            <th scope="col">Shipping Address</th> 
                            <th scope="col">Shipped Date</th> 
                            <th scope="col">Expected Date to Delieverd</th> 
                            <th scope="col">Days to Deliever</th> 
                        </tr> 
                    </thead> 
                    <?php  

                        $sql = "SELECT O.Order_Number, CONCAT(B.Firstname, ' ', B.LastName) AS 'Customer_Name', 
        CT.Address AS 'Shipping Address',
        S.Date AS 'Shipped Date', S.Expected_Delivery_Date AS 'Expected Date to Delieverd', 
        DATEDIFF(S.Expected_Delivery_Date, S.Date) AS 'Days to Deliever'
FROM ORDERS AS O
INNER JOIN BUYER AS B ON O.Cust_ID = B.Cust_ID
INNER JOIN TRACK AS T ON O.Order_Number = T.Order_Num
INNER JOIN SHIPPING AS S ON T.Tracking_ID = S.Tracking_ID
INNER JOIN CUSTOMERADDRESS AS CT ON T.Address_ID = CT.Address_ID
WHERE O.Order_Number = '{$selected}';"; 


                        if ($result = mysqli_query($connection, $sql))  
                        { 

                            while($row = mysqli_fetch_assoc($result)) 

                            {  
                    ?> 
                    <tr> 
                        <td><?php echo $row['Customer_Name'] ?></td> 
                        <td><?php echo $row['Shipping Address'] ?></td> 
                        <td><?php echo $row['Shipped Date'] ?></td> 
                        <td><?php echo $row['Expected Date to Delieverd'] ?></td> 
                        <td><?php echo $row['Days to Deliever'] ?></td> 
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
