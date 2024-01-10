<?php
function getStudents() {
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

    // Fetch student data from the database
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);

    $students = array();

    if ($result->num_rows > 0) {
        // Loop through each row and store the data in the students array
        while ($row = $result->fetch_assoc()) {
            $student[] = $row;
        }
    }

    // Close the database connection
    $conn->close();

    return $student;
}
?>
