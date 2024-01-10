<?php

session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['Reg_number'])) {
    header("Location: login.php"); 
    exit;
}

$regNumber = $_SESSION['Reg_number'];

// Construct the SQL query to fetch notifications based on registration number
$query = "SELECT  message,timestamp FROM notifications WHERE Reg_number = '$regNumber'";

$result = mysqli_query($conn, $query);

if (!$result) {
    // Handle the query error, if any
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="style1.css">
</head>
<body>
<header>
        <div class="top-nav">
            <a href="#"><i class="fas fa-university"></i> Portal Name</a>
            <a href="logout.php" style="float: right;"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </header>
    <div class="dashboard-container">
        <nav class="sidebar">
        <a href="dashboard.php" class="active"><i class="fas fa-home"></i> Home</a>
        <a href="#"><i class="fas fa-book"></i> Courses</a>
        <div class="sub-menu">
        <a href="courses.php"><i class="fas fa-book"></i> Course Details</a>
        <a href="course.php"><i class="fas fa-book"></i> Enroll in Courses</a>
        </div>
        <a href="gpa.php"><i class="fas fa-chart-bar"></i> Grades</a>
        <a href="schedule_appoinement1.php"><i class="fas fa-calendar"></i> Schedule</a>
        <a href="notification.php"><i class="fas fa-bell"></i> Notifications</a>
        <a href="setting.php"><i class="fas fa-cog"></i> Settings</a>
        <div class="sub-menu">
        <a href="profile.php"><i class="fas fa-book"></i> Profile</a>
        <a href="Cus.php"><i class="fas fa-book"></i> Enroll in Courses</a>
        </nav>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            Notifications
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['timestamp'] . "</td>";
                        echo "<td>" . $row['message'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

