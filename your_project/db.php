<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create a connection to MySQL
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS blog_system";
if ($conn->query($sql) === TRUE) {

    // Select the blog_system database
    $conn->select_db("blog_system");

    // Create the users table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        password VARCHAR(255),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $conn->query($sql);

    // Create the blogs table if it doesn't exist, with a views column
    $sql = "CREATE TABLE IF NOT EXISTS blogs (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(6) UNSIGNED,
        title VARCHAR(100),
        content TEXT,
        views INT DEFAULT 0,  -- Add views column for view count
        blog_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";

    // Execute the query to create the blogs table
    $conn->query($sql);
    echo "";
} else {
    echo "Error creating database: " . $conn->error;
}
?>
