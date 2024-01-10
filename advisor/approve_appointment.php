<?php
include 'db_connect.php';

// Retrieve the appointmentId from the POST request
if (isset($_POST['id'])) {
    $appointmentId = $_POST['id'];

    // Perform the appointment approval in your database
    // Use prepared statements to prevent SQL injection
    $sql = "UPDATE appointments SET status = 'Approved' WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $appointmentId);
        
        if ($stmt->execute()) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false, 'error' => $stmt->error];
        }
    
        $stmt->close();
    } else {
        $response = ['success' => false, 'error' => $conn->error];
    }
} else {
    $response = ['success' => false, 'error' => 'Invalid appointment ID'];
}

// Close the database connection
$conn->close();

// Send a JSON response to the client
header('Content-Type: application/json');
echo json_encode($response);

?>
