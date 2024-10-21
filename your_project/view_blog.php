<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM blogs WHERE user_id='$user_id' ORDER BY blog_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blogs</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 style="text-align:center;">Your Blogs</h2>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="container rounded shadow mb-4 p-3">
            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
            <p><?php echo htmlspecialchars($row['content']); ?></p>
            <small>Posted on: <?php echo htmlspecialchars($row['blog_date']); ?></small>

            <!-- Display View Count -->
            <div>
                <strong>Views:</strong> <?php echo htmlspecialchars($row['views']); ?>
            </div>

            <!-- Delete Button Form -->
            <form action="delete_blog.php" method="POST" class="mt-2">
                <input type="hidden" name="blog_id" value="<?php echo $row['id']; ?>">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    <?php } ?>
    <div>
        <a href="logout.php" class="btn btn-success">Logout</a>
    </div>
</div>
</body>
</html>
