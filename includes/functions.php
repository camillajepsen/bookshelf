<?php

require_once 'db.php';

function getBooks($search_query = '', $rating = ''){
    $connection = getConnection();

    $sql = "SELECT * FROM book WHERE 1=1";
    $parameters = [];

    if($search_query){
        $sql .= " AND (title LIKE :search_query OR author LIKE :search_query";
        $parameters['search_query'] = "%$search_query%";
    }

    if($rating !== ''){
        $sql .= " AND rating = :rating";
        $parameters['rating'] = $rating;
    }

    $statement = $connection->prepare($sql);
    foreach($parameters as $key => $value){
        $statement->bindValue(":$key", $value);
    }

    $statement->execute();
    return $statement->fetchAll();
}

// ADD BOOK FUNCTIONS 


// Function to handle file uploads
function handleFileUpload($file) {
    $uploadDir = 'assets/uploads/';
    $uploadFile = $uploadDir . basename($file['name']);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // Check if file is an image
    $check = getimagesize($file['tmp_name']);
    if ($check === false) {
        return 'File is not an image.';
    }

    // Check if file already exists
    if (file_exists($uploadFile)) {
        return 'File already exists.';
    }

    // Check file size (limit to 5MB)
    if ($file['size'] > 5000000) {
        return 'File is too large.';
    }

    // Allow only certain formats
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        return 'Only JPG, JPEG, PNG & GIF files are allowed.';
    }

    // Move the uploaded file to the destination
    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        return $uploadFile; // Return the path if the upload is successful
    } else {
        return 'Sorry, there was an error uploading your file.';
    }
}

// Function to add the book to the database
function addBook($title, $author, $isRead, $rating, $coverImage) {
    // Assuming you have a connection set up, replace with your DB connection
    $connection = getConnection(); // from db.php
    $statement = $connection->prepare("INSERT INTO book (title, author, isread, rating, img_file, created_at) 
        VALUES (:title, :author, :isread, :rating, :img_file, NOW())");
    
    $statement->bindValue(':title', $title);
    $statement->bindValue(':author', $author);
    $statement->bindValue(':isread', $isRead);
    $statement->bindValue(':rating', $rating);
    $statement->bindValue(':img_file', $coverImage);
    
    if ($statement->execute()) {
        return true;
    } else {
        return false;
    }
}
