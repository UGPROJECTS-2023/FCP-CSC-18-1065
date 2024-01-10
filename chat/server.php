<?php
// Simulate database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentadvisingsystem";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Simulate sending a message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senderId = $_POST['senderId'];
    $receiverId = $_POST['receiverId'];
    $message = $_POST['message'];

    // Perform database insert operation (replace with actual SQL query)
    $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$senderId', '$receiverId', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
}

$conn->close();
?>
