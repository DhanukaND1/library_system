<?php

require_once("./connection.php");
require_once("process.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Member Management</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripts.js"></script>
</head>
<body>
    <h2>Register Library Member</h2>
    <form id="memberForm" method="post" action="process.php">
        <label for="member_id">Member ID:</label>
        <input type="text" id="member_id" name="member_id" required pattern="M\d{3}" title="Member ID must be in the format M001" placeholder = "M001"><br><br>

        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required placeholder = "John"><br><br>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required placeholder = "Doe"><br><br>

        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required placeholder = "sample@gmail.com"><br><br>

        <input type="submit" value="Register" class = "btn">
        <button type="button" id="updateButton"  class = "btn" style="display:none;">Update Member</button>
    </form>

    <h2>Library Members</h2>
    <table id="membersTable" border="1">
        <thead>
            <tr>
                <th>Member ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Birthday</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Records will be injected here by JavaScript -->
        </tbody>
    </table>
</body>
</html>
