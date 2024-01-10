<?php
session_start();
require_once 'db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName = $_POST['Reg_number'];
    $password = $_POST['password'];

    // Simulate database check (replace with your actual database query)
    $query = "SELECT * FROM students WHERE Reg_number = '$userName' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Store registration number in session
        $_SESSION['Reg_number'] = $userName;
        header("Location: dashboard.php");
        exit;
    } else {
        $error_message = 'Invalid Reg_number or password.';
      
    }

    mysqli_close($conn);
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
    <title>Login Page</title>
    <style>
      
      
    form {
  border: 3px solid #f1f1f1;
  align-content: center;
}

/* Full-width inputs */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the avatar image inside this container */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}


img.avatar {
  width: 10%;
  border-radius: 50%;
}

/* Add padding to containers */
.container {
  
  padding: 16px;
  width: 40%;
  
}

/* The "Forgot password" text */
span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 100%;
  }
}

.ERROR {
  color: red;
}
</style>
   
</head>
<body>
<div class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
    <i class="fas fa-university"></i> <span class="bold-text">FUD DUTSE</span>
    <br>
    Student Advising Portal
  </a>
</div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="login.php" method="post" id="login-form" class="bg-light p-4 rounded">
                    <div class="text-center">
                        <img src="iMG/abraze.jpg" alt="Avatar" class="avatar img-fluid mb-4">
                    </div>
                    <div class="form-group">
                        <div class="ERROR">
                            <?php if (isset($error_message)): ?>
                                <p class="text-danger"><?php echo $error_message; ?></p>
                            <?php endif; ?>
                        </div>
                        <label for="Reg_number"><b>Registration Number</b></label>
                        <input type="text" class="form-control" placeholder="Registration Number" name="Reg_number" required>
                    </div>
                    <div class="form-group">
                        <label for="password"><b>Password</b></label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" checked="checked" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <button type="button" class="btn btn-secondary cancelbtn">Cancel</button>
                    <span class="psw">Forgot <a href="#">password?</a></span>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>