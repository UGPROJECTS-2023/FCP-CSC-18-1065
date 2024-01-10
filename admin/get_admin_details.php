<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $adminId = $_GET['id'];
    
    // Query to fetch admin details by ID
    $sql = "SELECT * FROM admin WHERE id = $adminId";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        echo json_encode($row); // Return admin details as JSON
    } else {
        // Handle the case where admin is not found
        echo json_encode(['error' => 'Admin not found']);
    }
} else {
    // Handle missing 'id' parameter
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>
