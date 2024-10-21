<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blog_id = $_POST['blog_id'];
    $user_id = $_SESSION['user_id'];

    // Delete the blog post from the database
    $stmt = $conn->prepare("DELETE FROM blogs WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $blog_id, $user_id);

    if ($stmt->execute()) {
        // Redirect back to the blog list page after deletion
        header("Location: view_blog.php");
        exit;
    } else {
        echo "Error deleting the blog post.";
    }

    $stmt->close();
}
?>
