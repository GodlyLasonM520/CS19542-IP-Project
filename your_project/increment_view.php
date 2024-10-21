<?php
session_start();
include 'db.php';

// Check if the blog_id is set in the POST request
if (isset($_POST['blog_id'])) {
    $blog_id = $_POST['blog_id'];

    // Increment the view count in the database
    $sql = "UPDATE blogs SET views = views + 1 WHERE id = '$blog_id'";
    if ($conn->query($sql)) {
        // Retrieve the updated view count
        $result = $conn->query("SELECT views FROM blogs WHERE id = '$blog_id'");
        $row = $result->fetch_assoc();

        // Return the updated view count
        echo $row['views'];
    } else {
        echo "Error";
    }
}
?>
