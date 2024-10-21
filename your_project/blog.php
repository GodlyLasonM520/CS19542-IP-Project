<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO blogs (user_id, title, content) VALUES ('$user_id', '$title', '$content')";
    if ($conn->query($sql) === TRUE) {
        header("Location: view_blog.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
