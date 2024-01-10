<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['advisor_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$advisorId = $_SESSION['advisor_id'];

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$office = $_POST['office'];

$query = "UPDATE advisors 
          SET advisor_name = '$name', advisor_email = '$email', 
              advisor_password = '$password', advisor_phone = '$phone', 
              advisor_office_location = '$office' 
          WHERE advisor_id = '$advisorId'";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(['success' => false, 'message' => 'Error updating profile: ' . mysqli_error($conn)]);
    exit;
}

echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);

mysqli_close($conn);
?>
