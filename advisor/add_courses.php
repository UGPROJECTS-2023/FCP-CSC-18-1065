<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['Advisor_id'])) {
    header("Location: advisor_login.php");
    exit;
}

$advisorLevel = $_SESSION['Advisor_level'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_course'])) {
        // Handle adding a new course
        $courseCode = $_POST['course_number'];
        $courseName = $_POST['course_name'];

        // Perform validation
        $errors = [];

        // Validate course code (e.g., alphanumeric and not empty)
        if (empty($courseCode) || !ctype_alnum($courseCode)) {
            $errors[] = "Course code must be alphanumeric and not empty.";
        }

        // Validate course name (e.g., not empty)
        if (empty($courseName)) {
            $errors[] = "Course name cannot be empty.";
        }

        // If there are validation errors, display them
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<p>Error: $error</p>";
            }
        } else {
            // Insert the new course into the database
            $insertQuery = "INSERT INTO courses (course_code, course_name, advisor_level) VALUES ('$courseCode', '$courseName', '$advisorLevel')";
            if (mysqli_query($conn, $insertQuery)) {
                header("Location: advisor_courses.php");
                exit;
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <!-- Add your CSS links here -->
</head>
<body>
    <!-- Add your navigation bar here -->
    
    <div class="container mt-5">
        <h2>Add Course for Advisor Level <?php echo $advisorLevel; ?></h2>
        <form method="POST">
            <input type="text" name="course_code" placeholder="Course Code" required>
            <input type="text" name="course_name" placeholder="Course Name" required>
            <input type="submit" name="add_course" value="Add Course">
        </form>
    </div>

    <!-- Add your footer and scripts here -->
</body>
</html>
