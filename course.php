<?php
session_start();
require_once 'db_connect.php'; 

if (!isset($_SESSION['Reg_number'])) {
    header("Location: login.php"); 
    exit;
}

$regNumber = $_SESSION['Reg_number'];


$query = "SELECT * FROM students WHERE Reg_number = '$regNumber'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    
    header("Location: login.php");
    exit;
}

$userData = mysqli_fetch_assoc($result);


$academicYear = $userData['Academic_Level'];
$courseQuery = "SELECT * FROM courseregistration WHERE academic_level = '$academicYear'";
$courseResult = mysqli_query($conn, $courseQuery);

$courseData = array();
if ($courseResult) {
    while ($row = mysqli_fetch_assoc($courseResult)) {
        $courseData[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <title>Course</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="style1.css">
<style>
       .content{
        background-color: whitesmoke;
    
  }
   

  th{
    background-color: #04AA6D;
  }
     </style>
</head>
<body>
<header>
<div class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
    <i class="fas fa-university"></i> <span class="bold-text">FUD DUTSE</span>
   
    SAAS
  </a>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a href="logout.php" class="nav-link">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </li>
  </ul>
</div>

        <nav class="sidebar">
        <a href="dashboard.php" class="active"><i class="fas fa-home"></i> Home</a>
        <a href="courses.php"><i class="fas fa-book"></i> Course Catelog</a>
        <a href="course.php"><i class="fas fa-book"></i> Courses</a>
        <a href="gpa.php"><i class="fas fa-chart-bar"></i>GPA Calculator</a>
        <a href="schedule_appoinement1.php"><i class="fas fa-calendar"></i> Schedule</a>
        <a href="profile.php"><i class="fas fa-book"></i> Profile</a>
        <a href="report.php"><i class="fas fa-book"></i> Report Problem</a>
        </nav>

    <div class="content">
    
  <div class="container mt-5">
   <h2>Courses for <?php echo $academicYear; ?></h2>
   <?php
   if (!empty($courseData)) {
      echo '<h3>First Semester</h3>';
      echo '<div class="table-responsive">';
      echo '<table class="table table-striped table-bordered">';
      echo '<thead class="thead-dark">';
      echo '<tr><th>Course ID</th><th>Course Name</th></tr>';
      echo '</thead>';
      echo '<tbody>';
      foreach ($courseData as $course) {
         if ($course['academic_semester'] == 'First') {
            echo '<tr>';
            echo '<td>' . $course['course_code'] . '</td>';
            echo '<td>' . $course['course_name'] . '</td>';
            echo '</tr>';
         }
      }
      echo '</tbody>';
      echo '</table>';
      echo '</div>';

      echo '<h3>Second Semester</h3>';
      echo '<div class="table-responsive">';
      echo '<table class="table table-striped table-bordered">';
      echo '<thead class="thead-dark">';
      echo '<tr><th>Course ID</th><th>Course Name</th></tr>';
      echo '</thead>';
      echo '<tbody>';
      foreach ($courseData as $course) {
         if ($course['academic_semester'] == 'Second') {
            echo '<tr>';
            echo '<td>' . $course['course_code'] . '</td>';
            echo '<td>' . $course['course_name'] . '</td>';
            echo '</tr>';
         }
      }
      echo '</tbody>';
      echo '</table>';
      echo '</div>';
   } else {
      echo '<p>No courses found for this academic year.</p>';
   }
   ?>
</div>

<!-- Your footer and scripts here -->
</body>
</html>
