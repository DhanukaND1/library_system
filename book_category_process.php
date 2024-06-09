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
        } elseif ($_POST['action'] == 'update') {
        //Update category
        $category_id = $_POST['category_id'];
        $category_Name = $_POST['category_Name'];
        $date_modified = date('Y-m-d h:i:sa'); // Set date_modified to current date and time

        //Check if any books are associated with this category
        $stmt_check_books = $pdo->prepare('SELECT COuNT * AS book_count FROM booktable WHERE category_id = :category_id');
        $stmt_check_books->bindParam(':category_id', $category_id);
        $book_count = $stmt_check_books->fetch(PDO::FETCH_ASSOC)['book_count'];

        if ($book_count > 0) {
            //If books are associated,inform the user and don't update
            $_SESSION['message'] = 'Cannot update category because there are associated books. Please delete the associated books first.';
            $_SESSION['msg_type'] = 'danger';
        } else {
            // If no books are associated, proceed with the update
            $stmt = $pdo->prepare("UPDATE bookcategory SET category_id = :category_id, category_Name = :category_Name, date_modified = :date_modified WHERE category_id = :category_id");
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':category_Name', $category_Name);
            $stmt->bindParam(':date_modified', $date_modified);
            $stmt->execute();

            $_SESSION['message'] = "Category updated successfully!";
            $_SESSION['msg_type'] = 'success';
        }
    }


    header('Location: book_category.php');
    exit();
}


if (isset($_GET['delete'])) {
    // Delete category
    $category_id = $_GET['delete'];

    try {
        // Begin a transaction
        $pdo->beginTransaction();

        // Delete the category
        $stmt_delete_category = $pdo->prepare("DELETE FROM bookcategory WHERE category_id = :category_id");
        $stmt_delete_category->bindParam(':category_id', $category_id);
        $stmt_delete_category->execute();

        $_SESSION['message'] = 'Book category deleted successfully';
        $_SESSION['msg_type'] = 'success';

        // Commit the transaction
        $pdo->commit();

    } catch (PDOException $e) {
        // Roll back the transaction on error
        $pdo->rollBack();

        $_SESSION['message'] = 'Error deleting book category: ' . $e->getMessage();
        $_SESSION['msg_type'] = 'danger';
    }

    header('Location: book_category.php');
}
?>
    
