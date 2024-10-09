-- Create the bookshelf database
CREATE DATABASE IF NOT EXISTS bookshelf;

-- Use the bookshelf database
USE bookshelf;

-- Create the book table
CREATE TABLE book (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    rating INT,
    img_file VARCHAR(255),
    isread ENUM('yes', 'no') DEFAULT 'no',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert book data
INSERT INTO book (title, author, rating, img_file, isread)
VALUES 
    ('A New Earth', 'Eckhart Tolle', 4, 'a_new_earth.jpg', 'yes'),
    ('The Four Agreements', 'Don Miguel Ruiz', 5, 'the_four_agreements.jpg', 'yes'),
    ('The Seven Husbands of Evelyn Hugo', 'Taylor Jenkins Reid', 3, 'seven_husbands.jpg', 'yes'),
    ('Green Lights', 'Matthew McConaughey', 4, 'green_lights.jpg', 'no');
