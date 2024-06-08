<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'];
  $user_id = $_POST['user_id'];

  if ($action === 'delete') {
    $sql = "DELETE FROM user WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $user_id);
    if ($stmt->execute()) {
      echo "Record deleted successfully";
    } else {
      echo "Error deleting record: " . $conn->error;
    }
  } elseif ($action === 'edit') {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "UPDATE user SET user_id =?,first_name=?, last_name=?, email=?, username=?, password=? WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssss', $user_id,$first_name, $last_name, $email, $username, $password, $user_id);
    if ($stmt->execute()) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $conn->error;
    }
  }

  $stmt->close();
  $conn->close();
}
?>
