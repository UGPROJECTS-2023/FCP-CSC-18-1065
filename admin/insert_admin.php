<?php
include'db_connect.php';;
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required POST parameters are set
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {
        // Retrieve POST data
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];


        // Prepare an SQL query to insert data into the 'admin' table (replace with your table name)
        $sql = "INSERT INTO admin (username, password, role) VALUES (?, ?, ?)";

        // Create a prepared statement
        $stmt = $conn->prepare($sql);

        // Bind parameters to the prepared statement
        $stmt->bind_param("sss", $username, $password, $role);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Insertion was successful
            echo "Admin data inserted successfully";
        } else {
            // Insertion failed
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement and the database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Incomplete or missing parameters"; // Handle missing parameters
    }
} else {
    echo "Invalid request"; // Handle non-POST requests
}
?>
