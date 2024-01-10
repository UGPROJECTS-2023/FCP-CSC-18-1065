<!DOCTYPE html>
<html>
<head>
    <title>Registration Successful</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="alert alert-success" role="alert">
        Registration Successful! You will be redirected to the <a href="login.php" class="alert-link">login page</a> in 2 seconds.
    </div>
</div>

<script>
    // JavaScript code to redirect to the login page after 2 seconds
    setTimeout(function () {
        window.location.href = "login.php";
    }, 2000); // 2000 milliseconds (2 seconds)
</script>

</body>
</html>
