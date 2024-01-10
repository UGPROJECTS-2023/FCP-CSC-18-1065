<?php
// Include the database connection
require_once 'db_connect.php';

// Check if the request is made using POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the data sent via POST
   
    $advisorName = $_POST['advisorName'];
    $advisorEmail = $_POST['advisorEmail'];
    $advisorRole = $_POST['advisorRole'];
    $advisorPhone = $_POST['advisorPhone'];
    $advisorAddress = $_POST['advisorAddress'];

    // Prepare and execute the SQL query to update the advisor
    $sql = "UPDATE advisors SET advisor_name = ?, advisor_email = ?, advisor_level = ?, advisor_phone = ?, advisor_address = ? WHERE advisor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $advisorName, $advisorEmail, $advisorRole, $advisorPhone, $advisorAddress);

    if ($stmt->execute()) {
        // Update successful
        $response = [
            'success' => true,
            'message' => 'Advisor updated successfully.',
        ];
    } else {
        // Update failed
        $response = [
            'success' => false,
            'message' => 'Error updating advisor. Please try again.',
        ];
    }

    // Close the database connection
    $stmt->close();
    $conn->close();

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Handle invalid request method (not POST)
    header("HTTP/1.1 405 Method Not Allowed");
    echo "Method Not Allowed";
}
?>
