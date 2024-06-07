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

        header('Location: Homepage2.html');
        exit();

    }else {
        // Invalid credentials
        echo '<script>
                alert("Login failed. Invalid username or password");
                window.location.href = "log.html";
            </script>';



    }
  
} session_write_close();
?>