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
    $firstname =mysqli_real_escape_string($connection, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Check if the username and email already exist
    $query = "SELECT * FROM BUYER WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        // Username or email already exists, display error message
             $message = "Error: Username or email already exists.";
        echo $message;
    } else {
        // Insert the new user into the database
        $query = "INSERT INTO BUYER (username, password,firstname,lastname,email,phone) VALUES ('$username', '$password','$firstname','$lastname', '$email','$phone')";
        $result = mysqli_query($connection, $query);
        if ($result) {
                  // Sign up successful, display success message
            $message = "User registered successfully!";
            echo $message;

        } else {
            // Sign up failed, display error message
        $message = "Error: " . mysqli_error($connection);
            echo $message;
        }
    }
}


?>