<?php
// Start or resume the session.

// Include the database connection file.
include 'db_connect.php';

// Check if the 'advisor_id' session variable is set.
if (!isset($_SESSION['advisor_id'])) {
    // Redirect to the login page if the advisor is not logged in.
    header('Location: advisor_login.php');
    exit(); // Terminate the script.
}

$advisorid = $_SESSION['advisor_id'];

// Retrieve advisor's notifications from the database.
$query = "SELECT * FROM notifications WHERE advisor_id = '$advisorid'";
$result = mysqli_query($conn, $query);

// Check if the query was successful.
if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Notifications</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Manage Notifications</h1>

        <div class="list-group mt-4">
            <?php
            // Loop through notifications and display them.
            while ($row = mysqli_fetch_assoc($result)) {
                $notificationId = $row['id'];
                $message = $row['message'];

                echo "<div class='list-group-item'>";
                echo "<p class='mb-0'>$message</p>";
                echo "<a href='delete_notification.php?id=$notificationId' class='btn btn-danger btn-sm float-end'>Delete</a>";
                echo "</div>";
            }
            ?>
        </div>

        <p class="mt-4"><a href="advisor_dashboard.php" class="btn btn-primary">Back to Dashboard</a></p>
    </div>

  <!-- Include Bootstrap JS scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+EPj3fR7aPp4lk5z5FfGc6Fzj9fgjz4z0qq7uIdu5pi8E+7O" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-d7I10A8h9TP5p4jUC/Zf3Fk8boxjWN6F5r5n5Y5R5f5k5M5K5J5a5f5g5C5f5V5L5" crossorigin="anonymous"></script>

</body>
</html>
