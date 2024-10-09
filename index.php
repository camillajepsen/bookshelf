<?php
require_once 'includes/functions.php';

// Handle search input
$search_query = $_GET['search'] ?? '';
$rating = $_GET['rating'] ?? '';

// Fetch books from the database
$books = getBooks($search_query, $rating);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookshelf</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="index-body">

    <header>
            <nav class="upper-nav">
                <div><a href="index.html">My Bookshelf</a></div>
            </nav>
            <nav class="lower-nav">
                <a href="index.php" class="lower-nav-button" id="pressed-btn">Read Books</a>
                <a href="to_read.php" class="lower-nav-button">To Read</a>
                <a href="add_book.php" class="lower-nav-button">Add Book</a>
            </nav>
    </header>

    <div class="content">

        <div class="inner-content">
            <div class="inner-content-title">
    
                <!-- Search Form -->
                <form class="filter-form" method="get" action="index.php">
                    <input type="text" name="search" placeholder="Search book name or author" value="<?= htmlspecialchars($search_query); ?>">
                    <select name="rating">
                        <option value="">Select Rating</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <button type="submit" class="form-btn">Search</button>
                </form>
            </div>
    
            <div class="inner-content-grid">
                <?php if (!empty($books)): ?>
                    <?php foreach ($books as $book): ?>
                        <div class="book-card">
                            <img src="assets/uploads/<?= htmlspecialchars($book['img_file']); ?>" alt="Book Image">
                            <h3><?= htmlspecialchars($book['title']); ?></h3>
                            <p>Author: <?= htmlspecialchars($book['author']); ?></p>
                            <p>Rating: <?= htmlspecialchars($book['rating']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No books found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <footer></footer>
    
    </body>
    </html>