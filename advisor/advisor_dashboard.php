<?php
// Start or resume the session
session_start();
include'db_connect.php';

// Check if the advisor is logged in
if (!isset($_SESSION['advisor_id'])) {
    header('Location: advisor_login.php');
    exit();
}

// Retrieve the advisor's level from the session
$advisorLevel = $_SESSION['advisor_level'];
$advisorid = $_SESSION['advisor_id'];
$advisorname = $_SESSION['advisor_name'];

// In your PHP code, query the database to get the total number of students
$query = "SELECT COUNT(*) AS total_students FROM students where Academic_Level ='$advisorLevel'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalStudents = $row['total_students'];

// In your PHP code, query the database to get the courses based on advisor level
$query = "SELECT * FROM courseregistration WHERE Academic_Level = '$advisorLevel'";
$result = mysqli_query($conn, $query);
$courseCount = mysqli_num_rows($result);


// In your PHP code, query the database to get the total number of appointments
$query = "SELECT COUNT(*) AS total_appointments FROM appointments WHERE advisor_id = $advisorid";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalAppointments = $row['total_appointments'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the notification message from the form
    $message = $_POST['message'];



    // Construct the SQL query to retrieve student names with matching academic_level
    $query = "SELECT Reg_number, Fullname
              FROM students
              WHERE Academic_Level = '$advisorLevel'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Handle the query error, if any
        die("Error: " . mysqli_error($conn));
    }

    echo "Students with Academic Level '$advisorLevel':<br>";

    // Create an associative array to store student names and IDs
    $students = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $studentId = $row['Reg_number'];
        $studentName = $row['Fullname'];

        // Add the student name as the option text and student ID as the option value
        $students[$studentId] = $studentName;
    }


}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advisor Dashboard</title>
    <link rel="stylesheet" href="style1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-+0n0xqj4FWRz3Oy4TEvge5PIe5t5A2g8GDv1z1l/A2MWfR5vR7+3p2q5a5Fh5w5f5" crossorigin="anonymous"></script>

   <style>
    .container{
        box-decoration-break: clone;
        width: 100%;
        padding: 12px;
        
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
        <a href="manage_course.php"><i class="fas fa-cog"></i> Settings</a>
        <a href="manage_notifications.php"><i class="fas fa-cog"></i>Manage Notifications </a>
        <a href="profile.php"><i class="fas fa-book"></i> Profile</a>
       
        </nav>
        <div class="content">
            <h1>Welcome to the Advisor <?php echo $advisorname; ?></p></h1>
        </header>
        
        <section class="section">

            <div class="container">
    <div class="row">
        <!-- Total Number of Students Card -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Students</h5>
                    <p class="card-text"><?php echo $totalStudents; ?></p>
                </div>
            </div>
        </div>
        
        <!-- Courses Based on Advisor Level Card -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Courses (Advisor Level)</h5>
                    <p class="card-text"><?php echo $courseCount; ?></p>
                </div>
            </div>
        </div>
        
        
        <!-- Total Number of Appointments Card -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Appointments</h5>
                    <p class="card-text"><?php echo $totalAppointments; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

        </section>
        
        
        <section class="section">
            <h2>Appointments</h2>
            <table class="table table-bordered">
    <thead>
        <tr>
        <th>Appointment ID</th>
            <th>Student Name</th>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include"db_connect.php";
        // Assuming $appointments is an array containing appointment data
        $query = "SELECT * FROM appointments where advisor_id = $advisorid"; // Replace 'appointments' with your actual table name
$result = mysqli_query($conn, $query);

$appointments = array(); // Initialize an array to store appointment data

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $appointments[] = $row; // Add each row to the $appointments array
    }
} else {
    // Handle the case where the query fails
    echo "Error fetching appointments: " . mysqli_error($conn);
}

        foreach ($appointments as $appointment) {
            echo "<tr>";
            echo "<td>" . $appointment['id'] . "</td>";
            echo "<td>" . $appointment['Reg_number'] . "</td>";
            echo "<td>" . $appointment['appointment_date'] . "</td>";
            echo "<td>" . $appointment['appointment_time'] . "</td>";
            echo "<td>";
            echo "<button class='btn btn-success btn-sm approve-btn' data-appointment-id='" . $appointment['id'] . "'>Approve</button>";
            echo "<button class='btn btn-warning btn-sm reschedule-btn' data-appointment-id='" . $appointment['id'] . "'>Reschedule</button>";
            echo "</td>";
            echo "</tr>";
        }
        ?>

<div id="rescheduleModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reschedule Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Reschedule Appointment Form -->
                <form id="rescheduleForm">
                    <div class="form-group">
                        <label for="newDate">New Date:</label>
                        <input type="date" class="form-control" id="newDate" name="newDate" required>
                    </div>
                    <div class="form-group">
                        <label for="newTime">New Time:</label>
                        <input type="time" class="form-control" id="newTime" name="newTime" required>
                    </div>
                    <!-- Add more form fields here if needed -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
            </div>
        </div>
    </div>
</div>

</div>

    </tbody>
</table>
<?php include'manage_notifications.php';?>
    </div>
    </div>
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<!-- Your custom JavaScript code -->
<script>
$(document).ready(function() {
    // When the "Approve" button is clicked
    $('.approve-btn').click(function() {
        // Get the appointment ID from the button's data attribute
        var appointmentId = $(this).data('appointment-id');

        // Perform an action (e.g., make an AJAX request to approve the appointment)
        $.ajax({
            type: 'POST',
            url: 'approve_appointment.php', // Replace with your backend script
            data: { id: appointmentId }, // Use 'id' as the parameter name
            success: function(response) {
                if (response.success) {
                    // If the approval was successful, show a success alert
                    alert('Appointment approved successfully.');
                } else {
                    // If there was an error, show an error alert
                    alert('Error approving appointment.');
                }
            }
        });
    });

$(document).ready(function() {
    // When the "Reschedule" button is clicked
    $('.reschedule-btn').click(function() {
        // Get the appointment ID from the button's data attribute
        var appointmentId = $(this).data('appointment-id');

        // Open the modal for rescheduling
        $('#rescheduleModal').modal('show');

        // Pass the appointmentId to the modal for further processing (if needed)
        $('#rescheduleModal').data('appointment-id', appointmentId);
    });

    // When the "Save changes" button inside the modal is clicked
    $('#saveChanges').click(function() {
        // Get the rescheduling data from the form
        var newDate = $('#newDate').val();
        var newTime = $('#newTime').val();
        var appointmentId = $('#rescheduleModal').data('appointment-id'); // Retrieve the appointmentId

        // Perform an action (e.g., send the data to the server for rescheduling)
        $.ajax({
            type: 'POST',
            url: 'reschedule_appointment.php', // Replace with your backend script
            data: {
                appointmentId: appointmentId,
                newDate: newDate,
                newTime: newTime
            },
            success: function(response) {
                if (response.success) {
                    // If rescheduling was successful, show a success alert
                    alert('Appointment rescheduled successfully.');
                } else {
                    // If there was an error, show an error alert
                    alert('Error rescheduling appointment.');
                }
                // Close the modal
                $('#rescheduleModal').modal('hide');
            }
        });
    });
});


    // When the "Save changes" button inside the modal is clicked
    $('#saveChanges').click(function() {
        // Get the rescheduling data from the form
        var newDate = $('#newDate').val();
        var newTime = $('#newTime').val();
        var appointmentId = $('#rescheduleModal').data('appointment-id'); // Retrieve the appointmentId

        // Perform an action (e.g., send the data to the server for rescheduling)
        $.ajax({
            type: 'POST',
            url: 'reschedule_appointment.php', // Replace with your backend script
            data: {
                appointmentId: appointmentId,
                newDate: newDate,
                newTime: newTime
            },
            success: function(response) {
                if (response.success) {
                    // If rescheduling was successful, show a success alert
                    alert('Appointment rescheduled successfully.');
                } else {
                    // If there was an error, show an error alert
                    alert('Error rescheduling appointment.');
                }
                // Close the modal
                $('#rescheduleModal').modal('hide');
            }
        });
    });
});


</script>


    
</body>
</html>
