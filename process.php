<?php
require 'connection.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $category_Name = $_POST['book_category'];

    //Validate book ID
      if (!preg_match('/^B\d{3}$/', $book_id)) {
           $_SESSION['message'] = 'Invalid Book ID. It must be in the format B001.';
           $_SESSION['msg_type'] = 'danger';
           header('Location: assignment1.php');
           exit();
       };

    // Check if book ID already exists
      $stmt = $pdo->prepare("SELECT book_id FROM book WHERE book_id = :book_id");
      $stmt->bindParam(':book_id', $book_id);
      $stmt->execute();
      $existingBook = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($existingBook && $_POST['action'] == 'insert') {
          $_SESSION['message'] = 'Book ID already exists. Please use a different Book ID.';
          $_SESSION['msg_type'] = 'danger';
          header('Location: assignment1.php');
          exit();
       };

    

    // Get category_id from category_name
    $stmt = $pdo->prepare("SELECT category_id FROM bookcategory WHERE category_Name = :category_Name");
    $stmt->bindParam(':category_Name', $category_Name);
    $stmt->execute();
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($category) {
        $category_id = $category['category_id'];

        // Insert into book table
        if ($_POST['action'] == 'insert') {
            $stmt = $pdo->prepare("INSERT INTO book (book_id, book_name, category_id) VALUES (:book_id, :book_name, :category_id)");
            $stmt->bindParam(':book_id', $book_id);
            $stmt->bindParam(':book_name', $book_name);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->execute();
            
            $_SESSION['message'] = "Book inserted successfully!";
            $_SESSION['msg_type'] = 'success';

            header('Location: assignment1.php');

        } elseif ($_POST['action'] == 'update') {
            // Update book details
            $stmt = $pdo->prepare("UPDATE book SET book_name = :book_name, category_id = :category_id WHERE book_id = :book_id");
            $stmt->bindParam(':book_id', $book_id);
            $stmt->bindParam(':book_name', $book_name);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->execute();

            $_SESSION['message'] = 'Book updated successfully';
            $_SESSION['msg_type'] = 'success';

            header('Location: assignment1.php');
    }
}
}
