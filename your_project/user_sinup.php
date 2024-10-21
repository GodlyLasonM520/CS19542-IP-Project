<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<style>
    .container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 40px;
    border-radius: 15px;
    background-color: rgba(255, 255, 255, 0.454);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.306); 
    
}
body{
    background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRSYbl1xiecZolTDFI54hT0emEyea-Tpx1ECA&s');
    background-repeat: no-repeat;
    background-size: 1700px;
}
</style>
<body>
    <header> 
        <h1>
        <img src="ii.png" alt="Logo" class="log">
        Sky Gliders
        </h1>
    </header>
    
    <div class="d-flex justify-content-center">
        <div class="p-4 rounded shadow container" style="max-width: 400px; width: 100%;">
            <h2 class="text-center mb-4">Signup</h2>
            <?php
            session_start();
            if (isset($_SESSION['error_message']) && $_SESSION['error_message'] != ''): ?>
                <div class="alert alert-danger"> 
                    <?php echo $_SESSION['error_message']; ?>
                </div>
            <?php
            unset($_SESSION['error_message']);
            endif;
            ?>
            <form action="user_sinuph.php" method="POST">
                <input type="text" class="form-control mb-3" name="username" placeholder="Username" required>
                <input type="email" class="form-control mb-3" name="email" placeholder="Email" required>
                <input type="password" class="form-control mb-3" name="password" placeholder="Password" required>
                <button type="submit" class="btn btn-primary btn-block">Signup</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
