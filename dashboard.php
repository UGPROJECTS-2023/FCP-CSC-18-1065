<?php 
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['Reg_number'])) {
    header("Location: login.php"); 
    exit;
}

$regNumber = $_SESSION['Reg_number'];

$queryy = "SELECT * FROM appointments WHERE Reg_number = ?";
$stmt = mysqli_prepare($conn, $queryy);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $regNumber);
    mysqli_stmt_execute($stmt);
    
    $resultt = mysqli_stmt_get_result($stmt);

    $studentAppointments = array(); // Initialize an array to store student appointments

    while ($row = mysqli_fetch_assoc($resultt)) {
        $studentAppointments[] = $row; // Add each row to the $studentAppointments array
    }

    mysqli_stmt_close($stmt);
} else {
    // Handle the case where the prepared statement fails
    echo "Error preparing the statement: " . mysqli_error($conn);
}


// Fetch the profile picture image path from the database based on the registration number
$query = "SELECT Academic_Level FROM students WHERE Reg_number = '$regNumber'";

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $Academic_Level = $row['Academic_Level'];
} else {
    // Default image path if not found in the database
    $profilePicturePath = 'default-profile-image.png';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* styles.css */
body {
    background-color: whitesmoke;
    font-family: Arial, sans-serif;

    margin: 0;
    padding: 0;
   
}

.nav-link{
    float: right;
}

.courseCount {
    font-size: 24px;
    font-weight: bold;
    color: #3498db;
}
/* Style for the chatbot button */
#openChatbotButton {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
}

/* Style for the close icon */
#closeChatbotIcon {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px; /* Adjust the size as needed */
    color: #888; /* Adjust the color as needed */
    cursor: pointer;
}

/* Style for the chatbot container */
#chatbotContainer {
    display: none;
    position: fixed;
    bottom: 0;
    right: 0;
    width: 400px; /* Adjust this value as needed */
    height: 400px; /* Adjust this value as needed */
    border: 1px solid #888;
    background-color: #fefefe;
}
/* Style for the chatbot iframe */
iframe {
    width: 100%;
    height: 100%;
    border: none; /* Remove iframe border */
}
/* Style for the close icon */
.fas.fa-times {
    font-size: 16px; /* Adjust the size as needed */
    color: #888; /* Adjust the color as needed */
    margin-right: 5px; /* Add some spacing between the icon and text */
}


/* Style for the "Open Chatbot" button on hover */
#openChatbotButton:hover {
    background-color: #45a049;
}


   
   
   </style>
</head>
<body>
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
        <div class="container mt-4">
        <h1>Welcome :<?php echo "$regNumber"?></h1>
               <div class="row">
                 <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                
                    <h3 class="card-title">Academic Level</h3>
                    <?php
                    $hostname = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "studentadvisingsystem";

                    // Create a database connection
                    $conn = new mysqli($hostname, $username, $password, $database);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $query = "SELECT Academic_Level FROM students WHERE Reg_number = '$regNumber'";
                    $result = $conn->query($query);

                    if ($result) {
                        $row = $result->fetch_assoc();
                        $academicLevel = $row['Academic_Level'];
                        echo '<p class="card-text">' . $academicLevel . '</p>';
                    } else {
                        echo "Error executing query: " . $conn->error;
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">Notifications</div>
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
                            include'db_connect.php';
                            $regNumber = $_SESSION['Reg_number'];

                            // Construct the SQL query to fetch notifications based on registration number
                            $query = "SELECT  message,timestamp FROM notifications WHERE Reg_number = '$regNumber'";
                            
                            $result = mysqli_query($conn, $query);
                        
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
    </div>
</div>


<div class="container mt-4">
    <div class="card">
        <div class="card-header">Appointments</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($studentAppointments as $appointment) {
                        echo "<tr>";
                        echo "<td>" . $appointment['appointment_date'] . "</td>";
                        echo "<td>" . $appointment['appointment_time'] . "</td>";
                        echo "<td>" . $appointment['status'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<button id="openChatbotButton" class="btn btn-primary mt-4">Open Chatbot</button>

<!-- Chatbot container (hidden by default) -->
<div id="chatbotContainer" class="hidden">
    <i id="closeChatbotIcon" class="fas fa-times"></i>
    <!-- Chatbot iframe or content goes here -->
    <iframe src="chatbot/index.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
    <button id="closeChatbotButton" class="btn btn-danger mt-2">Close Chatbot</button>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>

    fetch('/dashboarddisplay.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('courseCount').textContent = data.count;
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            document.getElementById('courseCount').textContent = 'Error';
        });
 
   // Get the chatbot button and container elements
var openChatbotButton = document.getElementById('openChatbotButton');
var chatbotContainer = document.getElementById('chatbotContainer');
var closeChatbotButton = document.getElementById('closeChatbotButton');

// Show the chatbot container when the chatbot button is clicked
openChatbotButton.addEventListener('click', function () {
    chatbotContainer.style.display = 'block';
});

// Hide the chatbot container when the close button is clicked
closeChatbotButton.addEventListener('click', function () {
    chatbotContainer.style.display = 'none';
});
// Get the close icon element
var closeChatbotIcon = document.getElementById('closeChatbotIcon');

closeChatbotIcon.addEventListener('click', closeChatbotModal);




    </script>
      
    <script src="scrinpt.js"></script>
</body>
</html>
