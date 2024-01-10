<?php
session_start();
require_once 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure user is logged in
    if (!isset($_SESSION['Reg_number'])) {
        echo json_encode(['success' => false, 'message' => 'User not logged in']);
        exit;
    }

    // Retrieve form data
    $regNumber = $_SESSION['Reg_number'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if a new profile picture was uploaded
    if (!empty($_FILES['image']['name'])) {
        // Process the uploaded image here and update the database accordingly
        // You may need to move the uploaded file to a specific directory and store the file path in the database
        // Example:
        $targetDir = 'uploads/'; // Specify your target directory
        $imageName = $_FILES['image']['name'];
        $targetFilePath = $targetDir . $imageName;

        // Check if the file type is allowed (e.g., JPEG or PNG)
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        if ($imageFileType != 'jpg' && $imageFileType != 'png') {
            echo json_encode(['success' => false, 'message' => 'Invalid file type']);
            exit;
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            // Update the database with the new profile picture file path
            $updateQuery = "UPDATE students SET Fullname = '$fullname', email = '$email', password = '$password', image = '$targetFilePath' WHERE Reg_number = '$regNumber'";
        } else {
            echo json_encode(['success' => false, 'message' => 'Error uploading file']);
            exit;
        }
    } else {
        // Update the database without changing the profile picture
        $updateQuery = "UPDATE students SET Fullname = '$fullname', email = '$email', password = '$password' WHERE Reg_number = '$regNumber'";
    }

    // Perform the database update
    if (mysqli_query($conn, $updateQuery)) {
        echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'updating profile: ' . mysqli_error($conn)]);
        exit;
    }
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}
?>
