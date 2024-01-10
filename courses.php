<?php
session_start();

include 'db_connect.php';

if (!isset($_SESSION['Reg_number'])) {
    header("Location: login.php");
    exit;
}

$regNumber = $_SESSION['Reg_number'];

// Fetch course data from the database
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);

$courses = array(); // Initialize an array to store course data

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Catalog</title>
    <link rel="stylesheet" href="style1.css">
    <!-- Include your CSS and external libraries here -->
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

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
        <h1>Course Catalog</h1>
        <?php
        // Assuming you have already fetched course data into $courses array
        if (!empty($courses)) {
            // Group courses by academic level and semester
            $coursesByLevelSemester = array();

            foreach ($courses as $course) {
                $level = $course['Academic_Level'];
                $semester = $course['semester_id'];

                // Create an array for each level and semester if not exists
                if (!isset($coursesByLevelSemester[$level][$semester])) {
                    $coursesByLevelSemester[$level][$semester] = array();
                }

                // Add the course to the corresponding level and semester
                $coursesByLevelSemester[$level][$semester][] = $course;
            }

            // Loop through each academic level
            for ($level = 100; $level <= 400; $level += 100) {
                echo '<div class="catalog-container">';
                
                // Display tables for both semesters
                for ($semester = 1; $semester <= 2; $semester++) {
                    echo '<div class="semester-column">';
                    echo '<h2>' . ($semester === 1 ? 'First' : 'Second') . ' Semester for Level ' . $level . '</h2>';
                    echo '<table class="table table-striped table-bordered table-responsive">';
                    echo '<thead class="thead-dark">';
                    echo '<tr><th>Course ID</th><th>Course Name</th><th>Course Number</th><th>Course Detail</th></tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    // Check if there are courses for this level and semester
                    if (isset($coursesByLevelSemester[$level][$semester]) && is_array($coursesByLevelSemester[$level][$semester])) {
                        foreach ($coursesByLevelSemester[$level][$semester] as $course) {
                            echo '<tr>';
                            echo '<td>' . $course['course_id'] . '</td>';
                            echo '<td>' . htmlspecialchars($course['course_name']) . '</td>';
                            echo '<td>' . $course['course_number'] . '</td>';
                            echo '<td><a href="#" class="course-detail-link" data-course-id="' . $course['course_id'] . '">View Details</a></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4">No courses found for this level and semester.</td></tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>'; // End of semester-column
                }

                echo '</div>'; // End of catalog-container
            }
        } else {
            echo '<p>No courses found in the catalog.</p>';
        }
        ?>
    </div>

    <!-- Modal Popup -->
    <div id="courseModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Course Detail</h2>
            <p id="courseDetailText"></p>
        </div>
    </div>
</div>

    <script>


var modal = document.getElementById('courseModal');
// Get close button
var closeBtn = modal.querySelector('.close');

// Function to close modal
function closeModal() {
    modal.style.display = 'none';
}

// Function to open modal
function openModal(courseDetail) {
    document.getElementById('courseDetailText').textContent = courseDetail;
    modal.style.display = 'block';
}

// Close modal on close button click
closeBtn.addEventListener('click', closeModal);

// Close modal on outside click
window.addEventListener('click', function(event) {
    if (event.target === modal) {
        closeModal();
    }
});

       // Add click event to course detail links
var courseDetailLinks = document.getElementsByClassName('course-detail-link');
Array.from(courseDetailLinks).forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        var courseId = this.getAttribute('data-course-id');
        
        // Fetch course detail from the database based on courseId
        fetchCourseDetail(courseId);
    });
});

// Function to fetch course detail from the database
function fetchCourseDetail(courseId) {
    // Make an AJAX request to a PHP script that retrieves course detail from the database
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_course_detail.php?courseId=' + courseId, true);
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var courseDetail = xhr.responseText;
                openModal(courseDetail);
            } else {
                console.error('Error fetching course detail: ' + xhr.statusText);
            }
        }
    };
    
    xhr.send();
}




function myFunction() {
  var x = document.getElementById("mynav");
  if (x.className === "dashboard-container") {
    x.className += " responsive";
  } else {
    x.className = "dashboard-container";
  }
}

    </script>
</body>
</html>
