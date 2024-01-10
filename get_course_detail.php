<?php
// Include database connection
include 'db_connect.php';

// Get courseId from the query parameter
$courseId = $_GET['courseId'];

// Fetch course detail from the database based on courseId
$sql = "SELECT description FROM Courses WHERE course_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $courseId);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['description'];
} else {
    echo 'Course detail not found.';
}

$stmt->close();
$conn->close();
?>
