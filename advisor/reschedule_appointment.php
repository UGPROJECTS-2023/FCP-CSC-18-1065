<?php
// Include your database connection script here
include 'db_connect.php';

// Retrieve the rescheduling data from the POST request
$appointmentId = $_POST['appointmentId'];
$newDate = $_POST['newDate'];
$newTime = $_POST['newTime'];

// Perform the appointment rescheduling in your database
// Replace this with your actual database update code
$sql = "UPDATE appointments SET appointment_date = ?, appointment_time = ? WHERE id = ?";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssi", $newDate, $newTime, $appointmentId);

    if ($stmt->execute()) {
        $response = ['success' => true];
    } else {
        $response = ['success' => false, 'error' => $stmt->error];
    }

    $stmt->close();
} else {
    $response = ['success' => false, 'error' => $conn->error];
}

// Close the database connection
$conn->close();

// Send a JSON response to the client
header('Content-Type: application/json');
echo json_encode($response);
?>
