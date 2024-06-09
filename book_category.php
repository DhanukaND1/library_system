<?php

require_once ("connection.php");
require_once ("book_category_process.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Registration</title>

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
    <link rel="stylesheet" type="text/css" href="book_category.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="javascript" href="book_category.js">
</head>

<body>
<!-- Book category Table -->
    <div class="container">
        <h1>Book Category</h1>
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
        <div class="Bookcategorytable">
            <table class="table table-hover dt-responsive" style="width:100%; dispaly:flex; top:80px;">
                <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Date Modified</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        $sql = "SELECT * FROM bookcategory";
                        $result = $pdo->query($sql);

                    if ($result->rowCount() > 0) {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?php echo $row['category_id']; ?></td>
                                <td><?php echo $row['category_Name']; ?></td>
                                <td><?php echo $row['date_modified']; ?></td>
                                
                                <td>
                                    <a href="javascript:void[0]; " class="btn btn-success"
                                            id="showeditform">Edit</button></a>
                                    <div class="edit" id="categoryEdit" <?php echo htmlspecialchars($row['category_id']); ?>>

                                        <div class="edit-content">

                                            <h4>Edit Book Category</h4><br>

                                            <span class="eclose">&times;</span>

                                            <form action="book_category_process.php" method="post" id="efrm" class="efrm">
                                                <input type="hidden" name="action" value="update">
                                                <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($row['category_id']); ?>">
                                                <label for="category_id">Category Id</label><br>
                                                <input id="bid" name="category_id" type="text" value="<?php echo htmlspecialchars($row['category_id']); ?>" required autofa><br><br>

                                                <label for="category_Name">Category Name</label><br>
                                                <input id="cname" name="category_Name" type="text" value="<?php echo htmlspecialchars($row['category_Name']); ?>" required autofa><br><br>

                                                <label for="date_modified">Date modified</label><br>
                                                <input id="date" name="date_modified" type="date" value="<?php echo htmlspecialchars($row['date_modified']); ?>" required autofa><br><br>

                                                </select>

                                                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <script src="book_category.js"></script>

                                    <a href="javascript:void(0);" class="btn btn-danger btn-xl delete-btn"
                                        data-id="<?php echo htmlspecialchars($row['category_id']); ?>"
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
