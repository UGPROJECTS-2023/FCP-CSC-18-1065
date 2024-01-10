<?php
// Assuming you have a database connection established
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $advisorName = $_POST['advisorName'];
    $advisorEmail = $_POST['advisorEmail'];
    $advisorPassword= $_POST['advisorPassword'];
    $advisorRole = $_POST['advisorRole'];
    $advisorPhone = $_POST['advisorPhone'];
    $advisorAddress = $_POST['advisorAddress'];

    // Validate and sanitize input data here if needed

    // Perform the insertion into the database
    $insertQuery = "INSERT INTO advisors (advisor_name, advisor_email,advisor_password,advisor_level,advisor_phone,advisor_office_location) VALUES ('$advisorName', '$advisorEmail','$advisorPassword','$advisorRole','$advisorPhone','$advisorAddress')";

    if (mysqli_query($conn, $insertQuery)) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false);
    }

    // Send JSON response back to the client
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Redirect or handle invalid requests
    header('Location: advisor.php');
    exit();
}
?>
