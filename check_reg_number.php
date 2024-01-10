<?php
include 'db_connect.php';

if (isset($_POST['regNumber'])) {
    $regNumber = $_POST['regNumber'];

    // Perform a SELECT query to check if the registration number exists
    $checkQuery = "SELECT * FROM students WHERE Reg_number = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $regNumber);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Registration number already exists
        echo 'exists';
    } else {
        // Registration number is available
        echo 'available';
    }
}
?>
