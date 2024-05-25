<?php
session_start();
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['user'];
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember']);

    // Validate user credentials
    
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    
    if($result->num_rows >0){

        header('Location: Homepage.php');
        exit();

    }else {
        // Invalid credentials
        echo '<script>
                window.location.href = "log.php";
                alert("Login failed. Invalid username or password");
            </script>';



    }
  
}
?>