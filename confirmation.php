<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Page</title>
    <!-- Add the Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add any additional CSS styles or headers you need -->
</head>
<body>
    <header>
        <h1 class="text-center">Confirmation Page</h1>
    </header>
    <main class="container mt-4">
        <?php
        // Check if the 'message' query parameter is set to 'success'
        if (isset($_GET['message']) && $_GET['message'] === 'success') {
            echo '<div class="alert alert-success text-center" role="alert">Report submitted successfully!</div>';
        } else {
            echo '<div class="alert alert-danger text-center" role="alert">An error occurred.</div>';
        }
        ?>
        <!-- You can provide additional content or links here -->
    </main>

    <!-- Add the Bootstrap JavaScript and jQuery links here if needed -->

    <script>
        // Redirect to the dashboard after a countdown of 3 seconds
        setTimeout(function () {
            window.location.href = 'dashboard.php'; // Replace 'dashboard.php' with the actual URL of your dashboard page
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
</body>
</html>
