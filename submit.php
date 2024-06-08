<?php
session_start();
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['user'];
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember']);

    // Validate user credentials
    
    $sql ="SELECT username, hashed_password FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$username);
    
    
    if($stmt->execute()){
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if($user){
            if (password_verify($password, $user['hashed_password'])) {
                $_SESSION['username'] = $username;
                header('Location: homepage2.html');
                exit;
            } else {
                echo '<script>
                    alert("Login failed. Invalid username or password");
                    window.location.href = "log.html";
                 </script>';
            }
            }else {
            echo '<script>
                    alert("Login failed. Invalid username or password");
                    window.location.href = "log.html";
                 </script>';

            }
        }
    }
?>