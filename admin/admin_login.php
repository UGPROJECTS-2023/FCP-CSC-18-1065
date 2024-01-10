<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform admin login authentication here
    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $adminData = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $adminData['user_id'];
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error_message = "Invalid login credentials.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-image: url(Advisor.jpg);
            background-size: cover;
            background-position: center center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header {
            background-color: #343a40; 
      
           
            width: 100%;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px; /* Adjust margin to create space between header and container */
        }
    </style>
</head>
<body>
<div class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          
                <a class="navbar-brand" href="#">
                    <i class="fas fa-university"></i> <span class="bold-text">FUD DUTSE</span> SAAS
                </a>
            </div>
        </nav>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="post" action="admin_login.php" class="border p-4">
                    <h3 class="text-center">ADMIN LOGIN</h3>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <?php if (isset($error_message)): ?>
                    <p class="text-danger mt-3"><?php echo $error_message; ?></p>
                <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS (jQuery and Popper.js are required) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
