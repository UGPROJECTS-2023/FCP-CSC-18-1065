<?php
// Start a session or resume the current session
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentadvisingsystem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in (Replace this with your authentication logic)
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Handle incoming messages
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senderId = $_SESSION['user_id'];
    $receiverId = $_POST['receiver_id'];
    $message = $_POST['message'];

    // Insert the message into the database (Replace this with your database schema)
    $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$senderId', '$receiverId', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['message' => 'Message sent successfully']);
    } else {
        echo json_encode(['error' => 'Error sending message']);
    }
}

// Close the database connection
$conn->close();
?>
