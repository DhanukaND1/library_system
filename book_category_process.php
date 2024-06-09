<?php
require 'connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'insert') {
        // Insert new category
        $category_id = $_POST['category_id'];
        $category_Name = $_POST['category_Name'];
        $date_modified = date('Y-m-d h:i:sa'); // Set date_modified to current date and time

        // Check if category_id already exists
        $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM bookcategory WHERE category_id = :category_id");
        $stmt_check->bindParam(':category_id', $category_id);
        $stmt_check->execute();
        $count = $stmt_check->fetchColumn();

        if ($count > 0) {
            $_SESSION['message'] = "Category ID already exists. Please use a different ID.";
            $_SESSION['msg_type'] = 'danger';
        } else {
            try {
                $stmt = $pdo->prepare("INSERT INTO bookcategory (category_id, category_Name, date_modified) VALUES (:category_id, :category_Name, :date_modified)");
                $stmt->bindParam(':category_id', $category_id);
                $stmt->bindParam(':category_Name', $category_Name);
                $stmt->bindParam(':date_modified', $date_modified);
                $stmt->execute();

                $_SESSION['message'] = "Category added successfully!";
                $_SESSION['msg_type'] = 'success';
            } catch (PDOException $e) {
                $_SESSION['message'] = "Error adding category: " . $e->getMessage();
                $_SESSION['msg_type'] = 'danger';
            }
        }