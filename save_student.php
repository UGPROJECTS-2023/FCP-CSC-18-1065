<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve student details from the form
$regNumber = $_POST['regNumber'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$phoneNumber = $_POST['phoneNumber'];
$email = $_POST['email'];
$address = $_POST['address'];

// Prepare the SQL statement to insert the data into the students table
$sql = "INSERT INTO student (regNumber, firstName, lastName, phoneNumber, email, address)
        VALUES ('$regNumber', '$firstName', '$lastName', '$phoneNumber', '$email', '$address')";

if ($conn->query($sql) === TRUE) {
    echo "Student details saved successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
header('Location: dashboard.php');
// Close the database connection
$conn->close();
?>
