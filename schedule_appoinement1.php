<?php

session_start();
require'db_connect.php';
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

$courseQuery = "SELECT * FROM advisors WHERE advisor_level = '$academicYear'";
$courseResult = mysqli_query($conn, $courseQuery);

$courseData = array();
if ($courseResult) {
    while ($row = mysqli_fetch_assoc($courseResult)) {
        $courseData[] = $row;
    }
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $regNumber = $_SESSION['Reg_number'];
        $appointmentType = $_POST["appointment_type"];
        $selectedAdvisor = $_POST["advisor_id"];
        $selectedDate = $_POST["appointment_date"];
        $selectedTime = $_POST["appointment_time"];
        $reason = $_POST["reason"];
        // Insert appointment request into the database
        $sql = "INSERT INTO appointments (appointment_type, Reg_number, advisor_id, appointment_date, appointment_time, reason)
        VALUES ('$appointmentType', '$regNumber', '$selectedAdvisor', '$selectedDate', '$selectedTime', '$reason')";

if ($conn->query($sql) === TRUE) {
    $error ="<p>Appointment request submitted successfully!</p>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    }
    $conn->close();
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Schedule Appointment</title>
    <link rel="stylesheet" href="style1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
   

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        h1 {
            text-align: center;
            margin: 20px 0;
        }
        .container {
            width: 700px;
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        select, input[type="date"], input[type="time"], input[type="text"]{
            width: 90%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
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

    <div class="container mt-4">
    <h1>Schedule an Appointment</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="mb-3">
            <label for="appointment_type" class="form-label">Appointment Type:</label>
            <select class="form-select" name="appointment_type">
                <option value="academic_advising">Academic Advising</option>
                <option value="career_counseling">Career Counseling</option>
                <!-- Add more options as needed -->
            </select>
        </div>
        <div class="mb-3">
            <label for="advisor" class="form-label">Advisor:</label>
            <select class="form-select" name="advisor_id" id="advisor">
                <?php
                include 'db_connect.php';

                $academicLevel = $userData['Academic_Level'];

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
        </div>
        <div class="mb-3">
            <label for="appointment_date" class="form-label">Date:</label>
            <input type="date" class="form-control" name="appointment_date" required>
        </div>
        <div class="mb-3">
            <label for="appointment_time" class="form-label">Time:</label>
            <input type="time" class="form-control" name="appointment_time" required>
        </div>
        <div class="mb-3">
            <label for="reason" class="form-label">Reason:</label>
            <input type="text" class="form-control" name="reason" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit Appointment Request</button>
    </form>
</div>
</body>
</html>