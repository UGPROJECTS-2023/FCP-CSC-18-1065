<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['email'];
    $password = $_POST['password'];

    // Perform admin login authentication here
    $query = "SELECT * FROM advisors WHERE advisor_email = '$username' AND advisor_password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $adminData = mysqli_fetch_assoc($result);
        $_SESSION['advisor_level'] = $adminData['advisor_level'];
        $_SESSION['department_id'] = $adminData['department_id'];
        $_SESSION['advisor_id'] = $adminData['advisor_id'];
        $_SESSION['advisor_name']=$adminData['advisor_name'];
        header("Location: advisor_dashboard.php");
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
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mb-4">Welcome to Advisor page</h1>
                <h3 class="text-center mb-4">Advisor Login</h3>
                <form method="post" action="advisor_login.php" class="border p-4">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <?php if (isset($error_message)): ?>
                    <p class="mt-3 text-danger text-center"><?php echo $error_message; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JavaScript libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
