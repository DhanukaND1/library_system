<?php

require_once ("./connection.php");
require_once ("process1.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Registration</title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>

    <!--<link rel="stylesheet" href="bootstrap.css">-->
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="javascript" href="script.js">
</head>
<body>


    <!-- Book Table -->
    <div class="container">
        <h1>Books</h1>
        <?php if (isset($_SESSION["message"])): ?>
            <div style="dispaly:flex; top:30px;" class="alert alert-<?= $_SESSION['msg_type'] ?> fade show" role="alert">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                unset($_SESSION['msg_type']);
                ?>
                <span class="eclose" s>&times;</span>

            </div>
        <?php endif; ?>
        <div class="Booktable">
            <table class="table table-hover dt-responsive" style="width:100%; dispaly:flex; top:80px;">
                <thead>
                    <tr>
                        <th>Book ID</th>
                        <th>Book Name</th>
                        <th>Book Category</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sql = "SELECT b.book_id, b.book_name, bc.category_Name FROM book b JOIN bookcategory bc ON b.category_id = bc.category_id";
                    $result = $pdo->query($sql);

                    if ($result->rowCount() > 0) {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?php echo $row['book_id']; ?></td>
                                <td><?php echo $row['book_name']; ?></td>
                                <td><?php echo $row['category_Name']; ?></td>
                                <td>
                                    <a href="javascript:void[0]; " class="btn btn-success" id="showeditform">Edit</button></a>
                                    <div class="edit" id="bookEdit" <?php echo htmlspecialchars($row['book_id']); ?>>
                                        <div class="edit-content">
                                            <h4>Edit Book</h4><br>
                                            <span class="eclose">&times;</span>
                                            <form action="process1.php" method="post" id="efrm">
                                                <input type="hidden" name="action" value="update">
                                                <input type="hidden" name="book_id"
                                                    value="<?php echo htmlspecialchars($row['book_id']); ?>">
                                                <label for="book_id">Book Id</label>
                                                <input id="bid" name="book_id" type="text"
                                                    value="<?php echo htmlspecialchars($row['book_id']); ?>" required><br>

                                                <label for="book_name">Book Name</label>
                                                <input id="bname" name="book_name" type="text"
                                                    value="<?php echo htmlspecialchars($row['book_name']); ?>" required><br>

                                                <label for="book_category">Book Category</label>
                                                <select name="book_category" id="book_category" required>
                                                    <option value="">Select a category</option>
                                                    <?php
                                                    $category_sql = "SELECT category_Name FROM bookcategory";
                                                    $category_result = $pdo->query($category_sql);
                                                    while ($category_row = $category_result->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<option value='" . htmlspecialchars($category_row["category_Name"]) . "'";
                                                        if ($category_row["category_Name"] == $row['category_Name']) {
                                                            echo "selected";
                                                        }
                                                        echo ">" . htmlspecialchars($category_row["category_Name"]) . "</option>";
                                                    }
                                                    ?>
                                                </select><br><br>

                                                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <script src="script.js"></script>

                                    <a href="javascript:void(0);" class="btn btn-danger btn-xl delete-btn"
                                        data-id="<?php echo htmlspecialchars($row['book_id']); ?>"
                                        style="display: inline !important">Delete</a>

                                </td>
                            </tr>

                        <?php }
                    } else {
                        echo '0 results';
                    }
                    ?>
                </tbody>
            </table>

        </div>
        <!-- Delete confirmation form -->
        <div class="delete-confirm" id="deleteConfirm" style="display: none;">
            <div class="delete-content">
                <p id="deleteMessage"></p>
                <button class="btn btn-danger confirm-delete">Yes</button>
                <button class="btn btn-secondary cancel-delete">No</button>
            </div>
        </div>
    </div>
    </div>

    <!-- Book registration form -->
    <div class="container">
        <button id="showFormButton" class="btn btn-primary mt-3">
            Register Book
        </button>

        <div class="name" id="myModal">
            <div class="name-content">
                <span class="close">&times;</span>

                <form action="process1.php" method="post" id="frm">
                    <h4>Book Registration</h4><br>
                    <input type="hidden" name="action" value="insert">

                    <label for="book_id">Book Id</label>
                    <input id="bid" name="book_id" type="text" placeholder="B001" required><br>

                    <label for="book_name">Book Name</label>
                    <input id="bname" name="book_name" type="text" placeholder="Enter book name" required><br>

                    <label for="book_category">Book Category</label>
                    <select name="book_category" id="book_category" required>
                        <option value="">Select a category</option>
                        <?php
                        $category_sql = "SELECT category_Name FROM bookcategory";
                        $category_result = $pdo->query($category_sql);
                        while ($category_row = $category_result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . htmlspecialchars($category_row["category_Name"]) . "'>" . htmlspecialchars($category_row["category_Name"]) . "</option>";
                        }
                        ?>
                    </select><br><br>

                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>

        <script src="script.js"></script>
    </div>

     
