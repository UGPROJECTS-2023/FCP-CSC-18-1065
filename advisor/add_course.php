<?php
session_start();
include'db_connect.php';
if (!isset($_SESSION['advisor_id'])) {
    header("Location: advisor_login.php"); 
    exit;
}


// Function to fetch department options based on advisor's department
function fetchDepartmentsForAdvisor($advisorDepartment) {
  include'db_connect.php';
    // Escape the advisor's department to prevent SQL injection
    $escapedAdvisorDepartment = mysqli_real_escape_string($conn, $advisorDepartment);
    
    // Query to fetch departments based on advisor's department
    $query = "SELECT department_name FROM departments WHERE advisor_department = '$escapedAdvisorDepartment'";
    
    $departments = array();
    
    // Execute the query
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $departments[] = $row['department_name'];
        }
    }
    
    mysqli_close($conn);
    
    return $departments;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advisor Add Course</title>
    <link rel="stylesheet" href="style1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>

.content {
    margin-left: 250px;
    padding: 20px;
}

/* Form styling */
form {
    margin-top: 20px;
    border: 1px solid #ddd;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
}

form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

form input[type="text"],select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

form button[type="submit"] {
    background-color: #333;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
}

/* Responsive styles */
@media screen and (max-width: 768px) {
    .sidebar {
        width: 100%;
        position: relative;
    }
    
    .content {
        margin-left: 0;
    }
}
</style>

</head>
<body>

<div class="top-nav">
            <a href="#"><i class="fas fa-university"></i> FUD DUTSE Student Advising Portal</a>
            <a href="logout.php" style="float: right;"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </header>
    <div class="dashboard-container">
        <nav class="sidebar">
        <a href="advisor_dashboard.php" class="active"><i class="fas fa-home"></i> Home</a>
        <a href="add_course.php"><i class="fas fa-book"></i> Courses</a>
        <a href="send_notification.php"><i class="fas fa-bell"></i> Notifications</a>
        <a href="setting.php"><i class="fas fa-cog"></i> Settings</a>
        <a href="profile.php"><i class="fas fa-book"></i> Profile</a>
       
        </nav>
        
    <div class="content">
        <h2>Add Course</h2>
        <form id="addCourseForm">
            <label for="courseCode">Course Name:</label>
            <input type="text" id="courseName" name="courseName" required><br>
            
            <label for="courseCode">Course Code:</label>
            <input type="text" id="courseCode" name="courseCode" required><br>

            <label for="courseCode">Course Description:</label>
            <input type="text" id="courseDes" name="courseDes" required><br>

            <label for="Department">Department:</label>
            <select name="advisor_id" id="advisor">
    <?php
    include 'db_connect.php';

    $academicLevel = $userData['advisor_level'];

    $sql = "SELECT * FROM advisors WHERE advisor_level = '$academicLevel'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['advisor_id'] . "'>" . $row['advisor_name'] . "</option>";
        }
    } else {
        echo "Error fetching advisors: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    ?>
</select>

<label for="advisor">Advisor:</label>
<select name="advisor_id" id="advisor">
    <?php
    include 'db_connect.php';

    $academicLevel = $advisorLevel; // Use the advisor's academic level

    $sql = "SELECT * FROM advisors WHERE advisor_level = '$academicLevel'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['advisor_id'] . "'>" . $row['advisor_name'] . "</option>";
        }
    } else {
        echo "Error fetching advisors: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    ?>
</select>

            
            <button type="submit">Add Course</button>
        </form>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
