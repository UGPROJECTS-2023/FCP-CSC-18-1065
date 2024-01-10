<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['advisor_id'])) {
    header('Location: advisor_login.php');
    exit();
}

$advisorid = $_SESSION['advisor_id'];

if (isset($_GET['id'])) {
    $notificationId = $_GET['id'];

    // Delete the notification only if it belongs to the advisor
    $query = "DELETE FROM notifications WHERE id = '$notificationId' AND advisor_id = '$advisorid'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Successful deletion, you can redirect to the manage_notifications.php page
        header('Location: manage_notifications.php');
        exit();
    } else {
        die("Error: " . mysqli_error($conn));
    }
} else {
    // Handle the case when the notification ID is not provided
    echo "Invalid request.";
}
?>
