<?php
// Connect to your database
require_once 'db_connect.php';

// Query to fetch courses
$query = "SELECT course_code, course_name, department FROM courses";
$result = mysqli_query($conn, $query);

$courses = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $courses[] = $row;
    }
}

mysqli_close($conn);

// Return courses as JSON
header('Content-Type: application/json');
echo json_encode($courses);
?>
