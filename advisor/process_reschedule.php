<?php
// Include database configuration and initialize the database connection
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the new date and time from the form submission
    $newDate = $_POST['new_date'];
    $newTime = $_POST['new_time'];

    // Validate and sanitize the input (you can add more validation as needed)
    $newDate = htmlspecialchars(trim($newDate));
    $newTime = htmlspecialchars(trim($newTime));

    // Check if the new date and time are valid (you can add more validation here)
    if (isValidDate($newDate) && isValidTime($newTime)) {
        // Retrieve the appointment ID from the form or session, assuming it's already set
        $appointmentId = $_POST['appointment_id']; // Change 'appointment_id' to your actual field name

        // Update the appointment in the database with the new date and time
        $updateQuery = "UPDATE appointments SET date = '$newDate', time = '$newTime' WHERE id = $appointmentId";

        if (mysqli_query($conn, $updateQuery)) {
            // Appointment successfully rescheduled
            echo "Appointment rescheduled successfully!";
        } else {
            // Error occurred while updating the appointment
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Invalid date or time format
        echo "Invalid date or time format. Please check your input.";
    }
}

// Function to validate the date format (you can customize this as needed)
function isValidDate($date) {
    return (bool) strtotime($date);
}

// Function to validate the time format (you can customize this as needed)
function isValidTime($time) {
    return preg_match('/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', $time);
}

// Close the database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reschedule Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Reschedule Appointment</h1>

        <!-- Display appointment details retrieved from the database -->
        <div class="mb-4">
            <h2>Current Appointment Details:</h2>
            <!-- Display current date, time, and other details here -->
        </div>

        <!-- Form for rescheduling the appointment -->
        <form method="post" action="process_reschedule.php">
            <div class="mb-3">
                <label for="new_date" class="form-label">New Date:</label>
                <input type="date" id="new_date" name="new_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="new_time" class="form-label">New Time:</label>
                <input type="time" id="new_time" name="new_time" class="form-control" required>
            </div>

            <!-- Add more fields as needed for location, additional details, etc. -->

            <button type="submit" class="btn btn-primary">Reschedule Appointment</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
