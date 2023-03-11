<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
require_once('config.php');

$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

session_start();

    // Validate the input data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Check if the username and password are correct
   $query = "SELECT * FROM BUYER WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['customer_id'] = $row['Cust_ID'];
        $_SESSION['loggedin'] = true;
        $message = "Success";
        echo $message;
    } else {
        $message = "Invalid username or password.";
        echo $message;
    }
}
// Check if customer_id is set in the session
if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
    // Use the customer_id in your queries
} else {
    header("Location: login.php");
    exit;
}


?>