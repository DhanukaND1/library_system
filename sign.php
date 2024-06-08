
<?php
require 'connection.php';

// print_r($_POST);


//Retrieve form data
$id = $_POST['id'];
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$user = $_POST['user'];
$password = $_POST['password'];

// SQL query to insert data into the database
$sql = "INSERT INTO user (user_id ,first_name, last_name, email, username, password) 
        VALUES ('$id','$fname', '$lname', '$email', '$user','$password')";
// print_r($sql);

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    echo '<script>
    window.location.href = "Homepage2.html";
</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    echo '<script>
    alert("Record Created Failed");
    window.location.href = "signup.html";
</script>';
}

$conn->close();
?>









