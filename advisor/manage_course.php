<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['advisor_id'])) {
    header("Location: advisor_login.php");
    exit;
}

$advisorLevel = $_SESSION['advisor_level'];

// Fetch courses based on advisor_level
$query = "SELECT * FROM courses WHERE Academic_Level1 = '$advisorLevel'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    $courses = [];
} else {
    $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Handle form submissions to add or edit courses
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_course'])) {
        // Handle adding a new course
        $courseCode = $_POST['course_number'];
        $courseName = $_POST['course_name'];

        $insertQuery = "INSERT INTO courses (course_number, course_name) VALUES ('$courseCode', '$courseName')";
        mysqli_query($conn, $insertQuery);

        header("Location: advisor_courses.php");
        exit;
    } elseif (isset($_POST['edit_course'])) {
        // Handle editing an existing course
        $courseId = $_POST['course_id'];
        $courseCode = $_POST['course_code'];
        $courseName = $_POST['course_name'];

        $updateQuery = "UPDATE courses SET course_number = '$courseCode', course_name = '$courseName' WHERE course_id = $courseId";
        mysqli_query($conn, $updateQuery);

        header("Location: add_course.php");
        exit;
    } elseif (isset($_POST['delete_course'])) {
        // Handle deleting a course
        $courseId = $_POST['course_id'];

        $deleteQuery = "DELETE FROM courses WHERE course_id = $courseId";
        mysqli_query($conn, $deleteQuery);

        header("Location: advisor_course.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advisor Courses</title>
    <!-- Add your CSS links here -->
</head>
<body>
    <!-- Add your navigation bar here -->
    
    <div class="container mt-5">
        <h2>Manage Courses for Advisor Level <?php echo $advisorLevel; ?></h2>
        <h3>Add Course</h3>
        <form method="POST">
            <input type="text" name="course_code" placeholder="Course Code" required>
            <input type="text" name="course_name" placeholder="Course Name" required>
            <input type="submit" name="add_course" value="Add Course">
        </form>

        <h3>Courses</h3>
        <table>
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course) : ?>
                    <tr>
                        <td><?php echo $course['course_number']; ?></td>
                        <td><?php echo $course['course_name']; ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="course_id" value="<?php echo $course['course_id']; ?>">
                                <input type="text" name="course_code" value="<?php echo $course['course_number']; ?>">
                                <input type="text" name="course_name" value="<?php echo $course['course_name']; ?>">
                                <input type="submit" name="edit_course" value="Edit">
                                <input type="submit" name="delete_course" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Add your footer and scripts here -->
</body>
</html>
