<?php
Include'db_connect.php';

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the admin ID from the form
    $adminId = $_POST["id"];

    // Get other admin information from the form (e.g., name, email, etc.)
    $adminName = $_POST["editUsername"];
    $adminEmail = $_POST["editPassword"];
    $role = $_POST['editRole'];

   
    $stmt = $conn->prepare("UPDATE admin SET username=?, password=?, role=? WHERE admin_id=?");
    
    // Execute the prepared statement with the updated values
    $stmt->bind_param("sssi", $adminName, $adminEmail,$role, $adminId);
    // $stmt->execute();

    if ($stmt->affected_rows > 0) {
     $response["success"] = true;
    } else {
       $response["success"] = false;
    }

    // Close the database connection
    $stmt->close();

    // Return the response as JSON
    header("Content-Type: application/json");
    echo json_encode($response);
} else {
    // Handle non-POST requests here (e.g., redirect to an error page)
    header("Location: error.php");
}
?>
