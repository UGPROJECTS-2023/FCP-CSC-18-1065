<?php
session_start();
include 'db_connect.php';

// Check if the user is logged in as an advisor
if (!isset($_SESSION['advisor_id'])) {
    header('Location: advisor_login.php');
    exit();
}

// Retrieve the advisor's information from the session
$advisorLevel = $_SESSION['advisor_level'];
$advisorId = $_SESSION['advisor_id'];
$advisorName = $_SESSION['advisor_name'];

// Initialize the students array
$students = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the notification message from the form
    $message = $_POST['message'];

    // Get the selected students from the form
    $selectedStudents = isset($_POST['students']) ? $_POST['students'] : [];

    // Insert notifications into the database for selected students
    if (!empty($selectedStudents)) {
        include 'db_connect.php'; // Make sure to include the database connection here

        $insertedNotifications = 0;

        foreach ($selectedStudents as $studentId) {
            $query = "INSERT INTO notifications (Reg_number, message, advisor_id) VALUES ('$studentId', '$message', '$advisorId')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $insertedNotifications++;
            } else {
                // Handle the query error, if any
                die("Error: " . mysqli_error($conn));
            }
        }

        // Close the database connection
        mysqli_close($conn);

        // Display a success message
        if ($insertedNotifications > 0) {
            $successMessage = "Notification sent to $insertedNotifications student(s) successfully.";
        }
    }
}

// Retrieve the list of students based on the advisor's level
include 'db_connect.php'; // Make sure to include the database connection here

$query = "SELECT Reg_number, Fullname FROM students WHERE Academic_Level = '$advisorLevel'";
$result = mysqli_query($conn, $query);

if (!$result) {
    // Handle the query error, if any
    die("Error: " . mysqli_error($conn));
}

// Create an associative array to store student names and IDs
$students = [];

while ($row = mysqli_fetch_assoc($result)) {
    $studentId = $row['Reg_number'];
    $studentName = $row['Fullname'];
    $students[$studentId] = $studentName;
}

// Close the database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Document</title>
<link rel="stylesheet" href="style1.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
       <style>
       #success-message {
    display: none;
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
    <div class="dashboard-container">
        <!-- Include your dashboard navigation/sidebar here -->

        <!-- Main content area -->
        <div class="content">
            <!-- Dashboard header -->
            <div class="dashboard-header">
                <!-- Add any header content here -->
            </div>

            <!-- Notification form section -->
            <div class="dashboard-section">
                <h2>Send Notification</h2>
                <form action="send_notification.php" method="post">
                    <div class="form-group">
                        <label for="message">Notification Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Select Students:</label><br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="select-all">
                            <label class="form-check-label" for="select-all">Select All</label>
                        </div>
                        <select class="form-control" multiple name="students[]" id="students">
                            <?php
                            include 'db_connect.php';
                            // Generate options from the $students array
                            foreach ($students as $studentId => $studentName) {
                                echo "<option value='$studentId'>$studentName</option>";
                           }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Notification</button>
                </form>
            </div>
        </div>
    </div>
    <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
    Students loaded successfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal fade" id="notificationSentModal" tabindex="-1" aria-labelledby="notificationSentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationSentModalLabel">Notification Sent</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Notification sent successfully.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <script>

function showSuccessMessage() {
    var successMessage = document.getElementById("success-message");
    successMessage.style.display = "block"; // Display the success message
    setTimeout(function () {
        successMessage.style.display = "none"; // Hide the success message after a few seconds
    }, 5000); // You can adjust the duration (in milliseconds)
}

// Function to handle the "Select All" checkbox
document.getElementById("select-all").addEventListener("change", function () {
    var selectAllCheckbox = this;
    var studentCheckboxes = document.querySelectorAll("#students option");

    studentCheckboxes.forEach(function (studentCheckbox) {
        studentCheckbox.selected = selectAllCheckbox.checked;
    });
});


function showSuccessMessage() {
    $('#notificationSentModal').modal('show'); // Display the modal
    setTimeout(function () {
        $('#notificationSentModal').modal('hide'); // Hide the modal after a few seconds
    }, 5000); // You can adjust the duration (in milliseconds)
}
</script>

</body>
</html>
