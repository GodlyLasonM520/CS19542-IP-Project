<?php
session_start();
include 'db.php';

$error_message = ''; // Initialize error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement to prevent SQL injection
    $sql = $conn->prepare("SELECT * FROM users WHERE username=?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            // Redirect to blog page
            header("Location: blog.html");
            exit();
        } else {
            $error_message = "Invalid password";
        }
    } else {
        $error_message = "No user found";
    }

    // Store error message in session and redirect back to login page
    $_SESSION['error_message'] = $error_message;
    header("Location: loginh.php");
    exit();
}
?>
