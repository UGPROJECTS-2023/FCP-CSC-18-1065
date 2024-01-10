<?php
// Include your database connection script
include 'db_connect.php';

// Check if the admin ID is provided
if (isset($_POST['id'])) {
    $adminId = $_POST['id'];

    // Perform the deletion query (replace 'admin' with your table name)
    $sql = "DELETE FROM admin WHERE id = $adminId";
    if ($conn->query($sql) === TRUE) {
        $response = array("success" => true);
    } else {
        $response = array("success" => false);
    }
} else {
    $response = array("success" => false);
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>
