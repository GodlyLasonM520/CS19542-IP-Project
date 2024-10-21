<?php
session_start();
include 'db.php';

$error_message = ''; // Initialize error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the username already exists
    $check_username = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($check_username);
    
    // Check if the email already exists
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result1 = $conn->query($check_email);

    if ($result->num_rows > 0) {
        $error_message = "Username already taken. Please choose another.";
    } elseif ($result1->num_rows > 0) {
        $error_message = "Email already taken. Please choose another.";
    } else {
        // Username and email do not exist, proceed with registration
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            header("Location: loginh.php");
            exit();
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Store the error message in the session
    $_SESSION['error_message'] = $error_message;

    // Redirect back to the form
    header("Location: signuph.php");
    exit();
}
?>
