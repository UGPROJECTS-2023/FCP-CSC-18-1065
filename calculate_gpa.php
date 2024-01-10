<?php
// Include your database connection here
require_once 'db_connect.php';
if (!isset($_SESSION['Reg_number'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

$registrationNumber = $_SESSION['Reg_number'];

// Fetch the user's Academic Level based on the registration number from the database
$query = "SELECT Academic_level FROM students WHERE Reg_number = '$registrationNumber'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $academicLevel = $row['Academic_level'];

    // Fetch courses based on the user's Academic Level from the database
    $coursesQuery = "SELECT * FROM courses WHERE academic_level = '$academicLevel'";
    $coursesResult = mysqli_query($conn, $coursesQuery);
} else {
    // Handle error here
    exit("Error fetching user data");
}

// Fetch course options based on the academic level
$query = "SELECT course_id, course_name FROM courses WHERE Academic_level = '$academicLevel'";
$result = mysqli_query($conn, $query);

// Populate course options
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['Course_id'] . '">' . $row['Course_name'] . '</option>';
    }
} else {
    echo '<option value="">No courses available</option>';
}

// Close the database connection
mysqli_close($conn);
?>
