<?php
include 'db_connect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] === "DELETE" && isset($_GET['advisorId'])) {
    $advisorId = $_GET['advisorId'];

    // Delete the advisor from the database
    $sql = "DELETE FROM advisors WHERE advisor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $advisorId);

    if ($stmt->execute()) {
        $response = array("success" => true);
        echo json_encode($response);
    } else {
        $response = array("success" => false);
        echo json_encode($response);
    }
} else {
    $response = array("success" => false);
    echo json_encode($response); // Invalid request
}

$conn->close();
?>
