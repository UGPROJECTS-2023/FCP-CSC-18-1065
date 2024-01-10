<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Check if the email address exists in the database
    $checkQuery = "SELECT * FROM students WHERE email = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Email address already exists
        echo 'exists';
    } else {
        // Email address does not exist
        echo 'not_exists';
    }
} else {
    echo 'error';
}

// Close the database connection
$conn->close();
?>
