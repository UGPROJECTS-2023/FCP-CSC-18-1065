<?php
include 'db_connect.php'; // Include your database connection script

// Retrieve advisors from the database
$sql = "SELECT advisor_id, advisor_name, advisor_email FROM advisors";
$result = $conn->query($sql);

$advisors = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $advisors[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($advisors);
?>
