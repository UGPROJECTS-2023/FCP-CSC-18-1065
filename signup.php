<?php
include 'db_connect.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $regNumber = $_POST["regNumber"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $academicLevel = $_POST["academic_level"];

    // Handle image upload
    $targetDirectory = "uploads/";

    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    $targetFile = $targetDirectory . basename($_FILES["student_image"]["name"]);

    if (move_uploaded_file($_FILES["student_image"]["tmp_name"], $targetFile)) {
        // Image uploaded successfully

        // Check if the registration number already exists in the database
        $checkQuery = "SELECT * FROM students WHERE Reg_number = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $regNumber);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            // Registration number already exists, show an error message
            $registrationError = "Registration number already exists.";
        } else {
            // Registration number is available, insert data into the database
            $sql = "INSERT INTO students (Reg_number, Fullname, email, password, Academic_Level, image) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $regNumber, $name, $email, $password, $academicLevel, $targetFile);

            if ($stmt->execute()) {
                // Data inserted successfully
                header("Location: success.php"); // Redirect to a success page
                exit();
            } else {
                // Handle database insertion error
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        // Handle image upload error
        echo "Sorry, there was an error uploading your image.";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Signup</title>
    <link rel="stylesheet" href="style1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
    <i class="fas fa-university"></i><span style="font-weight: bold;"> FUD DUTSE
    <br>
    Student Advising Portal
  </a>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a href="logout.php" class="nav-link">

      </a>
    </li>
  </ul>
</div>


  
<div class="container mt-5">
    <h1 class="mb-4">Student Signup</h1>
    <form action="signup.php" method="post" enctype="multipart/form-data">
    <div class="mb-3">
    <label for="regNumber" class="form-label">Reg Number:</label>
    <input type="text" class="form-control" id="regNumber" name="regNumber" pattern="^[A-Z]{3}\/[A-Z]{3}\/\d{2}\/\d{4}$">
    <small class="form-text text-muted">Pattern: FCP/CSC/18/1065</small>
    <?php if (isset($registrationError)) { ?>
        <div class="text-danger"><?php echo $registrationError; ?></div>
    <?php } ?>
</div>
<div id="regNumberStatus"></div> <!-- This will display the validation message -->

        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
    <label for="email" class="form-label">Email:</label>
    <input type="email" class="form-control" id="email" name="email" required>
    <?php if (isset($emailError)) { ?>
        <div class="text-danger"><?php echo $emailError; ?></div>
    <?php } ?>
</div>
<div id="emailStatus"></div> <!-- This will display the validation message -->

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="academic_level" class="form-label">Academic Level:</label>
            <select class="form-control" id="academic_level" name="academic_level" required>
                <option value="" selected disabled>Select Level</option>
                <option value="Level 1">Level 1</option>
                <option value="Level 2">Level 2</option>
                <option value="Level 3">Level 3</option>
                <option value="Level 4">Level 4</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="student_image" class="form-label">Upload Image:</label>
            <input type="file" class="form-control" id="student_image" name="student_image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to validate the registration number input
    function validateRegNumber() {
        const regNumberInput = document.getElementById('regNumber');
        const regNumberStatus = document.getElementById('regNumberStatus');
        const pattern = /^[A-Z]{3}\/[A-Z]{3}\/\d{2}\/\d{4}$/;
        const regNumber = regNumberInput.value.trim();

        if (!pattern.test(regNumber)) {
            regNumberStatus.innerHTML = 'Invalid registration number format. Please use the pattern FCP/CSC/XX/XXXX.';
        } else {
            // Use AJAX to check if the registration number already exists
            $.ajax({
                type: 'POST',
                url: 'check_reg_number.php', // Replace with the actual URL to your PHP script
                data: { regNumber: regNumber },
                success: function (response) {
                    if (response === 'exists') {
                        regNumberStatus.innerHTML = 'Registration number already exists.';
                    } else {
                        regNumberStatus.innerHTML = '';
                    }
                }
            });
        }
    }

    // Add an event listener to the registration number input for real-time validation
    const regNumberInput = document.getElementById('regNumber');
    regNumberInput.addEventListener('input', validateRegNumber);


    // Function to validate the email address input
    function validateEmail() {
        const emailInput = document.getElementById('email');
        const emailStatus = document.getElementById('emailStatus');
        const email = emailInput.value.trim();

        if (!validateEmailFormat(email)) {
            emailStatus.innerHTML = 'Invalid email address format.';
        } else {
            // Use AJAX to check if the email address already exists
            $.ajax({
                type: 'POST',
                url: 'check_email.php', // Replace with the actual URL to your PHP script
                data: { email: email },
                success: function (response) {
                    if (response === 'exists') {
                        emailStatus.innerHTML = 'Email address already exists.';
                    } else {
                        emailStatus.innerHTML = '';
                    }
                }
            });
        }
    }

    // Function to validate the email address format
    function validateEmailFormat(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }

    // Add an event listener to the email input for real-time validation
    const emailInput = document.getElementById('email');
    emailInput.addEventListener('input', validateEmail);

</script>


</body>
</html>
