<?php
// Start a session to access session variables (if not already started)
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the student's registration number from the session
    if (isset($_SESSION['Reg_number'])) {
        $regNumber = $_SESSION['Reg_number'];

        // Retrieve and sanitize form data
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $problemType = htmlspecialchars($_POST["problemType"]);
        $description = htmlspecialchars($_POST["description"]);
    
        // Include your database connection configuration here
        require_once("db_connect.php"); // You need to create this file
        
        // Check if a file was uploaded
        if (isset($_FILES["file"]) && $_FILES["file"]["name"]) {
            $file = $_FILES["file"];
            $fileName = $file["name"];
            $fileTmpName = $file["tmp_name"];
            $fileType = $file["type"];
            $fileSize = $file["size"];
            
            // Move the uploaded file to a directory on your server
            $uploadDirectory = "uploads/"; // Specify the directory where you want to save the files
            $uploadedFile = $uploadDirectory . $fileName;
            
            if (move_uploaded_file($fileTmpName, $uploadedFile)) {
                // File upload successful
                // Now insert the report data, including evidence-related information, into the database
                
                $sql = "INSERT INTO reports (Reg_number, name, email, problem_type, description, filename)
                VALUES (?, ?, ?, ?, ?, ?)";
                
                // Prepare the SQL statement
                $stmt = $conn->prepare($sql);
                
                // Bind parameters
                $stmt->bind_param("ssssss", $regNumber, $name, $email, $problemType, $description, $fileName);
                
                // Execute the prepared statement
                if ($stmt->execute()) {
                    // Redirect to the confirmation page with a success message
                    header("Location: confirmation.php?message=success");
                    exit(); // Terminate the script to prevent further execution
                } else {
                    echo "Error: " . $sql . "<br>" . $stmt->error;
                }
                
                // Close the prepared statement
                $stmt->close();
            } else {
                // Handle file upload error
                echo "Error uploading file.";
            }
        } else {
            // If no file was uploaded, insert the report data without evidence-related information
            $sql = "INSERT INTO reports (Reg_number, name, email, problem_type, description)
            VALUES (?, ?, ?, ?, ?)";
            
            // Prepare the SQL statement
            $stmt = $conn->prepare($sql);
            
            // Bind parameters
            $stmt->bind_param("sssss", $regNumber, $name, $email, $problemType, $description);
            
            // Execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to the confirmation page with a success message
                header("Location: confirmation.php?message=success");
                exit(); // Terminate the script to prevent further execution
            } else {
                echo "Error: " . $sql . "<br>" . $stmt->error;
            }
            
            // Close the prepared statement
            $stmt->close();
        }

        // Close the database connection
        $conn->close();
    } else {
        // Handle the case where the registration number is not set in the session
        echo "Error: Registration number not found in session.";
    }
}
?>
