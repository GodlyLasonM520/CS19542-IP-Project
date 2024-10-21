<?php
session_start();
include 'db.php';

// Select all blogs from the database
$sql = "SELECT * FROM blogs ORDER BY blog_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Blogs</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .view-icon {
            cursor: pointer;
            width: 20px; /* Adjust size */
            height: 20px; /* Adjust size */
            margin-left: 10px; /* Space between views and icon */
        }
    </style>
</head>
<body>
<div class="container">
    <h2 style="text-align:center;">All Blogs</h2>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="container rounded shadow mb-4 p-3">
            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
            <p><?php echo htmlspecialchars($row['content']); ?></p>
            <small>Posted on: <?php echo htmlspecialchars($row['blog_date']); ?></small>
            
            <!-- Display view count with an eye icon -->
            <div>
                <span id="views-<?php echo $row['id']; ?>"><?php echo $row['views']; ?></span> 
                <img src="eye.png" alt="View" class="view-icon" onclick="incrementView(<?php echo $row['id']; ?>)">
            </div>
        </div>
    <?php } ?>
    <div>
        <a href="logout.php" class="btn btn-success">Logout</a>
    </div>
</div>

<!-- jQuery for Ajax -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
// Function to increment the view count
function incrementView(blogId) {
    $.ajax({
        url: 'increment_view.php',
        type: 'POST',
        data: { blog_id: blogId },
        success: function(response) {
            // Update the view count displayed on the page
            $('#views-' + blogId).text(response);
        },
        error: function() {
            alert("Failed to update view count");
        }
    });
}
</script>
</body>
</html>
