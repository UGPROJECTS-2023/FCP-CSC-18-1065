<?php
include 'db_connect.php'; // Include your database connection script


$sql = "SELECT id, Reg_number, appointment_date, appiontment_time, status FROM appointments WHERE advisor_id = $advisorId"; 

$result = $conn->query($sql);

$appointments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($appointments);
?>
