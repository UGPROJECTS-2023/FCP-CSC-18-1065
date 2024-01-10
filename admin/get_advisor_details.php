<?php
// Include your database connection script (e.g., db_connect.php)
include 'db_connect.php';

// Check if the advisor ID is provided via GET request
if (isset($_GET['advisorId'])) {
    $advisorId = $_GET['advisorId'];

    // Prepare and execute a SELECT query to retrieve advisor details
    $sql = "SELECT * FROM advisors WHERE advisor_id = $advisorId"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch advisor details as an associative array
        $advisor = $result->fetch_assoc();

        // Convert the advisor details to JSON format
        $response = json_encode($advisor);

        // Send the JSON response with advisor details
        header('Content-Type: application/json');
        echo $response;
    } else {
        // If no advisor found with the provided ID, return an empty JSON object or an error message
        header('Content-Type: application/json');
        echo json_encode(array());
    }
} else {
    // If advisor ID is not provided, return an error message or appropriate response
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Advisor ID not provided'));
}

// Close the database connection
$conn->close();
?>
