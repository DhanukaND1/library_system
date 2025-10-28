📚 Book and Category Management System

A web-based application for managing books and their categories, built using PHP, MySQL, HTML, CSS, and JavaScript.
It provides full CRUD (Create, Read, Update, Delete) functionality for both books and categories — making it ideal for a library or bookstore management platform.

🚀 Features
📖 Book Management (assignment1.php)

✅ View Books
Displays a dynamic table listing all books from the database.

➕ Add Book

Add new books using a clean, Bootstrap modal form.

Inputs include: Book ID, Book Name, and Category (dropdown).

Validates Book ID format (B001) and prevents duplicates.

✏️ Update Book

Edit book details via an intuitive modal interface.

Update the book’s name or category seamlessly.

🗑️ Delete Book

Prompts for confirmation before deletion.

Handles cascading deletes — automatically removes related records from:

fine

bookborrower
before deleting the book itself.

🗂️ Book Category Management (book_category.php)

✅ View Categories
Lists all categories in a structured, easy-to-read table.

➕ Add Category

Add new categories through a Bootstrap modal.

Inputs include: Category ID, Category Name, and Date Modified.

Validates Category ID format (C001) and prevents duplicates.

✏️ Update Category

Edit category names quickly using an edit modal.

🗑️ Delete Category

Confirmation dialog before deletion.

Supports cascade delete:

Deleting a category removes all associated books (and their related fine and bookborrower records).

🛠️ Technologies Used
Layer	Technologies
Backend	PHP
Database	MySQL (with PDO)
Frontend	HTML, CSS, JavaScript
UI Framework	Bootstrap 4
