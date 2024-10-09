<?php
// Database connection configuration
function getConnection() {
    $host = 'localhost';
    $db = 'bookshelf';
    $user = 'root';
    $pass = 'root';
    $charset = 'utf8mb4';

    try {
        return new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
}
