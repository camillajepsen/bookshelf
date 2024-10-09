<?php
require_once 'includes/functions.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['book-title'];
    $author = $_POST['book-author'];
    $isRead = $_POST['isread'];
    $rating = $_POST['rating'];
    $coverImage = $_FILES['book-cover'];

    // Handle file upload
    $uploadResult = handleFileUpload($coverImage);
    
    // If the upload was successful (we assume if it returns a path, it's successful)
    if (!is_string($uploadResult)) {
        echo $uploadResult; // Show any errors with file upload
    } else {
        // Add the book to the database
        $isAdded = addBook($title, $author, $isRead, $rating, $uploadResult);
        if ($isAdded) {
            echo 'Book successfully added!';
            header('Location: index.php'); // Redirect to the book list or success page
        } else {
            echo 'Failed to add the book.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Book</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script>
        // toggle rating based on whether the book is read
        function toggleRating() {
            var isRead = document.getElementById("isread").value;
            var ratingSelect = document.getElementById("rating-container");

            if (isRead === "yes") {
                ratingSelect.style.display = "block"; // Show rating
            } else {
                ratingSelect.style.display = "none";  // Hide rating
                document.getElementById("rating").value = "0"; // Reset rating
            }
        }
    </script>
</head>
<body class="add-book-body">
        
    <header>
        <nav class="upper-nav">
            <div><a href="index.php">My Bookshelf</a></div>
        </nav>
        <nav class="lower-nav">
            <a href="index.php" class="lower-nav-button">Read Books</a>
            <a href="to_read.php" class="lower-nav-button">To Read</a>
            <a href="add_book.php" class="lower-nav-button" id="pressed-btn">Add Book</a>
        </nav>
    </header>

    <div class="content">
        <video autoplay muted loop id="background-video">
            <source src="assets/videos/bookvideo1.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="inner-content">
            <div class="inner-content-title"><h1 id="add-title">Add to Book List</h1></div>
            <form class="add-book" action="add_book.php" method="post" enctype="multipart/form-data">

                    <input type="text" id="book-title" name="book-title" placeholder="BOOK TITLE" required>
            
                    <input type="text" id="book-author" name="book-author" placeholder="BOOK AUTHOR" required>

                    <!-- Is the book read? -->
                    <select id="isread" name="isread" onchange="toggleRating()" required>
                        <option value="" disabled selected>Has the book been read?</option>
                        <option value="no">No</option>
                        <option value="yes">Yes</option>
                    </select>

                    <!-- Rating field (initially hidden) -->
                    <div id="rating-container" style="display: none;">
                        <select id="rating" name="rating">
                            <option value="0" disabled selected>SELECT RATING</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <label for="book-cover" class="custom-file-upload">
                        Upload Book Cover
                    </label>
                    <input type="file" id="book-cover" name="book-cover" required>
            
                    <button type="submit" class="form-btn">ADD BOOK</button>
            </form>
        </div>
    </div>
</body>
<footer>

</footer>
</html>
