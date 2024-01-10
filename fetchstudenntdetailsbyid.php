<?php
include'db_connect.php';

function fetchStudentDetailsById($studentId) {
    global $conn;

    $studentId = mysqli_real_escape_string($conn, $studentId);

    $query = "SELECT * FROM students WHERE student_id = '$studentId'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}
?>
